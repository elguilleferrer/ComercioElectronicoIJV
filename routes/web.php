<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\TipoUnidadController;
use App\Http\Controllers\Api\ApiEstadisticasController;
use \App\Http\Controllers\RegistroEfectivoCreditoController;

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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('estadisticas')->group(function () {
    Route::get('/',[EstadisticaController::class,'index']);
    Route::get('/generales',[EstadisticaController::class,'generales']);
    Route::get('/especifica/{unidad}/{year}',[EstadisticaController::class,'especifica']);
});

Route::prefix('admin')->group(function () {

    Route::resource('registro',RegistroController::class);
    Route::get('get_registros',[RegistroController::class,'getRegistros']);

    Route::resource('efectivo_credito',RegistroEfectivoCreditoController::class);
    Route::get('get_registros_efectivo_credito',[RegistroEfectivoCreditoController::class,'getRegistros']);

});

Route::prefix('estadisticas_api')->group(function () {
    Route::get('informacion_general',[ApiEstadisticasController::class,'informacionGeneral']);
});
