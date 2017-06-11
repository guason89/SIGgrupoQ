@extends('layouts.master')

@section('contenido')


<div class="panel-body table-responsive">
       
                <div class="box-header with-border">
                  <h3 class="box-title">CONFIRMA ELIMINAR EL USUARIO???</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="form-horizontal">
	               <form action="{{ route('destroy.usuario') }}" method="POST"  role="form">
						{{ csrf_field() }}
	               		<div class="panel panel-default">
							<table class="table table-hover ">							
							  
							    <tr class="row">
								    <th class="col-xs-1">Numero</th>
								    <input type="hidden" name="idUsuario" value="{{$usuario->id}}">
								    <td class="col-xs-6">{{$usuario->id}}</td>
								    <td class="col-xs-5"></td>
							    </tr>
								    <tr class="row">
								    <th class="col-xs-1">Nombre</th>
								    <td class="col-xs-6">{{$usuario->nombre}}</td>
								    <td class="col-xs-5 "></td>
							    </tr> 
							    </tr>
								    <tr class="row">
								    <th class="col-xs-1">Usuario</th>
								    <td class="col-xs-6">{{$usuario->usuario}}</td>
								    <td class="col-xs-5 "></td>
							    </tr> 							   
							    <tr class="row">
								    <th class="col-xs-1">Perfil</th>
								    <td class="col-xs-6">{{$usuario->perfil['nombre']}}</td>
								    <td class="col-xs-5"></td>
							    </tr> 
							    <tr class="row">
								    <th class="col-xs-1">Correo</th>
								    <td class="col-xs-6">{{$usuario->email}}</td>
								    <td class="col-xs-5"></td>
							    </tr>
													         
												  
							</table>
						</div>
	            
	                  <div class="">
	                  		<a href="javascript:window.history.back();"><button type="button" id="cancelar" class="btn btn-default m-t-10">Cancelar</button></a>
	                        <button type="submit" class="btn btn-danger">Eliminar</button>
	                  </div><!-- /.box-footer -->
	               {!!Form::close()!!}
               </div>
       

</div>
 @endsection


