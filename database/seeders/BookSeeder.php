<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// TODO-3-4 : cree avec php artisan make:seeder BookSeeder
class BookSeeder extends Seeder
{
    public function run(): void
    {
        // TODO-3-5 : quelques livres de depart
        \App\Models\Book::truncate();

        $books = [
            ['title' => 'Assassins Apprentice', 'pages' => 110, 'quantity' => 1],
            ['title' => 'Assassins Apprentice 2', 'pages' => 110, 'quantity' => 1],
            ['title' => 'The Hobbit', 'pages' => 245, 'quantity' => 10],
            ['title' => 'Nineteen Eighty-Four', 'pages' => 123, 'quantity' => 11],
            ['title' => 'The Black Prism', 'pages' => 345, 'quantity' => 0]
        ];

        foreach ($books as $book){
            \App\Models\Book::create(array(
                'title' => $book["title"],
                'pages' => $book["pages"],
                'quantity' => $book["quantity"]
            ));
        }
    }
}
