<?php
use App\Routes\Route;

// En débutant le site
Route::get('/', 'AuthController@index');
Route::post('/', 'AuthController@validate');

Route::dispatch();