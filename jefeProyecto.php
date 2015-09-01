<?php  
session_start();
if($_SESSION["usuario"] == "JefeProyecto")
{
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<title>Módulo Jefe de Proyecto</title>
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
    <script src="/RySO/js/slideJP.js"></script>

    <?php if (($_GET['captura']!="paso2")and($_GET['captura']!="postedicion")and($_GET['captura']!="postedicionobra")) { ?>
    <script>
     $(document).on("ready",inicioJP);      //alert('1');
	</script>    
   <?php  }?>
  
  <?php if ($_GET['captura']=="paso2") { ?>
      <script>
        $(document).on("ready",asignaObra); //alert('2');
    </script>   
  <?php } ?>

    <?php if ($_GET['captura']=="postedicion") { ?>
      <script>
        $(document).on("ready",asignaOficio); //alert('3');
    </script>   
  <?php } ?>

   <?php if ($_GET['captura']=="postedicionobra") { ?>
      <script>
        $(document).on("ready",asignaObra); //alert('4');
    </script>   
  <?php } ?>
  
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
          <span class="icon-home" aria-hidden="trxue"></span></a>
          <p class="brand">Bienvenido <?php echo $_SESSION["nameusuario"]; ?></p>
          <div class="nav-collapse collapse">
            <ul id="op1JP" class="nav">
              <li><a href="#" onClick="inicioJP();">Inicio</a></li>
              <li><a href="#" onClick="asignaOficio();">Captura y Seguimiento Oficios</a></li>
              <li><a href="#" onClick="asignaObra();">Datos de Obra</a></li>                            
              <li><a href="#" onClick="asignaGestor();">Asignar Gestor</a></li>
              <li><a href="#" onClick="asignaPermiso();">Permisos de Paso</a></li>  
              <li><a href="#" onClick="observaciones();">Observaciones</a></li>                                                                   
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="row margenJP2" id="resumenObrasJP">
      <h2>Resumen de Obras<span class="label label-primary pull-right"><script> fecha();</script></span></h2>
      <div class="container-fluid" id="consultaobras"> <?php include('consultaObrasgral.php') ?> </div>      
    </div>

    <div class="container margenJP" id="capturaObraJP">
      <h2>Control Obras <span class="label label-primary pull-right"><script> fecha();</script></span></h2>
        <div id="edicionObras" class="container-fluid"></div>        
        <div id="muestraobras" class="container-fluid">                
        </div> 
    </div>

    <div class="container margenJP" id="capturaOficiosJP">
      <h2>Oficios <span class="label label-primary pull-right"><script> fecha();</script></span></h2>
            <div id="edicionOficio" class="container-fluid"></div>
      <div id="muestraoficios" class="container-fluid">  
      </div>      
    </div>

    <div class="container margenJP" id="asignaGestorJP">
      <h2>Control Gestores <span class="label label-primary pull-right"><script> fecha();</script></span></h2>
      <div id="muestraobrasG" class="container-fluid"></div>                
    </div>

    <div class="container margenJP" id="capturaPermisoJP">
      <h2>Control Permisos de Paso <span class="label label-primary pull-right"><script> fecha();</script></span></h2>
    </div>

    <div class="container margenJP" id="observacionesJP">
      <h2>Observaciones <span class="label label-primary pull-right"><script> fecha();</script></span></h2>
    </div>
    <!-- /container -->
  </body>
</html>
<?php 
	}
    else
	 	  { header('Location: index.php');}
?>