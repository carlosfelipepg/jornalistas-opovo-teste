<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'checkAuth'], function(){
    Route::get('/', function () {
        return response()->json(['message' => 'Jornalista API', 'status' => 'Connected']);;
    });
    Route::post('/me', 'JornalistaController@me');
});

Route::post('/login', 'JornalistaController@login');
Route::post('/register', 'JornalistaController@register');
