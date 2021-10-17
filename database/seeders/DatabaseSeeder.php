<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Author::truncate();
        Book::truncate();
        Schema::enableForeignKeyConstraints();

        \App\Models\User::factory(10)->create();
        $this->call(AuthorSeeder::class);
        $this->call(BookSeeder::class);
    }
}
