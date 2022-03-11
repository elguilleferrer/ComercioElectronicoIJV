<?php

namespace App\Http\Controllers;

use App\Models\TipoUnidad;
use App\Http\Requests\StoreTipoUnidadRequest;
use App\Http\Requests\UpdateTipoUnidadRequest;

class TipoUnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipoUnidadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoUnidadRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoUnidad  $tipoUnidad
     * @return \Illuminate\Http\Response
     */
    public function show(TipoUnidad $tipoUnidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoUnidad  $tipoUnidad
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoUnidad $tipoUnidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoUnidadRequest  $request
     * @param  \App\Models\TipoUnidad  $tipoUnidad
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoUnidadRequest $request, TipoUnidad $tipoUnidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoUnidad  $tipoUnidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoUnidad $tipoUnidad)
    {
        //
    }
}
