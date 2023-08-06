<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::all();
        return response()->json(['data' => $cursos, 'message' => 'Cursos obtenidos correctamente'], 200);
    }

    public function show($id)
    {
        $curso = Curso::find($id);

        if (!$curso) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }

        return response()->json(['data' => $curso, 'message' => 'Curso obtenido correctamente'], 200);
    }

    public function store(Request $request)
    {
        // Validar los datos del curso aquí
        $curso = new Curso([
            'nombre' => $request->input('nombre'),
            'horas' => $request->input('horas'),
            // Otros campos del curso
        ]);

        $curso->save();

        return response()->json(['data' => $curso, 'message' => 'Curso creado correctamente'], 201);
    }

    public function update(Request $request, $id)
    {
        $curso = Curso::find($id);

        if (!$curso) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }

        // Validar y actualizar los datos del curso aquí
        $curso->update([
            'nombre' => $request->input('nombre'),
            'horas' => $request->input('horas'),
            // Otros campos a actualizar
        ]);

        return response()->json(['data' => $curso, 'message' => 'Curso actualizado correctamente'], 200);
    }

    public function destroy($id)
    {
        $curso = Curso::find($id);

        if (!$curso) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }

        $curso->delete();

        return response()->json(['message' => 'Curso eliminado correctamente'], 200);
    }
}
