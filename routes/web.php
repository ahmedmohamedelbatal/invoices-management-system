<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::prefix('/')->middleware('auth')->group(function () {
  Route::prefix('profile')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('profile');
    Route::put('/update', [UserController::class, 'update'])->name('update-profile');
    Route::post('/change-password', [UserController::class, 'change_password'])->name('change_password');
  });

  Route::get('/', [HomeController::class, 'index'])->name('home');

  Route::resource('invoices', InvoiceController::class);

  Route::resource('sections', SectionController::class);

  Route::resource('products', ProductController::class);

  Route::get('section/{id}', [InvoiceController::class, 'GetProducts']);

  Route::post('pay-invoice/{id}', [InvoiceController::class, 'PayInvoice'])->name('pay-invoice');

  Route::post('update-attachment', [InvoiceController::class, 'update_attachment'])->name('update-attachment');
});