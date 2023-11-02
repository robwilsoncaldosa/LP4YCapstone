<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Personnel;
use Illuminate\Support\Facades\Hash;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
       // Sample data
       $data = [
        [
            'name' => 'Rob Wilson Caldosa',
            'email' => 'caldozarobwilson@gmail.com',
            'password' => Hash::make('password'), // Hashed password
            'role' => 'admin',
            'status' => 'active',
        ],
        [
            'name' => 'Rogina Rolloque',
            'email' => 'roginarolloque@gmail.com',
            'password' => Hash::make('password'), // Hashed password
            'role' => 'staff',
            'status' => 'active',
        ],
    ];

    // Insert data
    foreach ($data as $item) {
        Personnel::create($item);
    }
    }
}
