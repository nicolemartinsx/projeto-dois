<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PdfController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return redirect('/login');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware(['auth', 'verified', RoleMiddleware::class . ':admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/create', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users', [UserController::class, 'destroy'])->name('users.destroy');
    });

    

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     
     
        Route::get('/pdfs', [PdfController::class, 'index'])->name('pdfs.index');

        Route::post('/pdf/upload', [PdfController::class, 'uploadPDF'])->name('pdf.upload');
        Route::get('/pdfs/{id}', [PdfController::class, 'show'])->name('pdfs.show');
        Route::get('/pdfs/download/{id}', [PdfController::class, 'download'])->name('pdfs.download');
        Route::delete('/pdfs/{id}', [PdfController::class, 'deletar'])->name('pdfs.deletar');
    });
});

// Requerendo rotas de autenticação adicionais
require __DIR__ . '/auth.php';
