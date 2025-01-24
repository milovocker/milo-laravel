<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use Illuminate\Support\Facades\Validator;

class LibroController extends Controller
{
    function listado()
    {
        $libros = Libro::all();
        $EDITORIALES = Libro::EDITORIALES;
        $GENEROS = Libro::GENEROS;

        return view('libros.listado', compact('libros', 'EDITORIALES', 'GENEROS'));
    }

    function formulario()
    {
        $EDITORIALES = Libro::EDITORIALES;
        $GENEROS = Libro::GENEROS;
        
        return view('libros.formulario', compact('GENEROS', 'EDITORIALES'));
    }

    function alta( Request $request )
    {
        $data = [
            'nombre' => $request->nombre,
            'autor' => $request->autor,
            'genero' => $request->genero,
            'editorial' => $request->editorial,
            'descripcion' => $request->descripcion,
            'anho' => $request->anho,
        ];

        $rules = [
            'nombre' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'genero' => 'required',
            'editorial' => 'required',
            'descripcion' => 'required',
            'anho' => 'required|integer'
        ];

        $validator = Validator::make($data, $rules);

        $errors = $validator->errors();

        if ($validator->fails()) {

            return redirect()->back()
            ->withErrors($validator)
            ->withInput();


        } else {

            $libro = new Libro;
            $libro->nombre = $request->nombre;
            $libro->autor = $request->autor;
            $libro->genero = $request->genero;
            $libro->editorial = $request->editorial;
            $libro->descripcion = $request->descripcion;
            $libro->anho = $request->anho;
            $libro->save();
        }

        return redirect()->back()->with('exitoAlta', 'Libro añadido correctamente')
                                 ->withInput();
    }

    function eliminar($id)
    {
        $libroEliminar = Libro::find($id);
        $libroEliminar->delete();
        return redirect()->back()->with('exitoEliminar', 'Libro eliminado correctamente');
    }
}
