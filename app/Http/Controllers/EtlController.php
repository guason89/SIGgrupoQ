<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Marquine\Etl\Job;
use Redirect;
use Session;

class EtlController extends Controller
{
    public function llenarBase(){
    	$path = getcwd(); // directorio actual
    	$dir = explode( '\public', $path) ;
    	//$job = new Job;

    	Job::start()->extract('csv', $dir[0].'\archivosCSV\clientes.csv')
    		->transform('trim', ['columns' => ['idcliente','nombre','nit','direccion','cuentahabilitada']])
    		->load('table','cliente');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\centro.csv')
            ->transform('trim', ['columns' => ['idcentro','codigo','nombre']])
            ->load('table','centro');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\almacen.csv')
            ->transform('trim', ['columns' => ['idalmacen','codigo','nombre','direccion','deptodestino']])
            ->load('table','almacen');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\tipoagravio.csv')
            ->transform('trim', ['columns' => ['idtipoagravio','nombre','descripcion']])
            ->load('table','tipoagravio');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\tipoorden.csv')
            ->transform('trim', ['columns' => ['idtipoorden','nombre']])
            ->load('table','tipoorden');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\tipodepago.csv')
            ->transform('trim', ['columns' => ['idtipopago','nombre','descripcion']])
            ->load('table','tipopago');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\producto.csv')
            ->transform('trim', ['columns' => ['idproducto','idcentro','nombre','codigo','descripcion']])
            ->load('table','producto');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\proveedor.csv')
            ->transform('trim', ['columns' => ['idproveedor','nombre','descripcion','codigo']])
            ->load('table','proveedor');

        /*Job::start()->extract('csv', $dir[0].'\archivosCSV\agraviointerior.csv')
            ->transform('trim', ['columns' => ['id','idcentro','idproducto','idtipoagravio','cantexistencia','unidad','fechareportado','unidadestotales','precio','montototal','empleadonombre','empleadodui']])
            ->load('table','agraviointerioralmacentact04');*//*No funciona ErrorException Undefined index: id*/

        Job::start()->extract('csv', $dir[0].'\archivosCSV\agraviorespuestotact02.csv')
            ->transform('trim', ['columns' => ['id','idproducto','idproveedor','idalmacen','idtipoagravio','fechareportado','unidadestotales','precio','montototal','ubicacion']])
            ->load('table','agraviosrespuestostact02');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\equipodetransportee.csv')
            ->transform('trim', ['columns' => ['idequipotransporte','idcentro','placa','marca','modelo','estadoactualuso','valordepreciacionanual','valorcomprarreal']])
            ->load('table','equipotransporte');

       Job::start()->extract('csv', $dir[0].'\archivosCSV\combustibleconsumidotest05.csv')
            ->transform('trim', ['columns' => ['id','idequipotransporte','fechaasignado','combustibleasignado','ahorroexcedente','combustibleactualfinal']])
            ->load('table','combustibleconsumidotest05');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\descargacontenedortest04.csv')
            ->transform('trim', ['columns' => ['id','nofactura','fechafactura','fechallegada','horallegada','fechaapertura','horaapertura','fechafinalizacion','horafinalizacion','tiempoestandar']])
            ->load('table','descargacontenedortest04');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\diferenciasfisicosistemastest01.csv')
            ->transform('trim', ['columns' => ['id','idproducto','centrocodigo','centronombre','fecharealizado','unidadescontadas','unidadessistema','preciounitario','montodiferencias']])
            ->load('table','diferenciafisicosistematest01');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\existenciasdespachotact06.csv')
            ->transform('trim', ['columns' => ['id','materialdespachonombre','tipodatosnombre','cantidadmensual','costototalmensual','fecha','cantidaddisponibles','saldodisponible']])
            ->load('table','existenciadespachotact06');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\kilometrajetrasportetest03.csv')
            ->transform('trim', ['columns' => ['id','idequipotransporte','fechaasignado','kminicial','kmfinal','combustiblesconsumido','montoconsumido']])
            ->load('table','kiloequipotransportetest03');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\llegadacontenedorestact01.csv')
            ->transform('trim', ['columns' => ['id','idproveedor','polizaimportacion','nopedido','cantidadbultos','fechafactura']])
            ->load('table','llegadacontenedorestact01');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\reabastecimientoproductostest02.csv')
            ->transform('trim', ['columns' => ['id','idproducto','idcentrosalida','idcentrodestino','fecha','cantidad','costounitario','montototal']])
            ->load('table','rebastecimientoproductotest02');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\ventascontadotact05.csv')
            ->transform('trim', ['columns' => ['id','idcliente','idtipopago','idtipoorden','fecha','totalmontofactura']])
            ->load('table','ventascontadotact05');

        Job::start()->extract('csv', $dir[0].'\archivosCSV\ventasnoentregadastact03.csv')
            ->transform('trim', ['columns' => ['id','idcliente','codigofactura','fecha','totalmontofactura','nopedido','estadoactual','tipoordennombre']])
            ->load('table','ventasnoentregadastact03');


    	

    flash('La Base De Datos Se Lleno Exitosamente!','success');            
            return redirect()->route('doInicio');

    }
}
