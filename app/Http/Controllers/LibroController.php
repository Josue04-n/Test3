<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Libro::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'titulo' => 'required',
            'anio_publicacion' => 'required',
            'autor_id' => 'required'
        ]);

        $libro = Libro::create([
            'titulo' => $request->titulo,
            'anio_publicacion' => $request->anio_publicacion,
            'autor_id' => $request->autor_id,
        ]);

        return response()->json([
            'mesagge' => 'Libro Creado Exitosamente',
            'libro' => $libro->load('autor'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, $id)
    {
        $libro = Libro::find($id);
 
        if (!$libro) {
            return response()->json(['message' => 'Libro no encontrado']);
        }
 
        $request->validate([
            'titulo'           => 'sometimes|required',
            'anio_publicacion' => 'sometimes|required',
            'autor_id'         => 'sometimes|required|exists:autores,id',
        ]);
 
        $libro->update($request->only(['titulo', 'anio_publicacion', 'autor_id']));
 
        return response()->json([
            'message' => 'Libro actualizado exitosamente',
            'libro'   => $libro->load('autor'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        //
    }

    public function buscarLibroTitulo($titulo){
        $libro = Libro::where('titulo' , 'like' , '%' . $titulo . '%')
                      ->with('autor')
                      ->first();
        if (!$libro) {
            # code...
            return response()->json(['message' => 'Libro No Encontrado']);
        }
        return response()->json($libro);
    }

    public function autoresCombo(){
        $autores  = Autor::select('id','nombre') -> orderBy('nombre')->get();
        return response()->json($autores);
    }
}
