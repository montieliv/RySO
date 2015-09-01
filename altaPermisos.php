<?php 
  if (isset($_POST['submit']))
  {
     $b=$_POST['afecregP'];
     $a=$_POST['obraslecc'];
     $c=$_POST['comuniP'];
     $d=$_POST['regimenP'];
     $e=$_POST['dk'];
     $f=$_POST['ak'];
     $g=$_POST['longp'];
     $h=$_POST['supp'];
     $i=$_POST['supap'];
     $j=$_POST['expp'];
     $k=$_POST['tipop'];
     $l=$_POST['montop'];
     $n=$_POST['estatusP']; 

    if (isset ($_POST['permisoEsca'])) { 
      $m= "files/permisosP/".$_POST['permisoEsca']; } 
      else {
        $m="";
        } 
     

    $con = mysql_connect("localhost","root","123");
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
    mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!");
    $sql = "INSERT INTO mpreclamantes (id_D,id_ObraR,link_Com,reg_Prop,del_km,al_km,longi,sup,supAd,numExp,tipoPermiso,monto,estatusPermiso,filePermiso) 
    VALUES ('$b','$a','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$n','$m')";        
    mysql_query($sql,$con);
     mysql_close($con);
    echo "<html><html lang='en'><head><meta charset='utf-8'><meta http-equiv='REFRESH' content='0; url=gestor.php?permisos=$a'></head><body><script>  
     alert('Permiso de Paso almacenado con éxito');</script></body></html>";
        }
  else
  { 
    ?>  
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">

    <style type="text/css">
        #frmOficios01 .table-striped tr th {
        text-align: center;
                }
          #frmOficios01 .table-striped tr td #fileField {
        text-align: left;
      }
          .table-striped tr td label {
        text-align: left;
      }
    </style>    
    <script>
		function asignaEdo(mun)
		{
       var str1 = mun.value;                                 
       str1.toString();    
       var res = str1.substr(str1.search(":")+1,str1.length); //nombre de afectado registrado
 
		    $.get("buscaEdo.php?idM="+res,function(data){
             var txt2 = data;   
             var caj= document.getElementById("munComu");            
             caj.value=txt2;                 
           }); 
		}		
	</script>
    </head>
    <body>   
<form action="altaPermisos.php" method="post"  name="frmPermisos" id="frmPermisos">   
<table align="center" class="table-striped">
  <tr><input type="hidden" name="obraslecc" id="obraslecc" value="<?php echo $_GET['id']; ?>">
      <th>Obra <br>Relacionada:<br>        </th>
        <td colspan="8">
          <select id="obrasregafec" name="obrasregafec" style="width:100%" disabled>
              <option value="NULL">Seleccione una obra</option>
                      <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                            mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
                            $Otodas = mysql_query("SELECT id_Obras,nombre_Campo,tipoObra,descObra FROM obrasgmaec,campos where (id_Obras = '".$_GET['id']."') and (campo=id_Campos) order by campo,tipoObra,descObra desc",$conec); 
                            while( $ppO = mysql_fetch_array($Otodas) )
                            { ?>
                              <option value="<?php  echo $ppO ['id_Obras']?>" <?php if ($ppO ['id_Obras']==$_GET['id']) { ?> selected <?php }  ?> >
                                     <?php  echo $ppO ['nombre_Campo'].' - '.$ppO ['tipoObra'].' - '.$ppO ['descObra'];

                                      $nombreObra=$ppO ['descObra']; ?>
                              </option>
                      <?php } ?>
                    </select>          
          </td>
    </tr>         
    <tr>
      <th colspan="2">Afectados Relacionados:<br>
        <select id="afecregP" name="afecregP" style="width:auto;">
        <option value="NULL">Seleccione una Afectado</option>
        <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                            mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!");                             
                           // $numtodos = mysql_query("SELECT id_Obras,campo,tipoObra,descObra FROM obrasgmaec where id_Obras = '".$_GET['id']."' order by campo,tipoObra,descObra desc",$conec); 
                            $numtodos = mysql_query("SELECT id_Propietario,apatP,amatP,nombreP,id_croqi from croquisvalidados,propietariosgmaec where (idObraC='".$_GET['id']."') and (id_croqi not IN (select id_D from mpreclamantes where id_ObraR='".$_GET['id']."')) and (id_afec=id_Propietario) order by apatP asc",$conec); 
                            while( $pp = mysql_fetch_array($numtodos) )
                            { ?>
                                <option value="<?php  echo $pp ['id_croqi']?>"><?php  echo $pp ['apatP'].'  '.$pp ['amatP'].'  '.$pp ['nombreP'].'. # Croqui: '.$pp ['id_croqi']?>
                                  </option>
                       <?php } ?>
      </select></th>
      <th colspan="2">Comunidad:<br>
        <select id="comuniP" name="comuniP" style="width:auto;" onChange="asignaEdo(this);">
          <option value="NULL">Seleccione una Comunidad</option>
          <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                            mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!");                             
                           // $numtodos = mysql_query("SELECT id_Obras,campo,tipoObra,descObra FROM obrasgmaec where id_Obras = '".$_GET['id']."' order by campo,tipoObra,descObra desc",$conec); 
                            $numtodos = mysql_query("select * from comunidades order by Nombre asc",$conec); 
                            while( $pp = mysql_fetch_array($numtodos) )
                            { ?>
          <option value="<?php  echo $pp ['id_Comunidad'].":".$pp['id_Mun']?>">
            <?php  echo $pp ['Nombre']?>
          </option>
          <?php } ?>
      </select></th>
      <th colspan="2" align="center" style="padding-left:3em;">Municipio:<br>
      <input name="munComu" type="text" id="munComu" size="35" maxlength="150" disabled/></th>
      <th>Régimen de Propiedad:<br>
        <select name="regimenP" id="regimenP">
          <option value="NULL">Seleccione un Regímen</option>
          <option value="E">Ejido</option>
          <option value="P">Propiedad</option>
          <option value="Z">Zona Federal</option>
          <option value="S">Posesión</option>
      </select></th>
    </tr>
    <tr>
        <th>Del<br>km:<br>
        <input name="dk" type="text" id="dk" size="9" maxlength="15" style="width:6em;" /></th>
      <th>Al<br>km:<br>
      <input name="ak" type="text" id="ak" size="9" maxlength="15" style="width:6em;" /></th>
        <th>Longitud<br>(ml):<br>
        <input name="longp" type="text" id="longp" size="9" maxlength="15" style="width:6em;" /></th>
        <th>Superficie<br>(m<sup>2</sup>):<br>
        <input name="supp" type="text" id="supp" size="9" maxlength="15" style="width:6em;" /></th>
      <th colspan="2">Superficie Áreas Adicionales<br>
        (m<sup>2</sup>):<br>
      <input name="supap" type="text" id="supap" size="9" maxlength="15" style="width:6em;" /></th>
        <th>Subir Permiso Escaneado:<br>
        <input type="file" name="permisoEsca" id="permisoEsca"></th>        
    </tr>
    <tr>
      <th>No. de Expediente:</th>
      <th><input name="expp" type="text" id="expp" size="9" maxlength="15" style="width:6em;" /></th>
      <th>Tipo Permiso de Paso:</th>
      <th colspan="3"><select name="tipop" id="tipop" style="width:23em;">
        <option value="NULL">Seleccione un Tipo de Permiso</option>
        <option value="T">Topográfico</option>
        <option value="D">DDV</option>
        <option value="A">Áreas Adicionales</option>
      </select></th>
      <th>Monto Permiso : $<input name="montop" type="text" id="montop" size="9" maxlength="15" style="width:9em;" /></th>
    </tr>
    <tr>
      <th colspan="3" align="right">Estatus Permiso de Paso Actual:
        <select name="estatusP" id="estatusP">
          <option value="NULL">Estatus Actual?</option>
          <option value="P">Pendiente</option>
          <option value="O">Obtenido</option>
          <option value="N">N/A</option>
          <option value="4">Opc 4</option>
      </select></th>
      <th align="right">&nbsp;</th> 
      <th align="right">Suma Permisos de la Obra: <br>     
	  <?php $codigoSql=mysql_query("SELECT SUM(mpreclamantes.monto),AVG(mpreclamantes.monto) FROM mpreclamantes WHERE mpreclamantes.id_ObraR=".$_GET['id'],$conec); 
	        $resumenObra= mysql_fetch_row($codigoSql);	?>$
  <input name="nomafec8" type="text" id="nomafec8" size="9" maxlength="15" style="width:9em;" readonly value="<?php echo number_format($resumenObra['0'],2); ?>" /></th>
      <th colspan="2" align="center">Promedio Permisos de la Obra: <br>
        $
<input name="nomafec9" type="text" id="nomafec9" size="9" maxlength="15" style="width:9em;" readonly value="<?php echo number_format($resumenObra['1'],2); ?>" /></th>
    </tr>
    <tr>
      <th colspan="7" align="right"><input type="submit" name="submit" value="Guardar Permiso de Paso" class="btn btn-primary" />
       <input type="reset" name="reset" value="Cerrar Ventana" class="btn btn-primary" OnClick="cierraEdicionPermiso();"/></th>
    </tr>
  </table>
</form>
   <div class="container-fluid" 
   style=" overflow:scroll;  height:500px;   
   width:100%;"> 
<table class="table">
 <thead>
  <tr><td colspan="5">
     <span class="label label-warning pull-left">
     <h4>Censo de Permisos de Paso. Obra: "<?php  echo $nombreObra; ?>"</h4> </span>   
 </td></tr>
    <tr aling="center" style="background-color:#f89406; color:white; margin:0; padding:0;" >
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
      <th style="text-align: center" >Extras</th>
    </tr> 
  </thead>
  <tbody>    
        <?php $conec2= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
              mysql_select_db("rysobd",$conec2) or die ("Imposible conectar a la base de datos!!!!"); 
              //$numtodos = mysql_query("SELECT * FROM propietariosgmaec,mpreclamantes WHERE (id_ObraR='".$_GET['id']."') AND (id_D=id_Propietario) order by apatP asc",$conec); 
              $numtodos = mysql_query("SELECT  numExp,filePermiso,id_croqi,filecroqui,apatP,amatP,nombreP,tipoPermiso,Nombre,nombreMun,nomEstado,reg_Prop
                ,del_km,al_km,longi,sup,supAd,monto,estatusPermiso,id_R,id_ObraR
from mpreclamantes,obrasgmaec,croquisvalidados,propietariosgmaec,comunidades,municipios 
where (id_ObraR='".$_GET['id']."') and (id_ObraR=id_Obras) and (id_D=id_croqi) and (id_afec=id_Propietario) and (link_Com=id_Comunidad) and (id_Mun=id_Municipio) 
order by estatusPermiso, apatP, amatP, nombreP  desc",$conec); 
              $indice=0;
              while( $pp = mysql_fetch_array($numtodos) )
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
                  <td> <button class="btn btn-info" type="button" OnClick="openWinEditPermi(<?php echo $pp['19'] ?>);"><small>Editar</small><span class="icon-pencil icon-white"></span></button>
                        <form action="desvinculaPermisodeP.php" method="POST" style="margin:0;">
                             <input type="hidden" value="<?php echo $pp['19']?>" id="obrades" name="obrades">
                             <input type="hidden" value="<?php echo $pp['20']?>" id="obradesof" name="obradesof">  
                             <input type="submit" name="submit" id="button" value="Desvincular §"  class="btn btn-small" style="margin:0"/></form>                            
                        </button>
                  </td>
                </td>                                   
                </tr>
            <?php } ?>
    </tbody>
</table>
</div>
    </body>
    </html>
<?php } ?>