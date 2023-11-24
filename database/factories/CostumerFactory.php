<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Costumer>
 */
class CostumerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "Dostonbek Ko'palboyev",
            'phone' => "+998 914269870",
            'address' => "Xonqa tumani Navxos qishlog'i Madaniyat mahallasi Mustaqillik ko'chasi-3",
            'description' => "Qarz daftari egasi",
        ];
    }
}
