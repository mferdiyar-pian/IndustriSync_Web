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
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin IndustriSync',
            'email' => 'admin@industrisync.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role_id' => 1, // Admin
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Owner Toko',
            'email' => 'owner@industrisync.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role_id' => 2, // Owner
        ]);

        \App\Models\User::factory()->create([
            'name' => 'User Biasa',
            'email' => 'user@industrisync.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role_id' => 4, // User
        ]);
    }
}
