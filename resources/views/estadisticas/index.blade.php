@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h4>Estadísticas</h4>
        <h6 class="text-black-50">Detalles de las estadisticas</h6>
        <div class="row mb-2">
            <div class="col">
                <label for="mes">Mes</label>
                <select name="mes" id="mesF" class="form-control" required>
                    @foreach($meses as $mes)
                        <option value="{{$mes->id}}" @if($mes->id == \Carbon\Carbon::now()->format('m')) selected @endif>{{$mes->label}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="year">Año</label>
                <select name="year" id="yearF" class="form-control" required>
                    @for($i=2021;$i<=2060;$i++)
                        <option value="{{$i}}" @if($i == \Carbon\Carbon::now()->format('Y')) selected @endif>{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-6">
                        <canvas id="myChart" style="width: 100%;max-height: 600px;"></canvas>
                    </div>
                    <div class="col-sm-6">
                        <canvas id="myChart1" style="width: 100%;max-height: 600px;"></canvas>
                    </div>
                </div>

                <div class="row my-4">
                    <div class="col-sm-6">
                        <h4 class="text-center rounded-3 p-3 border border-success border-2"> Monto Total : <strong class="text-success" id="totalGrafico">$0.00</strong></h4>
                    </div>
                    <div class="col-sm-6">
                        <h4 class="text-center rounded-3 p-3 border border-success border-2">Total de Operaciones: <strong class="text-success" id="totalOperacionesGrafico">0</strong></h4>
                    </div>
                    <div class="col-sm-6">
                        <h4 class="text-center rounded-3 p-3 border border-success border-2">Efectivo y Crédito: <strong class="text-success">${{number_format($acumuladoEfectivoCredito,2)}}</strong></h4>
                    </div>
                    <div class="col-sm-6">
                        <h4 class="text-center rounded-3 p-3 border border-success border-2">Acumulado: <strong class="text-success">${{number_format($acumuladoComercioElectronico,2)}}</strong></h4>
                    </div>
                </div>

                <div class="row">
                    @if($acumuladoEfectivoCredito > 0)
                        <div class="col-12 text-center">
                            <h5>Esto representa un <strong class="text-success">%{{number_format(($acumuladoComercioElectronico*100)/$acumuladoEfectivoCredito,2)}}</strong></h5>
                        </div>
                    @endif
                    <div class="col-12">
                        <h3 class="text-center text-decoration-underline">Acumulados por tipo de unidad</h3>
                        <div class="row">
                            @foreach($tipoUnidades as $tipoUnidad)
                                <div class="col-sm-4">
                                    <div class="card shadow m-2 border-0 rounded-3">
                                        <div class="card-header p-0 m-0">
                                            <h3 class="text-center bg-white mb-0">{{$tipoUnidad->nombre}}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="text-black-50 fw-bold text-decoration-underline text-end"><small>Monto</small></div>
                                                    <h4 class="text-success" style="text-align: right;">
                                                        <i class="fa fa-money-bill-alt"></i> ${{number_format($tipoUnidad->acumuladoCE()->sum(DB::raw("transfer_movil + post + enzona + tienda_virtual")),2)}}
                                                    </h4>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="text-black-50 fw-bold text-decoration-underline"><small>Operaciones</small></div>
                                                    <h4 class="text-primary">
                                                        <i class="fa fa-mobile"></i> {{$tipoUnidad->acumuladoCE()->sum("operaciones")}}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer p-0">
                                            <a href="#" class="btn btn-light d-block">
                                                <i class="fa fa-link"></i> Ver detalles
                                            </a>
                                        </div>
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

        var data = {},
            data1 = {};

        const ctx = document.getElementById('myChart').getContext('2d');
        const ctx1 = document.getElementById('myChart1').getContext('2d');

        const myChart = new Chart(ctx, {
            type: 'bar',
            data : data,
            responsive: true,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const myChart1 = new Chart(ctx1, {
            type: 'bar',
            data : data1,
            responsive: true,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });

        $.get('{{url('estadisticas_api/filtro/'.\Carbon\Carbon::now()->format('n').'/'.\Carbon\Carbon::now()->format('Y'))}}').then( r => {

            data = {
                labels: r.labels,
                datasets: [
                    {
                        label: 'Enzona',
                        data: r.enzona,
                        borderWidth: 1,
                        backgroundColor : '#0c88cb',
                        barThickness: 15,
                        maxBarThickness: 15,
                        minBarLength: 15,
                        borderRadius: 5,
                    },
                    {
                        label: 'Transfermovil',
                        data: r.transfermovil,
                        borderWidth: 1,
                        backgroundColor : '#1fc9d9',
                        barThickness: 15,
                        maxBarThickness: 15,
                        minBarLength: 15,
                        borderRadius: 5,
                    },
                    {
                        label: 'Post',
                        data: r.posts,
                        borderWidth: 1,
                        backgroundColor : '#664ecc',
                        barThickness: 15,
                        maxBarThickness: 15,
                        minBarLength: 15,
                        borderRadius: 5,
                    },
                    {
                        label: 'Tienda Virtual',
                        data: r.tiendavirtual,
                        borderWidth: 1,
                        backgroundColor : '#0ccbbb',
                        barThickness: 15,
                        maxBarThickness: 15,
                        minBarLength: 15,
                        borderRadius: 5,
                    }
                ]
            };

            data1 = {
                labels: r.labels,
                datasets: [{
                    label: 'Operaciones acumulado',
                    data: r.operaciones,
                    borderWidth: 1,
                    backgroundColor : '#0ccbbb',
                    barThickness: 15,
                    maxBarThickness: 15,
                    minBarLength: 15,
                    borderRadius: 5,
                }]
            };

            $('#totalGrafico').html(currency(r.totalVentas));
            $('#totalOperacionesGrafico').html(r.totalOperaciones);

            myChart.data = data;
            myChart1.data = data1;

            myChart.update();
            myChart1.update();

        });

        function obtenerEstadistica(mes,year){
            $.get('{{url('estadisticas_api/filtro')}}/'+mes+'/'+year).then( r => {

                data = {
                    labels: r.labels,
                    datasets: [
                        {
                            label: 'Enzona',
                            data: r.enzona,
                            borderWidth: 1,
                            backgroundColor : '#0c88cb',
                            barThickness: 15,
                            maxBarThickness: 15,
                            minBarLength: 15,
                            borderRadius: 5,
                        },
                        {
                            label: 'Transfermovil',
                            data: r.transfermovil,
                            borderWidth: 1,
                            backgroundColor : '#1fc9d9',
                            barThickness: 15,
                            maxBarThickness: 15,
                            minBarLength: 15,
                            borderRadius: 5,
                        },
                        {
                            label: 'Post',
                            data: r.posts,
                            borderWidth: 1,
                            backgroundColor : '#664ecc',
                            barThickness: 15,
                            maxBarThickness: 15,
                            minBarLength: 15,
                            borderRadius: 5,
                        },
                        {
                            label: 'Tienda Virtual',
                            data: r.tiendavirtual,
                            borderWidth: 1,
                            backgroundColor : '#0ccbbb',
                            barThickness: 15,
                            maxBarThickness: 15,
                            minBarLength: 15,
                            borderRadius: 5,
                        }
                    ]
                };

                data1 = {
                    labels: r.labels,
                    datasets: [{
                        label: 'Operaciones acumulado',
                        data: r.operaciones,
                        borderWidth: 1,
                        backgroundColor : '#0ccbbb',
                        barThickness: 15,
                        maxBarThickness: 15,
                        minBarLength: 15,
                        borderRadius: 5,
                    }]
                };

                $('#totalGrafico').html(currency(r.totalVentas));
                $('#totalOperacionesGrafico').html(r.totalOperaciones);

                myChart.data = data;
                myChart1.data = data1;

                myChart.update();
                myChart1.update();
            });
        }

        $('#mesF').on('change', function(){
            obtenerEstadistica($(this).val(),$('#yearF').val());
        });

        $('#yearF').on('change', function(){
            obtenerEstadistica($('#mesF').val(),$(this).val());
        });
    </script>
@endsection
