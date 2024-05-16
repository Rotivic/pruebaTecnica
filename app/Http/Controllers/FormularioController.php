<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreFormRequest;
use Illuminate\Http\RedirectResponse;

class FormularioController extends Controller
{
    public function mostrarLogin() {
        return view('login');
    }   

    public function mostrarFormulario()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Verificar si el usuario está autenticado
        if (!$user) {
            return redirect()->route('login')->with('error', 'Por favor, inicie sesión.');
        }
        // Construir el endpoint con los datos del usuario
        $url = 'http://212.225.255.130:8010/ws/accesotec/'. $user->i_user.'/' . $user->dni;
        
        // Hacer la solicitud HTTP para obtener los datos del usuario
        $response = Http::get($url);

        // Verificar que la solicitud fue exitosa
        if ($response->successful()) {
             // Obtener el cuerpo de la respuesta como cadena
             $responseBody = $response->body();
            
             // Parsear el XML
             $userData = simplexml_load_string($responseBody);
             // Convertir el objeto SimpleXML en un array
             $userData = json_decode(json_encode($userData), true);
 
            // Simplificar el array resultante
            $simplifiedUserData = [
                'Nombre' => $userData['Registro']['@attributes']['Nombre'],
                'Email' => $userData['Registro']['@attributes']['Email'],
            ];

             // Pasar los datos del usuario a la vista
             return view('formulario', ['user' => $simplifiedUserData]);
        } else {
            // Manejar el error de la solicitud
            return back()->with('error', 'No se pudieron obtener los datos del usuario.');
        }
      
        // Pasar los datos del usuario a la vista
        return view('formulario', ['user' => $userData]);
    }

  


    public function procesarFormulario(StoreFormRequest $request): RedirectResponse{
        // Validar los datos del formulario si es necesario
        // Validar los datos del formulario

        $validated = $request->validated();
        // Guardar los datos en la base de datos
        $user = Auth::user();
        $user->update($request->safe()->only(['nombre', 'email', 'sign']));

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

        // Mostrar mensaje de éxito o error
        return redirect()->route('formulario')->with('success', 'Formulario rellenado exitosamente.');
    }

}
