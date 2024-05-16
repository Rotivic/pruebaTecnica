<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Obtener los datos enviados desde el formulario de inicio de sesión
        $usuario = $request->input('usuario');
        $dni = $request->input('dni');

        // Consultar la base de datos para verificar las credenciales del usuario
        $user = User::where('i_user', $usuario)->where('dni', $dni)->first();


        // Verificar si se encontró un usuario con las credenciales proporcionadas
        if ($user) {
                 

            // Usuario encontrado, iniciar sesión
            auth()->login($user);

            // Redirigir al usuario a la página de formulario
            return redirect()->route('formulario')->with(['success' => 'Inicio de sesión exitoso.' , 'user' => $user]);
        } else {
       
            // Usuario no encontrado, mostrar mensaje de error
            return redirect()->back()->with('error', 'Credenciales incorrectas. Por favor, inténtalo de nuevo.');
        }
    }
}
