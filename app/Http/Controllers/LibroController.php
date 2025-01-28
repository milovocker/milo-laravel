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
        $disabled = '';

        return view('libros.listado', compact('libros', 'EDITORIALES', 'GENEROS', 'disabled'));
    }

    function formulario()
    {
        $EDITORIALES = Libro::EDITORIALES;
        $GENEROS = Libro::GENEROS;
        $disabled = false;
        $oper = 'alta';
        $datosLibro = '';
        return view('libros.formulario', compact('GENEROS', 'EDITORIALES', 'disabled','oper', 'datosLibro'));
    }

    function alta( Request $request )
    {
        $validatedData = $request->validate([
            'nombre'         => 'required|string|max:255',
            'autor'          => 'required|string|max:255',
            'anho'           => 'required|integer',
            'genero'         => 'required',
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


            $libro = new Libro;
            $libro->nombre = $request->nombre;
            $libro->autor = $request->autor;
            $libro->genero = $request->genero;
            $libro->editorial = $request->editorial;
            $libro->descripcion = $request->descripcion;
            $libro->anho = $request->anho;
            $libro->save();

            
            return redirect()->route('libros.alta')->with([
                     'exito' => 'Libro insertado correctamente.'
                    ,'formData' =>  $validatedData
                ]);
    }

    function eliminar($id)
    {
        $libroEliminar = Libro::find($id);
        $libroEliminar->delete();
        $oper = 'eliminar';

        return redirect()->back()->with('exitoEliminar', 'Libro eliminado correctamente');
    }

    function consultar($id)
    {
        $datosLibro = Libro::find($id);

        $EDITORIALES = Libro::EDITORIALES;
        $GENEROS = Libro::GENEROS;
        $oper = 'consultar';
  
        return view('libros.formulario', compact('EDITORIALES', 'GENEROS', 'datosLibro', 'oper', 'datosLibro'))->with([
            'formData' =>  $datosLibro
       ]);;

    }

    function confirmarEdicion($id)
    {
        $libroActualizar = Libro::find($id);

        $EDITORIALES = Libro::EDITORIALES;
        $GENEROS = Libro::GENEROS;
        $disabled = '';

        $libroActualizar->nombre      = $libroActualizar['nombre'];
        $libroActualizar->autor       = $libroActualizar['autor'];
        $libroActualizar->genero      = $libroActualizar['genero'];
        $libroActualizar->editorial   = $libroActualizar['editorial'];
        $libroActualizar->descripcion = $libroActualizar['descripcion'];
        $libroActualizar->anho        = $libroActualizar['anho'];
        $libroActualizar->save($id);

        return redirect()->back();
    }

    function verLibroEditar($id)
    {
        $datosLibro = Libro::find($id);

        $EDITORIALES = Libro::EDITORIALES;
        $GENEROS = Libro::GENEROS;
        $oper = 'editar';
        return view('libros.formulario', compact('EDITORIALES', 'GENEROS', 'datosLibro', 'oper'));
    }
}