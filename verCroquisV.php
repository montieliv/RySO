<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Croquis Validados</title>
<link href="/RySO/bootstrap/css/bootstrap.css" rel="stylesheet">

</head>
<body>
  <button onclick="window.close(); style:'top:0; left:0; position:absolute;'"><span class="icon-home" aria-hidden="true"></span> Cerrar Ventana </button>            
<div class="text-center" style=" overflow:auto;  height:auto;   width:auto; vertical-align:middle;">   
<table class="table" align="center">
 <thead>
  <tr><td colspan="5">
     <span class="label label-warning pull-left">
     <h4>Croquis Vinculados</h4></span>   
 </td></tr>
    <tr style="background-color:#f89406; color:white; margin:0; padding:0;" >
      <th style="vertical-align:middle; text-align:center" width="auto">No.</th>
      <th style="vertical-align:middle; text-align:center" width="auto">Descargas</th>          
      <th style="vertical-align:middle; text-align:center" width="auto">Nombre</th>                  
      <th style="vertical-align:middle; text-align:center" width="auto">Estatus</th>
    </tr> 
  </thead>
  <tbody>    
     <?php 
           $indice=0;
            $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
              mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
           $ante=mysql_query("SELECT id_croqi,idObraC,filecroqui,apatP,amatP,nombreP,activado FROM croquisvalidados,propietariosgmaec WHERE ((idObraC=".$_GET['idov2']." ) and (id_afec=id_Propietario)) order by activado desc",$conec);          

           while( $croqv = mysql_fetch_array($ante) )
             { ?><tr style="margin:0; padding:0">                     
                  <td style="text-align:center; vertical-align:middle;"> <?php echo "<b>".++$indice."</b>.".$croqv['0']  ?> </td>
                  <td style="text-align:center; vertical-align:middle;">  <a id="linkC" name="linkC" href="<?php echo $croqv['2'] ?>"><span class="icon-download"></span></a></td>
                  <td><?php echo $croqv['3']."\t".$croqv['4']."\t".$croqv['5'] ?></td>
                  <td style="text-align:center; vertical-align:middle;">                     
                     <input type="text" id="<?php echo $croqv['0']?>" value="<?php if ($croqv['6']=='Y') {echo 'Activado';} else {echo 'Sin Activar';} ?>" readonly  <?php if ($croqv['6']=='N') { ?> style="width:40%; background:red; color:white; font-weight:bold;" <?php } else { ?> style="width:40%; background:green; color:white; text-align:center;" <?php } ?> >
                  </td>                          
          <?php  } ?> 
  </tbody>
</table>
</div> 
</body>
</html>