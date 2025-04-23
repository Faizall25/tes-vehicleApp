<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Approver 1',
            'email' => 'approver1@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'approver_1',
        ]);

        User::create([
            'name' => 'Approver 2',
            'email' => 'approver2@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'approver_2',
        ]);

        // Drivers
        Driver::factory()->count(5)->create();

        // Vehicles
        Vehicle::insert([
            ['name' => 'Toyota Hiace', 'type' => 'angkutan_orang', 'is_rented' => false, 'capacity' => 10],
            ['name' => 'Fuso Truk', 'type' => 'angkutan_barang', 'is_rented' => true, 'capacity' => 2000],
        ]);
    }
}
