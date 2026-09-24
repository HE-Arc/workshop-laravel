<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// TODO-1-2
Route::get('/', [HomeController::class, 'index'])->name('home');

// TODO-7-1 : doit etre declaree AVANT la ressource, sinon /books/order
// est capture par books/{book} et renvoie 404
Route::get('books/order', [BookController::class, 'order'])->name('books.order');

// TODO-4-2
Route::resource('books', BookController::class);
