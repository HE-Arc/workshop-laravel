<?php

namespace Database\Seeders;

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
        \App\Models\User::truncate();

        \App\Models\User::factory(10)->create();
        // TODO-3-6 Ajouter le seeder "BookSeeder" ici en utilisant "$this->call(...)"
        $this->call(BookSeeder::class);
    }
}
