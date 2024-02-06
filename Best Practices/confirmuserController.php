<?php

namespace App\Http\Controllers;
use App\Services\UserInfoService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class confirmuserController extends Controller
{
    public function showForm()
    {
        return view('password.confirm-user');
    }


    public function procesarFormulario(Request $request)

    {
        //dd($request->all());
         // Obtiene el usuario autenticado
           $user = Auth::user();

           //dd('Usuario Autenticado:', $user);
           if (!$user) {
    return redirect()->route('confirm-user.show')->with('error', 'Usuario no autenticado');
}

        // Obtiene la información del usuario
        $info = UserInfoService::getUserInfo();
        //dd($info);
        // Verifica que $info no sea nulo antes de acceder a sus propiedades
        if (!$info) {
            return redirect()->route('confirm-user.show')->with('error', 'No se encontró información del usuario');
        }
        //dd('Datos del Formulario:', $request->all(), 'Información del Usuario:', $info);

        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        //$tipoDocumento = $request->input('tipo_documento');
        $numeroDocumento = $request->input('numero_documento');
        $correo = $request->input('correo');


        // Obtiene el usuario autenticado


        // Lógica para comparar los datos con la información del usuario
        if (
            $nombre == $info->first_name &&
            $apellido == $info->last_name &&
            //$tipoDocumento == $info->dni_type &&
            $numeroDocumento == $info->dni &&
            $correo == $user->email
        )

        {
            //dd('Comparación exitosa. Redireccionando a confirm-user.success', $nombre, $apellido,  $numeroDocumento, $correo, );
            // Datos válidos, puedes realizar alguna acción aquí
            return redirect()->route('confirm-user.success', ['success' => 'Datos procesados con éxito. Espere un momento mientras generamos su firma electrónica']);

        } else {
            //dd('Comparación fallida. Redireccionando a confirm-user.show', $nombre, $apellido,  $numeroDocumento, $correo, );
            // Datos inválidos, puedes realizar alguna acción aquí
            return redirect()->route('confirm-user.show')->with('error', 'Datos inválidos');
        }
    }
    public function success()
{
    return view('password.confirm-user-success');
}

}
