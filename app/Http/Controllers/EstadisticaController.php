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
        $acumuladoEfectivoCredito = RegistroEfectivoCredito::where('year',Carbon::now('Y'))->sum(DB::raw('venta_efectivo + venta_credito'));
        $acumuladoComercioElectronico = Registro::where('year',Carbon::now('Y'))->sum(DB::raw("transfer_movil + post + enzona + tienda_virtual"));
        $tipoUnidades = TipoUnidad::all();
        $meses = [
            (object) [
                'id' => 1,
                'label' => 'Enero',
                'acumulado' => Registro::where('mes',1)->where('year',Carbon::now()->format('Y'))->sum(DB::raw('transfer_movil + post + enzona + tienda_virtual')),
            ],
            (object) [
                'id' => 2,
                'label' => 'Febrero',
                'acumulado' => Registro::where('mes',2)->where('year',Carbon::now()->format('Y'))->sum(DB::raw('transfer_movil + post + enzona + tienda_virtual')),
            ],
            (object) [
                'id' => 3,
                'label' => 'Marzo',
                'acumulado' => Registro::where('mes',3)->where('year',Carbon::now()->format('Y'))->sum(DB::raw('transfer_movil + post + enzona + tienda_virtual')),
            ],
            (object) [
                'id' => 4,
                'label' => 'Abril',
                'acumulado' => Registro::where('mes',4)->where('year',Carbon::now()->format('Y'))->sum(DB::raw('transfer_movil + post + enzona + tienda_virtual')),
            ],
            (object) [
                'id' => 5,
                'label' => 'Mayo',
                'acumulado' => Registro::where('mes',5)->where('year',Carbon::now()->format('Y'))->sum(DB::raw('transfer_movil + post + enzona + tienda_virtual')),
            ],
            (object) [
                'id' => 6,
                'label' => 'Junio',
                'acumulado' => Registro::where('mes',6)->where('year',Carbon::now()->format('Y'))->sum(DB::raw('transfer_movil + post + enzona + tienda_virtual')),
            ],
            (object) [
                'id' => 7,
                'label' => 'Julio',
                'acumulado' => Registro::where('mes',7)->where('year',Carbon::now()->format('Y'))->sum(DB::raw('transfer_movil + post + enzona + tienda_virtual')),
            ],
            (object) [
                'id' => 8,
                'label' => 'Agosto',
                'acumulado' => Registro::where('mes',8)->where('year',Carbon::now()->format('Y'))->sum(DB::raw('transfer_movil + post + enzona + tienda_virtual')),
            ],
            (object) [
                'id' => 9,
                'label' => 'Septiembre',
                'acumulado' => Registro::where('mes',9) ->where('year',Carbon::now()->format('Y'))->sum(DB::raw('transfer_movil + post + enzona + tienda_virtual')),
            ],
            (object) [
                'id' => 10,
                'label' => 'Octubre',
                'acumulado' => Registro::where('mes',10)->where('year',Carbon::now()->format('Y'))->sum(DB::raw('transfer_movil + post + enzona + tienda_virtual')),
            ],
            (object) [
                'id' => 11,
                'label' => 'Noviembre',
                'acumulado' => Registro::where('mes',11)->where('year',Carbon::now()->format('Y'))->sum(DB::raw('transfer_movil + post + enzona + tienda_virtual')),
            ],
            (object) [
                'id' => 12,
                'label' => 'Diciembre',
                'acumulado' => Registro::where('mes',12)->where('year',Carbon::now()->format('Y'))->sum(DB::raw('transfer_movil + post + enzona + tienda_virtual')),
            ],
        ];
        return view('estadisticas.index', compact('acumuladoEfectivoCredito','acumuladoComercioElectronico','tipoUnidades','meses'));
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
