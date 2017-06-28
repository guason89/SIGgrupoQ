<?php


Route::group(['middleware'=>['auth']],function(){

	Route::get('llenarBaseEtl',['as'=>'llenar.base','uses'=>'EtlController@llenarBase']);

});