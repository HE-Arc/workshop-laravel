<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::truncate();
        $books = [
            ['title' => 'Hunter x Hunter n°1', 'pages' => 110, 'quantity' => 1],
            ['title' => 'Hunter x Hunter n°2', 'pages' => 87, 'quantity' => 10],
            ['title' => 'Harry and the Poter', 'pages' => 123, 'quantity' => 11],
            ['title' => 'Youpi Lands', 'pages' => 9, 'quantity' => 0]
        ];
        foreach ($books as $book)
        {
            Book::create(array(
                'title' => $book["title"],
                'pages' => $book["pages"],
                'quantity' => $book["quantity"]
            ));
        }
    }
}
