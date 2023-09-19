<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Models\User;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

// TODO-1-2 Remplacer la route "welcome" par la route "home" affichant le hello world

// TODO-7-1 Créer une route pour "order" en s'inspirant de la route "home"

// TODO-4-2 Ajouter la ressource BookController aux routes
