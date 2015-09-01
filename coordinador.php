<?php  
session_start();
if($_SESSION["usuario"] == "Coordinador")
{
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<title>Módulo Coordinador</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Le styles -->
<link href="/RySO/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="css/contendorCoor.css" rel="stylesheet">
<style>
      body {
        padding-top: 3em; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
<link href="/RySO/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<script src="/RySO/ScriptLibrary/jquery-latest.pack.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6/html5shiv.min.js"></script>
    <![endif]-->
<!-- Fav and touch icons -->
<link rel="shortcut icon" href="bootstrap/ico/favicon4.png">

<script type="text/javascript" src="/RySO/bootstrap/js/bootstrap.js"></script>
<script src="/RySO/js/slideCOOR.js"></script>

<script>
     $(document).on("ready",vertodascoor);      //alert('1');
  </script>    

</head>
  <body cz-shortcut-listen="true">
    <div class="navbar navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
               <a href="index.php" onClick="<?php  session_write_close(); ?>"> 
               <span class="icon-home" aria-hidden="true"></span></a>           
               <a class="brand" href="#">Bienvenido Ing. Arturo Martín de la Parra Cárdenas</a> <!--//mostrar semáforo pántalla incial-->

          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="nav-collapse collapse">
<!--               <li class="active"><a href="#" OnClick="vertodascoor();">Inicio</a></li>
 -->         <!--      <li><a href="#" OnClick="vertodascoorsp();">Falta de Presupuesto</a></li>
              <li><a href="#" OnClick="vertodascoorsc();">Falta de Croquis</a></li>
              <li><a href="#" Onclick="vertodascoorsg();">Falta de Gestor Asignado</a></li>              
              <li><a href="#contact">Permisos de paso faltantes</a></li> --> <!--//mostrar fecha de asignación al gestor-->
<!--               <li><a href="#">Observaciones</a></li>                                                        
 -->            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/container -->
      </div><!--/navbar-inner -->
    </div><!--/navbar navbar navbar-fixed-top -->
    <!-- <h2 id="tituloCoor" style="margin:0; paddining:0;">Resumen de Obras</h2> -->
    <div class="bootstrap-demo" id="contendorCoor" style="margin-top:0; paddining:0;">
	   <div class="row ">
           <div class="col-md-12">
           </div>
       </div>
         <div class="row" id="relacioncoor">                
     		 <div class="col-md-4"><p class="demog"></p></div>
	   </div>
    </div>
  </body>
</html>
<?php 
	}
    else
	 	  { header('Location: index.php');}
?>