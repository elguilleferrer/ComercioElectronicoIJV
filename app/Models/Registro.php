<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable = ['tipo_unidad_id','operaciones','year','mes','venta_efectivo','venta_credito','post','enzona','transfermovil','tienda_virtual'];

    public function getTipoUnidad()
    {
        return $this->hasOne(TipoUnidad::class,'id');
    }
}