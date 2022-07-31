<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingcartController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomeController::class)->name('home');

Route::get('/Productos', [ProductController::class, 'products'])->name('products');

Route::get('/Productos/{product}', [ProductController::class, 'productOverview'])->name('product-overview');

Route::view('/Nosotros', 'about')->name('about');

Route::get('/Contacto', [ContactController::class, 'home'])->name('contact');

Route::post('/Contacto', [ContactController::class, 'send'])->name('contact.send');

Route::view('/Términos-y-Condiciones-Política-de-Privacidad', 'termsAndPrivacy')->name('termsAndPrivacy');

Route::get('/Carrito', ShoppingcartController::class)->name('cart');