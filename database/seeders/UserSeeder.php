<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'full_name' => 'Thoriq Hanif',
            'username' => 'Thoriq',
            'telp' => '089669572100',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'entry_date' => '2024-02-01',
            'division_id' => '1',
            'position_id' => '1',
            'role_id' => '1',
        
        ]);

        $user->assignRole('superadmin');

    }
}
