<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AjaxController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware(['auth', 'verified']);
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

Route::get('/tasks', function () {
    return view('tasks'); // This assumes you have a blade view named tasks-page.blade.php
});

//Project routes//
Route::get('/projects', function () {
    return view('projects'); // This assumes you have a blade view named projects.blade.php
});
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects_store');
Route::get('/myprojects', [ProjectController::class, 'index'])->name('projects.index');
//Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');Display the data on the page.//

//Ojective routes//
Route::get('/objectives', [ObjectiveController::class, 'index'])->name('objectives.index');
Route::get('/objectives/create', [ObjectiveController::class, 'create'])->name('objectives.create');
Route::post('/objectives/store', [ObjectiveController::class, 'store'])->name('objectives.store');
Route::get('/objectives/show', [ObjectiveController::class, 'show'])->name('objectives.show');
Route::get('/objectives/edit', [ObjectiveController::class, 'edit'])->name('objectives.edit');
Route::put('/objectives/update', [ObjectiveController::class, 'update'])->name('objectives.update');
Route::delete('/objectives/destroy', [ObjectiveController::class, 'destroy'])->name('objectives.destroy');

//Contact routes//
Route::get('/contacts', [ContactController::class, 'index']);
Route::post('/addcontact', [ContactController::class, 'add']);
Route::delete('/delete/{id}', [ContactController::class, 'delete']);
Route::get('/edit/{id}', [ContactController::class, 'edit']);
Route::post('/edit/{id}', [ContactController::class, 'update']);

// Route for displaying the edit form
//Route::get('/edit/{id}', [ContactController::class, 'edit'])->name('contacts.edit');

// Route for updating the contact
//Route::post('/update/{id}', [ContactController::class, 'update'])->name('contacts.update');

Route::resource('ajax-crud', AjaxController::class);


