<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'clave' => 'required'
        ]);

        $persona = Persona::where('correo', $request->correo)->first();

        if (!$persona) {
            return response()->json(['error' => 'Correo no encontrado'], 404);
        }

        // Depuración: Imprimir claves para comparar
        $inputClave = $request->clave;
        $dbClave = $persona->clave;

        if ($inputClave === $dbClave) {
            return response()->json([
                'correo' => $persona->correo,
                'nombre' => $persona->nombre
            ]);
        } else {
            return response()->json([
                'error' => 'Clave incorrecta',
                'inputClave' => $inputClave,
                'dbClave' => $dbClave
            ], 401);
        }
    }
}
