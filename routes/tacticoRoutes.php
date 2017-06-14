<?php



Route::group(['middleware'=>['auth']],function(){

	Route::get('rptact01',['as'=>'bultos.por.contenedor','uses'=>'TacticoController@bultosPorContenedor']);

	Route::get('rptact02',['as'=>'daño.repuestos.importados','uses'=>'TacticoController@dañoRepuestosImportados']);

	Route::get('rptact03',['as'=>'ventas.no.entregadas','uses'=>'TacticoController@ventasDomicilioNoEntregadas']);

	Route::get('rptact04',['as'=>'daño.interno.repuestos','uses'=>'TacticoController@dañoInternoRepuestos']);

	Route::get('rptact05',['as'=>'ventas.al.contado','uses'=>'TacticoController@ventasAlContado']);

	Route::get('rptact06',['as'=>'material.despacho','uses'=>'TacticoController@materialDeDespacho']);

});