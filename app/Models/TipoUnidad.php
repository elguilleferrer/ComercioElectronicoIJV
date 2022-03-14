<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use DB;

class TipoUnidad extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','descripcion'];

    public function acumuladoCE()
    {
        return $this->belongsTo(Registro::class,'id','tipo_unidad_id');
    }

    public function acumuladoCEAA()
    {
        return $this->belongsTo(Registro::class,'id','tipo_unidad_id')->where('year',Carbon::now()->format('Y'));
    }

    public function ultimaActualizacion()
    {
        return $this->belongsTo(Registro::class,'id')->orderByDesc('id');
    }
}
