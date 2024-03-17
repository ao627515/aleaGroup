<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'ouedraogo abdoul aziz',
            'phone' => '73471085',
            'role' => 'admin'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'ouedraogo abdoul aziz',
            'phone' => '74289890',
            'role' => 'user'
        ]);
    }
}
