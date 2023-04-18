<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);

        $user = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'username' => 'test',
            'email' => 'test@test.com'
        ]);

        $user->assignRole('Admin');
    }
}
