<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GudangsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gudangs')->insert([
            [
                'nama_gudang' => 'Gudang 1',
                'kapasitas' => '1000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('gudangs')->insert([
            [
                'nama_gudang' => 'Gudang 2',
                'kapasitas' => '2000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
