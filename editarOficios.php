<?php 
session_start();
$conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
$numtod = mysql_query("SELECT * FROM oficiossolicitud where idOficio=".$_GET['id'],$conec); 
$pp = mysql_fetch_array($numtod);
    ?>
<!DOCTYPE html>
   <html lang="en">
   <head>
     <meta charset="UTF-8">
     <title>Edición de oficios</title>
     <script>
	 	$('html,body').animate({scrollTop:0},300);
	 </script>
   </head>
   <body>
   <form  name="frmOficiosedit" id="frmOficiosedit" action="saveoficio.php" method="post" class="form">           
<table class="table-striped" align="center" border="2">
     <input type="hidden" value="<?php  echo $pp ['0'] ?>" name="idoficioedit" id="idoficioedit">
    <tr><th>No. Oficio:</th>
        <td><input type="text" size="30" id="numO" name="numO" value="<?php  echo $pp ['1'] ?>"></td>
        <th>Fecha Oficio:</th>
        <td><input type="date" id="fechaO" name="fechaO" value="<?php  echo $pp ['2'] ?>"/></td>
    </tr> 
    <tr>
      <th>Enviado Por:</th>  
      <td >
            <select id="remitente" name="remitente">
              <option value="NULL">Seleccione el Departamento</option>
      <?php 
            $numtodosss = mysql_query("SELECT * FROM areas order by nombre desc",$conec); 
            while( $ppD = mysql_fetch_array($numtodosss) )
            { ?>
              <option value="<?php  echo $ppD ['id_area']?>" <?php if  ($pp['3'] == $ppD ['id_area']) { ?> selected  <?php } ?>><?php  echo $ppD ['nombre'].' - '.$ppD ['titular']?></option>
      <?php } ?> 
            </select>
      <th>Antecedente(s):</th>
      <td colspan="3">
            <select id="antecedente" name="antecedente" value="<?php  echo $pp ['4'] ?>">
              <option value="NULL">Seleccione un Oficio</option>
                      <?php 
                            $numtodos = mysql_query("SELECT * FROM oficiossolicitud order by fechaO desc",$conec); 
                            while( $ppp = mysql_fetch_array($numtodos) )
                            { ?>
                              <option value="<?php  echo $ppp ['idOficio']?>" <?php if  ($pp['4']== $ppp ['idOficio']) { ?> selected  <?php } ?> ><?php  echo $ppp ['numO'].' - '.$ppp ['fechaO'].' - '.$ppp ['remitente'] ?></option>
                      <?php } ?>
                    </select>           
      </td>   
    </tr>   
    <tr>
      <th>Fecha Acuse:</th>
        <td><input type="date" id="fechaAcuse" name="fechaAcuse" value="<?php  echo $pp ['7'] ?>" /></td>
      <th>Subir Archivo:</th>
      <td><input class="btn-small" type="file" id="descarga" name="descarga"><br>
      <input type="text" name="aF" id="aF" value="<?php  echo $pp['5'] ?>"> </td>
      <tr>
      <th>Obras Registradas</th>
        <td colspan="3" align="center">        
       <select id="obrasreg2" name="obrasreg2" style="width:100%" required>
              <option value="NULL">Seleccione una obra</option>
                      <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                            mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
                            $numtodos = mysql_query("SELECT id_Obras,nombre_Campo,tipoObra,descObra FROM obrasgmaec,gestionobras,campos where (id_Obras=id_ObrasGestion) and (id_J='".$_SESSION["idUsuario"]."') and (campo=id_Campos) order by campo,tipoObra,descObra desc",$conec); 
                            while( $pp = mysql_fetch_array($numtodos) )
                            { ?>
                              <option value="<?php  echo $pp ['id_Obras']?>"><?php  echo $pp ['nombre_Campo'].' - '.$pp ['tipoObra'].' - '.$pp ['descObra'] ?></option>
                      <?php } ?>
                    </select>           
     <tr><th>Tipo de Oficio</th>
      <td>
         <select id="editipoof" name="editipoof">
          <option value="NULL">Seleccione un Tipo de Oficio</option>
          <option value="Solicitud"<?php if  ($pp['8']== "Solicitud") { ?> selected  <?php } ?> >Solicitud</option>
          <option value="Ampliación"<?php if  ($pp['8']== "Ampliación") { ?> selected  <?php } ?> >Ampliación</option>
          <option value="SCorrección"<?php if  ($pp['8']== "SCorrección") { ?> selected  <?php } ?>>SOL.- Corrección</option>
          <option value="RCorrección"<?php if  ($pp['8']== "RCorrección") { ?> selected  <?php } ?>>RES.- Corrección</option>          
          <option value="Recordatorio"<?php if  ($pp['8']== "Recordatorio") { ?> selected  <?php } ?>>Recordatorio</option>
          <option value="Presupuesto"<?php if  ($pp['8']== "Presupuesto") { ?> selected  <?php } ?>>Presupuesto</option>
          <option value="Permiso"<?php if  ($pp['8']== "Permiso") { ?> selected  <?php } ?>>Permiso de Paso</option>
        <option value="Cancelación"<?php if  ($pp['8']== "Cancelación") { ?> selected  <?php } ?>>Cancelación</option>          
        </select>
      </td>
      <td colspan="3" align="center">
       <input type="submit" name="submit" value="Guardar Modificaciones del Oficio" class="btn btn-primary" />
       <input type="reset" name="reset" value="Cerrar Ventana" class="btn btn-primary" OnClick="cierraEdicionOficio();"/>
   </table>
    </form>   
<hr>
<div class="container-fluid" style=" overflow:scroll;  height:300px;   width:100%;"> 
<table class="table">
 <thead>
  <tr><td colspan="7">
     <span class="label label-warning pull-left">
     <h4>Obras Vinculadas al Ofico</h4></span>   
 </td></tr>
    <tr style="background-color:#f89406; color:white;" >
      <th>Proyecto</th>
      <th>Campo</th>         
      <th>Tipo/Obra</th>              
      <th>Instalación</th>    
      <th>Estatus</th>
      <th>Oficio</th> 
      <th>Opciones</th>
    </tr> 
  </thead>
  <tbody>    
        <?php 
              $obrasr = mysql_query("SELECT id_Obras,proyecto_Campo,nombre_Campo,tipoObra,instalacion,status,latitudO,longitudO,descObra FROM oficiosobras,obrasgmaec,campos WHERE ((idOfref=".$pp['0'].") and (idObraref=id_Obras) and (campo=id_Campos))order by campo desc",$conec); 
              while( $pop = mysql_fetch_array($obrasr) )
              { ?>
                <tr>                     
                  <td> <?php echo $pop['0'] ?> </td>
                  <td> <?php echo $pop['2'] ?> </td>
                  <td> <?php echo $pop['3'] ?> </td> 
                 <td><?php echo $pop['8'] ?></td>  <!--Se debe cambiar para imprimir instalación-->                                 
                  <td> <?php echo $pop['5'] ?></td>
                 <td>
                    <?php  $ante=mysql_fetch_array(mysql_query("SELECT numO,linkDescarga,tipoOficio FROM oficiosobras,oficiossolicitud WHERE ((idObraref= ".$pop['0'].") and (idOfref=idOficio))",$conec)); echo $ante['2'].".-".$ante['0']."<br>";
                          if ($ante['1']) { ?>                               
                             <a id="linkoficio2" name="linkoficio2" href="<?php echo $ante['1'] ?>"><span class="icon-download"></span></a>
                    <?php } ?> </td>                                   
                <td> <form action="desvinculaObOF.php" method="POST" style="margin:0;">
                         <input type="hidden" value="<?php echo $pop['0']?>" id="obrades" name="obrades">
                         <input type="hidden" value="<?php echo $pp['0']?>" id="obradesof" name="obradesof">  
                         <input type="submit" name="submit" id="button" value="Desvincular §"  class="btn btn-small" style="margin:0"/></form>
                                  <?php  if (($pop['6']!="S/L")&& ($pop['7']!="S/L")) { ?>   <a target="new" href="https://www.google.com.mx/maps/search/<?php echo $pop['6']?>,<?php echo $pop['7']?>/@<?php echo $pop['6']?>,<?php echo $pop['7']?>,2900m/data=!3m1!1e3!">
                                  <img src="imagenes/logomap.png" style="width:25px; height:25px;" title="Ubicar" alt="Mapa" /></a></td>  <?php } ?>
                </td>                                   
                </tr>
            <?php } ?>
    </tbody>
</table>
</div>
</body>
   </html>