<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Requisicion;
use App\Http\Requests;
use DB;
use Date;

class HomeController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
       
    }
    
     public function index()
    {
    	$data = ['title' 			=> 'Inicio' 
				,'subtitle'			=> ''
				,'breadcrumb' 		=> [
			 		['nom'	=>	'', 'url' => '#']
				]];

    $date = new Date();
    $date = $date->format('l, j \d\e F \d\e Y');
    $data['fecha'] = $date;
    
        return view('home',$data);     
    }

}
