@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Estadísticas</h4>
        <h6 class="text-black-50">Detalles de las estadisticas</h6>
        <div class="row">
            <div class="col-sm-6">
                <canvas id="myChart" style="width: 100%;"></canvas>
            </div>
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
