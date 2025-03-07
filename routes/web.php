<?php

use App\Http\Controllers\Backend\TaskAssignController;
use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\ProfileController;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $users = User::where('role','User')->get();

    $team = \App\Models\Team::pluck('name'); // Returns only team names

    return view('dashboard', compact('users', 'team'));
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/task-assign', TaskAssignController::class)->names('task-assign');
Route::resource('/task', TaskController::class)->names('task');
Route::resource('/team', TeamController::class)->names('team');

require __DIR__.'/auth.php';
