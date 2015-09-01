<?php 
$conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
$numtod = mysql_query("SELECT * FROM propietariosgmaec where id_Propietario=".$_GET['id'],$conec); 
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
   <form  name="frmOficiosedit" id="frmOficiosedit" action="saveafec.php" method="post" class="form">           
<table align="center" class="table-striped">
  <input type="hidden" value="<?php  echo $pp ['0'] ?>" name="idafecedit" id="idafecedit">
  <input type="hidden" value="<?php  echo $_GET['obr'] ?>" name="idobragesedit" id="idobragesedit">
    <tr>
        <th>Datos <br>
          Generales</th>
      <th width="213">Nombre:<br>
        <input name="nomafec" type="text" id="nomafec" value="<?php  echo $pp ['1']?>" size="35" maxlength="150" /></th>
        <th width="210" colspan="2">Apellido Paterno:<br>
        <input name="apatafec" type="text" id="apatafec" size="35" maxlength="150" value="<?php  echo $pp ['2']?>"  /></th>
        <th colspan="2">Apellido Materno:<br>
        <input name="amatafec" type="text" id="amatafec" size="35" maxlength="150" value="<?php  echo $pp ['3']?>"  /></th>
    </tr> 
    <tr>
      <th width="84">Domicilio:</th>  
      <th colspan="4"><textarea name="domafec" cols="30" rows="2" id="domafec" style="width:98%;"><?php  echo $pp ['4']?></textarea></th>
    </tr>
    <tr>
      <th height="25">Teléfono:</th>
      <th width="213"><input name="telafec" type="text" id="telafec" value="<?php  echo $pp ['5']?>"  /></th>
      <th>Correo Electrónico:</th>
      <th colspan="2"><input name="correoafec" type="email" id="correoafec" value="<?php  echo $pp ['7']?>"  /></th>
    
    <tr>
      <th>Información <br>
      Adicional:</th>
      <td align="center"><textarea name="extraafec" cols="20" rows="2" id="extraafec" style="width:98%;"><?php  echo $pp ['8']?></textarea></td>
      <td colspan="3" align="center">Foto:<br><input type="file" name="fotoafec" id="fotoafec"><br>
      <input type="text" name="aF2" id="aF2" value="<?php  echo $pp['6'] ?>"></td>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <td colspan="4" align="center"><input type="submit" name="submit" value="Guardar Acctualización del Afectado" class="btn btn-primary" />
       <input type="reset" name="reset" value="Cerrar Ventana" class="btn btn-primary" OnClick="cierraEdicionAfec();"/></td>      
    </tr>             
</table>
    </form>   
<hr>
<div class="container-fluid" style=" overflow:scroll;  height:300px;   width:100%;"> 
<table class="table">
 <thead>
  <tr><td colspan="7">
     <span class="label label-warning pull-left">
     <h4>Obras Vinculadas al Afectado</h4></span>   
 </td></tr>
    <tr style="background-color:#f89406; color:white;" >
      <th>Campo</th>
      <th>Obra</th>         
      <th>Tipo/Obra</th>              
      <th>Instalación</th>    
      <th>Estatus</th>
      <th>Oficio</th> 
      <th>Opciones</th>
    </tr> 
  </thead>
  <tbody>    
        <?php 
              //$obrasr = mysql_query("SELECT id_Obras,proyecto,campo,tipoObra,instalacion,status,latitudO,longitudO,descObra FROM oficiosobras,obrasgmaec WHERE ((idOfref=".$pp['0'].")and (idObraref=id_Obras))order by proyecto,campo desc",$conec); 
              $obrasr = mysql_query("SELECT id_Obras,nombre_Campo,tipoObra,instalacion,status,latitudO,longitudO,descObra,proyecto_Campo FROM obrasgmaec,croquisvalidados,campos WHERE ((id_afec=".$pp['0'].")and (idObraC=id_Obras) and (campo=id_Campos)) group by id_Obras order by  proyecto_Campo,nombre_Campo desc",$conec); 
              while( $pop = mysql_fetch_array($obrasr) )
              { ?>
                <tr>                     
                  <td> <?php echo $pop['8'] ?> </td>
                  <td> <?php echo $pop['7'] ?> </td>
                  <td> <?php echo $pop['2'] ?> </td> 
                 <td> <?php $remi=mysql_fetch_array(mysql_query("SELECT nombre FROM mpinstalaciones WHERE (id_insta= ".$pop['3'].")",$conec)); echo $remi['0'] ?></td>  <!--Se debe cambiar para imprimir instalación-->                                 
                  <td> <?php echo $pop['4'] ?></td>
                                  <td style="font-size:.9em; mmarging:0; padding:0;"> <?php                                    
                                  $numI = mysql_query("select fechaO,numO,remitente,antecedente,linkDescarga,fechaAcuse,tipoOficio from 
                                  oficiossolicitud,oficiosobras where ((idOficio=idOfref) and (idObraref=".$pop['id_Obras'].")) order by fechaAcuse asc");
                                  $division=0;      
                                  while( $nI = mysql_fetch_array($numI)) {                                             
                                       if($division>0){echo "<hr id='dividef' style='margin:0; padding:0;'>";}
                                       //echo "#:".$nI[1]."<br>F.Elab.:".$nI[0]."<br>Área:";                                   
                                       echo "#:".$nI[1]."<br>";                                    
                                       $remi=mysql_fetch_array(mysql_query("SELECT nombre,titular FROM areas WHERE (id_area= ".$nI['2'].")",$conec)); echo $remi['0'] ?>
                                           <a href="<?php echo $nI[4] ?>"><span class="icon-download"></span></a>        
                                       <?php $division++; 
                                  } ?>      
                                  </td>                                
                                  <td>  <?php  if (($pop['5']!="S/L")&& ($pop['6']!="S/L")) { ?>   <a target="new" href="https://www.google.com.mx/maps/search/<?php echo $pop['5']?>,<?php echo $pop['6']?>/@<?php echo $pop['5']?>,<?php echo $pop['6']?>,2900m/data=!3m1!1e3!">
                                  <img src="imagenes/logomap.png" style="width:25px; height:25px;" title="Ubicar" alt="Mapa" /></a></td>  <?php } ?>
                </td>                                   
                </tr>
            <?php } ?>
    </tbody>
</table>
</div>
</body>
   </html>