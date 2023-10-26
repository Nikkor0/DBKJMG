<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class respuestaController extends Controller
{
    //
    /**
     *descripcion de prueba de clase de backends y apis
 * 
 * Esta es una descripción de nuestro método aqui no debería ser muy extensa la descripción.
 * @return \Illuminate\Http\Response
 *
 * @OA\Get(
 *     path="/api/ejecutar",
 *     tags={"ejecutar"},
 *     summary="Es un endpoint para obtener datos y mostrarlos al usuario",
 *     @OA\Response(
 *         response=200,
 *         description="Se devuelven todos los registros cuando la consulta cuando la consulta sea satisfactoria"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="No se pudo realizar la ejecución al parecer hubo un error interno"
 *     )
 * ) 
 */
    public function index() {
        return response()->json([
            "success"=>true, 
            "data"=>"Hola, soy Jonathan Marroquín Guzmán",
            "message"=>"Registro Encontrado",
            "ammount"=>1
        ]);
    }
}
