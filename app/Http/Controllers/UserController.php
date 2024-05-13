<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updatePhone(Request $request)
    {
        $request->validate(['phone' => 'required|string']);
        $user = auth()->user();
        $user->phone = $request->phone;
        $user->save;      

        return back()->with('success', 'Teléfono actualizado con éxito.');
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'line_1' => 'required|string',
            'line_2' => 'nullable|string',
            'city' => 'required|string',
            'post_code' => 'required|string',
            'country' => 'required|string',
        ]);

        $address = new Address([
            'addressable_id' => auth()->id(),
            'addressable_type' => User::class,
            'line_1' => $request->line_1,
            'line_2' => $request->line_2,
            'city' => $request->city,
            'post_code' => $request->post_code,
            'country' => $request->country,
        ]);

        $address->save();

        return back()->with('success', 'Dirección actualizada con éxito.');
    }


}
