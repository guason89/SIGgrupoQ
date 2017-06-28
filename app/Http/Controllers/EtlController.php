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

    	Job::start()->extract('csv', $dir[0].'\archivosCSV\cliente.csv')
    		->transform('trim', ['columns' => ['idcliente','nombre','nit','direccion','cuentahabilitada']])
    		->load('table','cliente');

    	

    flash('La Base De Datos Se Lleno Exitosamente!','success');            
            return redirect()->route('doInicio');

    }
}
