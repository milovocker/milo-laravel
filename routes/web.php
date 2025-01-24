<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LibroController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/libros'       , [LibroController::class, 'listado']);



Route::get('/libros/alta'       , [LibroController::class, 'formulario']);
Route::post('/libros/alta'       , [LibroController::class, 'alta']);

Route::get('/libros/eliminar/{$id}'       , [LibroController::class, 'eliminar']);
