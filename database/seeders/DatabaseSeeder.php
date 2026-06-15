<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin Sức Khỏe',
            'email' => env('ADMIN_EMAIL', 'annhien@gmail.com'),
            'password' => bcrypt(env('ADMIN_PASSWORD', 'annhien123@')),
        ]);

        $this->call([
            HealthConsultationSeeder::class,
        ]);
    }
}
