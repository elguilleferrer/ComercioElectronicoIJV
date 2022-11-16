@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h4>
            Usuarios
            <a href="{{route('efectivo_credito.create')}}" class="btn btn-primary float-end">Nuevo Registro</a>
        </h4>
        <h6 class="text-black-50">Detalles de las ventas en efectivo y por credito mes por mes</h6>

        @include('layouts.mensaje')

        <table class="table table-bordered table-striped" id="contenedor">
            <thead class="bg-primary text-light">
            <tr>
                <th>V/Efectivo</th>
                <th>V/Credito</th>
                <th>Mes</th>
                <th>Año</th>
                <th>Created at</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <form action="" id="eliminarRegistro" method="POST">
        @csrf
        @method('delete')
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const customTable = $('#contenedor').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{url('/admin/get_registros_efectivo_credito')}}",
                "language": {
                    'loadingRecords': '&nbsp;',
                    'processing': '<i class="fa fa-spinner fa-spin"></i>'
                },
                "columns": [
                    {
                        data:null,
                        render : function (data, type, row) {
                            return currency(data.venta_efectivo);
                        },
                        name : 'venta_efectivo'
                    },
                    {
                        data:null,
                        render : function (data, type, row) {
                            return currency(data.venta_credito);
                        },
                        name : 'venta_credito'
                    },
                    {
                        data:null,
                        render : function (data, type, row) {
                            return data.get_mes.nombre;
                        },
                        name : 'mes'
                    },
                    { "data": "year"},
                    {
                        data:null,
                        render : function (data, type, row) {
                            return moment(data.created_at).format('D/M/Y');
                        },
                        name : 'created_at'
                    },
                    {
                        data:null,
                        render : function (data, type, row) {
                            return `
                    <div class="btn-group btn-group-sm">
                        <a href="{{url('admin/efectivo_credito')}}/`+data.id+`" class="btn btn-sm btn-info" title="Ver"><i class="fa fa-eye"></i></a>
                        <a href="{{url('admin/efectivo_credito')}}/`+data.id+`/edit" class="btn btn-sm btn-success" title="Editar"><i class="fa fa-edit"></i></a>
                        <a href="#" data-id="`+data.id+`" class="btn btn-sm btn-danger eliminarRegistro" title="Eliminar"><i class="fa fa-trash"></i></a>
                    </div>
                    `;
                        },
                        orderable : false,
                        searchable: false,
                    },
                ],
                order: [[ 4, "desc" ]]
            });

            function botonesDeAccion(){
                $('.eliminarRegistro').off().on('click',function(e){
                    e.preventDefault();
                    if(confirm('Estas seguro/a que deseas eliminar este registro')){
                        $('#eliminarRegistro').attr('action','{{url('admin/efectivo_credito/')}}/'+$(this).data('id'));
                        $('#eliminarRegistro').submit();
                    }
                });
            }

            $(document).ajaxStop(function(){
                botonesDeAccion();
            });

        } );
    </script>
@endsection
