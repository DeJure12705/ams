<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'admin_fname' => 'Test',
            'admin_lname' => 'User',
            'admin_uname' => 'TestUser',
            'admin_type' => 'super',
            'password' => '123',
            'admin_email' => 'test@example.com',
        ]);

        $this->call([
            FineSettingsSeeder::class
        ]);
    }
}
