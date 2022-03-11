@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>
            Nuevo Registro
            <a href="{{route('registro.index')}}" class="btn btn-primary float-end">Lista de registros</a>
        </h4>
        <h6 class="text-black-50">Creando un nuevo registro</h6>

        @include('layouts.mensaje')

        <form action="{{route('registro.store')}}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mt-2">
                                <label for="tipo_unidad_id">Tipo de unidad</label>
                                <select name="tipo_unidad_id" id="tipo_unidad_id" class="form-control" required>
                                    <option value="" selected disabled>Selecciona</option>
                                    @foreach($tiposUnidad as $tipoUnidad)
                                        <option value="{{$tipoUnidad->id}}">{{$tipoUnidad->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="operaciones">Operaciones</label>
                                <input type="number" class="form-control" id="operaciones" name="operaciones" required>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-2">
                            <div class="form-group">
                                <label for="year">Año</label>
                                <select name="year" id="year" class="form-control" required>
                                    @for($i=2021;$i<=2060;$i++)
                                        <option value="{{$i}}" @if($i == \Carbon\Carbon::now()->format('Y')) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="monto">Monto</label>
                                <input type="text" class="form-control" id="monto" name="monto" required>
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
