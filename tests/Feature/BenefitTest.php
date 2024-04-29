<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BenefitTest extends TestCase
{

    public function test_can_fetch_benefits_list(): void
    {
        $response = $this->getJson('/api/filtros');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'success',
                'data' => [
                    '*' => [
                        'id_programa',
                        'tramite',
                        'min',
                        'max',
                        'ficha_id',
                    ],
                ],
            ]);
    }

    public function test_can_fetch_valid_benefits_list(): void
    {
        $response = $this->getJson('/api/beneficios-validos');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'success',
                'data' => [
                    '*' => [
                        'year',
                        'num',
                        'beneficios' => [
                            '*' => [
                                'id_programa',
                                'monto',
                                'fecha_recepcion',
                                'fecha',
                                'ano',
                                'view',
                                'ficha' => [
                                    'id',
                                    'nombre',
                                    'id_programa',
                                    'url',
                                    'categoria',
                                    'descripcion',
                                ],
                            ],
                        ],
                    ],
                ],
            ])->assertJson([
                'code' => 200,
                'success' => true,
            ]);
    }

    public function test_can_fetch_benefits_of_user(): void
    {
        $user_id = 1;
        $response = $this->getJson('/api/beneficios/' . $user_id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'monto',
                        'fecha_recepcion',
                        'fecha',
                    ],
                ],
            ])->assertJson([
                'code' => 200,
                'success' => true,
            ]);
    }

    public function test_can_fetch_benefits_of_inexistent_user(): void
    {
        $user_id = 0;
        $response = $this->getJson('/api/beneficios/' . $user_id);

        $response->assertStatus(404)
            ->assertJsonStructure([
                'code',
                'success',
                'data' => [],
            ])->assertJson([
                'code' => 404,
                'success' => false,
                'data' => [],
            ]);
    }
}
