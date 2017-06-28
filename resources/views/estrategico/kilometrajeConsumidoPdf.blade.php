
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title> </title>
    <style type="text/css">
   
      body{
        font-size: 14px;

      }

    #content {
        float: center;
        position: relative;
      }
      div#header{
        width: 74%;
        display: inline-block;
        margin: 0 auto; 
        border:1px solid black;
      }
      div#header img#escudo{
        height: 60px;
        width: auto;
        max-width: 20%;
        display: inline-block;
        margin: 0.5em;
      }
      div#header img#logo{
        height: 40px;
        width: auto;
        max-width: 20%;
        display: inline-block;
        margin: 0.5em;
      }
      div#header div#mainTitle{
        width: 65%;
        display: inline-block;
        margin: 0.5em;  
        margin-right: 1em;
        text-align: center; 
      }
      #footer {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 0;
        text-align: center;
      }


      table#Tabla{
        width: auto;
        min-width: 95%;
        max-width: 95%;
        margin: 0 auto;
        border-collapse: collapse !important;
        width: auto !important;
        max-width: 70% !important;
        margin: 0 auto;
        font-style: 'times new roman' !important;
        width: auto !important;
        max-width: 70% !important;
        margin: 0 auto;

      }
      table#Tabla tr td{
      border-left: .5px solid black;
      border-right: .5px solid black;
      border-top: .5px solid black;
      border-bottom: .5px solid black !important;
      padding-bottom: 0px  !important;
      text-align: center !important;
      max-width: 70% !important;
      margin: 0 auto;
      
    }
     
      #firma{
        height: auto; 
        width: auto; 
        max-width: 400px; 
        max-height: 800px;
      
      }
    </style>
  </head>
  <body>


    <header>
    <table  style="width:100%;">
      <tr>
        <td style="width:20%;">
          <center>
            <h4>RPTEST03</h4> 
        <font size=1><b>{{$usuario->nombre}}</b><br><i>{{$fecha}}</i></font>
          </center> 
        </td>
        <td style="width:70%;">
          <center>
            <h3 style="margin:0;padding:0;">
              &nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cantidad De kilometrajes Consumidos En Flota De Despacho&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <p>&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;Area Logistica En Bodegas&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;</p>
              <strong>Grupo Q</strong>
              <br>
              ___________________________________________________________
            </h3>
          </center>
        </td>
        <td style="width:10%;">
          <center> <h4>Pag 1/1</h4></center>       
          <center>
            <img id="logo" src="{{asset('assets/img/logo.png')}}" 
              alt="logo"
              style="width: 70px; height:60px; "
            />
          </center> 
        </td>
    </table>
    </header>  

   <div align="center">
     <main>
        <p><b>Desde :</b> {{$fechaInicio}} <b>Hasta :</b> {{$fechaFin}}</p> 
        <p><b>Vehiculo : </b> {{$vehiculo}}</p>    

               <table id="Tabla" style="width:100%;">
          <tbody> 
            <tr>                            
               <td width="30" height="40">FECHA ASIGNADA</td>
               <td width="30" height="40">KM INICIAL</td>
               <td width="30" height="40">KM FINAL</td>
               <td width="30" height="40">ESTADO ACTUAL</td>
               <td width="30" height="40">COMBUSTIBLE CONSUMIDO</td>
               <td width="30" height="40">MONTO CONSUMIDO</td>        
            </tr>
            @foreach($tabla as $t)
             <tr>
               <td width="30" height="40">{{$t->fechaasignado}}</td>
               <td width="30" height="40">{{$t->kminicial}}</td>
               <td width="30" height="40">{{$t->kmfinal}}</td>
               <td width="30" height="40">{{$t->estadoactualuso}}</td>
               <td width="30" height="40">{{$t->combustiblesconsumido}}</td>
               <td width="30" height="40">{{$t->montoconsumido}}</td>               
            </tr>
            @endforeach
          </tbody>
        </table>
      
     </main>
    </div>


    <footer id="footer">
 
    </footer>

  </body>

</html>