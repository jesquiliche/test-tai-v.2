@extends('adminlte::page')

@section('title', 'Editar pregunta')

@section('content_header')
    <h1>Editar pregunta</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($pregunta, ['route' => ['admin.pregunta.update', $pregunta], 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::label('pregunta', 'Pregunta') !!}
                    {!! Form::text('pregunta', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('a', 'Opción A') !!}
                    {!! Form::text('a', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('b', 'Opción B') !!}
                    {!! Form::text('b', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('c', 'Opción C') !!}
                    {!! Form::text('c', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('d', 'Opción D') !!}
                    {!! Form::text('d', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('respuesta', 'Respuesta correcta') !!}
                    {!! Form::select('respuesta', ['a' => 'Opción A', 'b' => 'Opción B', 'c' => 'Opción C', 'd' => 'Opción D'], null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('categoria_id', 'Categoría') !!}
                    {!! Form::select('categoria_id', $categorias, $pregunta->categoria_id, ['class' => 'form-control']) !!}

                </div>

                <div class="form-group">
                    {!! Form::label('explicacion', 'Explicación') !!}
                    {!! Form::textarea('explicacion', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="/js/ckeditor/ckeditor.css">
@stop

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#explicacion'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    $(document).ready(function() {
        CKEDITOR.replace('explicacion');
    });
</script>
@stop

