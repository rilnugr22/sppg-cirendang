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
        $super_admin = User::where('email', 'admin@sppg.com')->first();

        User::create([
            'name' => 'Admin SPPG',
            'email' => 'admin@sppg.com',
            'password' => Hash::make('password123'),
     
        ]);
    }
}
