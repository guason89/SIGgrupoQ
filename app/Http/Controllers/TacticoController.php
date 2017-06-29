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

class TacticoController extends Controller
{
    public function bultosPorContenedor(){

    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        $proveedores = DB::table('proveedor')->get();
        $data['proveedores'] = $proveedores;
        return view('tactico.bultosContenedor',$data);
    }

    public function bultosPorContenedorPdf(Request $request){
        $this->validate($request,[             
          'fechaInicio'=>'required',
          'fechaFin' => 'required',
          'proveedor' => 'required'         
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

        $proveedor = DB::table('proveedor')
                    ->where('idproveedor',$request->proveedor)->first();
                   

        $tabla =DB::table('proveedor as pro')
        ->join('llegadacontenedorestact01 as tact01','tact01.idproveedor','=','pro.idproveedor')       
        ->select('tact01.polizaimportacion','tact01.nopedido','tact01.fechafactura','tact01.cantidadbultos')
        ->where('pro.idproveedor',$request->proveedor)
        ->whereBetween('tact01.fechafactura', array($request->fechaInicio, $request->fechaFin))
        ->get();

        if(count($tabla)<1){
            Session::put('msjErr','alert');
            return redirect()->back();
        }

        $totalBultos = 0; 
        for($i=0; $i<count($tabla);$i++)
        {
            $totalBultos = $totalBultos+$tabla[$i]->cantidadbultos;           
        }

        $data['proveedor'] = $proveedor;
        $data['tabla'] = $tabla;
        $data['totalBultos'] = $totalBultos;       

        $view =  \View::make('tactico.bultosContenedorPdf',$data)->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream("rptact01.pdf");    
       
    }

    public function dañoRepuestosImportados(){
    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;
        $proveedores = DB::table('proveedor')->get();
        $data['proveedores'] = $proveedores;

        return view('tactico.danhoRepuestosImportados',$data);
    }

    public function dañoRepuestosImportadosPdf(Request $request){
        $this->validate($request,[             
          'fechaInicio'=>'required',
          'fechaFin' => 'required',
          'proveedor' => 'required'         
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

        $proveedor = DB::table('proveedor')
                    ->where('idproveedor',$request->proveedor)->first();
        $data['proveedor'] = $proveedor;

        $tabla =DB::table('agraviosrespuestostact02 as tact02')
        ->join('producto as pro','tact02.idproducto','=','pro.idproducto')
        ->join('proveedor as pdr','tact02.idproveedor','=','pdr.idproveedor')
        ->join('almacen as acen','tact02.idalmacen','=','acen.idalmacen')
        ->join('tipoagravio as tao','tact02.idtipoagravio','=','tao.idtipoagravio')       
        ->select('pro.codigo','pro.nombre','acen.nombre as almacen','tao.nombre as averia','tao.descripcion','tact02.fechareportado','tact02.precio','tact02.unidadestotales','tact02.montototal')
        ->where('pdr.idproveedor',$request->proveedor)
        ->whereBetween('tact02.fechareportado', array($request->fechaInicio, $request->fechaFin))
        ->get();

        if(count($tabla)<1){
            Session::put('msjErr','alert');
            return redirect()->back();
        }

        $totalSustituir = 0; $totalMonto=0.00;
        for($i=0; $i<count($tabla); $i++)
        {
            $totalSustituir = $totalSustituir + $tabla[$i]->unidadestotales;
            $totalMonto = $totalMonto + $tabla[$i]->montototal;
        }

        $data['tabla'] = $tabla;
        $data['totalSustituir'] = $totalSustituir;
        $data['totalMonto'] = $totalMonto;

        $view =  \View::make('tactico.danhoRepuestosImportadosPdf',$data)->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream("rptact02.pdf");
    }

    public function ventasDomicilioNoEntregadas(){
    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        $centros = DB::table('centro')->get();
        $data['centros'] = $centros;

        return view('tactico.ventasNoEntregadas',$data);
    }

    public function ventasDomicilioNoEntregadasPdf(Request $request){
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


        $tabla = DB::table('ventasnoentregadastact03 as tact03')
            ->join('cliente as cli','tact03.idcliente','=','cli.idcliente')
            ->join('equipotransporte as equi','tact03.idequipotransporte','=','equi.idequipotransporte') 
            ->where('tact03.estadoactual','no entregado')        
            ->whereBetween('tact03.fecha', array($request->fechaInicio, $request->fechaFin))
            ->select('tact03.codigofactura','tact03.fecha','cli.nombre','tact03.nopedido','equi.placa','tact03.totalmontofactura','tact03.estadoactual','equi.marca')
            ->limit(15)->get();

        if(count($tabla)<1){
            Session::put('msjErr','alert');
            return redirect()->back();
        }

        $totalMonto=0.00;
        for($i=0; $i<count($tabla); $i++)
        {            
            $totalMonto = $totalMonto + $tabla[$i]->totalmontofactura;
        }

        $data['tabla'] = $tabla;        
        $data['totalMonto'] = $totalMonto;
//return view('tactico.ventasNoEntregadasPdf',$data);
        $view =  \View::make('tactico.ventasNoEntregadasPdf',$data)->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream("rptact03.pdf");
    }

    public function dañoInternoRepuestos(){
    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        $centros = DB::table('centro')->get();
        $data['centros'] = $centros;

        return view('tactico.danhoInternoRepuestos',$data);
    }

    public function dañoInternoRepuestosPdf(Request $request){
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

        $tabla = DB::table('agraviointerioralmacentact04 as tact04')
                ->join('producto as pro','tact04.idproducto','=','pro.idproducto')
                ->join('tipoagravio as tip','tact04.idtipoagravio','=','tip.idtipoagravio')
                ->whereBetween('tact04.fechareportado', array($request->fechaInicio, $request->fechaFin))
                ->select('pro.nombre','pro.descripcion','tact04.fechareportado','tact04.cantexistencia','tact04.unidadestotales','tact04.precio','tip.descripcion as averia','tact04.montototal','tact04.empleadonombre','tact04.empleadodui')
                ->limit(18)->get();  
   
        if(count($tabla)<1){
            Session::put('msjErr','alert');
            return redirect()->back();
        }
        
        $totalMonto=0.00;
        for($i=0; $i<count($tabla); $i++)
        {            
            $totalMonto = $totalMonto + $tabla[$i]->montototal;
        }

        $data['tabla'] = $tabla;        
        $data['totalMonto'] = $totalMonto;

        $view =  \View::make('tactico.danhoInternoRepuestosPdf',$data)->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream("rptact04.pdf");
    }

    public function ventasAlContado(){
    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        return view('tactico.ventasAlContado',$data);
    }

    public function ventasAlContadoPdf(Request $request){
        $this->validate($request,[             
          'fechaInicio'=>'required',
          'fechaFin' => 'required'         
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

        
        $tabla = DB::table('ventascontadotact05 as tact05')
                ->join('cliente as cli','tact05.idcliente','=','cli.idcliente')
                ->join('tipopago as tpo','tact05.idtipopago','=','tpo.idtipopago')
                ->join('tipoorden as tno','tact05.idtipoorden','=','tno.idtipoorden')
                ->whereIn('tpo.nombre',['contado','cheque'])
                ->whereBetween('tact05.fecha', array($request->fechaInicio, $request->fechaFin))
                ->select('cli.nombre as cliente','tpo.nombre as tipopago','tact05.fecha','tno.nombre','tact05.totalmontofactura')
                ->limit(16)->get();  
   
        if(count($tabla)<1){
            Session::put('msjErr','alert');
            return redirect()->back();
        }

         $totalMonto=0.00;
        for($i=0; $i<count($tabla); $i++)
        {            
            $totalMonto = $totalMonto + $tabla[$i]->totalmontofactura;
        }

        $data['tabla'] = $tabla;        
        $data['totalMonto'] = $totalMonto;

        $view =  \View::make('tactico.ventasAlContadoPdf',$data)->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream("rptact05.pdf");
    }

    public function materialDeDespacho(){
    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        return view('tactico.materialDespacho',$data);
    }

    public function materialDeDespachoPdf(Request $request){
        $this->validate($request,[             
          'fechaInicio'=>'required',
          'fechaFin' => 'required'         
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


        $tabla = DB::table('existenciadespachotact06 as tact06')
                ->whereBetween('tact06.fecha', array($request->fechaInicio, $request->fechaFin))
                ->select('materialdespachonombre as nombre','tipodatosnombre','tact06.fecha','cantidadmensual','costototalmensual','cantidaddisponibles','saldodisponible')
                ->limit(10)->get();  
   
        if(count($tabla)<1){
            Session::put('msjErr','alert');
            return redirect()->back();
        }

         $totalMonto=0.00;
        for($i=0; $i<count($tabla); $i++)
        {            
            $totalMonto = $totalMonto + $tabla[$i]->saldodisponible;
        }

        $data['tabla'] = $tabla;        
        $data['totalMonto'] = $totalMonto;

        $view =  \View::make('tactico.materialDespachoPdf',$data)->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream("rptact05.pdf");
    }
}
