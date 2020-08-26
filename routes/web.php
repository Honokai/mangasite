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

Route::get('/', 'MangasController@index')->name('inicio');
/*
function () {
    return view('inicio')->with('paginacao','MangasController@index');
}
*/
Auth::routes();

Route::resource('capitulos', 'CapitulosController'); 

Route::resource('mangas', 'MangasController');

Route::get('/manga/{nome}', 'MangasController@show')->where('nome','(.*)')->name('manga');

Route::get('/ler/{manga}/{capitulo}', 'CapitulosController@imagens')->where('manga','(.*)')->name('ler');

Route::post('/adicionar_manga', 'MangasController@store')->name('am');

Route::post('/adicionar_capitulo', 'CapitulosController@store')->name('adicionar capitulo');

Route::get('painel', 'PainelController@painel')->name('painel');

Route::get('/home', 'HomeController@index')->name('home');
