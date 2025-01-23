<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;


class LibroController extends Controller
{
    function listado()
    {
        $libros = Libro::paginate(5);
        $EDITORIALES = Libro::EDITORIALES;
        $GENEROS = Libro::GENEROS;

        return view('libros.listado', compact('libros', 'EDITORIALES', 'GENEROS'));
    }
}
