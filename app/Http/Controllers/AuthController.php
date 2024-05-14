<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Traits\LogLoginTrait;

class AuthController extends Controller
{

    use LogLoginTrait;

    public function register(Request $request)
    {
/*         
        $user = new user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
 */

        //Validacion de datos
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
        ]);

        //Crear nuevo usuario
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]); 

        // Opcional por si queremos logear el nuevo usuario directamente
        // Auth::login($user); 

        $user->logCreation();

        //Redirigir a la pagina de inicio o la ruta que deseamos
        return redirect()->route('home')->withSucces('¡Nuevo usario registrado correctamente!');
    }

    public function login(Request $request)
    {

        //Validacion de los datos
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.email' => 'Ingresa una dirección de correo electrónico valida.',
            'password.required' => 'El campo de contraseá es obligatorio.',
        ]);

        //Intentamos realizar el inicio de sesion
        if (Auth::attempt($credentials)) {
            //Regeneración del ID de la sesión
            $request->session()->regenerate();
            
            self::logLogin();

            //Si es exitosa, redirigirmos a dashboard u otra ruta deseada
            return redirect()->route('dashboard');
        }
    
        self::badCredentials($credentials['email']);

        //Si la autenticacion falla, redirigir al inicio de sesion con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }
    
    public function logout(Request $request)
    {
        self::logLogout();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
