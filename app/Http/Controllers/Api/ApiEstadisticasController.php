<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Registro;
use App\Models\TipoUnidad;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiEstadisticasController extends Controller
{
    public function informacionGeneral()
    {

        $tiposUnidad = TipoUnidad::all();

        $operacionesMonto = [];

        $labels = [];

        foreach ($tiposUnidad as $item) {
            $labels[] = $item->nombre;
            $operacionesMonto[] = [
                'label' => $item->nombre,
                'data' => [
                    Registro::where('tipo_unidad_id',$item->id)->where('year',Carbon::now()->format('Y'))->sum('monto'),
                    Registro::where('tipo_unidad_id',$item->id)->where('year',Carbon::now()->format('Y'))->sum('operaciones'),
                ]
            ];
        }

        return [
            'labels' => $labels,
            'datasets' => $operacionesMonto
        ];

    }
}
