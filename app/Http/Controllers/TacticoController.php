<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Date;
use PDF;
use Carbon\Carbon;
use Flash;
use Auth;
use DB;

class TacticoController extends Controller
{
    public function bultosPorContenedor(){
    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        return view('tactico.bultosContenedor',$data);
    }

    public function bultosPorContenedorPdf(Request $request){
    return "bultosContenedor";
    }

    public function dañoRepuestosImportados(){
    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        return view('tactico.dañosRepuestosImportados',$data);
    }

    public function dañoRepuestosImportadosPdf(Request $request){
        return "dañoRepuestosImportados";
    }

    public function ventasDomicilioNoEntregadas(){
    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        return view('tactico.ventasNoEntregadas',$data);
    }

    public function dañoInternoRepuestos(){
    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        return view('tactico.dañoInternoRepuestos',$data);
    }

    public function ventasAlContado(){
    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        return view('tactico.ventasAlContado',$data);
    }

    public function materialDeDespacho(){
    	$date = new Date();
        $date = $date->format('l, j \d\e F \d\e Y');
        $data['fecha'] = $date;

        return view('tactico.materialDespacho',$data);
    }
}
