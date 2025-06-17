<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InformasiMagang>
 */
class InformasiMagangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'deskripsi' => $this->faker->paragraph(),
            'persyaratan' => $this->faker->paragraph(),
            'benefit' => $this->faker->paragraph(),
            'info_kontak' => $this->faker->paragraph(),
            'slug' => 'informasi-magang'
        ];
    }
}
