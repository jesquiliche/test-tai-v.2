@extends('adminlte::page')

@section('title', 'Tablero')

@section('content_header')
    <h1>Lista de Bloques</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <table>
                <td>
                    <a href="{{ route('admin.bloque.create') }}" class="btn btn-primary btn-sm">
                        Agregar bloque
                    </a>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.bloque.export') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm ml-2">Exportar a JSON</button>
                    </form>
                </td>


        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col" colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bloques as $bloque)
                        <tr>
                            <th scope="row">{{ $bloque->id }}</th>
                            <td><b>{{ $bloque->nombre }}</b></td>
                            <td>{{ strip_tags($bloque->descripcion) }}</td>
                            <td width="10px">
                                <a href="{{ route('admin.bloque.edit', $bloque) }}" class="btn btn-primary btn-sm">Editar
                                </a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.bloque.destroy', $bloque) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este bloque?')">
                                        Eliminar
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
