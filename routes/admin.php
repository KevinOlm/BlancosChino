<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified', 'auth.admin'])
    ->get('/', [HomeController::class, 'index'])->name('admin.home');

Route::middleware(['auth:sanctum', 'verified', 'auth.admin'])
    ->get('/Usuarios', [HomeController::class, 'users'])->name('admin.users');

Route::middleware(['auth:sanctum', 'verified', 'auth.admin'])
    ->get('/Productos', [HomeController::class, 'products'])->name('admin.products');

Route::middleware(['auth:sanctum', 'verified', 'auth.admin'])
    ->get('/Productos/Nuevo', [HomeController::class, 'productCreate'])->name('admin.productCreate');

Route::middleware(['auth:sanctum', 'verified', 'auth.admin'])
    ->get('/Productos/{id}', [HomeController::class, 'productEdit'])->name('admin.productEdit');

Route::middleware(['auth:sanctum', 'verified', 'auth.admin'])
    ->get('/Comentarios', [HomeController::class, 'comments'])->name('admin.comments');

Route::middleware(['auth:sanctum', 'verified', 'auth.admin'])
    ->get('/Compras', [HomeController::class, 'purchases'])->name('admin.purchases');

Route::middleware(['auth:sanctum', 'verified', 'auth.admin'])
    ->get('/Compras/{id}', [HomeController::class, 'purchasesDetails'])->name('admin.purchasesDetails');

Route::middleware(['auth:sanctum', 'verified', 'auth.admin'])
    ->get('/Categorías', [HomeController::class, 'categories'])->name('admin.categories');

Route::middleware(['auth:sanctum', 'verified', 'auth.admin'])
    ->get('/Tamaños', [HomeController::class, 'sizes'])->name('admin.sizes');