<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Requisicion</title>  
  
  {!! Html::style('css/bootstrap.min.css') !!}

</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-xs-3">
        <h4>RPTEST01</h4> 
        <font size=1><b>{{$usuario->nombre}}</b><br><i>{{$fecha}}</i></font>     
      </div>
      <div class="col-xs-6" style="text-align: center;">
        <div class="row">
          <div class="col-xs-12">
           <font size=1><h5><b>Reporte De Inventario Selectivo De Almacenes De Repuesto</b></h5></font>    
          </div> 
           <br>        
          <div class="col-xs-12">
            <font size=1><h4>Area Logistica En Bodegas</h4></font>            
          </div>
              <br>   
          <div class="col-xs-12">
            <font size=1><h4>Grupo Q</h4></font>     
          </div>
        </div>             
      </div>
      <div class="col-xs-3">
         <h4>Pag 1/1</h4>
         <img 
            src="{{asset('assets/img/logo.png')}}"         
            alt="logo"
            style="width: 60px; height:50px; " 
          >
      </div>
    </div> 
    <br><br><br><br><br>
    <div class="row">     
      <div class="col-xs-5" style="margin-left: 30%;">
        <p><b>Desde :</b> {{$fechaInicio}} <b>Hasta :</b> {{$fechaFin}}</p>
      </div>
    </div>  
      <br><br>
      <div class="row" >
          <!-- <hr style="border: 1px ; border-top: 5px double #C0C0C0;"> -->
          <hr style="border: 0; height: 3px; border-top: 1px solid #C0C0C0; border-bottom: 1px solid #C0C0C0;">
        </div>
    
      <table class="table table-bordered ">
      <thead>
          <tr class="row">
              <th class="col-xs-1"><font size=1>CODIGO</font></th>
              <th class="col-xs-3"><font size=1>DESCRIPCION</font></th>        
              <th class="col-xs-2"><font size=1><P>CANTIDAD SEGUN SISTEMA</P></font></th>
              <th class="col-xs-2"><font size=1>INVENTARIO FISICO EFECTUADO</font></th>             
              <th class="col-xs-2"><font size=1>DIFERENCIAS DETECTADAS</font></th> 
              <th class="col-xs-2"><font size=1>COSTO DE DIFERENCIAS</font></th>            
          </tr>
       </thead>
      <tbody>            
     
      </tbody>  
      </table>
    </div>
    
    <div class="text-right">
      <p>Total :</p> 
    </div>

  <div class="row">
      <br><br>
  </div>

    
       
    

  </div>
  
    
</body>
</html>




     

 



