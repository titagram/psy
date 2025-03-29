<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 10 utenti con ruolo 'patient'
        User::factory()->count(10)->create(['role' => 'patient']);

        // utente admin
        User::factory()->create([
            'name' => 'Gabriele Tita',
            'email' => 'gabriele.tita@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        // utente terapeuta
        User::factory()->create([
            'name' => 'Laura Santi',
            'email' => 'laurasantipsicologa@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'therapist'
        ]);
    }
}
