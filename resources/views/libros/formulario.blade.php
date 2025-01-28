@extends('layout')

@section('title', 'Alta de libro')

@section('content')

    <br />
    @if(session('exito'))
        <p style="text-align:center;" class="alert alert-success">{{ session('exito') }}</p>
    @endif

    <form action="{{ route('libros.alta') }}" method="POST">
        @csrf

        @php
        $campos = ['nombre', 'autor', 'anho', 'editorial', 'genero', 'descripcion'];

        $values = [];
        $disabled = '';

        if ($oper == 'consultar') {
            $disabled = 'disabled';
            foreach ($campos as $campo) {
                $values[$campo] = $datosLibro[$campo] ?? '';
            }
        } elseif ($oper == 'alta') {
            $disabled = session('formData') ? 'disabled' : '';
            foreach ($campos as $campo) {
                $values[$campo] = old($campo, session("formData.$campo"));
            }
        } elseif ($oper == 'editar') {
            $disabled = session('formData') ? 'disabled' : '';
            foreach ($campos as $campo) {
                $values[$campo] = old($campo, $datosLibro[$campo]);
            }
        } else {
            abort(400, 'Operación no válida');
        }
        @endphp

        <div class="mb-3">
            <label for="nombre" class="form-label">Título</label>
            <input {{ $disabled }} type="text" name="nombre" class="form-control" id="nombre" value="{{ $values['nombre'] }}" placeholder="Título">
            @error('nombre') <p class="alert alert-danger py-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="autor" class="form-label">Autor</label>
            <input {{ $disabled }} type="text" name="autor" class="form-control" id="autor" value="{{ $values['autor'] }}" placeholder="Autor">
            @error('autor') <p class="alert alert-danger py-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="anho" class="form-label">Año</label>
            <input {{ $disabled }} type="text" name="anho" class="form-control" id="anho" value="{{ $values['anho'] }}" placeholder="Año">
            @error('anho') <p class="alert alert-danger py-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select {{ $disabled }} name="genero" id="genero" class="form-select form-select-sm">
                <option value="">Selecciona un género...</option>
                @foreach ($GENEROS as $clave_genero => $texto_genero)
                    <option value="{{ $clave_genero }}" {{ $values['genero'] == $clave_genero ? 'selected' : '' }}>
                        {{ $texto_genero }}
                    </option>
                @endforeach
            </select>
            @error('genero') <p class="alert alert-danger py-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="editorial" class="form-label">Editorial</label>
            <select {{ $disabled }} name="editorial" id="editorial" class="form-select form-select-sm">
                <option value="">Selecciona una editorial...</option>
                @foreach ($EDITORIALES as $clave_editorial => $texto_editorial)
                    <option value="{{ $clave_editorial }}" {{ $values['editorial'] == $clave_editorial ? 'selected' : '' }}>
                        {{ $texto_editorial }}
                    </option>
                @endforeach
            </select>
            @error('editorial') <p class="alert alert-danger py-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea {{ $disabled }} name="descripcion" class="form-control" id="descripcion" placeholder="Descripción...">{{ $values['descripcion'] }}</textarea>
            @error('descripcion') <p class="alert alert-danger py-1">{{ $message }}</p> @enderror
        </div>

        <button {{ $disabled }} type="submit" class="btn btn-primary">Enviar</button>
        <a href="/libros" class="btn btn-success">Volver al listado</a>
    </form>

@endsection