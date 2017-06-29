<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Date;
use PDF;
use Carbon\Carbon;
use Flash;
use Auth;
use DB;
use Session;

class EstrategicoController extends Controller
{
    public function inventarioSelectivo(){
        $date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

    	return view('estrategico.inventarioSelectivo',$data);
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

        $tabla = DB::table('diferenciafisicosistematest01 as test01')
                ->join('producto as pro','pro.idproducto','=','test01.idproducto')
                ->select('pro.nombre','pro.descripcion','test01.fecharealizado','test01.unidadessistema','test01.unidadescontadas','test01.preciounitario','test01.montodiferencias')
                ->whereBetween('test01.fecharealizado', array($request->fechaInicio, $request->fechaFin))
                ->limit(10)->get();

        if(count($tabla)<1){
         
            Session::put('msjErr','alert');
            return redirect()->back();
        }

        $total = 0.00;
        foreach ($tabla as $t) {
            $total += $t->montodiferencias;
        }

        $data['tabla'] = $tabla; 
        $data['total'] = $total;    
        
        $view =  \View::make('estrategico.inventarioSelectivoPdf',$data)->render();
                 $pdf = \App::make('dompdf.wrapper');
                 $pdf->loadHTML($view);
                 return $pdf->stream("rptest01.pdf");

    }

     public function reabastecimientoAlmacenes(){
        $date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        $centro = DB::table('centro')->get();
        $data['centro'] = $centro;
        return view('estrategico.reabastecimientoAlmacenes',$data);
    }

    public function reabastecimientoAlmacenesPdf(Request $request){
        $this->validate($request,[             
          'fechaInicio'=>'required',
          'fechaFin' => 'required',
          'centroSalida'=>'required',
          'centroEntrada'=>'required'          
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

        $tabla = DB::table('rebastecimientoproductotest02 as test02')
                ->join('producto as pro','test02.idproducto','=','pro.idproducto')                
                ->select('pro.codigo','pro.nombre','test02.fecha','test02.cantidad','test02.costounitario','test02.montototal')
                ->where('test02.idcentrosalida',$request->centroSalida)
                ->where('test02.idcentrodestino',$request->centroEntrada)
                ->whereBetween('test02.fecha', array($request->fechaInicio, $request->fechaFin))
                ->limit(16)->get();

        if(count($tabla)<1){
         
            Session::put('msjErr','alert');
            return redirect()->back();
        }
            $total= 0.00;
        foreach ($tabla as $t) {
            $total += $t->montototal;
        }

        $data['tabla'] = $tabla;
        $data['centroSalida'] =$request->centroSalida;  
        $data['centroEntrada'] = $request->centroEntrada;
        $data['total'] = $total;

        $view =  \View::make('estrategico.reabastecimientoAlmacenesPdf',$data)->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream("rptest02.pdf");
    }

    public function kilometrajeConsumido(){
    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        $vehiculo = DB::table('equipotransporte')->get();
        $data['vehiculo'] = $vehiculo;
        return view('estrategico.kilometrajeConsumido',$data);
    }

    public function kilometrajeConsumidoPdf(Request $request){
        $this->validate($request,[             
          'fechaInicio'=>'required',
          'fechaFin' => 'required',
          'vehiculo'=>'required'                   
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

        $tabla = DB::table('kiloequipotransportetest03 as test03')
                ->join('equipotransporte as equi','test03.idequipotransporte','=','equi.idequipotransporte')
                ->where('equi.placa',$request->vehiculo)
                ->whereBetween('test03.fechaasignado', array($request->fechaInicio, $request->fechaFin))
                ->select('equi.estadoactualuso','test03.fechaasignado','test03.kminicial','test03.kmfinal','test03.combustiblesconsumido','test03.montoconsumido')
                ->limit(10)->get();

        if(count($tabla)<1){
         
            Session::put('msjErr','alert');
            return redirect()->back();
        }

        $total = 0.00;
        foreach ($tabla as $t) {
            $total += $t->montoconsumido;
        }

        $data['tabla'] = $tabla;
        $data['total'] = $total;
        $data['vehiculo'] = $request->vehiculo;

        $view =  \View::make('estrategico.kilometrajeConsumidoPdf',$data)->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream("rptest03.pdf");
    }

    public function tiempoDescarga(){

    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        return view('estrategico.tiempoDescarga',$data);
    }

    public function tiempoDescargaPdf(Request $request){
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

        $tabla = DB::table('descargacontenedortest04')
                ->whereBetween('fechafactura', array($request->fechaInicio, $request->fechaFin))
                ->select('nofactura','fechafactura','fechallegada','horallegada','fechaapertura','horaapertura','fechafinalizacion','horafinalizacion','tiempoestandar')
                ->limit(11)->get();

        if(count($tabla)<1){
         
            Session::put('msjErr','alert');
            return redirect()->back();
        }

        $data['tabla'] = $tabla;      

        $view =  \View::make('estrategico.tiempoDescargaPdf',$data)->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream("rptest04.pdf");
    }

    public function combustibleConsumido(){
    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        $vehiculo = DB::table('equipotransporte')->get();
        $data['vehiculo'] = $vehiculo;

        return view('estrategico.cantidadCombustible',$data);
    }

    public function combustibleConsumidoPdf(Request $request){
        $this->validate($request,[             
          'fechaInicio'=>'required',
          'fechaFin' => 'required',
          'vehiculo'=>'required'                   
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

        $tabla = DB::table('combustibleconsumidotest05 as test05')
                ->join('equipotransporte as equi','test05.idequipotransporte','=','equi.idequipotransporte')
                ->where('equi.placa',$request->vehiculo)
                ->whereBetween('test05.fechaasignado', array($request->fechaInicio, $request->fechaFin))
                ->select('equi.estadoactualuso','test05.fechaasignado','test05.combustibleasignado','test05.ahorroexcedente','test05.combustibleactualfinal')
                ->limit(13)->get();

        if(count($tabla)<1){
         
            Session::put('msjErr','alert');
            return redirect()->back();
        }

        $total = 0.00;
        foreach ($tabla as $t) {
            $total += $t->combustibleactualfinal;
        }
        
        $data['tabla'] = $tabla;
        $data['total'] = $total;

        $view =  \View::make('estrategico.cantidadCombustiblePdf',$data)->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream("rptest05.pdf");
    }

    public function getCentro(Request $request){
        $result = "<option value=''>Seleccione Una Opcion</option>";
        $centros = DB::table('centro')->where('idcentro','!=',$request->centro)->pluck('nombre','idcentro');
        foreach ($centros as $key => $value) {
            $result .= "<option value='$key'>$value</option>";
        }
        return $result;
    }
}

