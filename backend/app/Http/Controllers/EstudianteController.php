<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{

    public function index()
    {
        $estudiantes = Estudiante::all();
        return response()->json(['data' => $estudiantes, 'message' => 'Estudiantes obtenidos correctamente'], 200);
    }

    public function show($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        return response()->json(['data' => $estudiante, 'message' => 'Estudiante obtenido correctamente'], 200);
    }

    public function store(Request $request)
    {
        // Validar los datos del estudiante aquí
        $estudiante = new Estudiante([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'foto' => $request->input('foto'),
            // Otros campos del estudiante
        ]);

        $estudiante->save();

        return response()->json(['data' => $estudiante, 'message' => 'Estudiante creado correctamente'], 201);
    }

    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        // Validar y actualizar los datos del estudiante aquí
        $estudiante->update([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'foto' => $request->input('foto'),
            // Otros campos a actualizar
        ]);

        return response()->json(['data' => $estudiante, 'message' => 'Estudiante actualizado correctamente'], 200);
    }

    public function destroy($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        $estudiante->delete();

        return response()->json(['message' => 'Estudiante eliminado correctamente'], 200);
    }
}
