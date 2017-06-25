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
                   

        $tabla =DB::table('proveedorimportacion as pi')
        ->join('importacionfactura as ifa','pi.idproveedorimportacion','=','ifa.idproveedorimportacion')
        ->join('facturaordenenvio as fe','ifa.idimportacionfactura','=','fe.idimportacionfactura')
        ->select('pi.polizaimportacion','fe.nopedido','ifa.cantidadbultos','ifa.precio','ifa.montototal')
        ->where('pi.idproveedor',$request->proveedor)
        ->whereBetween('ifa.fechafactura', array($request->fechaInicio, $request->fechaFin))
        ->get();

         if(count($tabla)<1){
            /*
           flash('Error: No Se Encontro Ningun Registro!','warning');
            return redirect()->back(); 
            */
            Session::put('msjErr','alert');
            return redirect()->back();
        }

        $totalBultos = 0; $totalMonto=0.00;
        for($i=0; $i<count($tabla);$i++)
        {
            $totalBultos = $totalBultos+$tabla[$i]->cantidadbultos;
            $totalMonto = $totalMonto+$tabla[$i]->montototal;
        }

        $data['proveedor'] = $proveedor;
        $data['tabla'] = $tabla;
        $data['totalBultos'] = $totalBultos;
        $data['totalMonto'] = $totalMonto;

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

        $tabla =DB::table('proveedor as ps')
        ->join('inventarioproducto as ip','ip.idproveedor','=','ps.idproveedor')
        ->join('detalleagravio as da','ip.idinventarioproducto','=','da.idinventarioproducto')
        ->join('tipoagravio as ta','da.idtipoagravio','=','ta.idtipoagravio')
        ->join('almacen as an','ip.idalmacen','=','an.idalmacen')
        ->join('producto as po','ip.idproducto','=','po.idproducto')
        ->select(DB::raw('concat(po.codigo,\'-\',po.nombre) as producto'),'da.fechareportado','da.unidadestotales','da.precio','da.montototal',DB::raw('concat(da.idtipoagravio,\'-\',ta.nombre) as averia'),'ta.descripcion','ip.ubicacion',DB::raw('concat(an.codigo,\'-\',an.nombre) as almacen'))
        ->where('ps.idproveedor',$request->proveedor)
        ->whereBetween('da.fechareportado', array($request->fechaInicio, $request->fechaFin))
        ->get();

        $totalSustituir = 0; $totalMonto=0.00;
        for($i=0; $i<count($tabla); $i++)
        {
            $totalSustituir = $totalSustituir + $tabla[$i]->unidadestotales;
            $totalMonto = $totalMonto + $tabla[$i]->montototal;
        }

        $data['tabla'] = $tabla;
        $data['totalSustituir'] = $totalSustituir;
        $data['totalMonto'] = $totalMonto;

        if(count($tabla)<1){
            Session::put('msjErr','alert');
            return redirect()->back(); 
        }

        $pdf = PDF::loadView('tactico.danhoRepuestosImportadosPdf',$data);
        return $pdf->stream();
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
          'centro' => 'required'         
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

        $centro = DB::table('centro')->where('idcentro',$request->centro)->first();
        $data['centro'] = $centro;

        $tabla = DB::table('centro as ce')
            ->join('equipotransporte as et','ce.idcentro','=','et.idcentro')
            ->join('ordenenvio as oe','ce.idcentro','=','oe.idcentro')
            ->join('tipoorden as to','oe.idtipoorden','=','to.idtipoorden')
            ->join('factura as fa','oe.idordenenvio','=','fa.idordenenvio')
            ->join('cliente as cl','fa.idcliente','=','cl.idcliente')
            ->where('ce.idcentro',$request->centro)
            ->whereBetween('fa.fecha', array($request->fechaInicio, $request->fechaFin))
            ->select('fa.codigofactura','fa.fecha','fa.totalmontofactura','oe.nopedido','oe.estadoactual','to.nombre','et.placa','et.marca')
            ->get();

        $pdf = PDF::loadView('tactico.ventasNoEntregadasPdf',$data);
        return $pdf->stream();
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
          'centro' => 'required'         
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

        $centro = DB::table('centro')->where('idcentro',$request->centro)->first();
        $data['centro'] = $centro;

        $pdf = PDF::loadView('tactico.danhoInternoRepuestosPdf',$data);
        return $pdf->stream();
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

        $pdf = PDF::loadView('tactico.ventasAlContadoPdf',$data);
        return $pdf->stream();
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

        $pdf = PDF::loadView('tactico.materialDespachoPdf',$data);
        return $pdf->stream();
    }
}
