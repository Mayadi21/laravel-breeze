<?php
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [MahasiswaController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/dashboard', [MahasiswaController::class, 'store'])->middleware(['auth', 'verified'])->name('mahasiswa.store');
Route::put('/dashboard/{id}', [MahasiswaController::class, 'update'])->middleware(['auth', 'verified'])->name('mahasiswa.update');
Route::delete('/dashboard/{id}', [MahasiswaController::class, 'destroy'])->middleware(['auth', 'verified'])->name('mahasiswa.destroy');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
