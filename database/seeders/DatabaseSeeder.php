<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Super::factory(10)->create();
        \App\Models\Senior::factory(20)->create();
        \App\Models\Master::factory(30)->create();
        \App\Models\Agent::factory(40)->create();
        \App\Models\User::factory(50)->create();

        \App\Models\Admin::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => 'password',
        ]);

        $this->call([
            GameTypeSeeder::class,
            GameProviderSeeder::class,
        ]);
    }
}
