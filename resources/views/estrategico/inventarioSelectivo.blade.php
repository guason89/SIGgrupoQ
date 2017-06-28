@extends('layouts.master')
@section('css')
<style>
	.input-group-addon{
		background: #D8D8D8;
	}
	
</style>
@endsection
@section('contenido')
<div class="row">
		<div class="col-md-9 col-sm-8 col-xs-6">
			<label>RPTEST01</label>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6">
			<label>{{$fecha}}</label>
		</div>
</div>
<div class="panel with-nav-tabs panel-success">
  <div class="panel-heading" style="text-align: center;">    	
			<b>Reporte De Inventario Selectivo De Almacenes De Repuesto
	    	<br>Area Logistica En Bodegas
	    	<br>Grupo Q<b>
  </div>
  <div id="panel-collapse-info" class="collapse in">
    <form action="{{route('informe-inventario-selectivo')}}" method="POST" class="form form-vertical" role="form" id="almacenarRegistro" >
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <br>   
      <div class="panel-body">
        <div class="row">
        	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
		            <div class="input-group">
		              <div class="input-group-addon"><b>Fecha Desde :</b></div>
		              <input type="text" class="form-control datepicker date_masking" id="fechaInicio" name="fechaInicio" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd">
		            </div>	            
		        </div>
		        <div class="col-md-12"><br></div>
		        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
		            <div class="input-group">
		              <div class="input-group-addon"><b>Fecha Hasta :</b></div>
		              <input type="text" class="form-control datepicker date_masking" id="fechaFin" name="fechaFin" value="{{ \Carbon\Carbon::now()}}" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd">	              
		            </div>
		        </div>				
			</div>
			       
		</div>
		
        <br><br><br>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-success">Procesar</button>
			</div>
	        <div class="col-md-2">
	        	<a href="javascript:window.history.back();" style="border: 1px solid black;"  id="cancelar" class="btn btn-default m-t-10">Cancelar</a>
	        </div>          
	    </div>
      </div>   
    </form>
  
  </div><!-- /.tab-content -->
</div><!-- /.collapse in -->
	
@endsection

@section('js')

@if(Session::has('msjErr'))
<script>
	var msg = "<ul class='text-warning'><li>No Se Encontró Ningun Registro En El Rango de Fecha Indicado!</li></ul>";
	alertify.alert("Alerta!",msg, function(){    
  	});
	{{Session::forget('msjErr')}}  
 </script> 
@endif

<script>

$(document).ready(function(){

	$('.date_masking').mask('0000-00-00');
});
   
</script>
@endsection