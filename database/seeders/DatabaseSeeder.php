<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

// TODO-3-4 Créer le seeder "BookSeeder" --> php artisan...
// TODO-3-5 Rajouter quelques livres
// TODO-3-7 Exécuter le seeder --> php artisan...

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
        // TODO-3-6 Ajouter le seeder "BookSeeder" ici
        $this->call(BookSeeder::class);
    }
}
