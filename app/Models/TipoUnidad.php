<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class TipoUnidad extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','descripcion'];

    public function acumuladoCE()
    {
        return $this->belongsTo(Registro::class,'id');
    }

    public function ultimaActualizacion()
    {
        return $this->belongsTo(Registro::class,'id')->orderByDesc('id');
    }
}
