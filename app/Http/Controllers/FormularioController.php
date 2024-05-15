<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\PDF;
use App\Models\User;


class FormularioController extends Controller
{
    public function mostrarLogin() {
        return view('login');
    }   

    public function mostrarFormulario() {
        return view('formulario');
    }

  


    public function procesarFormulario(Request $request){

        // Validar los datos del formulario si es necesario
        $request->validate([
            // Reglas de validación
        ]);
        // Guardar los datos en la base de datos
        $user = new User();
        $user->fill($request->all());
        $user->i_user = '123456444';
        $user->save();

        // Generar el archivo PDF
        $pdf = PDF::loadView('pdf.template', ['user' => $user]);

        // Enviar correo electrónico con el archivo PDF adjunto
        Mail::send('emails.template', ['user' => $user], function ($message) use ($user, $pdf) {
            $message->to($user->email)
                    ->subject('Asunto del correo electrónico')
                    ->attachData($pdf->output(), 'archivo.pdf');
        });

        // Mostrar mensaje de éxito o error
        return redirect()->back()->with('success', 'Los datos se han guardado correctamente.');
    }

}
