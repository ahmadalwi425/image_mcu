<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['nama_level' => 'Admin'],
            ['nama_level' => 'Capture'],
            ['nama_level' => 'View'],
        ];
        Level::insert($levels);
    }
}
