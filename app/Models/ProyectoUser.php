<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoUser extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function usuario()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class,'proyecto_id');
    }
}
