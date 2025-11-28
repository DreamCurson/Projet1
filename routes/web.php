<?php
use App\Routes\Route;

// En débutant le site
Route::get('/', 'ConnexionController@index');
Route::post('/', 'ConnexionController@validate');

Route::dispatch();