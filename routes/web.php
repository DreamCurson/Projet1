<?php
use App\Routes\Route;

// En débutant le site
Route::get('/', 'AuthController@index');
Route::get('/login', 'AuthController@index');
Route::post('/', 'AuthController@validate');
Route::post('/login', 'AuthController@validate');

Route::get('/inscription', 'AuthController@inscription');
Route::get('/guest', 'AuthController@guest');

Route::dispatch();