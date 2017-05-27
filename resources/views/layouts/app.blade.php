<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/img/loguito.png">
    <title>SIGinventario</title>

    <!-- Fonts & Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}"> 
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap.min.css') }}">

   

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">      
                <div class="pull-left">
                 <img 
                    src="{{asset('assets/img/logo.png')}}" 
                    class="logo" 
                    alt="logo Image"
                    style="width: 30%; height:30%; " 
                    id='logo'>
                </div>
                  <!-- Branding Image -->
                <div class="navbar-brand" href="{{ url('/') }}">
                    SIG para la gestion del area logistica en bodegas de Repuesto y Productos automotrices, de Grupo Q                  
                </div>
            </div>

            
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    
</body>
</html>
