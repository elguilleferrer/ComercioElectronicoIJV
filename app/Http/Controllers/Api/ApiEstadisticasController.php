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
}
