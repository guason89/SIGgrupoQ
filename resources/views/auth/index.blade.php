@extends('layouts.master')

@section('contenido')
    <div class="encabezado">
	    <h3>Usuarios</h3>
    </div>	
        <a href="{{route('insertar.usuario')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>Nuevo</a>
     
<div class="panel-body table-responsive">
                   
           



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
                              <td>{{$u->nombre}}</td>               
                              <td>{{$u->perfil["nombre"]}}</td> 
                              <td >

                              <a class="btn btn-info btn-sm" title="editar" href="{{route('editar.usuario',['id'=>$u->id])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>   

                              <a class="btn btn-danger btn-sm" title="eliminar" href="{{route('eliminar.usuario',$u->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                              </td>
                         
                      </tr>
                   @endforeach      
                                      
                </tbody>
            </table>

</div>

 @endsection
