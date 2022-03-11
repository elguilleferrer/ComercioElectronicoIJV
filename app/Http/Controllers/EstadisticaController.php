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
        $meses = [
            (object) [
                'id' => 1,
                'label' => 'Enero',
            ],
            (object) [
                'id' => 2,
                'label' => 'Febrero',
            ],
            (object) [
                'id' => 3,
                'label' => 'Marzo',
            ],
            (object) [
                'id' => 4,
                'label' => 'Abril',
            ],
            (object) [
                'id' => 5,
                'label' => 'Mayo',
            ],
            (object) [
                'id' => 6,
                'label' => 'Junio',
            ],
            (object) [
                'id' => 7,
                'label' => 'Julio',
            ],
            (object) [
                'id' => 8,
                'label' => 'Agosto',
            ],
            (object) [
                'id' => 9,
                'label' => 'Septiembre',
            ],
            (object) [
                'id' => 10,
                'label' => 'Octubre',
            ],
            (object) [
                'id' => 11,
                'label' => 'Nobiembre',
            ],
            (object) [
                'id' => 12,
                'label' => 'Diciembre',
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
