<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\RolController;
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

Route::prefix('Empleado')->group(function(){
    Route::get('/', 'EmpleadoController@index')->name('empleado');
    Route::get('/listado', 'EmpleadoController@index');
    Route::post('/store', 'EmpleadoController@store');
    Route::post('/update', 'EmpleadoController@update');
    Route::post('/delete', 'EmpleadoController@delete');
  });

  Route::prefix('Area')->group(function(){
       Route::get('/getArea', 'AreaController@getArea');
  });

  Route::prefix('Rol')->group(function(){
    Route::get('/getRol', 'RolController@getRol');
});
