<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    //
    protected $table = 'autores';
    protected $fillable = [
        'nombre',
        'correo',
    ];

    // 1-->muchos
    public function Libros(){

        return $this->hasMany(Libro::class, 'autor_id');

    }
}
