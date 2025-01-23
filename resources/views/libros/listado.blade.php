@extends('layout')

@section('title', 'Listado de libros')

@section('content')
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col">Autor</th>
            <th scope="col">Género</th>
            <th scope="col">Editorial</th>
            <th scope="col">Descripción</th>
            <th scope="col">Año de publicación</th>
            </tr>
        </thead>
        @foreach($libros as $libro)
            <tr>
                <td>
                    <div>
                        <a href="/libros/{{ $libro->id }}" class="btn btn-primary"><i class="bi bi-search"></i></a>
                        <a href="/libros/actualizar/{{ $libro->id }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                        <a href="/libros/eliminar/{{ $libro->id }}" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
    <div class="container d-flex justify-content-center">
        {{ $libros->links() }}
    </div>
    <a href="/libros/nuevo" class="btn btn-success"><i class="bi bi-plus"></i> Nuevo libro</a>
@endsection