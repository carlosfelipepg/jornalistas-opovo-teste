<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'checkAuth'], function(){
    Route::get('/', function () {
        return response()->json(['message' => 'Jornalista API', 'status' => 'Connected']);;
    });
    Route::post('/me', 'JornalistaController@me');
//    Route::resource('news', 'NoticiaController');
});

Route::post('/login', 'JornalistaController@login');
Route::post('/register', 'JornalistaController@register');


Route::group(['middleware' => 'checkAuth', 'prefix' => 'news'], function(){
    Route::post('/create', 'NoticiaController@store');
    Route::post('/update/{id}', 'NoticiaController@update');
    Route::post('/delete/{id}', 'NoticiaController@destroy');
    Route::get('/me', 'NoticiaController@me');
    Route::get('/type/{id}', 'NoticiaController@typeShow');
});

Route::group(['middleware' => 'checkAuth', 'prefix' => 'type'], function(){
    Route::post('/create', 'TipoNoticiaController@store');
});
