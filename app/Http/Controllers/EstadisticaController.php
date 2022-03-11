<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EstadisticaController extends Controller
{
    public function index(){
        return view('estadisticas.index');
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
