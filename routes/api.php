<?php
use Illuminate\Support\Facades\Route;

/**
 * URLs relacionados ao jornalista sem autenticação
 */
Route::post('/login', 'JornalistaController@login');
Route::post('/register', 'JornalistaController@register');

/**
 * URLs relacionados ao jornalista com autenticação
 */
Route::group(['middleware' => 'checkAuth'], function(){
    Route::post('/me', 'JornalistaController@me');
});

/**
 * URLs relacionados as notícias com autenticação
 */
Route::group(['middleware' => 'checkAuth', 'prefix' => 'news'], function(){
    Route::post('/create', 'NoticiaController@store');
    Route::post('/update/{id}', 'NoticiaController@update');
    Route::post('/delete/{id}', 'NoticiaController@destroy');
    Route::get('/me', 'NoticiaController@me');
    Route::get('/type/{id}', 'NoticiaController@typeShow');
});

/**
 * URLs relacionados aos tipos de notícias com autenticação
 */
Route::group(['middleware' => 'checkAuth', 'prefix' => 'type'], function(){
    Route::post('/create', 'TipoNoticiaController@store');
    Route::post('/update/{id}', 'TipoNoticiaController@update');
    Route::post('/delete/{id}', 'TipoNoticiaController@destroy');
    Route::get('/me', 'TipoNoticiaController@me');
});
