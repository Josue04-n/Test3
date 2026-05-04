<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Autor::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'correo' => 'sometimes|required|email',
        ]);

        //
        $autor = Autor::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
        ]);

        return response()->json([
            'message' => 'Autor Creado',
            'autor' => $autor,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Autor $autor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $autor = Autor::find($id);
 
        if (!$autor) {
            return response()->json(['message' => 'Autor no encontrado']);
        }
 
        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'correo' => 'sometimes|required|email',
        ]);
 
        $autor->update($request->only(['nombre', 'correo']));
 
        return response()->json([
            'message' => 'Autor actualizado exitosamente',
            'autor'   => $autor,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $autor = Autor::find($id);

        if (!$autor) {
            return response()->json([
                'message' => 'Autor no encontrado'
            ], 404);
        }
    
        $autor->delete();

        return response()->json([
            'message' => 'Autor eliminado exitosamente'
        ], 200);
    }

    public function librosPorAutor($nombre)
    {
        $autor = Autor::where('nombre', 'like', '%' . $nombre . '%')
                      ->with('libros')
                      ->first();
 
        if (!$autor) {
            return response()->json(['message' => 'Autor no encontrado'], 404);
        }
 
        return response()->json([
            'autor'  => $autor->nombre,
            'correo' => $autor->correo,
            'libros' => $autor->libros,
        ], 200);
    }
}
