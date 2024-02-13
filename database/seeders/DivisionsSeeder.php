<?php

namespace Database\Seeders;

use App\Models\Divisions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Divisions::create([
            'name' => 'Marketing',
        ]);

        Divisions::create([
            'name' => 'Teknologi',
        ]);
    }

}
