<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioIncidencia extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function usuario()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
