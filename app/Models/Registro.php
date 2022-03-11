<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable = ['tipo_unidad_id', 'operaciones', 'year', 'mes', 'post', 'enzona', 'transfer_movil', 'tienda_virtual'];

    public function getTipoUnidad()
    {
        return $this->hasOne(TipoUnidad::class, 'id');
    }

    public function getMes()
    {
        return $this->hasOne(Mes::class,'id', 'mes');
    }
}