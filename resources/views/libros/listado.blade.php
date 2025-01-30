@extends('layout')

@section('title', 'Listado de libros')

@section('content')
<div class="container text-center">
    <br>
    
    <h3 class="text-center">Listado de libros</h3>
    
    @if(session('exitoEliminar'))
        <div class="container">
            <p style="color: white; background-color:rgb(86, 183, 86); padding:5px; text-align:center; border-radius: 5px;">{{ session('exitoEliminar') }}</p>
        </div>
    @endif
    <table class="table text-start">
        <thead>
            <tr>
            <th scope="col">Opciones</th>
            <th scope="col">Nombre</th>
            <th scope="col">Autor</th>
            <th scope="col">Género</th>
            <th scope="col">Editorial</th>
            <th scope="col">Descripción</th>
            <th scope="col">Año de publicación</th>
            </tr>
        </thead>
        @foreach($libros as $libro)
            <tr>
                <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <div>
                        <a  href="/libros/{{ $libro->id }}" class="btn btn-primary operBtn"><i class="bi bi-search"></i></a>
                        <a  href="/libros/actualizar/{{ $libro->id }}" class="btn btn-warning operBtn"><i class="bi bi-pencil-square"></i></a>
                        <a  href="/libros/eliminar/{{ $libro->id }}" class="btn btn-danger operBtn"><i class="bi bi-trash"></i></a>
                    </div>
                </td>
                <td>{{ $libro->nombre }}</td> 
                <td>{{ $libro->autor }}</td> 
                <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $GENEROS[$libro->genero] }}</td> 
                <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $EDITORIALES[$libro->editorial] }}</td> 
                <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $libro->descripcion }}</td> 
                <td>{{ $libro->anho }}</td> 
                
            </tr>
        @endforeach
    </table>

    <div>
        {{ $libros->links() }}
    </div>
    <div class="container d-flex justify-content-center">
    </div>
    <a href="/libros/nuevo" class="btn btn-success"><i class="bi bi-plus"></i> Nuevo libro</a>
</div>
@endsection