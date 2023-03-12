@extends('adminlte::page')

@section('title', 'Tablero')

@section('content_header')
    <h1>Lista de categorias</h1>
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
<div class="accordion" id="accordionCategorias">
    @foreach ($bloques as $bloque)
    <div class="card">
        <div class="card-header" id="heading{{ $bloque->id }}">
            <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse"
                    data-target="#collapse{{ $bloque->id }}" aria-expanded="true"
                    aria-controls="collapse{{ $bloque->id }}">
                    {{ $bloque->nombre }}
                </button>
            </h2>
        </div>

        <div id="collapse{{ $bloque->id }}" class="collapse @if($loop->first) show @endif"
            aria-labelledby="heading{{ $bloque->id }}" data-parent="#accordionCategorias">
        
            <div class="card-body">
                <table>
                <td>
                <a class="btn btn-primary btn-sm mb-2" href="{{route('admin.categoria.create')}}">Agregar categoria</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.categoria.export') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm ml-2 mb-2">Exportar a JSON</button>
                    </form>
                </td>
                </table>
                <table class="table table-bordered table-hover" id="tabla-categorias">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col" colspan="2">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias[$bloque->id] as $categoria)
                        <tr>
                            <td><b>{{ $categoria->id }}</b></td>
                            <td><b>{{ $categoria->nombre }}</b></td>
                            <td>{{ strip_tags($categoria->descripcion) }}</td>
                            <td>
                                <a href="{{ route('admin.categoria.edit', $categoria->id) }}"
                                    class="btn btn-primary btn-sm">Editar</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.categoria.destroy', $categoria->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-categorias').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                }
            });
        });
    </script>
@stop
