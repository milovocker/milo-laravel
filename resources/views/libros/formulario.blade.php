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

        $value = '';

        if($oper == 'consultar'){
            $value = $datosLibro['nombre'];
            $disabled = 'disabled';
        }elseif($oper == 'alta'){
            $disabled = session('formData') ? 'disabled' : '';
            $value    = old('nombre',session('formData.nombre'));
        }elseif($oper == 'editar'){
            $disabled = session('formData') ? 'disabled' : '';
            $value = $datosLibro['nombre'];
        }else{
            return 'Operación no válida';
        };

    @endphp

        <div class="mb-3">
            <label for="nombre" class="form-label">Título</label>
            <input {{ $disabled }} type="text" name="nombre" class="form-control" id="nombre" value="{{ $value }}" placeholder="Título">
            @error('nombre') <p class="alert alert-danger py-1">{{ $message }}</p> @enderror
        </div>

        @php

            $value = '';

            if($oper == 'consultar'){
                $value = $datosLibro['autor'];
                $disabled = 'disabled';
            }elseif($oper == 'alta'){
                $disabled = session('formData') ? 'disabled' : '';
                $value    = old('autor',session('formData.autor'));
            }elseif($oper == 'editar'){
                $disabled = session('formData') ? 'disabled' : '';
                $value = $datosLibro['autor'];
            }else{
                return 'Operación no válida';
            };

        @endphp



        <div class="mb-3">
            <label for="autor" class="form-label">Autor</label>
            <input {{ $disabled }} type="text" name="autor" class="form-control" id="autor" value="{{ $value }}" placeholder="Autor">
            @error('autor') <p class="alert alert-danger py-1">{{ $message }}</p> @enderror
        </div>

        @php

            $value = '';

            if($oper == 'consultar'){
                $value = $datosLibro['anho'];
                $disabled = 'disabled';
            }elseif($oper == 'alta'){
                $disabled = session('formData') ? 'disabled' : '';
                $value    = old('anho',session('formData.anho'));
            }elseif($oper == 'editar'){
                $disabled = session('formData') ? 'disabled' : '';
                $value = $datosLibro['anho'];
            }else{
                return 'Operación no válida';
            };

        @endphp


        <div class="mb-3">
            <label for="anho" class="form-label">Año</label>
            <input {{ $disabled }} type="text" name="anho" class="form-control" id="anho"  value="{{ $value }}" placeholder="Año">
            @error('anho') <p class="alert alert-danger py-1">{{ $message }}</p> @enderror
        </div>

        @php

            $valueGenero = '';

            if($oper == 'consultar'){
                $valueGenero = $datosLibro['genero'];
                $disabled = 'disabled';
            }elseif($oper == 'alta'){
                $disabled = session('formData') ? 'disabled' : '';
                $valueGenero    = old('genero',session('formData.genero'));
            }elseif($oper == 'editar'){
                $disabled = session('formData') ? 'disabled' : '';
                $valueGenero = $datosLibro['genero'];
            }else{
                return 'Operación no válida';
            };

        @endphp



        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select {{ $disabled }} name="genero" id="genero" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option value="">Selecciona un género...</option>
                @foreach ($GENEROS as $clave_genero => $texto_genero)

                    @php
                        $selected = '';
                        if($valueGenero == $clave_genero){
                            $selected = 'selected';
                        }else{
                            $selected = '';
                        }
                    @endphp

                <option value="{{ $clave_genero }}" {{ $selected }}>{{ $texto_genero }}</option>

                @endforeach
            </select>
            @error('genero') <p class="alert alert-danger py-1">{{ $message }}</p> @enderror
        </div>

        @php

            $valueEditorial = '';

            if($oper == 'consultar'){
                $valueEditorial = $datosLibro['editorial'];
                $disabled = 'disabled';
            }elseif($oper == 'alta'){
                $disabled = session('formData') ? 'disabled' : '';
                $valueEditorial    = old('editorial',session('formData.editorial'));
                
            }elseif($oper == 'editar'){
                $disabled = session('formData') ? 'disabled' : '';
                $valueEditorial = $datosLibro['editorial'];
            }else{
                return 'Operación no válida';
            };

        @endphp



        <div class="mb-3">
            <label for="editorial" class="form-label">Editorial</label>
            <select {{ $disabled }} name="editorial" id="editorial" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option value="">Selecciona una editorial...</option>
                
                @foreach ($EDITORIALES as $clave_editorial => $texto_editorial)
        
                    @php
                        $selected = '';
                        if($value == $clave_editorial){
                            $selected = 'selected';
                        }else{
                            $selected = '';
                        }
                    @endphp

                    <option value="{{ $clave_editorial }}" {{ $selected }}>{{ $texto_editorial }}</option>

                @endforeach
            </select>
            @error('editorial') <p class="alert alert-danger py-1">{{ $message }}</p> @enderror
        </div>

        @php

            $value = '';

            if($oper == 'consultar'){
                $value = $datosLibro['descripcion'];
                $disabled = 'disabled';
            }elseif($oper == 'alta'){
                $disabled = session('formData') ? 'disabled' : '';
                $value    = old('descripcion',session('formData.descripcion'));
            }elseif($oper == 'editar'){
                $disabled = session('formData') ? 'disabled' : '';
                $value = $datosLibro['descripcion'];
            }else{
                return 'Operación no válida';
            };

        @endphp

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea {{ $disabled }} name="descripcion" class="form-control" id="descripcion" placeholder="Descripción...">{{ $value }}</textarea>
            @error('descripcion') <p class="alert alert-danger py-1">{{ $message }}</p> @enderror
        </div>


        <button {{ $disabled }} type="submit" class="btn btn-primary">Enviar</button>
        <a href="/libros" class="btn btn-success">Volver al listado</a>
    </form>

@endsection