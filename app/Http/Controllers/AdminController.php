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
    public function submissions()
    {
        $submissions = Submission::with('hospital')
            ->latest()
            ->paginate(15);

        return view('admin.submissions', compact('submissions'));
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
    public function trainers()
    {
        $trainers = Trainer::with(['hospital', 'program', 'trainees'])
            ->orderBy('name')
            ->paginate(20);

        return view('admin.trainers', compact('trainers'));
    }

    // Trainees report
    public function trainees()
    {
        $trainees = Trainee::with(['trainers.hospital', 'trainers.program'])
            ->orderBy('name')
            ->paginate(20);

        return view('admin.trainees', compact('trainees'));
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
