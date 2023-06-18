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
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'employee']);

        $users = \App\Models\User::factory(4)->create();

        foreach ($users as $user){
            $user->assignRole('employee');
        }

        $userAdmin = \App\Models\User::factory()->create([
            'name' => 'yonarias',
            'email' => 'yonarias@example.com',
        ]);
        $userAdmin->assignRole('admin');

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
