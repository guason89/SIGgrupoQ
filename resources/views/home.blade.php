
@extends('layouts.master')

@section('contenido')
<div class="row">
	<div class="col-md-12">
    {{$fecha}}
</div><br><br>
</div>
	@if(Auth::User()->idperfil==1)
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                        
                        <div>CATALOGO DE USUARIOS</div>
                    </div>
                </div>
            </div>
            <a href="{{route('indexusuarios')}}">
                <div class="panel-footer">
                    <span class="pull-left">ir al catalogo</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
	</div>
        <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                        
                        <div>LLENAR BASE DE DATOS</div>
                    </div>
                </div>
            </div>
            <a href="{{route('llenar.base')}}">
                <div class="panel-footer">
                    <span class="pull-left">ETL</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
        <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                        
                        <div>RESTAURAR USUARIOS</div>
                    </div>
                </div>
            </div>
            <a href="{{route('reset.usuario')}}">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>                                              
    @endif
    @if(Auth::User()->idperfil==2)
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-pdf-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                        
                        <div>BULTOS POR CONTENEDOR</div>
                    </div>
                </div>
            </div>
            <a href="{{route('bultos.por.contenedor')}}">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
	</div> 
	<div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-pdf-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                        
                        <div>DAÑO EN REPUESTO IMPORTADOS</div>
                    </div>
                </div>
            </div>
            <a href="{{route('daño.repuestos.importados')}}">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
	</div>
	<div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-pdf-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                        
                        <div>VENTAS A DOMICILIO NO ENTREGADAS</div>
                    </div>
                </div>
            </div>
            <a href="{{route('ventas.no.entregadas')}}">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
	</div> 
	<div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-pdf-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                        
                        <div>DAÑO INTERNO A REPUESTOS</div>
                    </div>
                </div>
            </div>
            <a href="{{route('daño.interno.repuestos')}}">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
	</div> 
	<div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-pdf-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                        
                        <div>VENTAS AL CONTADO; POR CLIENTE</div>
                    </div>
                </div>
            </div>
            <a href="{{route('ventas.al.contado')}}">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
	</div> 
	<div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-pdf-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                        
                        <div>EXISTENCIA MATERIAL DE DESPACHO</div>
                    </div>
                </div>
            </div>
            <a href="{{route('material.despacho')}}">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
	</div> 
</div>                         
    @endif
    @if(Auth::User()->idperfil==3)
<div class="row"> 
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-pdf-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                        
                        <div>REPORTE DE INVENTARIO SELECTIVO</div>
                    </div>
                </div>
            </div>
            <a href="{{route('inventario.selectivo')}}">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
	</div>
	<div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-pdf-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                        
                        <div>REABASTECIMIENTO DE ALMACENES</div>
                    </div>
                </div>
            </div>
            <a href="{{route('reabastecimiento.almacenes')}}">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
	</div> 
	<div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-pdf-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                        
                        <div>KILOMETRAJE CONSUMUDO</div>
                    </div>
                </div>
            </div>
            <a href="{{route('kilometraje.consumido')}}">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
	</div>
	<div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-pdf-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                        
                        <div>TIEMPO DE DESCARGA</div>
                    </div>
                </div>
            </div>
            <a href="{{route('tiempo.descarga')}}">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
	</div>
	<div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-pdf-o fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">                        
                        <div>CANTIDAD DE COMBUSTIBLE</div>
                    </div>
                </div>
            </div>
            <a href="{{route('combustible.consumido')}}">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
	</div> 
</div>                                 
    @endif	

@endsection