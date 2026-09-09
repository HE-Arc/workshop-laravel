<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// TODO-3-4 Créer le seeder "BookSeeder" --> php artisan...
// TODO-3-5 Rajouter quelques livres
// TODO-3-7 Exécuter le seeder --> php artisan...


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::truncate();

        User::factory(10)->create();
        // TODO-3-6 Ajouter le seeder "BookSeeder" ici en utilisant "$this->call(...)"
    }
}
