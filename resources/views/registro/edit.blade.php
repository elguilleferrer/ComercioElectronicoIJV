@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>
            Editar Registro
            <a href="{{route('registro.index')}}" class="btn btn-primary float-end">Lista de registros</a>
        </h4>
        <h6 class="text-black-50">Editando un registro</h6>

        @include('layouts.mensaje')

        <form action="{{route('registro.update',$registro->id)}}" method="post">
        @csrf
        @method('put')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group mt-2">
                            <label for="tipo_unidad_id">Tipo de unidad</label>
                            <select name="tipo_unidad_id" id="tipo_unidad_id" class="form-control" required>
                                <option value="" selected disabled>Selecciona</option>
                                @foreach($tiposUnidad as $tipoUnidad)
                                <option value="{{$tipoUnidad->id}}" @if($tipoUnidad->id == $registro->tipo_unidad_id) selected @endif>{{$tipoUnidad->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="operaciones">Operaciones</label>
                            <input type="number" class="form-control" id="operaciones" name="operaciones" requird value="{{$registro->operaciones}}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="mes">Mes</label>
                            <select name="mes" id="mes" class="form-control" required>
                                @foreach($meses as $mes)
                                <option value="{{$mes->id}}" @if($mes->id == $registro->mes) selected @endif>{{$mes->label}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="year">Año</label>
                            <select name="year" id="year" class="form-control" required>
                                @for($i=2021;$i<=2060;$i++)
                                <option value="{{$i}}" @if($i == $registro->year) selected @endif>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group mt-2">
                            <label for="post">Post</label>
                            <input type="text" class="form-control" id="post" name="post" required value="{{$registro->post}}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="enzona">Enzona</label>
                            <input type="text" class="form-control" id="enzona" name="enzona" required value="{{$registro->enzona}}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="transfer_movil">Transfermovil</label>
                            <input type="text" class="form-control" id="transfer_movil" name="transfer_movil" required value="{{$registro->transfer_movil}}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="tienda_virtual">Tienda Virtual</label>
                            <input type="text" class="form-control" id="tienda_virtual" name="tienda_virtual" required value="{{$registro->tienda_virtual}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Guardar</button>
                <a href="{{route('registro.index')}}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>

    </div>
@endsection

@section('scripts')

@endsection
