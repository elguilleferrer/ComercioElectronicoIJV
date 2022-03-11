@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Estadísticas</h4>
        <h6 class="text-black-50">Detalles de las estadisticas</h6>
        <div class="row">
            <div class="col-12">
                <h3>Acumulado General</h3>
                <canvas id="myChart" style="width: 100%;max-height: 300px;"></canvas>
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="text-center">Ventas Efectivo y crédito General: <strong class="text-success">${{number_format($acumuladoEfectivoCredito,2)}}</strong></h4>
                    </div>
                    <div class="col-sm-6">
                        <h4 class="text-center">Ventas total Acumulado Comercio Electrónico: <strong class="text-success">${{number_format($acumuladoComercioElectronico,2)}}</strong></h4>
                    </div>
                    @if($acumuladoEfectivoCredito > 0)
                        <div class="col-12 text-center">
                            <h5>Esto representa un <strong class="text-success">%{{number_format(($acumuladoComercioElectronico*100)/$acumuladoEfectivoCredito,2)}}</strong></h5>
                        </div>
                    @endif
                    <div class="col-12">
                        <h3>Acumulados por tipo de unidad</h3>
                        <div class="row">
                            @foreach($tipoUnidades as $tipoUnidad)
                                <div class="col-sm-4">
                                    <div class="card shadow m-3 border-0 border-end border-3 border-success">
                                        <div class="card-header">
                                            {{$tipoUnidad->nombre}}
                                        </div>
                                        <div class="card-body">
                                            <h1 class="text-success" style="text-align: right;">
                                                ${{number_format($tipoUnidad->acumuladoCE()->sum(DB::raw("transfer_movil + post + enzona + tienda_virtual")),2)}}
                                            </h1>
                                        </div>
                                        {{--                                        <div class="card-footer">--}}
                                        {{--                                            <small class="text-black-50">Última actualización: <strong>{{$tipoUnidad->ultimaActualizacion()}}</strong></small>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6"></div>
            <div class="col-sm-6"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/chart.min.js')}}"></script>
    <script>
        $.get('estadisticas_api/informacion_general').then( r => {
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data : r,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
    </script>
@endsection
