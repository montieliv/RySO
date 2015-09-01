<?php  
session_start();
if ($_SESSION["usuario"]=="Supervisor")
{
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<meta charset="utf-8">
<title>Módulo Supervisor</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Le styles -->
<link href="/RySO/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="/RySO/css/estilosSUP.css" rel="stylesheet">

<style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
<link href="/RySO/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<script src="/RySO/ScriptLibrary/jquery-latest.pack.js"></script>
<!-- <script src="bootstrap/js/bootstrap.min.js"></script>
 --><!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6/html5shiv.min.js"></script>
    <![endif]-->
<!-- Fav and touch icons -->
<link rel="shortcut icon" href="bootstrap/ico/favicon4.png">
<script type="text/javascript" src="/RySO/bootstrap/js/bootstrap.js"></script>
<script src="/RySO/js/slideSUP.js"></script>
  <?php if (isset($_GET['idcroq']) and ($_GET['idcroq']!='gmaec')){ ?>
      <script>
              croquisValidado(<?php echo $_GET['idcroq'] ?>);
    </script>   
  <?php } else 
      { ?>
    <script>
     $(document).on("ready",function (){
            var cambioCSS2=
              {
                display : "none"
                };
              $("#edicionObrasC").css(cambioCSS2); 
             
              var cambioCSS2=
              {
                display : "block"
                };
              $("#consultaobrasSup").css(cambioCSS2); 
              $("#consultaobrasSup").load("asignaCroquis.php");
     });          
  </script> 
  <?php } ?>
</head>

  <body cz-shortcut-listen="true">
    <div class="navbar navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a href="index.php" onClick="<?php  session_write_close(); ?>"> 
               <span class="icon-home" aria-hidden="true"></span></a>
             <p class="brand">Bienvenido <?php echo $_SESSION["nameusuario"]; ?></p>
        </div>
      </div>
    </div>
    <div class="row-fluid" id="resumenObrasSup">      
      <h2>Resumen de Obras<span class="label label-primary pull-right"><script> fecha();</script></span></h2>
        <div id="edicionObrasC" class="container-fluid"></div>              
        <div class="container-fluid" id="consultaobrasSup"> </div>      
    </div>
  </body>
</html>
<?php 
	}
    else
	 	  { header('Location: index.php');}
?>