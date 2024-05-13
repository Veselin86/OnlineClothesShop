<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }


        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        
        return response()->json(['data' => $user], 201);

        return new UserResource($user);
    }
/*     public function store(Request $request)
    {
        // Valida y crea un usuario nuevo
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create($validated);

        return new UserResource($user);
    } */

    public function show(User $user)
    {
        // Muestra un usuario específico
        return new UserResource($user);
    }

    public function edit(Request $request)
    {
        $users = User::findorFail($request->id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);

        $users->update();

        return response()->json('Updated Succesfully');
    }

    public function destroy(User $user)
    {
        // Elimina un usuario
        $user->delete();

        return response()->json('Deleted Succesfully'); // No content
    }

   public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::guard('api')->attempt($credentials)) {
            $user = Auth::guard('api')->user();
            $jwt = JWTAuth::attempt($credentials);
            $success = true;
            $data = compact('user', 'jwt');
            
            return compact('success', 'data');
        }else{
            $success = false;
            $message = ' Credenciales incorectas';
            return compact('success', 'message');
        }
    } 

    public function logout(){
        Auth::guard('api')->logout();
        $success = true;
        return compact('success');
    } 
}

