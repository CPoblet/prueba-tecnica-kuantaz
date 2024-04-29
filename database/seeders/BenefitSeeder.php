<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $benefits = [
            [
                'id' => 147,
                'min_amount' => 0,
                'max_amount' => 50000,
                'proccess' => 'Emprende',
            ],
            [
                'id' => 146,
                'min_amount' => 0,
                'max_amount' => 30000,
                'proccess' => 'Crece',
            ],
            [
                'id' => 130,
                'min_amount' => 5000,
                'max_amount' => 180000,
                'proccess' => 'Subsidio Único Familiar',
            ],
        ];

        foreach ($benefits as $benefit) {
            \App\Models\Benefit::create($benefit);
        }
    }
}
