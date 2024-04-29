<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    public function test_can_fetch_documents()
    {
        $response = $this->getJson('/api/fichas');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'nombre',
                        'id_programa',
                        'url',
                        'categoria',
                        'descripcion',
                    ]
                ]
            ])->assertJson([
                'code' => 200,
                'success' => true
            ]);
    }
}
