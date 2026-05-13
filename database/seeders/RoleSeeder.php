<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'Owner', 'slug' => 'owner'],
            ['name' => 'Staff', 'slug' => 'staff'],
            ['name' => 'User', 'slug' => 'user'],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create([
                'name' => $role['name'],
                'slug' => strtolower(trim($role['slug'])),
            ]);
        }
    }
}
