<?php



Route::group(['middleware'=>['auth']],function(){

	Route::get('rptact01',['as'=>'bultos.por.contenedor','uses'=>'TacticoController@bultosPorContenedor']);

	Route::post('/pdf/rptact01',['as'=>'informe-bultos-contenedor','uses'=>'TacticoController@bultosPorContenedorPdf']);

	Route::get('rptact02',['as'=>'daño.repuestos.importados','uses'=>'TacticoController@dañoRepuestosImportados']);

	Route::post('pdf/rptact02',['as'=>'informe-daño-repuestos-importados','uses'=>'TacticoController@dañoRepuestosImportadosPdf']);

	Route::get('rptact03',['as'=>'ventas.no.entregadas','uses'=>'TacticoController@ventasDomicilioNoEntregadas']);

	Route::post('pdf/rptact03',['as'=>'informe-ventas-no-entregadas','uses'=>'TacticoController@ventasDomicilioNoEntregadasPdf']);

	Route::get('rptact04',['as'=>'daño.interno.repuestos','uses'=>'TacticoController@dañoInternoRepuestos']);

	Route::post('pdf/rptact04',['as'=>'informe-daño-interno-repuestos','uses'=>'TacticoController@dañoInternoRepuestosPdf']);

	Route::get('rptact05',['as'=>'ventas.al.contado','uses'=>'TacticoController@ventasAlContado']);

	Route::post('pdf/rptact05',['as'=>'iforme-ventas-al-contado','uses'=>'TacticoController@ventasAlContadoPdf']);

	Route::get('rptact06',['as'=>'material.despacho','uses'=>'TacticoController@materialDeDespacho']);

	Route::post('pdf/rptact06',['as'=>'informe-material-despacho','uses'=>'TacticoController@materialDeDespachoPdf']);

});