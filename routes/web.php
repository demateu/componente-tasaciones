<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Rutas para borrar la caché y limpiar configuración
|--------------------------------------------------------------------------
*/
use Illuminate\Support\Facades\Artisan;
Route::get('/clear-cache', function () {
    echo Artisan::call('config:clear');
    echo Artisan::call('cache:clear');
    echo Artisan::call('route:clear');
    echo Artisan::call('config:cache');
    echo "<br>Caché borrada, Configuración limpia!!";
 });


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
