@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>
            Registros Comercio Electronico
            <a href="{{route('registro.create')}}" class="btn btn-primary float-end">Nuevo Registro</a>
        </h4>
        <h6 class="text-black-50">Detalles de las estadísticas</h6>
        <table class="table table-bordered table-striped" id="contenedor">
            <thead class="bg-primary text-light">
            <tr>
                <th>Tipo de unidad</th>
                <th>Operaciones</th>
                <th>Monto</th>
                <th>Año</th>
                <th>Created at</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
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
                    'processing': 'Cargando datos'
                },
                "columns": [
                    {
                        data:null,
                        render : function (data, type, row) {
                            return data.get_tipo_unidad.nombre;
                        }
                    },
                    { "data": "operaciones"},
                    {
                        data:null,
                        render : function (data, type, row) {
                            return currency(data.monto);
                        }
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
                            <a href="{{url('admin/registro')}}/`+data.id+`" class="editor_view" title="Voir">Ver</a>&nbsp;
                            <a href="{{url('admin/registro')}}/`+data.id+`/edit" class="editor_edit" title="Editer">Editar</a>&nbsp;
                            <a href="{{url('admin/registro')}}/`+data.id+`/edit" class="editor_remove" title="Supprimer">Eliminar</a>
                            `;
                        }
                    },
                ],
                order: [[ 4, "asc" ]]
            });
        } );
    </script>
@endsection
