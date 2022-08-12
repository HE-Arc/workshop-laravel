<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// TODO-3-0 Créer un modèle "Book" --> php artisan...
// TODO-3-1 Créer une migration pour le modèle "Book" nommée "create_books_table" --> php artisan...
// TODO-3-2 Rajouter quelques champs au livre dans la migration
// TODO-3-3 Exécuter la migration --> php artisan...

// TODO-8-0 Créer un modèle "Author" et sa migration en une seule commande --> php artisan...
// TODO-8-1 Ajouter un champ "name" à "Author"
// TODO-8-2 Relier "Book" et "Author" à l'aide d'une clée étrangère dans la table "Book"
//      1. Créer une migration nommée "add_author_fk_to_books" --> php artisan...
//      2. Relier la clée étrangère de la table "Book" (author_id) avec la clée primaire de "Author" (id)
//      2. Permettre à la clée étrangère d'être null, ajouter

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
