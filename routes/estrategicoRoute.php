<?php



Route::group(['middleware'=>['auth']],function(){

	Route::get('rptest01',['as'=>'inventario.selectivo','uses'=>'EstrategicoController@inventarioSelectivo']);

	Route::get('rtrest02/',['as'=>'reabastecimiento.almacenes','uses'=>'EstrategicoController@reabastecimientoAlmacenes']);

	Route::get('rtrest03/',['as'=>'kilometraje.consumido','uses'=>'EstrategicoController@kilometrajeConsumido']);

	Route::get('rtrest04/',['as'=>'tiempo.descarga','uses'=>'EstrategicoController@tiempoDescarga']);

	Route::get('rtrest05/',['as'=>'combustible.consumido','uses'=>'EstrategicoController@combustibleConsumido']);

});