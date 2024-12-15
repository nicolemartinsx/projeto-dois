<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfessorController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return redirect('/login');
    });

    Route::post('/enviar-email', [PdfController::class, 'enviarEmail'])->name('enviar-selecionados');

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

        Route::get('/tabela', [PdfController::class, 'tabela'])->name('pdfs.tabela');
        Route::get('/pdfs', [PdfController::class, 'index'])->name('pdfs.index');
        Route::get('/pdfs/professor/{id}', [PdfController::class, 'tabelaProfessor'])->name('pdfs.professor');
        Route::post('/pdf/upload', [PdfController::class, 'uploadPDF'])->name('pdf.upload');
        Route::get('/pdfs/{id}', [PdfController::class, 'show'])->name('pdfs.show');
        Route::get('/pdfs/download/{id}', [PdfController::class, 'download'])->name('pdfs.download');
        Route::delete('/pdfs/{id}', [PdfController::class, 'deletar'])->name('pdfs.deletar');

        Route::get('/pdfs/{id}/selecao', [PdfController::class, 'compartilhar'])->name('pdfs.selecao');

        Route::get('/professors', [ProfessorController::class, 'index'])->name('professors');



        //rotas de confirmação pei
        Route::get('/pei/{dados}', [pdfController::class, 'confirmacaoPei'])->name('pei.confirmacao-pei');
        Route::get('/getpei/{dados}', [pdfController::class, 'getPei'])->name('pei.getpei');
        
        Route::post('/confirmar-leitura/{file}', [pdfController::class, 'confirmarLeitura'])->name('confirmar-leitura');

    });
});

// Requerendo rotas de autenticação adicionais
require __DIR__ . '/auth.php';
