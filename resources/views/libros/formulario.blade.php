@extends('layout')

@section('title', 'Alta')

@section('content')
    <div class="container">

        @if(session('exitoAlta'))
            <p style="color: white; background-color:rgb(86, 183, 86); padding:5px; text-align:center; border-radius: 5px;">{{ session('exitoAlta') }}</p>
        @endif

        <form action="/libros/alta" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Título</label>
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre">
            </div>
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" name="autor" class="form-control" id="autor" placeholder="Autor">
            </div>
            <div class="mb-3">
                <label for="anho" class="form-label">Año</label>
                <input type="text" name="anho" class="form-control" id="anho" placeholder="Año">
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Género</label>
                <select name="genero" id="genero" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option value="">Selecciona un género...</option>
                    @foreach ($GENEROS as $clave_genero => $texto_genero)
            
                        <option value="{{ $clave_genero }}">{{ $texto_genero }}</option>
    
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="editorial" class="form-label">Editorial</label>
                <select name="editorial" id="editorial" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option value="">Selecciona una editorial...</option>
                    @foreach ($EDITORIALES as $clave_editorial => $texto_editorial)
            
                        <option value="{{ $clave_editorial }}">{{ $texto_editorial }}</option>
    
                    @endforeach
                </select>
            </div>
    
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" id="descripcion" placeholder="Descripción..."></textarea>
            </div>
    
    
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
@endsection