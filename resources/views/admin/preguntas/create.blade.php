@extends('adminlte::page')

@section('title', 'Crear Pregunta')

@section('content_header')
    <h1>Crear Pregunta</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.pregunta.store']) !!}

            <div class="form-group">
                {!! Form::label('pregunta', 'Pregunta') !!}
                {!! Form::text('pregunta', null, ['class' => 'form-control']) !!}
            </div>

            @error('pregunta')
					<span class="text-danger">{{ $message }}</span>
			@enderror

            <div class="form-group">
                {!! Form::label('a', 'Opción A') !!}
                {!! Form::text('a', null, ['class' => 'form-control']) !!}
            </div>

            @error('a')
                <span class="text-danger">{{ $message }}</span>
            @enderror


            <div class="form-group">
                {!! Form::label('b', 'Opción B') !!}
                {!! Form::text('b', null, ['class' => 'form-control']) !!}
            </div>

            @error('b')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="form-group">
                {!! Form::label('c', 'Opción C') !!}
                {!! Form::text('c', null, ['class' => 'form-control']) !!}
            </div>

            @error('c')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="form-group">
                {!! Form::label('d', 'Opción D') !!}
                {!! Form::text('d', null, ['class' => 'form-control']) !!}
            </div>

            @error('d')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="form-group">
                {!! Form::label('respuesta', 'Respuesta') !!}
                {!! Form::select('respuesta', ['a' => 'Opción A', 'b' => 'Opción B', 'c' => 'Opción C', 'd' => 'Opción D'], 'a') !!}
            </div>

            @error('respuesta')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="form-group">
                {!! Form::label('categoria_id', 'Categoría') !!}
                {!! Form::select('categoria_id', $categorias->pluck('nombre', 'id'), null, ['class' => 'form-control']) !!}
            </div>

            @error('categoria_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="form-group">
                {!! Form::label('explicacion', 'Explicación') !!}
                {!! Form::textarea('explicacion', null, ['class' => 'form-control']) !!}
            </div>

            @error('explicacion')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection

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




