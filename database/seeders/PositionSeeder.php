<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            'Store Manager',
            'Supervisor',
            'Cashier',
            'Sales Assistant',
            'Washer'
        ];

        foreach ($positions as $position) {
            \App\Models\Position::create(['name' => $position, 'description' => 'This is a ' . $position . ' position']);
        }
    }
}
