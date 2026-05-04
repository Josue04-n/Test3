<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//AUTORES
Route::get('/autores', [AutorController::class, 'index']);
Route::post('/autores', [AutorController::class, 'store']);
Route::put('/autores/{id}', [AutorController::class, 'update']);
Route::get('/autores/{nombre}', [AutorController::class, 'librosPorAutor']);

//LIBROS 
Route::get('/libros', [LibroController::class, 'index']);
Route::post('/libros', [LibroController::class, 'store']);
Route::get('/libros/buscar/{titulo}', [LibroController::class, 'buscarLibroTitulo']);
Route::put('/libros/{id}', [LibroController::class, 'update']);


