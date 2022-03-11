<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Registro;
use App\Models\TipoUnidad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class ApiEstadisticasController extends Controller
{
    public function informacionGeneral()
    {

        $tiposUnidad = TipoUnidad::all();

        $operacionesMonto = [];

        $labels = [];

        $opciones = [
            (object)[
                'label' => 'Operaciones',
                'backgroundColor' => '#0078D7'
            ],
            (object)[
                'label' => 'Monto',
                'backgroundColor' => '#36893A'
            ],
        ];

        foreach ($tiposUnidad as $item) {
            $labels[] = $item->nombre;
        }

        foreach ($opciones as $opcion) {

            $data = [];

            foreach($tiposUnidad as $item){

                if($opcion->label == 'Operaciones'){
                    $data[] = Registro::where('tipo_unidad_id',$item->id)->sum('operaciones');
                }

                if ($opcion->label == 'Monto') {
                    $data[] = Registro::where('tipo_unidad_id', $item->id)->sum(DB::raw("transfer_movil + post + enzona + tienda_virtual"));
                }

            }

            $operacionesMonto[] = [
                'label' => $opcion->label,
                'data' => $data,
                'backgroundColor' => $opcion->backgroundColor
            ];

        }


        return [
            'labels' => $labels,
            'datasets' => $operacionesMonto
        ];

    }
}
