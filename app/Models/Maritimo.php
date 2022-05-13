<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maritimo extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function costo()
    {
        return $this->morphOne(Costo::class, 'costeable');
    }
}
