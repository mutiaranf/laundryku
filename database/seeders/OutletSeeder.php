<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $outlets = [
            'Outlet 1',
            'Outlet 2',
            'Outlet 3',
            'Outlet 4',
            'Outlet 5',
        ];

        foreach ($outlets as $outlet) {
            \App\Models\Outlet::create(['name' => $outlet, 'address' => 'This is the address of ' . $outlet,
                'phone' => '08123456789', 'photo' => null, 'latitude' => '0.000000',
                'longitude' => '0.000000', 'status' => 'active', 'start_operation' => '08:00:00',
                'end_operation' => '08:00:00'
            ]);
        }
    }
}
