<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ['user','admin'];
        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }

        \App\Models\User::factory(5)->create();
        \App\Models\Post::factory(20)->create();
        \App\Models\Comment::factory(20)->create();
    }
}
