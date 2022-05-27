<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function costo()
    {
        return $this->belongsTo(Costo::class);
    }
}
