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

        $opciones = ['Operaciones','Monto'];

        foreach ($tiposUnidad as $item) {
            $labels[] = $item->nombre;
        }

        foreach ($opciones as $opcion) {

            $data = [];

            foreach($tiposUnidad as $item){

                if($opcion == 'Operaciones'){
                    $data[] = Registro::where('tipo_unidad_id',$item->id)->sum('operaciones');
                }

                if ($opcion == 'Monto') {
                    $data[] = Registro::where('tipo_unidad_id', $item->id)->sum('monto');
                }

            }

            $operacionesMonto[] = [
                'label' => $opcion,
                'data' => $data,
            ];

        }


        return [
            'labels' => $labels,
            'datasets' => $operacionesMonto
        ];

    }
}