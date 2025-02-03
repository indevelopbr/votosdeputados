<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (is_null(User::first())) {
            User::create([
                'name'      => 'Votos Senadores',
                'email'     => 'contato@votossenadores.com.br',
                'password'  => Hash::make('password')
            ]);
        }
    }
}
