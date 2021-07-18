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
    return view('welcome');
});

Route::get('contactanos',function(){
    return "Seccion de contactos";
})-> name('contactos');

Route::get('saludo/{nombre?}',function($nombre="Invitado"){
    return "Saludos ".$nombre;
});
/** 
*Route::get('/',function(){
 *   echo "<a href='".route('contactos')."'>Contactos 1</a><br>";
  *  echo "<a href='".route('contactos')."'>Contactos 2</a><br>";
   * echo "<a href='".route('contactos')."'>Contactos 3</a><br>";
*});*/