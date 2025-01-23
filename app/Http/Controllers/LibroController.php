<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibroController extends Controller
{
    function listado()
    {
        $libros = Libro::paginate(5);

        return view('libros.listado', compact('libros'));
    }
}
