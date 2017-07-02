<?php



Route::group(['middleware'=>['auth']],function(){

	Route::get('usuario/registrar',['as'=>'insertar.usuario','uses'=>'UsersController@getRegister']);
	Route::post('post/register',['as'=>'store.usuario' ,'uses'=>'UsersController@postRegister']);
	Route::get('usuarios',['as'=>'indexusuarios', 'uses'=>'UsersController@index']);
	Route::get('usuario/editar/{id}',['as'=>'editar.usuario','uses'=>'UsersController@getEdit']); 
	Route::post('usuario/actualizar',['as'=>'actualizar.usuario','uses'=>'UsersController@update']);   
	Route::get('usuario/eliminar/{id}',['as'=>'eliminar.usuario','uses'=>'UsersController@mostrar']);
    Route::post('usuario/destroy/',['as'=>'destroy.usuario','uses'=>'UsersController@destroy']);

    Route::get('usuario/reset/',['as'=>'reset.usuario','uses'=>'UsersController@restaurarUsuarios']);
});