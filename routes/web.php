<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FilmController::class, 'index']);
Route::resource('films', FilmController::class);
Route::resource('tags', TagController::class);


Route::get('contacto', [ContactoController::class, 'pintarFormulario'])->name('email.pintarFormulario');
Route::post('contacto', [ContactoController::class, 'procesarFormulario'])->name('email.procesarformulario');

