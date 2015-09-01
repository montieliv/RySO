<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Módulo de Jefes de Proyecto</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilosgmaec.css" rel="stylesheet">
    </head>
	<body>
        <script src="js/jquery.min.js"></script>        
        <div class="jumbotron"><div class="text-center">
           <h1>Registro de Obras Nuevas y/o de Mantenimiento</h1>				
		</div>

        <div id="topmenu">
                      <?php //include('menu.php') ?>
		</div>             
		</header>
	    <section> 
			<div id="contenedor">
			    <div id="formulario" style="display:none;">
			    </div>
				    <div id="tabla">
                      <?php //include('consulta.php') ?>
                	</div>
            </div>        
             <div id="contenedor2">
				    <div id="tabla2">
                      <?php //include('consulta2.php') ?>
                	</div>
            </div>                   
	    </section>                        
	    <div class="modal-footer" id="piepagina">
	    <p>&copy;Todos los Derechos Reservados PEMEX 2015  <br><span class="label label-warning"><a href="https://twitter.com/montieliv" target="new">@montieliv</a></span>	</p>
	    </div>
    </body>
 </html>