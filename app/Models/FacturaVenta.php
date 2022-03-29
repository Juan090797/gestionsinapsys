<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaVenta extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
    public function documento()
    {
        return $this->belongsTo(TipoDocumento::class,'tipo_documento_id');
    }
}
