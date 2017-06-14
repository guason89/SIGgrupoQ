<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Date;
use PDF;

class EstrategicoController extends Controller
{
    public function inventarioSelectivo(){
        $date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

    	return view('estrategico.inventarioSelectivo',$data);
    }

    public function reabastecimientoAlmacenes(){
    	$pdf = PDF::loadHtml('<p>contenido del pdf</p>');
        return $pdf->stream(); 
    }

    public function kilometrajeConsumido(){
    	return "kilometrajeConsumido";
    }

    public function tiempoDescarga(){
    	return "tiempoDescarga";
    }

    public function combustibleConsumido(){
    	return "combustibleConsumido";
    }
}

