<?php

namespace Database\Seeders;

use App\Models\InformasiRiset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformasiRisetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InformasiRiset::factory(1)->create();
    }
}
