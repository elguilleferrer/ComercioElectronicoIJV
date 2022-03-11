@extends('layouts.app')

@section('content')
<div class="container">
    <h4>
        Nuevo Registro
        <a href="{{route('efectivo_credito.index')}}" class="btn btn-primary float-end">Lista de registros</a>
    </h4>
    <h6 class="text-black-50">Creando un nuevo registro</h6>

    @include('layouts.mensaje')

    <form action="{{route('efectivo_credito.store')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group mt-2">
                            <label for="mes">Mes</label>
                            <select name="mes" id="mes" class="form-control" required>
                                @foreach($meses as $mes)
                                <option value="{{$mes->id}}" @if($mes->id == \Carbon\Carbon::now()->format('m')) selected @endif>{{$mes->label}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="year">Año</label>
                            <select name="year" id="year" class="form-control" required>
                                @for($i=2021;$i<=2060;$i++)
                                <option value="{{$i}}" @if($i == \Carbon\Carbon::now()->format('Y')) selected @endif>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group mt-2">
                            <label for="venta_efectivo">Venta Efectivo</label>
                            <input type="text" class="form-control" id="venta_efectivo" name="venta_efectivo" required value="0">
                        </div>
                        <div class="form-group mt-2">
                            <label for="venta_credito">Venta Crédito</label>
                            <input type="text" class="form-control" id="venta_credito" name="venta_credito" required value="0">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mt-2">
                            <label for="comentario">Comentario</label>
                            <textarea name="comentario" id="comentario" rows="5" class="form-control" style="resize: none;" placeholder="Escribe el un comentario aquí"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Guardar</button>
                <a href="{{route('efectivo_credito.index')}}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>

</div>
@endsection

@section('scripts')

@endsection
