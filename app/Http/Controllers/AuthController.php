<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EndpointController;

class AuthController extends Controller
{

    public function mostrarLogin() {
        return view('login');
    }   

    public function login(Request $request)
    {
         // Validar los datos del formulario de inicio de sesión
         $credentials = $request->validate([
            'usuario' => ['required', 'string'],
            'dni' => ['required', 'string'],
        ]);

        // Buscar el usuario por i_user y dni
        $user = User::where('i_user', $request->usuario)->where('dni', $request->dni)->first();

        if ($user) {
            // Iniciar sesión manualmente
            Auth::login($user);
            $request->session()->regenerate();

            $externalData = (new EndpointController())->cargarEndpoint($user->i_user, $user->dni);

            if($externalData) {
                session(['user' => $externalData]);
            };

            return redirect()->intended('formulario')->with(['success' => 'Inicio de sesión exitoso.']);
        }

        return back()->withErrors([
            'dni' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->withInput($request->only('usuario', 'dni'));
    }
}
