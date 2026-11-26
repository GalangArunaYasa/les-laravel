<?php

use App\Http\Controllers\CatatanController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rute catatan crud
    Route::get('/catatan', [CatatanController::class, 'index'])->name('catatan');
    Route::get('/catatan/add', [CatatanController::class, 'create'])->name('catatan.create');
    Route::post('/catatan', [CatatanController::class, 'store']);
    Route::get('/catatan/arsip', [CatatanController::class, 'arsip']);

    Route::get('/catatan/export', [CatatanController::class, 'export']);
    Route::get('/catatan/import', [CatatanController::class, 'importForm']);
    Route::post('/catatan/import', [CatatanController::class, 'import']);

    Route::get('/catatan/{id}', [CatatanController::class, 'show'])->name('catatan.show');
    Route::get('/catatan/{id}/edit', [CatatanController::class, 'edit'])->name('catatan.edit');
    Route::put('/catatan/{id}', [CatatanController::class, 'update'])->name('catatan.update');
    Route::delete('/catatan/{id}', [CatatanController::class, 'destroy'])->name('catatan.destroy');
     ///Rute untuk arsip catatan
    Route::post('/catatan/{id}/archive', [CatatanController::class, 'archive']);
    Route::post('/catatan/{id}/unarchive', [CatatanController::class, 'unarchive']);

    // Rute kontak
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
    Route::get('/kontak/add', [KontakController::class, 'create'])->name('kontak.create');
    Route::get('/kontak/{id}/edit', [KontakController::class, 'edit'])->name('kontak.edit');
    Route::delete('/kontak/{id}', [KontakController::class, 'destroy'])->name('kontak.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return redirect('/catatan');
});
Route::get('/halo', function () {
    return redirect('halo');
})->name('halo');

require __DIR__.'/auth.php';
