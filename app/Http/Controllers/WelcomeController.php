<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

// TODO-1-0 DONE Créer un contrôleur "HomeController" --> php artisan...
// TODO-1-1 Créer la méthode index pphour renvoyer "hello world!"

// TODO-4-0 Créer un contrôleur "BookController" capable de traiter la ressource "Book" --> php artisan... --resource
// TODO-4-1 Compléter la fonction "index" afin de retourner tous les livres

// TODO-5-3 Relier les nouvelles vues aux méthodes de "BookController" et essayer d'accéder à chaque vues :
//      /books, /books/1, /books/1/edit, /books/create
// TODO-5-5 Compléter les méthodes du contrôleur "BookController"
// TODO-5-6 Ajouter un message de confirmation pour les méthodes store, update et destory du "BookController"
//      avec "->with(...)" et essayer le bouton "delete"

// TODO-6-0 Ajouter des validations dans "BookController.store"
//      - title : obligatoire, nb de charactère [5; 25]
//      - pages : obligatoire, entier, nombre ]0; 1000[
//      - quantity : obligatoire, entier, nombre [0; 100[
// TODO-6-3 Modifier "BookController.index" pour renvoyer 5 éléments uniquements et un numéro de page (pagination)

// TODO-7-2 Créer une méthode "order" dans le contrôleur "BookController" basé sur la méthode "index" qui
//      renvoie uniquement les livres ayant une quantité <= à 0

// TODO-8-10 Envoyer les auteurs sur la page "create" depuis la méthode "create" de "BookController"
// TODO-8-13 Ajouter la validation du champ auteur dans la méthode "store" de "BookController"

class WelcomeController extends Controller
{
    public function index() {
        $users = User::all();
        return view('welcome', ['users' => $users]);
    }
}
