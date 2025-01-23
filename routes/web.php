<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LibroController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/libros'       , [LibroController::class, 'listado']);