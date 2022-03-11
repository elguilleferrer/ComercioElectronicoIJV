@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4>
        Registros Comercio Electronico
        <a href="{{route('registro.create')}}" class="btn btn-primary float-end">Nuevo Registro</a>
    </h4>
    <h6 class="text-black-50">Detalles de las estadísticas</h6>

    @include('layouts.mensaje')

    <table class="table table-bordered table-striped" id="contenedor">
        <thead class="bg-primary text-light">
            <tr>
                <th>Tipo de unidad</th>
                <th>Operaciones</th>
                <th>Comercio Electrónico</th>
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
            "ajax": "{{url('/admin/get_registros')}}",
            "language": {
                'loadingRecords': '&nbsp;',
                'processing': '<i class="fa fa-spinner fa-spin"></i>'
            },
            "columns": [
            {
                data:null,
                render : function (data, type, row) {
                    return data.get_tipo_unidad.nombre;
                },
                name : 'tipo_unidad_id'
            },
            { "data": "operaciones"},
            {
                data:null,
                render : function (data, type, row) {
                    return `<strong>TRM:</strong> ` + currency(data.transfer_movil) +
                    `<br><strong>ENZ</strong>: ` + currency(data.enzona) +
                    `<br><strong>POST</strong>: ` + currency(data.post) +
                    `<br><strong>TIV</strong>: ` + currency(data.tienda_virtual);
                },
                orderable : false,
                searchable: false,
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
                        <a href="{{url('admin/registro')}}/`+data.id+`" class="btn btn-sm btn-info" title="Ver"><i class="fa fa-eye"></i></a>
                        <a href="{{url('admin/registro')}}/`+data.id+`/edit" class="btn btn-sm btn-success" title="Editar"><i class="fa fa-edit"></i></a>
                        <a href="#" data-id="`+data.id+`" class="btn btn-sm btn-danger eliminarRegistro" title="Eliminar"><i class="fa fa-trash"></i></a>
                    </div>
                    `;
                },
                orderable : false,
                searchable: false,
            },
            ],
            order: [[ 5, "desc" ]]
        });

        function botonesDeAccion(){
            $('.eliminarRegistro').off().on('click',function(e){
                e.preventDefault();
                if(confirm('Estas seguro/a que deseas eliminar este registro')){
                    $('#eliminarRegistro').attr('action','{{url('admin/registro/')}}/'+$(this).data('id'));
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
