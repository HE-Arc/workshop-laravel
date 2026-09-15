<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// TODO-1-2 Remplacer la route "welcome" par la route "home" affichant le hello world

// TODO-7-1 Créer une route pour "order" en s'inspirant de la route "home"

// TODO-4-2 Ajouter la ressource BookController aux routes
