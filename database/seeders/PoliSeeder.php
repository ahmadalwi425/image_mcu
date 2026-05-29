<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poliData = [
            ['nama_poli' => 'Admin'],
            ['nama_poli' => 'Rekam Medis'],
            ['nama_poli' => 'Laboratorium'],
            ['nama_poli' => 'MCU Teratai'],
            ['nama_poli' => 'Poli Gigi'],
            ['nama_poli' => 'Radiologi'],
        ];
        Poli::insert($poliData);
    }
}
