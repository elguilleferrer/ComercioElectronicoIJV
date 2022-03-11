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
        $labels = [];
        $montos = [];
        $operaciones = [];

        foreach ($tiposUnidad as $item) {
            $labels[] = $item->nombre;
            $montos[] = $item->acumuladoCE()->sum(DB::raw("transfer_movil + post + enzona + tienda_virtual"));
            $operaciones[] = $item->acumuladoCE()->sum('operaciones');
        }

        return [
            'labels' => $labels,
            'montos' => $montos,
            'operaciones' => $operaciones
        ];

    }

    public function informacionFiltro($mes, $year)
    {
        $tiposUnidad = TipoUnidad::all();
        $labels = [];

        $enzona = [];
        $transfermovil = [];
        $posts = [];
        $tiendavirtual = [];

        $totalesVirtuales = [
            'enzona' => 0,
            'transfermovil' => 0,
            'tiendavirtual' => 0,
            'posts' => 0
        ];

        $totalesOperaciones = [
            'enzona' => 0,
            'transfermovil' => 0,
            'tiendavirtual' => 0,
        ];

        foreach ($tiposUnidad as $item) {
            $labels[] = $item->nombre;
            $enzona[] = $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum("enzona");
            $transfermovil[] = $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum("transfer_movil");
            $posts[] = $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum("post");
            $tiendavirtual[] = $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum("tienda_virtual");

            $totalesVirtuales = [
                'enzona' => $totalesVirtuales['enzona'] + $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum("enzona"),
                'transfermovil' => $totalesVirtuales['transfermovil'] + $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum("transfer_movil"),
                'tiendavirtual' => $totalesVirtuales['tiendavirtual'] + $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum("tienda_virtual"),
                'posts' => $totalesVirtuales['posts'] + $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum("post"),
            ];

            $totalesOperaciones = [
                'enzona' =>  $totalesOperaciones['enzona'] + $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum('operaciones'),
                'transfermovil' =>  $totalesOperaciones['transfermovil'] + $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum('operaciones_tranf'),
                'tiendavirtual' =>  $totalesOperaciones['tiendavirtual'] + $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum('operaciones_tiendv'),
            ];

        }

        return compact(
            'enzona',
            'transfermovil',
            'posts',
            'tiendavirtual',
            'labels',
            'totalesVirtuales',
            'totalesOperaciones'
        );
    }

}
