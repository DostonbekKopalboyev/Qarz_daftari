<?php

namespace Database\Seeders;

use App\Models\Costumer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CostumerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Costumer::create([
            'name' => "Dostonbek Ko'palboyev",
            'phone' => "+998 914269870",
            'address' => "Xonqa tumani Navxos qishlog'i Madaniyat mahallasi Mustaqillik ko'chasi-3",
            'description' => "Qarz daftari egasi",
        ]);
    }
}
