@extends('layouts.template')

@section('content')
    <div class="encabezado">
	    <h3>Usuarios</h3>
    </div>	
        <a href="{{url('register')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>Nuevo</a>
     
<div class="panel-body table-responsive">
                   
             @include('Msj.messages')         



            <table id="TablaUsuarios" class="table table-hover table-striped table-bordered table-condensed">       
                <thead>
               
                      
                        <th >Usuario</th>
                        <th >NOMBRE</th>               
                        <th >PERFIL</th>               

                 
                </thead>
                <tbody>
                   @foreach ($usuarios as $u)
                      <tr>
                              <td>{{$u->usuario}}</td>
                              <td>{{$u->name}}</td>               
                              <td>{{$u->perfil["name"]}}</td> 
                              <td >

                              <a class="btn btn-default btn-sm" title="editar" href="{{url($u->id,'edit')}}"><span class="glyphicon glyphicon-pencil "></span></a>   

                              <a class="btn btn-default btn-sm" title="eliminar" href="{{route('usuario-eliminar',$u->id)}}"><span class="glyphicon glyphicon-trash "></span></a>
                              </td>
                         
                      </tr>
                   @endforeach      
                                      
                </tbody>
            </table>

</div>

 @endsection
