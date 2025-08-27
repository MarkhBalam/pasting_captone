<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProgramController, FacilityController, ServiceController, EquipmentController,
    ProjectController, ParticipantController, OutcomeController
};

Route::get('/', fn() => redirect()->route('projects.index'));

Route::resource('programs', ProgramController::class);
Route::resource('facilities', FacilityController::class);
Route::resource('facilities.services', ServiceController::class)->shallow();
Route::resource('facilities.equipment', EquipmentController::class)->shallow();
Route::resource('projects', ProjectController::class);
Route::resource('participants', ParticipantController::class);

// Top-level Outcomes for index/show/edit/update
Route::resource('outcomes', OutcomeController::class)->only(['index','show','edit','update']);

// Nested Outcomes for create/store/destroy on a specific project
Route::resource('projects.outcomes', OutcomeController::class)->only(['create','store','destroy'])->shallow();

// Project ↔ Facility linking
Route::post('projects/{project}/facilities', [ProjectController::class,'attachFacility'])->name('projects.facilities.attach');
Route::delete('projects/{project}/facilities/{facility}', [ProjectController::class,'detachFacility'])->name('projects.facilities.detach');
