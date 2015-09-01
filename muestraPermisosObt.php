<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
    <meta charset="UTF-8">
        <title>Permisos <?php if ($_GET['tip']=="Obtenidos") {echo "Obtenidos";} elseif ($_GET['tip']=="Pendientes") {echo "Pendientes"; } else {echo "Requeridos(Obt+Pend)";} ?></title>
<link href="/RySO/bootstrap/css/bootstrap.css" rel="stylesheet">
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

</head>
<body>
  <button onclick="window.close(); style:'top:0; left:0; position:absolute;'"><span class="icon-home" aria-hidden="true"></span> Cerrar Ventana </button>            
<div class="text-center" style=" overflow:auto;  height:auto;   width:auto; vertical-align:middle;">   
<table class="table" align="center">
 <thead>
  <tr><td colspan="5">
     <span class="label label-warning pull-left">
     <h4>Permisos <?php if ($_GET['tip']=="Obtenidos"){ echo "Obtenidos"; }  elseif ($_GET['tip']=="Pendientes") {echo "Pendientes"; } else {echo "Requeridos(Obt+Pend)";} ?></h4></span>   
 </td></tr>
    <tr style="background-color:<?php if ($_GET['tip']=="Obtenidos") { ?> #f89406; <?php } elseif ($_GET['tip']=="Pendientes") { ?> red; <?php } else { ?> green; <?php } ?> color:white; margin:0; padding:0;" >
      <th style="text-align: center" >No.<br>Exp.</th>
      <th style="text-align: center" >No. Croqui</th>
      <th style="text-align: center" >Monto</th>
      <th style="text-align: center" >Tipo<br>Permiso</th>         
      <th style="text-align: center" >Localidad</th>              
      <th style="text-align: center" >Regimen<br>Propiedad</th>    
      <th style="text-align: center" >Del Km<br>Al Km</th>
      <th style="text-align: center" >Longitud<br>ml</th>
      <th style="text-align: center" >Sup.<br>DDV m<sup>2</sup></th>
      <th style="text-align: center" >Sup. Áreas<br>Adic.m<sup>2</sup></th>
    </tr>
  </thead>
  <tbody>  
     <?php 
           $indice=0; 
            $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
            mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
           if ($_GET['tip']=="Obtenidos") { 
             $ante=mysql_query("CALL permisosObtenidos(".$_GET['id'].")",$conec);         
            }
            else if ($_GET['tip']=="Pendientes") { 
                   $ante=mysql_query("CALL permisosPendientes(".$_GET['id'].")",$conec);         
                  }
                  else
                  {
                   $ante=mysql_query("CALL permisosTot(".$_GET['id'].")",$conec);         
                  }

            $indice=0;
              while( $pp = mysql_fetch_array($ante) )
              { ?>
                <tr>  
                  <td> <?php echo ++$indice.'.- '.$pp['0'];?> 
                        <?php if (strlen ($pp['1'])> 1) {
                         ?> <a href="<?php echo $pp['1']?>" target="new"> <span class="icon-download"> </span> </a> <?php } ?> 
                  </td>                   
                  <td> <?php echo $pp ['2'].'.-'.$pp['4'].' '.$pp['5'].' '.$pp['6'] ?> <br>
                        <?php if (strlen ($pp['3'])> 1) {
                         ?> <a href="<?php echo $pp['3']?>" target="new"> <span class="icon-download"> </span> </a> <?php } ?> 
                         <?php if ($pp['18'] == 'O') {
                         ?>  <span class="icon-thumbs-up"> </span> <?php }else {  ?>   
                         <span class="icon-remove"> </span> <?php } ?>      
                  </td>
                  <td> <?php echo "$ ".number_format($pp['17'],2) ?> </td>
                  <td> <?php 
                            switch ($pp['7']) {
                                  case "D": echo "DDV";                break;
                                  case "T": echo "Topográfico";        break;
                                  case "A": echo "Áreas Adicionales";  break;
                              }
                        ?> 
                  </td>
                  <td> <?php echo $pp['8'].".";?> <br> <?php echo $pp['9'].", ".$pp['10']."."; ?> </td> 
                  <td> <?php 
                            switch ($pp['11']) {
                                  case "E": echo "Ejido";         break;
                                  case "P": echo "Propiedad";     break;
                                  case "Z": echo "Zona Federal";  break;
                                  case "S": echo "Posesión";      break;
                              }
                        ?> 
                  </td> 
                  <td> <?php echo $pp['12'];?><br> <?php echo $pp['13']; ?></td>  <!--Se debe cambiar para imprimir instalación-->                                 
                  <td> <?php echo $pp['14'] ?></td>  <!--Se debe cambiar para imprimir instalación-->                                 
                  <td> <?php echo $pp['15'] ?></td>  <!--Se debe cambiar para imprimir instalación-->                                 
                  <td> <?php echo $pp['16'] ?></td>  <!--Se debe cambiar para imprimir instalación-->                                                   
                </td>                                   
                </tr>
            <?php } ?>
  </tbody>
</table>
</div> 
</body>
</html>

