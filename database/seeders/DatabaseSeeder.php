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
        $this->call(RolePermissionSeeder::class);
         \App\Models\User::factory(300)->create()->each(function ($user) {
             $user->assignRole('admin');
         });
         \App\Models\User::factory(100)->create()->each(function ($user) {
             $user->assignRole('supervisor');
         });
        \App\Models\User::factory()->create([
            'name' => 'Mutiara NF',
            'email' => 'ara@gmail.com',
            'phone' => '1234567890',
            'status' => 1,

        ])->assignRole('superadmin');
        $this->call(PositionSeeder::class);
    }
}
