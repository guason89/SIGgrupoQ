<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{asset('assets/img/loguito.png')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
	<title>SIG grupo Q</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
 
    <!-- Bootstrap core CSS     -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
     
     <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker.min.css')}}">

    <link href="{{asset('plugins/alertifyjs/css/alertify.min.css')}}" rel="stylesheet">
    <!--     Fonts and icons     -->
    <link href="{{asset('assets/css/font-awesome.css')}}" rel="stylesheet">

      <!--  Light Bootstrap Table core CSS    -->
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
                @if(Auth::User()->idPerfil==1)
                    @include('layouts.menus.admin')
                    @include('layouts.menus.tactico')
                    @include('layouts.menus.estrategico')                
                @endif
                @if(Auth::User()->idPerfil==2)
                    @include('layouts.menus.tactico')                                
                @endif
                @if(Auth::User()->idPerfil==3)
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
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          {!! session('flash_notification.message') !!}
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
   
   
     <script src="{{asset('plugins/jQuery/jQuery.js')}}"></script>
    
    <script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
      
    <script src="{{asset('plugins/alertifyjs/alertify.min.js')}}"></script>
    <!-- para poner mascaras a los input-->
    <script src="{{asset('plugins/input-mask/inputmask.js')}}"></script>
    <!--<script src="{{asset('plugins/mask/jquery.mask.min.js')}}"></script>-->
	<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js"></script>

  

    <script >
       $('#msj').delay(1500).fadeOut(2000);

        
     </script>
     
    

    @yield('js')
     
</body>
</html>