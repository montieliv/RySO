<?php  
session_start();
if($_SESSION["usuario"] == "Administrativo")
{
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<title>Módulo Administrativo</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Le styles -->
<link href="/RySO/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="/RySO/css/estilosJP.css" rel="stylesheet">
<style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
</style>
<link href="/RySO/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<script src="/RySO/ScriptLibrary/jquery-latest.pack.js"></script><!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6/html5shiv.min.js"></script>
    <![endif]-->
<!-- Fav and touch icons -->
<link rel="shortcut icon" href="bootstrap/ico/favicon4.png">
<script type="text/javascript" src="/RySO/bootstrap/js/bootstrap.js"></script>
<script>
  function fecha()
  {
    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    var f=new Date();
    document.write(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
  }
</script>       
</head>
  <body cz-shortcut-listen="true">
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="index.php" onClick="<?php  session_write_close(); ?>">
          <span class="icon-home" aria-hidden="true"></span></a>
          <p class="brand">Bienvenido Ing. DIOMEDE DIOMEDE DIOMEDE</p>
          <div class="nav-collapse collapse">
            <ul id="op1JP" class="nav">
              <li><a href="#" onClick="inicioJPs();">Inicio</a></li>
              <li><a href="#" onClick="asignaPresupuesto();">Validar Presupuesto</a></li>
              <li><a href="#" onClick="observaciones();">Observaciones</a></li>                                                                   
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container" id="resumenObrasAD">
      <h2 style="margin:.5em 0 0 0; padding:0;">Resumen de Obras<span class="label label-primary pull-right"><script> fecha();</script></span></h2>
      <div class="container-fluid" id="consultaobrasAD"><?php include('consultaObrasAD.php') ?> </div>      
    </div>
    <!-- /container -->
  </body>
</html>
<?php 
	}
    else
	 	  { header('Location: index.php');}
?>