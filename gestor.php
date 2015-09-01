<?php  
session_start();
if($_SESSION["usuario"] == "Gestor")
{
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<title>Módulo Gestor</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Le styles -->
<link href="/RySO/bootstrap/css/bootstrap.css" rel="stylesheet">
<style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
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

<script src="/RySO/js/slideGES.js"></script>

<script type="text/javascript" src="/RySO/bootstrap/js/bootstrap.js"></script>  
   <?php if ($_GET['captura']=="") { ?>
      <script>
        $(document).on("ready",verObrasGes); //alert('2');
    </script>   
  <?php } ?>
  <?php if ($_GET['captura']!="") { ?>
      <script>
           verObrasGes2('<?php echo $_GET['captura']; ?>');
    </script>   
  <?php } ?>
    <?php if ($_GET['permisos']!="") { ?>
      <script>
           agregaPermisodePaso();
    </script>   
  <?php } ?>
  
  <?php if ($_GET['permisosE']!="") { ?>
      <script>
           agregaPermisodePaso2('<?php echo $_GET['permisosE']; ?>');
    </script>   
  <?php } ?>


</head>

  <body cz-shortcut-listen="true">

    <div class="navbar navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
                    <a href="index.php" onClick="<?php  session_write_close(); ?>"> 
               <span class="icon-home" aria-hidden="true"></span></a>
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Bienvenido <?php echo $_SESSION["nameusuario"]; ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#" OnClick="verObrasGes();">Inicio</a></li>
              <li><a href="#" OnClick="agregaAfectado();">Actualizar Afectados</a></li>
              <li><a href="#" OnClick="agregaPermisodePaso();">Dar de alta Permisos de Paso</a></li>              
              <li><a href="#contact">Agregar Montos</a></li>
              <li><a href="#">Observaciones</a></li>                                          
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container" id="resumenObrasGes"><br>
      <h1 id="titx">Resumen de Obras</h1>
      <div class="row" id="obrasGes"></div>
    </div> <!-- /container -->

    <div class="container" id="capturaAfec"> <br>
      <h2>Censo Afectados <span class="label label-primary pull-right"><script> fecha();</script></span></h2>
        <div id="edicionAfec" class="container-fluid"></div>        
        <div id="muestraAfecs" class="container-fluid">                
        </div> 
    </div>
    
    <div class="container" id="capturaPermisos"> <br>
      <h2>Censo Permisos <span class="label label-primary pull-right"><script> fecha();</script></span></h2>
        <div id="edicionPerm" class="container-fluid"></div>        
        <div id="muestraPermis" class="container-fluid">                
        </div> 
    </div>

  </body>
</html>
<?php 
  }
    else
      { header('Location: index.php');}
?>