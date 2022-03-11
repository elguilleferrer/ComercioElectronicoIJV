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
        $operaciones = [];

        $totalVentas = 0;
        $totalOperaciones = 0;

        foreach ($tiposUnidad as $item) {
            $labels[] = $item->nombre;
            $enzona[] = $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum("enzona");
            $transfermovil[] = $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum("transfer_movil");
            $posts[] = $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum("post");
            $tiendavirtual[] = $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum("tienda_virtual");
            $operaciones[] = $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum('operaciones');
            $totalVentas = $totalVentas + $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum(DB::raw("transfer_movil + enzona + tienda_virtual + post"));
            $totalOperaciones = $totalOperaciones + $item->acumuladoCE()->where(['mes'=>$mes,'year'=>$year])->sum('operaciones');
        }

        return compact('enzona','transfermovil','posts','tiendavirtual','labels','operaciones','totalOperaciones','totalVentas');
    }

}
