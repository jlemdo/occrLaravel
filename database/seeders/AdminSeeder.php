<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'John doe',
            'last_name' => 'Admin',
            'usertype' => 'admin',
            'email' => 'admin@admin.com',
            'state' => 'California',
            'password' => Hash::make('password')
        ]);
    }
}
