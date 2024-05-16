<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreFormRequest;
use Illuminate\Http\RedirectResponse;

class FormularioController extends Controller
{

    public function mostrarFormulario()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Verificar si el usuario está autenticado
        if (!$user) {
            return redirect()->route('/login')->with('error', 'Por favor, inicie sesión.');
        }

        return view('formulario');
  
    }
    
   


    public function procesarFormulario(StoreFormRequest $request): RedirectResponse{
        // Validar los datos del formulario si es necesario
        // Validar los datos del formulario

        $validated = $request->validated();
        // Guardar los datos en la base de datos
        $user = Auth::user();
        $user->update($request->safe()->only(['name', 'email', 'sign']));
        $user->save();
        // Generar el contenido HTML para el PDF
        $html = view('pdf.template', ['user' => $user])->render();

        // Configurar opciones de Dompdf si es necesario
        $pdfOptions = new Options();
        // Configurar opciones si es necesario

        // Crear instancia de Dompdf
        $pdf = new Dompdf($pdfOptions);

        // Cargar contenido HTML en Dompdf
        $pdf->loadHtml($html);

        // Renderizar PDF
        $pdf->render();

        // Enviar correo electrónico con el archivo PDF adjunto
        Mail::send('emails.template', ['user' => $user], function ($message) use ($user, $pdf) {
            $message->to($user->email)
                ->subject('Envío de fichero con datos de formulario')
                ->attachData($pdf->output(), 'formulario.pdf');
        });

        session()->flash('success', 'Formulario rellenado exitosamente.');

        // Eliminar datos de usuario de la sesión
        session()->forget('user');

        // Mostrar mensaje de éxito o error
        return redirect()->route('formulario');
    }

}
