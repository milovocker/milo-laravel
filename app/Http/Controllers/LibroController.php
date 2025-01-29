<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use Illuminate\Support\Facades\Validator;

class LibroController extends Controller
{
    function listado()
    {
        $libros = Libro::paginate(7);
        $EDITORIALES = Libro::EDITORIALES;
        $GENEROS = Libro::GENEROS;

        return view('libros.listado', compact('libros', 'EDITORIALES', 'GENEROS'));
    }

    function formulario($oper='', $id='')
    {
        $libro = empty($id)? new Libro() : Libro::find($id);
        dd($libro);
        $GENEROS     = Libro::GENEROS;
        $EDITORIALES = Libro::EDITORIALES;
        return view('libros.formulario', compact('GENEROS', 'EDITORIALES', 'oper', 'libro'));
    }

    function eliminar($id)
    {
        return $this->formulario('supr', $id);
    }

    function consultar($id)
    {
        return $this->formulario('cons', $id);

    }

    function editar($id)
    {
        return $this->formulario('modi', $id);
    }

    function alta()
    {
        return $this->formulario();
    }

    function almacenar(Request $request)
    {

        if ($request->oper == 'supr')
        {

            $libro = Libro::find($request->id);
            $libro->delete();

            $salida = redirect()->route('libros.listado');
        }
        else
        {
            $validacion_genero = '';
            foreach(Libro::GENEROS as $codigo_genero => $texto_genero)
            {
                $validacion_genero .= $codigo_genero .',';
            }

            $validacion_genero = substr($validacion_genero,0,-1);
            
            $validatedData = $request->validate([
                'nombre'         => 'required|string|max:255',
                'autor'          => 'required|string|max:255',
                'anho'           => 'required|integer',
                'genero'         => 'required|in:'.$validacion_genero,
                'editorial'      => 'required',
                'descripcion'    => 'required|string'
            ], [
                'nombre.required' => 'El nombre es obligatorio.',
                'nombre.string'   => 'Debe ser de tipo cadena de texto.',
                'nombre.max'      => 'Máximo 255 caracteres',

                'nombre.max'      => 'Máximo 255 caracteres',



                'autor.required' => 'El autor es obligatorio.',
                'autor.string'   => 'Debe ser de tipo cadena de texto.',
                'autor.max'      => 'Máximo 255 caracteres',

                'anho.required' => 'El año es obligatorio.',
                'anho.integer'  => 'Debe ser de tipo entero.',

                'genero.required'      => 'El género es obligatorio.',
                'editorial.required'   => 'la editorial es obligatoria.',
                'descripcion.required'   => 'La descripción es obligatoria.',


            ]);

            
        
            



            $libro = empty($request->id)? new Libro() : Libro::find($request->id) ;

            $libro->nombre      = $request->nombre;
            $libro->autor       = $request->autor;
            $libro->descripcion = $request->descripcion;
            $libro->editorial   = $request->editorial;
            $libro->anho        = $request->anho;
            $libro->genero      = $request->genero;

            $libro->save();


            $salida = redirect()->route('libros.alta')->with([
                    'exito'  => 'Libro insertado correctamente.'
                    ,'formData' => $libro
                ]
            );

        }

        return $salida;
    }

    
}