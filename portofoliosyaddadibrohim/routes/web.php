<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/portfolio/all', [PortfolioController::class, 'allPortfolio'])->name('portfolio.all');
Route::get('/download-cv', [PortfolioController::class, 'downloadCV'])->name('download.cv');
Route::get('/download-portfolio', [PortfolioController::class, 'downloadPortfolio'])->name('download.portfolio');

// Admin Portfolio Routes
Route::prefix('admin')->group(function () {
    Route::get('/portfolio', [PortfolioController::class, 'adminIndex'])->name('admin.portfolio.index');
    Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('admin.portfolio.create');
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('admin.portfolio.store');
    Route::get('/portfolio/{id}/edit', [PortfolioController::class, 'edit'])->name('admin.portfolio.edit');
    Route::put('/portfolio/{id}', [PortfolioController::class, 'update'])->name('admin.portfolio.update');
    Route::delete('/portfolio/{id}', [PortfolioController::class, 'destroy'])->name('admin.portfolio.destroy');
    // Admin Client Routes
    Route::get('/clients', [PortfolioController::class, 'adminClientsIndex'])->name('admin.clients.index');
    Route::get('/clients/create', [PortfolioController::class, 'createClient'])->name('admin.clients.create');
    Route::post('/clients', [PortfolioController::class, 'storeClient'])->name('admin.clients.store');
    Route::delete('/clients/{id}', [PortfolioController::class, 'destroyClient'])->name('admin.clients.destroy');
});