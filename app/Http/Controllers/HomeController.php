<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Requisicion;
use App\Http\Requests;
use DB;

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

        return view('home',$data);     
    }
}
