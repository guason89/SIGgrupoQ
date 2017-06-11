<?php

Route::get('register',['as'=>'insertar.usuario','uses'=>'UsersController@getRegister']);
Route::post('post/register',['as'=>'store.usuario' ,'uses'=>'UsersController@postRegister']);
Route::get('usuarios',['as'=>'indexusuarios', 'uses'=>'UsersController@index']);