<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $Users = User::all();
        return response()->json(['data' => $Users, 'message' => 'Users obtenidos correctamente'], 200);
    }

    public function show($id)
    {
        $User = User::find($id);

        if (!$User) {
            return response()->json(['message' => 'User no encontrado'], 404);
        }

        return response()->json(['data' => $User, 'message' => 'User obtenido correctamente'], 200);
    }

    public function store(Request $request)
    {
        // Validar los datos del User aquí
        $User = new User([
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password'=>Hash::make($request->input('password'))
        ]);

        $User->save();

        return response()->json(['data' => $User, 'message' => 'User creado correctamente'], 201);
    }

    public function update(Request $request, $id)
    {
        $User = User::find($id);

        if (!$User) {
            return response()->json(['message' => 'User no encontrado'], 404);
        }

        // Validar y actualizar los datos del User aquí
        $User->update([
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password'=>Hash::make($request->input('password'))
        ]);

        return response()->json(['data' => $User, 'message' => 'User actualizado correctamente'], 200);
    }

    public function destroy($id)
    {
        $User = User::find($id);

        if (!$User) {
            return response()->json(['message' => 'User no encontrado'], 404);
        }

        $User->delete();

        return response()->json(['message' => 'User eliminado correctamente'], 200);
    }
}
