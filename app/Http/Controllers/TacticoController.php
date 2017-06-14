<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TacticoController extends Controller
{
    public function bultosPorContenedor(){
    	return "bultosPorContenedor";
    }

    public function dañoRepuestosImportados(){
    	return "dañoRepuestosImportados";
    }

    public function ventasDomicilioNoEntregadas(){
    	return "ventasDomicilioNoEntregadas";
    }

    public function dañoInternoRepuestos(){
    	return "dañoInternoRepuestos";
    }

    public function ventasAlContado(){
    	return "ventasAlContado";
    }

    public function materialDeDespacho(){
    	return "materialDeDespacho";
    }
}
