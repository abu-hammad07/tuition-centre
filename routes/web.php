<?php

use App\Http\Controllers\ActionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});



Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('logout', [ProfileController::class, 'logoutUser'])->name('logoutUser');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users
    Route::get('users', [AdminController::class, 'userList'])->name('userList');
    Route::get('user/add', [AdminController::class, 'userAdd'])->name('userAdd');
    Route::post('user/add', [AdminController::class, 'userPost'])->name('userPost');
    Route::get('user/edit/{id}', [AdminController::class, 'userEdit'])->name('userEdit');
    Route::delete('user/{id}', [AdminController::class, 'userDestroy'])->name('userDestroy');
    
    // Students
    Route::get('students', [AdminController::class, 'studentList'])->name('studentList');
    Route::get('student/add', [AdminController::class, 'studentAdd'])->name('studentAdd');
    Route::post('student/add', [AdminController::class, 'studentPost'])->name('studentPost');
    Route::get('student/edit/{id}', [AdminController::class, 'studentEdit'])->name('studentEdit');
    Route::delete('student/{id}', [AdminController::class, 'studentDestroy'])->name('studentDestroy');


    // status enbale & desable
    Route::post('ajax_status', [ActionsController::class, 'ajax_status'])->name('ajax_status');
});

require __DIR__ . '/auth.php';
