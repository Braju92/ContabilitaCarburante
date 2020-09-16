<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

//Routing di Autenticazione
Route::redirect('/','Authentication');

Route::get('/Authentication', function () {
    return view('Authentication');
});

Route::get('/Signup', function () {
    return view('Signup');
});

Auth::routes();




//Routing della Home

Route::get('/MainBoard', function () {
    return view('MainBoard');
});

Route::get('/home', 'HomeController@Home')->name('home');
Route::get('Visualizza', 'HomeController@Visualizza')->name('Visualizza');
Route::get('Inserimento', 'HomeController@Inserimento')->name('Inserimento');
Route::get('Elimina', 'HomeController@Elimina')->name('Elimina');
Route::get('Fogli', 'HomeController@Fogli')->name('Fogli');


/***ROUTING DI VISUALIZZAZIONE***/

//Routing di Visualizzazione parco
Route::get('Visualizza/Parco','ViewsController@ParcoHome');
Route::post('Visualizza/parcoquery','ViewsController@ParcoQuery');
//Routing di Visualizzazione rifornimenti
Route::get('Visualizza/Rifornimenti','ViewsController@RifornimentiHome');
Route::post('Visualizza/rifornimentiquery','ViewsController@RifornimentiQuery');
//Routing di Visualizzazione cedole
Route::get('Visualizza/Cedole','ViewsController@CedoleHome');
Route::post('Visualizza/cedolequery','ViewsController@CedoleQuery');
//Routing di Visualizzazione cisterna
Route::get('Visualizza/Cisterna','ViewsController@CisternaHome');
Route::post('Visualizza/cisternaquery','ViewsController@CisternaQuery');
//Routing di Visualizzazione dipendenti
Route::get('Visualizza/Dipendenti','ViewsController@DipendentiHome');
Route::post('Visualizza/dipendentiquery','ViewsController@DipendentiQuery');
//Routing di Visualizzazione additivi
Route::get('Visualizza/Additivi','ViewsController@AdditiviHome');
Route::post('Visualizza/additiviquery','ViewsController@AdditiviQuery');
//Routing di Visualizzazione consumi
Route::get('Visualizza/Consumi','ViewsController@ConsumiHome');
Route::post('Visualizza/consumiquery','ViewsController@ConsumiQuery');



/***ROUTING DI INSERIMENTO***/

Route::get('InserimentoConfermato', function () {
    return view('InserimentoConfermato');
});
Route::get('InserimentoAnnullato', function () {
    return view('InserimentoAnnullato');
});

//Routing di Inserimento dipendenti
Route::post('insertdipendenti','InsertsController@Dipendenti');
//Routing di Inserimento parco
Route::post('insertparco','InsertsController@Parco');
//Routing di Inserimento additivi
Route::post('insertadditivi','InsertsController@Additivi');
//Routing di Inserimento cisterna
Route::post('insertcisterna','InsertsController@Cisterna');
//Routing di Inserimento cedole
Route::post('insertcedole','InsertsController@Cedole');
//Routing di Inserimento rifornimento
Route::post('insertrifornimento','InsertsController@Rifornimento');



/***ROUTING DI DELETE***/

//Routing di Delete dipendenti
Route::post('deletedipendenti','DeletesController@Dipendenti');
//Routing di Delete parco
Route::post('deleteparco','DeletesController@Parco');
//Routing di Delete additivi
Route::post('deleteadditivi','DeletesController@Additivi');
//Routing di Delete cisterna
Route::post('deletecisterna','DeletesController@Cisterna');
//Routing di Delete cedole
Route::post('deletecedole','DeletesController@Cedole');
//Routing di Delete rifornimento
Route::post('deleterifornimento','DeletesController@Rifornimento');



/***ROUTING DI ELIMINA***/

Route::get('EliminaConferma', function () {
    return view('EliminaConferma');
});
Route::get('DeleteConfermato', function () {
    return view('DeleteConfermato');
});
Route::get('DeleteAnnullato', function () {
    return view('DeleteAnnullato');
});
//Routing di Visualizza eliminazione dipendenti
Route::post('viewdeletedipendenti','ViewDeletesController@Dipendenti');
//Routing di Visualizza eliminazione parco
Route::post('viewdeleteparco','ViewDeletesController@Parco');
//Routing di Visualizza eliminazione additivi
Route::post('viewdeleteadditivi','ViewDeletesController@Additivi');
//Routing di Visualizza eliminazione cisterna
Route::post('viewdeletecisterna','ViewDeletesController@Cisterna');
//Routing di Visualizza eliminazione cedole
Route::post('viewdeletecedole','ViewDeletesController@Cedole');
//Routing di Visualizza eliminazione rifornimento
Route::post('viewdeleterifornimento','ViewDeletesController@Rifornimento');


/***ALTRI ROUTING***/
Route::get('/', function () {
    return view('welcome');
});



