@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">       
        <div class="col-md-8 col-md-offset-2"> <!--col-md-offset-1-->
            <div class="panel panel-default">
                <div class="panel-heading">Ingresar</div>
                <div class="panel-body">

                        {!!Form::open(['url'=>'login','method'=>'POST','class'=>'form-horizontal','role'=>'form','autocomplete'=>'off'])!!}

                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Usuario</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required>

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contraseña') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="contraseña" required>

                                @if ($errors->has('contraseña'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contraseña') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recordarme
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                    

                            {!!form::submit('Ingresar',['name'=>'login','id'=>'login','content'=>'Login','class'=>'btn btn-primary'])!!}
    


                               
                            </div>
                        </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>       
    </div>       
   <div class="row" style="text-align: center;">
       <div class="col-md-4">                   
            <div class="section-icon"><img src="{{asset('assets/img/icon-mision.png')}}"></div>
            <h3>misión</h3>
            <p class="padding-aside">Servirte con pasión es la fuerza que nos mueve.</p>    
       </div>
       <div class="col-md-4">                    
            <div class="section-icon"><img src="{{asset('assets/img/icon-vision.png')}}"></div>
            <h3>visión</h3>
            <p class="padding-aside">Ser la mejor empresa automotriz del mundo.</p>         
       </div>
       <div class="col-md-4">           
            <div class="section-icon"><img src="{{asset('assets/img/icon-valores.png')}}"></div>
            <h3>valores</h3>
            <p class="padding-aside">Pasión por el servicio. Excelencia e innovación. Integridad. <br> Sentido de pertenencia. Compromiso con la comunidad.</p>           
       </div>               
   </div>   
    
</div>
@endsection
