<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable=['categoria_id',
    'pregunta','a','b','c','d','explicacion','respuesta'];

    public function categoria(){
        return $this->belongsTo('App\Models\Categoria');
    }
}
