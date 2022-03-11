<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable = ['tipo_unidad_id','operaciones','monto','year'];

    public function getTipoUnidad()
    {
        return $this->hasOne(TipoUnidad::class,'id');
    }
}
