<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book = new Book();

        $book->title = "Titre1";
        $book->pages = 132;
        $book->quantity = 2;

        $book->save();

        $book2 = new Book(['title' => 'Titre2', 'pages' => 155, 'quantity' => 1000]);
        $book2->save();
    }
}
