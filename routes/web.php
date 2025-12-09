<?php

use App\Controllers\AuthController;
use App\Routes\Route;

// AuthController : Gestion d'inscription, connexion, déconnexion et connexion invité
Route::get('/', 'AuthController@index');
Route::get('/login', 'AuthController@index');
Route::post('/', 'AuthController@validate');
Route::post('/login', 'AuthController@validate');

Route::get('/logout', 'AuthController@logout');

Route::get('/inscription', 'AuthController@inscription');
Route::post('/inscription', 'AuthController@create');

Route::get('/guest', 'AuthController@guest');

// BaseController : Gestion de la page principal
Route::get('/lordStampee', 'BaseController@index');

Route::get('/profil', 'ClientController@index');
Route::get('/editProfil', 'ClientController@edit');
Route::post('/editProfil', 'ClientController@update');
Route::get('/deleteProfil', 'ClientController@delete');

Route::get('/stamp', 'StampController@index');
Route::get('/stampCreate', 'StampController@create');
Route::post('/stampCreate', 'StampController@save');
Route::get('/stampShow', 'StampController@show');

Route::get('/addImage', 'ImageController@index');

Route::dispatch();