<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/loguito.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
	<title>SIG grupo Q</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

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
                    <a>
                        <i class="fa fa-home"></i>
                        <p>Menu Principal</p>
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
                  @if (!empty($breadcrumb))               
                    <ol class="nav navbar-nav navbar-left">                        
                        <li><a href="{{ route('doInicio') }}"><i class="fa fa-home"></i></a></li>
                        @if(count($breadcrumb)>1)
                            @for ($i = 0; $i < count($breadcrumb) ; $i++)
                                @if(($i+1) == count($breadcrumb))
                                    <li class="active">{{ $breadcrumb[$i]['nom'] }}</li>
                                @else
                                    <li><a href="{{ $breadcrumb[$i]['url'] }}">{{ $breadcrumb[$i]['nom'] }}</a></li>
                                @endif
                            @endfor
                        @else
                            <li class="active">{{ $breadcrumb[0]['nom']}}</li>                  
                        @endif       
                                                                         
                    </ol>
                  @endif
                    <ul class="nav navbar-nav navbar-right">                    
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                       {{Auth::User()->nombre}}
                                        <b class="caret"></b>
                                    </p>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="{{route('logout')}}">Salir</a></li>                               
                              </ul>
                        </li>
                       
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                @yield('contenido')
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">                    
                    <img style="width: 60px; height: 60px;" src="assets/img/logo.png">                                   
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">SIG</a>, Grupo Q
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>


</html>