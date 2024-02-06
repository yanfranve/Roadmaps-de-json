<?php



namespace App\Http\Controllers;
use App\Services\UserInfoService;
use RealRashid\SweetAlert\Facades\Alert;




use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;



class PasswordController extends Controller
{
    public function showForm()
    {
        $info = UserInfoService::getUserInfo();
        return view('password.form', ['info' => $info]);

    }

    public function showVerifyForm(Request $request)
{
    // Obtiene el correo electrónico almacenado en la sesión
    $email = $request->session()->get('email');

    return view('password.verify', ['email' => $email]);
}

    public function sendCode(Request $request)
{
    $user = Auth::user();

    // Verificar si el usuario está autenticado y tiene un campo 'nombre'
    if ($user && $user->nombre) {
        // Obtener el correo electrónico del usuario autenticado
        $email = $user->email;
    } else {
        // Obtener el correo electrónico del formulario si el usuario no está autenticado
        $emailFromForm = $request->input('email');

        // Verificar si el correo del formulario coincide con el correo registrado en la base de datos
        $existingUser = User::where('email', $emailFromForm)->first();

        if (!$existingUser) {
            return redirect()->route('password.warning')->with('warningMessage', 'Correo no encontrado. Introduzca el correo con el que se registró.');
        }

        $email = $emailFromForm;
    }

    // Generar código de 5 dígitos
    $code = mt_rand(10000, 99999);
        //dd($code);

    // Enviar correo con el código
    Mail::to($email)->send(new \App\Mail\CodeMail($code));

    // Almacenar el código en la base de datos y en la sesión
    $request->session()->put('email', $email);
    $existingUser->update(['code' => $code]);

    $request->session()->put('success', 'Código enviado con éxito. Revise su correo electrónico.');

    return redirect()->route('verify');
}



    public function checkCode(Request $request)
{
    $email = $request->input('email');
    $code = $request->input('code');

    return $this->performCodeCheck($email, $code);

}

public function confirmCode(Request $request)

{

    $email = $request->input('email');
    $code = $request->input('code');




    return $this->performCodeCheck($email, $code, 'password.success', 'password.error');
}

private function performCodeCheck($email, $code, $successRoute = '/', $errorView = 'password.error')
{
    $user = User::where('email', $email)->whereRaw('BINARY code = ?', [$code])->first();

    if ($user) {

        // Verificar si el código ya fue utilizado
        if ($user->code_used) {
            return view($errorView)->with('error', 'Este código ya fue utilizado. Genera uno nuevo.');
        }
        $user->update(['code' => null, 'code_used' => true]); // Marcar el código como utilizado
        // Código correcto, realiza las acciones necesarias
        return redirect()->route('success')->with('success', 'Código correcto. Puedes continuar.');

    } else {
        // Código incorrecto, redirige a la vista de error
        return view($errorView)->with('error', 'Código incorrecto. Inténtalo de nuevo.');
    }
}

}





