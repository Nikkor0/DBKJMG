<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AutoresTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_codigo_respuesta_endpoint(): void
    {
        $response = $this->get('/api/autores');

        $response->assertStatus(200);
    }

    public function test_cantidad_atributos_endpoint(): void
    {
        $response = $this->get('/api/autores');

        $response->assertJsonCount(11); //es la cantidad de registros que tiene la base de datos (11 rows returned)
    }

    public function test_estructura_respuesta_endpoint(): void
    {
        $response = $this->get('/api/autores');

        $response->assertJsonStructure([
            [
                "success",
                "message",
                "data",
                "errors",
                "rows"
            ]
        ]); 
    }

    public function test_valor_respuesta_endpoint(): void
    {
        $response = $this->get('/api/autores');

        $response->assertSee("Francisco Gavidia");
    }
}
