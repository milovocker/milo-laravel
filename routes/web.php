<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\DatosController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/libros'                , [LibroController::class, 'listado'])->name('libros.listado');
    Route::get('/libro/{id}'            , [LibroController::class, 'mostrar'])->name('libros.mostrar');
    Route::get('/libro/actualizar/{id}' , [LibroController::class, 'actualizar'])->name('libros.actualizar');
    Route::get('/libro/eliminar/{id}'   , [LibroController::class, 'eliminar'])->name('libros.eliminar');
    Route::get('/libros/nuevo'          , [LibroController::class, 'alta'])->name('libros.alta');
    Route::post('/libros/nuevo'         , [LibroController::class, 'almacenar'])->name('libros.almacenar');

    Route::get('/users'                , [UserController::class, 'listado'])->name('users.listado');
    Route::get('/user/{id}'            , [UserController::class, 'mostrar'])->name('users.mostrar');
    Route::get('/user/actualizar/{id}' , [UserController::class, 'actualizar'])->name('users.actualizar');
    Route::get('/user/eliminar/{id}'   , [UserController::class, 'eliminar'])->name('users.eliminar');
    Route::get('/users/nuevo'          , [UserController::class, 'alta'])->name('users.alta');
    Route::post('/user/nuevo'         , [UserController::class, 'almacenar'])->name('users.almacenar');
});


Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware('auth');



require __DIR__.'/auth.php';

