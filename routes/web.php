<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LibroController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/libros'       , [LibroController::class, 'listado'])->name('libros.listado');
Route::get('/libros'       , [LibroController::class, 'listado'])->name('libros.listado');



Route::get('/libros/{id}'            , [LibroController::class, 'consultar'])->name('libros.mostrar');
Route::get('/libros/actualizar/{id}' , [LibroController::class, 'editar'])->name('libros.actualizar');
Route::get('/libros/eliminar/{id}'   , [LibroController::class, 'eliminar'])->name('libros.eliminar');
Route::get('/libros/nuevo'          , [LibroController::class, 'alta'])->name('libros.alta');
Route::post('/libros/nuevo'         , [LibroController::class, 'almacenar'])->name('libros.almacenar');

Route::get('/libros/{id}'            , [LibroController::class, 'consultar'])->name('libros.mostrar');
Route::get('/libros/actualizar/{id}' , [LibroController::class, 'editar'])->name('libros.actualizar');
Route::get('/libros/eliminar/{id}'   , [LibroController::class, 'eliminar'])->name('libros.eliminar');
Route::get('/libros/nuevo'          , [LibroController::class, 'alta'])->name('libros.alta');
Route::post('/libros/nuevo'         , [LibroController::class, 'almacenar'])->name('libros.almacenar');