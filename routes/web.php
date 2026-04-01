<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});
// Public form routes
Route::get('/form', [App\Http\Controllers\SubmissionController::class, 'create'])->name('submission.create');
Route::post('/form', [App\Http\Controllers\SubmissionController::class, 'store'])->name('submission.store');
require __DIR__.'/auth.php';
// Admin routes (protected by auth)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/submissions', [App\Http\Controllers\AdminController::class, 'submissions'])->name('submissions');
    Route::get('/submissions/{submission}', [App\Http\Controllers\AdminController::class, 'show'])->name('submissions.show');
    Route::get('/export', [App\Http\Controllers\AdminController::class, 'export'])->name('export');
    Route::get('/trainers', [App\Http\Controllers\AdminController::class, 'trainers'])->name('trainers');
    Route::get('/trainers/export', [App\Http\Controllers\AdminController::class, 'exportTrainers'])->name('trainers.export');
    Route::get('/trainees', [App\Http\Controllers\AdminController::class, 'trainees'])->name('trainees');
    Route::get('/trainees/export', [App\Http\Controllers\AdminController::class, 'exportTrainees'])->name('trainees.export');
    Route::get('/specialties', [App\Http\Controllers\AdminController::class, 'specialties'])->name('specialties');
    Route::put('/specialties/{program}', [App\Http\Controllers\AdminController::class, 'updateSpecialty'])->name('specialties.update');
    Route::delete('/specialties/{program}', [App\Http\Controllers\AdminController::class, 'destroySpecialty'])->name('specialties.destroy');
    Route::get('/hospitals', [App\Http\Controllers\AdminController::class, 'hospitals'])->name('hospitals');
    Route::post('/hospitals/import', [App\Http\Controllers\AdminController::class, 'importHospitals'])->name('hospitals.import');
    Route::put('/hospitals/{hospital}', [App\Http\Controllers\AdminController::class, 'updateHospital'])->name('hospitals.update');
    Route::delete('/hospitals/{hospital}', [App\Http\Controllers\AdminController::class, 'destroyHospital'])->name('hospitals.destroy');
});
