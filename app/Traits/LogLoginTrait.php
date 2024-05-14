<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

trait LogLoginTrait
{
    public function logCreation()
    {
        Log::info("Usuario creado con exito con nombre {$this->name} y correo electronico {$this->email}");
    }

    public function logLogin()
    {
        Log::info("Inicio de sesión de usuario " . Auth::user()->name . " con correo electronico " . Auth::user()->email);
    }

    public function logLogout()
    {
        Log::info("Cierre de sesión de usuario " . Auth::user()->name . " con correo electronico " . Auth::user()->email);
    }

    public function badCredentials($email)
    {
        Log::alert("Intento de login con email " . $email . " fallido debido a credenciales incorrectas.");
    }
}
