<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\KeepBookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserStateController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sheet', function () {
    return Inertia::render('CharacterSheet');
})->middleware(['auth', 'verified'])->name('sheet');

Route::get('/skills', function () {
    return Inertia::render('Skill');
})->middleware(['auth', 'verified'])->name('skills');

Route::get('/keepbook', function () {
    return Inertia::render('Keepbook');
})->middleware(['auth', 'verified'])->name('keepbook');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Inventory
    Route::get('/inventory', [InventoryController::class, 'edit'])->name('inventory');
    Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory');
    Route::patch('/inventory', [InventoryController::class, 'update'])->name('inventory');
    Route::delete('/inventory', [InventoryController::class, 'destroy'])->name('inventory');

    // Keepbook
    Route::get('/keepbook', [KeepBookController::class, 'edit'])->name('keepbook');
    Route::post('/keepbook', [KeepBookController::class, 'store'])->name('keepbook');
    Route::patch('/keepbook', [KeepBookController::class, 'update'])->name('keepbook');
    Route::delete('/keepbook', [KeepBookController::class, 'destroy'])->name('keepbook');

    // User State
    Route::patch('/state', [UserStateController::class, 'update'])->name('userState');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
require __DIR__ . '/auth.php';
