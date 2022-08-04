<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// TODO-1-0 Créer un contrôleur HomeController --> php artisan...
// TODO-1-1 Créer la méthode index pour renvoyer "hello world!"

// TODO-4-0 Créer un contrôleur "BookController" capable de traiter la ressource "Book" --> php artisan...
// TODO-4-1 Compléter la fonction "index" afin de retourner tous les livres

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
