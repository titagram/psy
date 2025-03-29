<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\SessionType; 
use Illuminate\Database\Seeder;

class SessionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SessionType::factory()->create([
            'name' => 'Seduta di psicoterapia',
            'description' => 'Seduta standard 60 minuti',
            'minutes' => 60,
            'price' => 70
        ]);
    }
}
