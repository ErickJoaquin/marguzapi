<?php

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

Route::resource('adjuntoprofesor', 'AdjuntoProfesorController');
Route::resource('clases', 'ClaseController');
Route::resource('horarios', 'HorarioController');
Route::resource('horarioprofesor', 'HorarioProfesorController');
Route::resource('idioma', 'IdiomasController');
Route::resource('idioma', 'IdiomaProfesorController');
Route::resource('interesestudiante', 'InteresEstudianteController');
Route::resource('materias', 'MateriaController');
Route::resource('materiaprofesor', 'MateriaProfesorController');
Route::resource('usuarios', 'UsuarioController');
Route::Post('login', 'UsuarioController@login');