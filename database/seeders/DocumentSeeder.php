<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 903,
                'name' => 'Crece',
                'url' => 'crece',
                'category' => 'trabajo',
                'description' => 'Subsidio para implementar plan de trabajo en empresas',
                'benefit_id' => 146,
            ],
            [
                'id' => 922,
                'name' => 'Emprende',
                'url' => 'emprende',
                'category' => 'trabajo',
                'description' => 'Fondos concursables para nuevos negocios',
                'benefit_id' => 147,
            ],
            [
                'id' => 2042,
                'name' => 'Subsidio Familiar (SUF)',
                'url' => 'subsidio_familiar_suf',
                'category' => 'bonos',
                'description' => 'Beneficio económico mensual entregado a madres, padres o tutores que no cuentan con previsión social.',
                'benefit_id' => 130,
            ],
        ];

        foreach ($data as $document) {
            \App\Models\Document::create($document);
        }
    }
}
