<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Http\Requests\StoreRegistroRequest;
use App\Http\Requests\UpdateRegistroRequest;
use App\Models\TipoUnidad;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RegistroController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('registro.index');
    }

    public function getRegistros()
    {
        // Using Eloquent
        return DataTables::eloquent(Registro::query()->with('getTipoUnidad','getMes'))->make(true);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $tiposUnidad = TipoUnidad::all();
        $meses = [
            (object)[
                'id' => 1,
                'label' => 'Enero'
            ],
            (object)[
                'id' => 2,
                'label' => 'Febrero'
            ],
            (object)[
                'id' => 3,
                'label' => 'Marzo'
            ],
            (object)[
                'id' => 4,
                'label' => 'Abril'
            ],
            (object)[
                'id' => 5,
                'label' => 'Mayo'
            ],
            (object)[
                'id' => 6,
                'label' => 'Junio'
            ],
            (object)[
                'id' => 7,
                'label' => 'Julio'
            ],
            (object)[
                'id' => 8,
                'label' => 'Agosto'
            ],
            (object)[
                'id' => 9,
                'label' => 'Septiembre'
            ],
            (object)[
                'id' => 10,
                'label' => 'Octubre'
            ],
            (object)[
                'id' => 11,
                'label' => 'Nobiembre'
            ],
            (object)[
                'id' => 12,
                'label' => 'Diciembre'
            ],
        ];
        return view('registro.create', compact('tiposUnidad','meses'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \App\Http\Requests\StoreRegistroRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {

        $consulta = Registro::where([
            'tipo_unidad_id' => $request->tipo_unidad_id,
            'mes' => $request->mes,
            'year' => $request->year,
            ])->first();

            if($consulta){
                return redirect()->back()->with([
                    'status' => 500,
                    'message' => 'Nose pudo registrar ese tipo de unidad en el mes seleccionado ya está registrado',
                ]);
            }

            $registro = Registro::create($request->all());

            if($registro){
                return redirect()->back()->with([
                    'status' => 200,
                    'message' => 'Registro creado'
                ]);
            }else{
                return redirect()->back()->with([
                    'status' => 500,
                    'message' => 'El registro no se pudo crear'
                ]);
            }

        }

        /**
        * Display the specified resource.
        *
        * @param  \App\Models\Registro  $registro
        * @return \Illuminate\Http\Response
        */
        public function show(Registro $registro)
        {
            //
        }

        /**
        * Show the form for editing the specified resource.
        *
        * @param  \App\Models\Registro  $registro
        * @return \Illuminate\Http\Response
        */
        public function edit(Registro $registro)
        {
            $tiposUnidad = TipoUnidad::all();
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

            return view('registro.edit', compact('registro','tiposUnidad','meses'));
        }

        /**
        * Update the specified resource in storage.
        *
        * @param  \App\Http\Requests\UpdateRegistroRequest  $request
        * @param  \App\Models\Registro  $registro
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, Registro $registro)
        {
            if($registro->update($request->all())){
                return redirect()->back()->with([
                    'status' => 200,
                    'message' => 'Registro actualizado'
                ]);
            }else{
                return redirect()->back()->with([
                    'status' => 500,
                    'message' => 'El registro no se pudo actualizar'
                ]);
            }
        }

        /**
        * Remove the specified resource from storage.
        *
        * @param  \App\Models\Registro  $registro
        * @return \Illuminate\Http\Response
        */
        public function destroy(Registro $registro)
        {
            if($registro->delete()){
                return redirect()->back()->with([
                    'status' => 200,
                    'message' => 'Registro eliminado',
                ]);

            }else{
                return redirect()->back()->with([
                    'status' => 500,
                    'message' => 'El Registro no se pudo eliminar',
                ]);

            }
        }
    }