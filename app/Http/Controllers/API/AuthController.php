<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


/*use App\Http\Controllers\Controller;
use Illuminate\Http\Request;*/

class AuthController extends Controller
{
    //
    
    public function __construct(){
        $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                "success"=> true,
                "data"=>[
                    'user' => $user,
                    'authorization' => [
                        'token' => $user->createToken('Logueo')->plainTextToken,
                        'type' => 'bearer',
                    ]
                ],
                "message"=>"Inicio satisfactorio",
                "errors"=>"",
                "rows"=>1
            ],200);
        }else{
            return response()->json([
                "success"=> false,
                "data"=>"",
                'message' => 'Credenciales Inválidas',
                "errors" => "",
                "rows"=> 0
            ], 401);
        }
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            "success"=> true,
            "data"=>$user,
            'message' => 'Usuario creado satisfactoriamente',
            "errors" => "",
            "rows"=> 1
        ], 200);
    }

    public function logout(){
        Auth::user()->tokens()->delete();
        return response()->json([
            "success"=> true,
            "data"=>"",
            'message' => 'Sesión cerrada satisfactoriamente',
            "errors" => "",
            "rows"=> 1
        ], 200);
    }

    public function refresh(){
        return response()->json([
            "success"=> true,
            "data"=>[
                'user' => Auth::user(),
                'authorization' => [
                    'token' => Auth::refresh(),
                    'type' => 'bearer',
                ]
            ],
            'message' => 'Nuevo token generado',
            "errors" => "",
            "rows"=> 1
        ], 200);
    }
}
