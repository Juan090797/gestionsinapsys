<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function proyecto()
    {
        return $this->hasMany(Proyecto::class);
    }
    public function cotizaciones()
    {
        return $this->hasMany(Proyecto::class);
    }
}
