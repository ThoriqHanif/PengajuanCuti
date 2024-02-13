<?php

namespace Database\Seeders;

use App\Models\Positions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Positions::create(['name' => 'Direktur', 'level' => '1']);
        Positions::create(['name' => 'Kepala Operasional', 'level' => '2']);
        Positions::create(['name' => 'Kepala Divisi', 'level' => '3']);
        Positions::create(['name' => 'Staff', 'level' => '4']);
    }
}
