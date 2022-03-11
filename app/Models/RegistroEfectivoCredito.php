<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroEfectivoCredito extends Model
{
    use HasFactory;

    protected $fillable = [
        'venta_efectivo',
        'venta_credito',
        'year',
        'mes',
        'comentario',
    ];

    public function getMes()
    {
        return $this->hasOne(Mes::class,'id', 'mes');
    }
}
