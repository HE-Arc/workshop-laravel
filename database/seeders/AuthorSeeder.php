<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = [
            ['name' => 'Spicy'],
            ['name' => 'Grunny']
        ];

        foreach ($authors as $author){
            Author::create(array(
                'name' => $author["name"],
            ));
        }
    }
}
