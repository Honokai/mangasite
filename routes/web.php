<?php

use App\Mangas;
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
    return view('inicio')->with('mangasAtualizados',Mangas::all()->sortByDesc('atualizado_em'));
})->name('inicio');


Auth::routes();

Route::get('/manga')->name('manga');

Route::post('/adicionar_manga', 'MangasController@store')->name('am');

Route::get('/painel', 'HomeController@painel')->name('painel');

Route::get('/home', 'HomeController@index')->name('home');
