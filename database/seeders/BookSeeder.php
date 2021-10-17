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
        $books = [
            ['title' => 'Hunter x Hunter n°1', 'pages' => 110, 'quantity' => 1, 'author_id' => 1],
            ['title' => 'Hunter x Hunter n°2', 'pages' => 87, 'quantity' => 10, 'author_id' => 1],
            ['title' => 'Harry and the Potter', 'pages' => 123, 'quantity' => 11, 'author_id' => 2],
            ['title' => 'Youpi Lands', 'pages' => 9, 'quantity' => 0, 'author_id' => 2]
        ];

        foreach ($books as $book){
            Book::create(array(
                'title' => $book["title"],
                'pages' => $book["pages"],
                'quantity' => $book["quantity"],
                'author_id' => $book["author_id"]
            ));
        }
    }
}
