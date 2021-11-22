<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $fillable =['nombre', 'celular_cont', 'correo_cont', 'area_cont', 'cargo_cont', 'cod_estado', 'cliente_id' ];
}
