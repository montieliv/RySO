<?php
	 function buscaUsuario($x)
	 {
      $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
      mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
      $numtodos = mysql_query("SELECT tipo_Usr,nomber,id_Gestor FROM gestores where pass_Usr='".$x."'",$conec); 
      $pp = mysql_fetch_array($numtodos);

      if ($pp['0'] != "") 
       {$back[0]=$pp['0']; $back[1]=$pp['1'];  $back[2]=$pp['2'];} 
        else
            {$back="ERROR";}
		 return $back;
	 }
	
	if( isset($_POST["inputPassword"]) )
	{
		if( $_POST["inputPassword"]=="") 
		  {
			echo "Por favor, completar usuario y clave";		
		  } 
		  else
		   {
			   $userdata=buscaUsuario(md5($_POST["inputPassword"]));
         if ($userdata[0] != "ERROR")
		    	{            		
					session_start();			
      			  $_SESSION["usuario"]=$userdata[0]; //"Supervisor", "Gestor", "Coordinador", "Vista Reuniones","vista juntas mmto"			  			   			   
              $_SESSION["nameusuario"]=$userdata[1];
              $_SESSION["idUsuario"]=$userdata[2];

                   if ($_SESSION["usuario"]== "JefeProyecto")
        				   {header('Location: jefeProyecto.php');}
        					 elseif ($_SESSION["usuario"]=="Supervisor")
        					   { header('Location: supervisor.php');}
        						 elseif ($_SESSION["usuario"]== "Gestor")
        					 	  { header('Location: gestor.php');}
        						    elseif ($_SESSION["usuario"]== "Coordinador")
        					 	      { header('Location: coordinador.php');}
                        elseif ($_SESSION["usuario"]== "Administrativo")
                          { header('Location: administrativo.php');}
				}
				else { ?> <script>alert("Error 465: Usuario no Registrado!");</script> <?php }
			}
	}
	else {session_write_close();  } 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="bootstrap/ico/favicon4.png">
    <title>Zona de Autenticación</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <script src="js/bootstrap.min.js"></script> 
    <link href="css/estilosgmaec.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/slideinicio.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
	    $(document).on("ready",inicio);
	</script>
  </head>

  <body>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Bienvenido</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" onClick="inicio();">Inicio</a></li>
                    <li><a href="#" onClick="avisos();">Avisos Importantes</a></li>
                    <li><a href="#" onClick="imagenes();">Galería de Imágenes</a></li>
                    <li><a href="mailto:montieliv@gmail.com">Soporte</a></li>
                    <li><a href="#" onClick="ayuda();">Ayuda</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
   <div id="secclogin">
            <div class="jumbotron">
                <div class="text-center">
                    <h1 style="color:white;">Grupo Multidisciplinario de Asuntos Externos y Comunicación<br><h2>
                        <span class="label label-success">BELLOTA-JUJO</span></h2>
                    </h1>
                 </div>
                 <div class="text-center">
                   <img id="logogmaec" class="img-circle" src="imagenes/logo2.png" alt="Generic placeholder image" style="width: 120px; height: 90px;">
                   <img id="logogmaec" class="img-circle" src="imagenes/activo.fw.png" alt="Generic placeholder image" style="width: 120px; height: 90px;">
                   <img id="logogmaec" class="img-circle" src="imagenes/gmaec.fw.png" alt="Generic placeholder image" style="width: 120px; height: 90px;">
                   <img id="logogmaec" class="img-circle" src="imagenes/sspa.fw.png" alt="Generic placeholder image" style="width: 120px; height: 90px;">
                  </div>
            </div>
            <div class="container">   
              <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" id="inputUser" name="inputUser" class="form-control" placeholder="Usuario" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USUARIO GMAEC" readonly>        
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>        
                <button class="btn btn-lg btn-primary btn-block" type="submit">Acceder</button>
              </form>
        	</div> 
         </div>
        <div id="seccAvisos">
        <h3><span class="label label-primary"><script> fecha();</script></span></h3>
        <p class="text-warning"> Sección donde se colocarán Avisos importantes y/o relevantes para el Personal de GMAEC.</p>
	                 <div class="text-center">
        	             <marquee class="marquee" direction="down" scrolldelay="25" scrollamount="2" onMouseOver="this.stop()" onMouseOut="this.start()"> 
                         .- La reunión de mantenimiento que se celebraría el día de hoy 30/05/2014 en las instalaciones de GMAEC con sede en cárdenas tabasco, se reprograma para el día 06/06/2014 en el mismo horario.<br>
                         .- En la página principal puede hacer clic en lo botones animados puede visualizar los diferentes tipos de obras.<br>
                         .- La reunión de mantenimiento que se celebraría el día de hoy 30/05/2014 en las instalaciones de GMAEC con sede en cárdenas tabasco, se reprograma para el día 06/06/2014 en el mismo horario.<br>
                         .- En la página principal puede hacer clic en lo botones animados puede visualizar los diferentes tipos de obras.<br>
                         .- La reunión de mantenimiento que se celebraría el día de hoy 30/05/2014 en las instalaciones de GMAEC con sede en cárdenas tabasco, se reprograma para el día 06/06/2014 en el mismo horario.<br>
                         .- En la página principal puede hacer clic en lo botones animados puede visualizar los diferentes tipos de obras.	                                                  
                         </marquee>                        
                        </div>
            <br>
        </div>
        <div id="seccGaleria">
                <h2><span class="label label-primary">Fotos Relevantes de Instalaciones Importantes</span></h2>
            <div class="text-center">
        	  <iframe width="710" height="365" name="galeria" src="http://localhost/aeycSitesirve/js/jquery-slider-master/demos-jquery/banner-slider.source[1].html"></iframe>
            </div>
        </div>
        <div id="seccContactanos">
          Hola contáctanos....
             
        </div>
        <div id="seccAyuda" align="center">
             <table class="table">
                <thead>
                    <tr>
                       <th>Indice</th>                       
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.- Acceso al sistema</td>                    </tr>
                      <tr>  <td>2.- Módulo Coordinador</td>                    </tr>
                        <tr><td>3.- Módulo Jefe de Proyecto</td>                    </tr>
                        <tr><td>4.- Módulo Supervisor</td>                    </tr>
                        <tr><td>5.- Módulo Gestor</td>                                            </tr>
                </tbody>                
            </table>
        </div>
    <div class="modal-footer" id="piepagina">
    <p>&copy;Todos los Derechos Reservados PEMEX 2015  <br><span class="label label-warning"><a href="https://twitter.com/montieliv" target="new">@montieliv</a></span>	</p>
    </div>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
