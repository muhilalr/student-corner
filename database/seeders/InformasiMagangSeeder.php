<?php

namespace Database\Seeders;

use App\Models\InformasiMagang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InformasiMagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InformasiMagang::factory(1)->create();
    }
}
