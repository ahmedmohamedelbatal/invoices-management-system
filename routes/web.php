<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::prefix('profile')->middleware('auth')->group(function () {
  Route::get('/', [UserController::class, 'index'])->name('profile');
  Route::put('/update', [UserController::class, 'update'])->name('update-profile');
  Route::post('/change-password', [UserController::class, 'change_password'])->name('change_password');  
});

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::resource('invoices', InvoiceController::class)->middleware('auth');

Route::resource('sections', SectionController::class)->middleware('auth');

Route::resource('products', ProductController::class)->middleware('auth');

Route::get('section/{id}', [InvoiceController::class, 'GetProducts'])->middleware('auth');

Route::post('pay-invoice/{id}', [InvoiceController::class, 'PayInvoice'])->name('pay-invoice')->middleware('auth');