<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\RegistroEfectivoCredito;
use App\Models\TipoUnidad;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DB;

class EstadisticaController extends Controller
{
    public function index(){
        $acumuladoEfectivoCredito = RegistroEfectivoCredito::sum(DB::raw('venta_efectivo + venta_credito'));
        $acumuladoComercioElectronico = Registro::sum(DB::raw("transfer_movil + post + enzona + tienda_virtual"));
        $tipoUnidades = TipoUnidad::all();
        return view('estadisticas.index', compact('acumuladoEfectivoCredito','acumuladoComercioElectronico','tipoUnidades'));
    }

    public function generales(){
        return view('estadisticas.generales');
    }

    public function especifica(Unidad $unidad, $year = null){

        if($year==null){
            $year = Carbon::now()->format('Y');
        }

        return view('estadisticas.especifica');
    }
}
