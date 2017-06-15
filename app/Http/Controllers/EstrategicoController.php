<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Date;
use PDF;
use Carbon\Carbon;
use Flash;
use Auth;

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

    public function inventarioSelectivoPdf(Request $request){ 
        $this->validate($request,[             
          'fechaInicio'=>'required',
          'fechaFin' => 'required',          
        ]);
        if($request->fechaFin>Date::now()){
            flash('Error: La fecha Fin No Debe Ser Mayor A La Fecha Actual!','danger');
            return redirect()->back();
        }
        if($request->fechaInicio>$request->fechaFin){
           flash('Error: La fecha Inicio No Debe Ser Mayor A La Fecha Fin!','danger');
            return redirect()->back(); 
        }

        $date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;
        $data['usuario'] = Auth::user();
        $data['fechaInicio'] = $request->fechaInicio;
        $data['fechaFin'] = $request->fechaFin;

        $pdf = PDF::loadView('estrategico.inventarioSelectivoPdf',$data);
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

