<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('usuarios',App\Http\Controllers\WebMastersController::class);
Route::resource('proyectos',App\Http\Controllers\ProyectosController::class);
Route::resource('c_internos',App\Http\Controllers\InternosController::class);
Route::resource('comprobantes',App\Http\Controllers\ComprobantesController::class);

Route::get('/del/comp/{id}',[App\Http\Controllers\ComprobantesController::class, 'destroy'])->name('comprobantes.borrar');

Route::get('/upd/clave',[App\Http\Controllers\AjaxController::class, 'clave'])->name('cambiar.clave');
Route::post('/Cambiarclave',[App\Http\Controllers\AjaxController::class, 'CambiarClave'])->name('cambiar.nuevaclave');
Route::get('ajax/validar',[App\Http\Controllers\AjaxController::class, 'validar_user'])->name('validar_user');
Route::get('ajax/validar_proy',[App\Http\Controllers\AjaxController::class, 'validar_proy'])->name('validar_proy');



