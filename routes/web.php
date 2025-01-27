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



Route::get('/libros/alta'                , [LibroController::class, 'formulario'])->name('libros.formulario');
Route::post('/libros/alta'               , [LibroController::class, 'alta'])->name('libros.alta');
Route::get('/libros/eliminar/{id}'       , [LibroController::class, 'eliminar']);
Route::get('/libros/{id}'                , [LibroController::class, 'consultar'])->name('libros.consultar');
