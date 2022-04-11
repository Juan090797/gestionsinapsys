<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
    public function clasificacion()
    {
        return $this->belongsTo(Clasificacion::class, 'clasificacions_id');
    }
    public function unidad()
    {
        return $this->belongsTo(UnidadMedida::class, 'unidad_medidas_id');
    }
}
