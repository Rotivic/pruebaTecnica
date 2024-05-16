<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EndpointController extends Controller
{
    public function cargarEndpoint($i_user, $dni){


        // Construir el endpoint con los datos del usuario
        $url = 'http://212.225.255.130:8010/ws/accesotec/' . $i_user . '/' . $dni;
            
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
                'name' => trim($userData['Registro']['@attributes']['Nombre']),
                'email' => trim($userData['Registro']['@attributes']['Email']),
            ];

            // Almacenar los datos del usuario en la sesión
            // session(['user' => $simplifiedUserData]);

            // Pasar los datos del usuario a la vista
            return $simplifiedUserData;
        }
    }
}
