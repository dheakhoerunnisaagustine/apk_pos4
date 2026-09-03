<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jenis')->insert([
            ['nama_jenis' => 'Makanan'],
            ['nama_jenis' => 'Minuman'],
        ]);
    }
}