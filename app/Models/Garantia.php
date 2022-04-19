<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantia extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class,'garantia_id');
    }
    public function getFinAttribute()
    {
        if($this->fin_garantia){
            return Carbon::parse($this->fin_garantia)->format('d-m-Y');
        }else{
            return null;
        }
    }
}
