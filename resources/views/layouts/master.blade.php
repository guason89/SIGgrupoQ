<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{asset('assets/img/loguito.png')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
	<title>SIG grupo Q</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
 
    {!! Html::style('css/bootstrap.min.css') !!} 
    {!! Html::style('plugins/datepicker/datepicker.min.css') !!}
    {!! Html::style('plugins/timepicker/bootstrap-timepicker.min.css') !!}
    {!! Html::style('assets/css/font-awesome.min.css') !!}
    {!! Html::style('plugins/alertifyjs/css/alertify.min.css') !!} 
    {!! Html::style('plugins/alertifyjs/css/themes/default.min.css') !!}       
    <link href="{{asset('assets/css/light-bootstrap-dashboard.css')}}" rel="stylesheet"/>
   



    
    @yield('css')

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.png">
        
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    SIG grupo Q
                </a>
            </div>
            <!--Area de menu-->
            <ul class="nav">
                <li class="active">
                    <a href="{{route('doInicio')}}">
                        <i class="fa fa-home"></i>
                        <p>INICIO</p>
                    </a>                    
                </li>
                @if(Auth::User()->idperfil==1)
                    @include('layouts.menus.admin')                                 
                @endif
                @if(Auth::User()->idperfil==2)
                    @include('layouts.menus.tactico')                                
                @endif
                @if(Auth::User()->idperfil==3)
                    @include('layouts.menus.estrategico')                                
                @endif

            </ul>

    	</div>
        
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">          
                
                <div class="collapse navbar-collapse"> 
                    
                    <ul class="nav navbar-nav navbar-right">                    
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{Auth::User()->nombre}}
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="{{route('logout')}}">Salir</a></li>                  
                              <li class="divider"></li>
                              <li><a href="#">ayuda</a></li>
                            </ul>
                        </div>
                       
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                @if (session()->has('flash_notification.message'))
                      <div class="alert alert-{{ session('flash_notification.level') }} " id="msj">
                         
                          {!! session('flash_notification.message') !!}
                      </div>
                @endif

                 <!-- msj de error -->
                @if (count($errors)>0)
                    <div class='alert alert-danger' role='alert' id="error">
                        <strong>Atencion:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>                            
                            @endforeach         
                        </ul>                        
                    </div>

                @endif

                @yield('contenido')

               
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">                    
                    <img style="width: 60px; height: 60px;" src="{{asset('assets/img/logo.png')}}">                                   
                </nav>
                <p class="copyright pull-right">
                    {{Auth::User()->perfil['nombre']}}
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">SIG</a>, Grupo Q
                </p>
            </div>
        </footer>

    </div>
</div>


  <!--   Core JS Files   -->
   
   
    {!! Html::script('js/jquery.min.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::script('plugins/datepicker/bootstrap-datepicker.js') !!}
    {!! Html::script('plugins/mask/jquery.mask.min.js') !!}
    {!! Html::script('plugins/alertifyjs/alertify.min.js') !!}
    {!! Html::script('plugins/timepicker/bootstrap-timepicker.js') !!}
    <script src="assets/js/light-bootstrap-dashboard.js"></script>

  

    <script >
        $('#msj').delay(2000).fadeOut(2000);
        $('#error').delay(3000).fadeOut(2000);

        $( ".datepicker" ).datepicker({            
        });

        
     </script>
     
    

    @yield('js')
     
</body>
</html>