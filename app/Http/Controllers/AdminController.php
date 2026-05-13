<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Trainer;
use App\Models\Trainee;
use App\Models\Submission;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    // Dashboard — summary stats
    public function dashboard()
    {
        $stats = [
            'total_submissions' => Submission::count(),
            'total_hospitals'   => Hospital::count(),
            'total_trainers'    => Trainer::count(),
            'total_trainees'    => Trainee::count(),
        ];

        $recent = Submission::with('hospital')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent'));
    }

    // All submissions
    public function submissions(Request $request)
    {
        $search = $request->input('search');

        $submissions = Submission::with('hospital')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('director_name', 'like', "%{$search}%")
                      ->orWhere('director_email', 'like', "%{$search}%")
                      ->orWhereHas('hospital', fn($q) => $q->where('name', 'like', "%{$search}%"));
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $hospitals = Hospital::orderBy('name')->get();

        return view('admin.submissions', compact('submissions', 'search', 'hospitals'));
    }

    // Delete a submission along with its trainers and any trainees who become orphaned
    public function destroySubmission(Submission $submission)
    {
        $trainers = Trainer::where('submission_id', $submission->id)->with('trainees')->get();

        // Collect all trainee IDs linked to this submission's trainers
        $traineeIds = $trainers->flatMap(fn($t) => $t->trainees->pluck('id'))->unique();

        // Detach pivot rows and delete trainers
        foreach ($trainers as $trainer) {
            $trainer->trainees()->detach();
            $trainer->delete();
        }

        // Delete trainees that are now orphaned (no remaining trainer links)
        Trainee::whereIn('id', $traineeIds)
            ->whereDoesntHave('trainers')
            ->delete();

        $submission->delete();

        return response()->json(['ok' => true]);
    }

    // Inline update of submission director + hospital fields
    public function updateSubmission(Request $request, Submission $submission)
    {
        $data = $request->validate([
            'director_name'  => 'required|string|max:255',
            'director_email' => 'required|email|max:255',
            'hospital_id'    => 'required|exists:hospitals,id',
        ]);

        $submission->update($data);

        return response()->json([
            'director_name'  => $submission->director_name,
            'director_email' => $submission->director_email,
            'hospital_name'  => $submission->hospital->name,
        ]);
    }

    // Single submission detail
    public function show(Submission $submission)
    {
        $submission->load([
            'hospital',
            'hospital.trainers.program',
            'hospital.trainers.trainees',
        ]);

        return view('admin.show', compact('submission'));
    }

    // Trainers report
    public function trainers(Request $request)
    {
        $search = $request->input('search');

        $trainers = Trainer::with(['hospital', 'program', 'trainees'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhereHas('hospital', fn($q) => $q->where('name', 'like', "%{$search}%"))
                      ->orWhereHas('program', fn($q) => $q->where('name', 'like', "%{$search}%"));
                });
            })
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.trainers', compact('trainers', 'search'));
    }

    // Trainees report
    public function trainees(Request $request)
    {
        $search = $request->input('search');

        $trainees = Trainee::with(['trainers.hospital', 'trainers.program'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('pen', 'like', "%{$search}%")
                      ->orWhere('nationality', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.trainees', compact('trainees', 'search'));
    }

    // Export trainers as CSV
    public function exportTrainers(): StreamedResponse
    {
        $trainers = Trainer::with(['hospital', 'program', 'trainees'])->orderBy('name')->get();

        $response = new StreamedResponse(function () use ($trainers) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Trainer Name', 'Trainer Email', 'Hospital', 'Programme', 'Trainee Count']);
            foreach ($trainers as $trainer) {
                fputcsv($handle, [
                    $trainer->name,
                    $trainer->email,
                    $trainer->hospital->name ?? '—',
                    $trainer->program->name ?? '—',
                    $trainer->trainees->count(),
                ]);
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="cosecsa-trainers.csv"');
        return $response;
    }

    // Export trainees as CSV
    public function exportTrainees(): StreamedResponse
    {
        $trainees = Trainee::with(['trainers.hospital', 'trainers.program'])->orderBy('name')->get();

        $response = new StreamedResponse(function () use ($trainees) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Trainee Name', 'Trainee Email', 'PEN', 'Gender', 'Nationality', 'Hospital(s)', 'Programme(s)', 'Trainer(s)']);
            foreach ($trainees as $trainee) {
                fputcsv($handle, [
                    $trainee->name,
                    $trainee->email,
                    $trainee->pen ?? '—',
                    $trainee->gender ?? '—',
                    $trainee->nationality ?? '—',
                    $trainee->trainers->pluck('hospital.name')->filter()->unique()->implode(', ') ?: '—',
                    $trainee->trainers->pluck('program.name')->filter()->unique()->implode(', ') ?: '—',
                    $trainee->trainers->pluck('name')->implode(', ') ?: '—',
                ]);
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="cosecsa-trainees.csv"');
        return $response;
    }

    // Specialties list with trainer + trainee counts
    public function specialties()
    {
        $specialties = \App\Models\Program::with('trainers.trainees')
            ->orderBy('name')
            ->get()
            ->map(function ($program) {
                $program->trainer_count = $program->trainers->count();
                $program->trainee_count = $program->trainers
                    ->flatMap->trainees
                    ->unique('id')
                    ->count();
                return $program;
            });

        return view('admin.specialties', compact('specialties'));
    }

    // Update a specialty
    public function updateSpecialty(Request $request, \App\Models\Program $program)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $program->update(['name' => $request->name]);
        return redirect()->route('admin.specialties')->with('success', 'Specialty updated.');
    }

    // Delete a specialty
    public function destroySpecialty(\App\Models\Program $program)
    {
        $program->delete();
        return redirect()->route('admin.specialties')->with('success', 'Specialty deleted.');
    }

    // Hospitals list with trainee counts
    public function hospitals()
    {
        $hospitals = Hospital::with('trainers.trainees')
            ->orderBy('country')
            ->orderBy('name')
            ->get()
            ->map(function ($hospital) {
                $hospital->trainee_count = $hospital->trainers
                    ->flatMap->trainees
                    ->unique('id')
                    ->count();
                return $hospital;
            });

        return view('admin.hospitals', compact('hospitals'));
    }

    // Import hospitals from CSV
    public function importHospitals(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');

        $imported = 0;
        $skipped  = 0;
        $firstRow = true;

        while (($row = fgetcsv($handle)) !== false) {
            // Skip header row if it looks like one
            if ($firstRow) {
                $firstRow = false;
                if (isset($row[0]) && strtolower(trim($row[0])) === 'name') {
                    continue;
                }
            }

            $name    = trim($row[0] ?? '');
            $country = trim($row[1] ?? '');

            if ($name === '') {
                $skipped++;
                continue;
            }

            $exists = Hospital::where('name', $name)->exists();
            Hospital::firstOrCreate(['name' => $name], ['country' => $country]);
            $exists ? $skipped++ : $imported++;
        }

        fclose($handle);

        return redirect()->route('admin.hospitals')
            ->with('success', "Import complete: {$imported} hospitals added, {$skipped} skipped (already exist or blank).");
    }

    // Update a hospital
    public function updateHospital(Request $request, Hospital $hospital)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        $hospital->update([
            'name'    => $request->name,
            'country' => $request->country,
        ]);

        return redirect()->route('admin.hospitals')->with('success', "Hospital updated successfully.");
    }

    // Delete a hospital
    public function destroyHospital(Hospital $hospital)
    {
        $hospital->delete();
        return redirect()->route('admin.hospitals')->with('success', "Hospital deleted.");
    }

    // Export all data as CSV
    public function export(): StreamedResponse
    {
        $trainers = Trainer::with(['hospital', 'program', 'trainees'])->get();

        $response = new StreamedResponse(function () use ($trainers) {
            $handle = fopen('php://output', 'w');

            // CSV Headers
            fputcsv($handle, [
                'Hospital',
                'Trainer Name',
                'Trainer Email',
                'Programme',
                'Trainee Name',
                'Trainee Email',
            ]);

            foreach ($trainers as $trainer) {
                if ($trainer->trainees->isEmpty()) {
                    fputcsv($handle, [
                        $trainer->hospital->name ?? '',
                        $trainer->name,
                        $trainer->email,
                        $trainer->program->name ?? '',
                        '—',
                        '—',
                    ]);
                } else {
                    foreach ($trainer->trainees as $trainee) {
                        fputcsv($handle, [
                            $trainer->hospital->name ?? '',
                            $trainer->name,
                            $trainer->email,
                            $trainer->program->name ?? '',
                            $trainee->name,
                            $trainee->email,
                        ]);
                    }
                }
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="cosecsa-export.csv"');

        return $response;
    }
}
