<?php

namespace Database\Seeders;

use App\Models\Rubric;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Client::factory(1)->create([
            'name' => "Test Client",
            'secret' => 'OoNa3SDhUIl2BUG5BPwbhs8xxW55VX5Bj6OKuV7U',
            'provider' => 'users',
            'password_client' => true,
        ]);
        // User::factory(10)->create();
        Rubric::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);
    }
}
