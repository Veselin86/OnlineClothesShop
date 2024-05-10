<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    public function index()
    {
        // Retorna una colección de usuarios
        return new UserCollection(User::all());
    }

    public function store(Request $request)
    {
        // Valida y crea un usuario nuevo
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create($validated);

        return new UserResource($user);
    }

    public function show(User $user)
    {
        // Muestra un usuario específico
        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        // Valida y actualiza un usuario existente
        $validated = $request->validate([
            'name' => 'sometimes|required|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:6',
        ]);

        $user->update($validated);

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        // Elimina un usuario
        $user->delete();

        return response()->json(null, 204); // No content
    }
}

