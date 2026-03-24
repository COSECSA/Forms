<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Program;
use App\Models\Trainer;
use App\Models\Trainee;
use App\Models\Submission;

class SubmissionController extends Controller
{
    public function create()
    {
        $hospitals = Hospital::orderBy('name')->get();
        $programs  = Program::orderBy('name')->get();
        return view('submission.create', compact('hospitals', 'programs'));
    }

    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'director_name'                         => 'required|string|max:255',
            'director_email'                        => 'required|email|max:255',
            'trainers'                              => 'required|array|min:1',
            'trainers.*.name'                       => 'required|string|max:255',
            'trainers.*.email'                      => 'required|email|max:255',
            'trainers.*.trainees'                   => 'required|array|min:1',
            'trainers.*.trainees.*.name'            => 'required|string|max:255',
            'trainers.*.trainees.*.email'           => 'required|email|max:255',
            'trainers.*.trainees.*.pen'             => 'nullable|string|max:100',
            'trainers.*.trainees.*.gender'          => 'nullable|string|max:50',
            'trainers.*.trainees.*.nationality'     => 'nullable|string|max:100',
        ]);

        // ── Hospital ──────────────────────────────
        if ($request->hospital_id === 'new') {
            $request->validate([
                'new_hospital_name'    => 'required|string|max:255',
                'new_hospital_country' => 'required|string|max:255',
            ]);
            $hospital = Hospital::firstOrCreate([
                'name'    => $request->new_hospital_name,
                'country' => $request->new_hospital_country,
            ]);
        } else {
            $request->validate([
                'hospital_id' => 'required|exists:hospitals,id',
            ]);
            $hospital = Hospital::findOrFail($request->hospital_id);
        }

        // ── Submission ────────────────────────────
        $submission = Submission::create([
            'director_name'  => $request->director_name,
            'director_email' => $request->director_email,
            'hospital_id'    => $hospital->id,
        ]);

        // ── Trainers & Trainees ───────────────────
        foreach ($request->trainers as $trainerData) {

            // Create trainer
            $trainer = Trainer::create([
                'name'        => $trainerData['name'],
                'email'       => $trainerData['email'],
                'hospital_id' => $hospital->id,
                'program_id'  => $trainerData['program_id'],
            ]);

            // Create trainees and link to trainer
            foreach ($trainerData['trainees'] as $traineeData) {
                $trainee = Trainee::updateOrCreate(
                    ['email' => $traineeData['email']],
                    [
                        'name'        => $traineeData['name'],
                        'pen'         => $traineeData['pen'] ?? null,
                        'gender'      => $traineeData['gender'] ?? null,
                        'nationality' => $traineeData['nationality'] ?? null,
                    ]
                );

                // Link trainee ↔ trainer (many-to-many)
                $trainer->trainees()->syncWithoutDetaching($trainee->id);
            }
        }

        return redirect()
            ->route('submission.create')
            ->with('success', 'Thank you! Your submission has been received successfully.');
    }
}