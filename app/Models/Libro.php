<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    //
    protected $table = 'libros';
    protected $fillable = [
        'titulo',
        'anio_publicacion',
        'autor_id',
    ];

    // Cada Libro pertenece a un autor 
    public function autor(){
       return $this->belongsTo(Autor::class, 'autor_id');
    }

}
