<?php


use Illuminate\Support\Facades\Auth;
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
Auth::routes(); 

Route::get('/', 'HomeController@dash');

Route::resource('/patients', 'PatientController');
Route::resource('/articles', 'ArticleController');
Route::resource('/fournisseurs', 'FournisseurController');
Route::resource('/categories', 'CategorieController');
Route::resource('/stocks', 'StockController');
Route::resource('/commandes','CommandeController');


Route::post('/storecommandes','CommandeController@storecmd');
Route::get('/getprice/{article}/{Qte}','CommandeController@getprice');
Route::get('/getcommandes','CommandeController@getcommandes');

Route::get('/listepatients', 'PatientController@listepatients');
Route::get('/listefournisseurs', 'FournisseurController@listefournisseurs');
Route::get('/listearticles','ArticleController@listearticles')->name('listearticles');
Route::get('/listecommades','CommandeController@listecommades')->name('listecommades');

Route::get('/search','HomeController@search');
