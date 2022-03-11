<?php

namespace App\Http\Controllers;

use App\Models\RegistroEfectivoCredito;
use App\Http\Requests\StoreRegistroEfectivoCreditoRequest;
use App\Http\Requests\UpdateRegistroEfectivoCreditoRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RegistroEfectivoCreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('efectivo_credito.index');
    }

    public function getRegistros()
    {
        // Using Eloquent
        return DataTables::eloquent(RegistroEfectivoCredito::query()->with('getMes'))->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        return view('efectivo_credito.create', compact('meses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRegistroEfectivoCreditoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consulta = RegistroEfectivoCredito::where([
            'mes' => $request->mes,
            'year' => $request->year,
        ])->first();

        if($consulta){
            return redirect()->back()->with([
                'status' => 500,
                'message' => 'Nose pudo completar el registro porque ya esta información se encuentra en el sistema, en el mes seleccionado',
            ]);
        }

        $registro = RegistroEfectivoCredito::create($request->all());

        if($registro){
            return redirect()->back()->with([
                'status' => 200,
                'message' => 'Registro efectivo-credito creado'
            ]);
        }else{
            return redirect()->back()->with([
                'status' => 500,
                'message' => 'El registro efectivo-credito no se pudo crear'
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegistroEfectivoCredito  $registroEfectivoCredito
     * @return \Illuminate\Http\Response
     */
    public function show(RegistroEfectivoCredito $registroEfectivoCredito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RegistroEfectivoCredito  $registroEfectivoCredito
     * @return \Illuminate\Http\Response
     */
    public function edit($registroEfectivoCredito)
    {
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

        $registroEfectivoCredito = RegistroEfectivoCredito::find($registroEfectivoCredito);

        $registro = $registroEfectivoCredito;

        return view('efectivo_credito.edit', compact('meses','registro','registroEfectivoCredito'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegistroEfectivoCreditoRequest  $request
     * @param  \App\Models\RegistroEfectivoCredito  $registroEfectivoCredito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $registroEfectivoCredito)
    {

        $registroEfectivoCredito = RegistroEfectivoCredito::find($registroEfectivoCredito);

        if($registroEfectivoCredito->update($request->all())){
            return redirect()->back()->with([
                'status' => 200,
                'message' => 'Registro efectivo-credito actualizado'
            ]);
        }else{
            return redirect()->back()->with([
                'status' => 500,
                'message' => 'El registro efectivo-credito no se pudo actualizar'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegistroEfectivoCredito  $registroEfectivoCredito
     * @return \Illuminate\Http\Response
     */
    public function destroy($registroEfectivoCredito)
    {

        $registroEfectivoCredito = RegistroEfectivoCredito::find($registroEfectivoCredito);

        if($registroEfectivoCredito->delete()){
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
