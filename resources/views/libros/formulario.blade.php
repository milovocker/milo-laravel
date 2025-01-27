@extends('layout')

@section('title', 'Alta')

@section('content')
    <div class="container">



        @php
            $finalValue = "";
            if(isset($datosLibro)){
                $finalValue = $datosLibro;
            }else{
                $finalValue = [
                    "nombre" => "",
                    "editorial" => "",
                    "autor" => "",
                    "descripcion" => "",
                    "anho" => "",
                    "genero" => ""
                ];

            }
        @endphp


        @if(session('exito'))
            <p style="color: white; background-color:rgb(86, 183, 86); padding:5px; text-align:center; border-radius: 5px;">{{ session('exito') }}</p>
        @endif

        <form action="{{ route('libros.alta')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Título</label>
                <input type="text" name="nombre" class="form-control" id="nombre" value="{{ $finalValue['nombre']}}" placeholder="Nombre" <?php echo $disabled?>>
            </div>
            @error('nombre') <p style="color: red;">{{ $message }}</p> @enderror

            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" name="autor" class="form-control" id="autor" value="{{ $finalValue['autor']}}" placeholder="Autor" <?php echo $disabled?>>
            </div>
            @error('autor') <p style="color: red;">{{ $message }}</p> @enderror

            <div class="mb-3">
                <label for="anho" class="form-label">Año</label>
                <input type="text" name="anho" class="form-control" id="anho" value="{{ $finalValue['anho']}}" placeholder="Año" <?php echo $disabled?>>
            </div>
            @error('anho') <p style="color: red;">{{ $message }}</p> @enderror

            <div class="mb-3">
                <label for="genero" class="form-label">Género</label>
                <select name="genero" id="genero" class="form-select form-select-sm" aria-label=".form-select-sm example" <?php echo $disabled?>>
                    <option value="">Selecciona un género...</option>
                    @foreach ($GENEROS as $clave_genero => $texto_genero)

                    @php
                        $selected = old('genero') == $clave_genero ? 'selected="selected"' : '';
                    @endphp

                    <option value="{{ $clave_genero }}" {{ $selected }}>{{ $texto_genero }}</option>
    
                    @endforeach
                </select>            
            </div>
            @error('genero') <p style="color: red;">{{ $message }}</p> @enderror

            <div class="mb-3">
                <label for="editorial" class="form-label">Editorial</label>
                <select name="editorial" id="editorial" class="form-select form-select-sm" aria-label=".form-select-sm example" <?php echo $disabled?>>
                    <option value="">Selecciona una editorial...</option>
                    @foreach ($EDITORIALES as $clave_editorial => $texto_editorial)
            
                        @php
                            $selected = old('editorial') == $clave_editorial ? 'selected="selected"' : '';
                        @endphp

                        <option value="{{ $clave_editorial }}" {{ $selected }}>{{ $texto_editorial }}</option>
    
                    @endforeach
                </select>
                
            </div>
            @error('editorial') <p style="color: red;">{{ $message }}</p> @enderror
    
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" id="descripcion" value="{{ old('descripcion')}}" placeholder="Descripción..." <?php echo $disabled?>>{{ $finalValue['descripcion'] }}</textarea>
            </div>

            @error('descripcion') <p style="color: red;">{{ $message }}</p> @enderror
    
    
            <button type="submit" class="btn btn-primary" <?php echo $disabled?>>Enviar</button>
            <a href="/libros" class="btn btn-success">Volver al listado</a>
        </form>
    </div>
@endsection