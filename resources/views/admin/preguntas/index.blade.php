@extends('adminlte::page')

@section('title', 'Lista de preguntas')

@section('content_header')
    <h1>Lista de preguntas</h1>
@stop

@section('content')
@if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            {!! Form::open(['route' => 'admin.pregunta.index', 'method' => 'GET']) !!}
            {!! Form::select('categoria_id', $categorias->pluck('nombre', 'id'), request('categoria_id'), [
                'class' => 'form-control col-md-4',
                'placeholder' => 'Escoge categoría',
            ]) !!}
            <br />
            <table>
                <td>
                    {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </td>
                <td>
                    <a href="{{ route('admin.pregunta.create') }}" class="btn btn-primary ml-2">Agregar</a>
                </td>
            </table>
        </div>

        <div class="card-body">
            <table id="preguntas-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Categoría</th>
                        <th>Pregunta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preguntas as $pregunta)
                        <tr>
                            <td><b>{{$pregunta->id}}</b></th>
                            <td>{{ $pregunta->categoria->nombre }}</td>
                            <td>{{ $pregunta->pregunta }}</td>
                            <td width="15%" >
                                <a href="{{ route('admin.pregunta.edit', $pregunta) }}" class="btn btn-primary btn-sm">Editar</a>
                                {!! Form::open(['route' => ['admin.pregunta.destroy', $pregunta], 'method' => 'DELETE', 'class' => 'd-inline']) !!}
                                {!! Form::submit('Eliminar', [
                                    'class' => 'btn btn-danger btn-sm',
                                    'onclick' => 'return confirm("¿Estás seguro de que deseas eliminar esta pregunta?")',
                                ]) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#preguntas-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "decimal":        "",
                    "emptyTable":     "No hay datos disponibles en la tabla",
                    "info":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    "infoEmpty":      "Mostrando 0 a 0 de 0 entradas",
                    "infoFiltered":   "(filtrado de un total de _MAX_ entradas)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Mostrar _MENU_ entradas",
                    "loadingRecords": "Cargando...",
                    "processing":     "Procesando...",
                    "search":         "Buscar:",
                    "zeroRecords":    "No se encontraron coincidencias",
                    "paginate": {
                        "first":      "Primero",
                        "last":       "Último",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    },
                    "aria": {
                        "sortAscending":  ": activar para ordenar la columna ascendente",
                        "sortDescending": ": activar para ordenar la columna descendente"
                    },
                    
                }
                
            });
        });
    </script>
    
@stop
