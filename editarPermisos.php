<?php 
$conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
$numtod = mysql_query("SELECT * FROM mpreclamantes where id_R=".$_GET['permId'],$conec); 
$ppE = mysql_fetch_array($numtod);
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
		function asignaEdo2(mun)
		{
      var str1 = mun.value;                                 
       str1.toString();    
       var res = str1.substr(str1.search(":")+1,str1.length); //nombre de afectado registrado
        $.get("buscaEdo.php?idM="+res,function(data){
             var txt2 = data;   
             var caj= document.getElementById("munComuEdit");            
             caj.value=txt2;                 
           }); 
		}		
    function buscaMNun( mun){
       $.get("buscaEdo.php?idM="+mun,function(data){
             var txt2 = data;   
             var caj= document.getElementById("munComuEdit");            
             caj.value=txt2;                 
           }); 
    }
     $('html,body').animate({scrollTop:0},300);       

	</script>
    </head>
    <body>   
<form action="saveaPerms.php" method="post"  name="frmPermisos" id="frmPermisos">   
<table align="center" class="table-striped">
  <tr><input type="hidden" name="obrasleccEdit" id="obrasleccEdit" value="<?php echo $ppE['id_R']; ?>">
    <input type="hidden" name="obraEdit" id="obraEdit" value="<?php echo $ppE['id_ObraR']; ?>">
      <th>Obra <br>Relacionada:<br>        </th>
        <td colspan="8">
          <select id="obrasregafecEdit" name="obrasregafecEdit" style="width:100%" disabled>
              <option value="NULL">Seleccione una obra</option>
                      <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                            mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
                            $Otodas = mysql_query("SELECT id_Obras,nombre_Campo,tipoObra,descObra FROM obrasgmaec,campos where (id_Obras = '".$ppE['id_ObraR']."') and (campo=id_Campos) order by campo,tipoObra,descObra desc",$conec); 
                            while( $ppO = mysql_fetch_array($Otodas) )
                            { ?>
                              <option value="<?php  echo $ppO ['id_Obras']?>" <?php if ($ppO ['id_Obras']==$ppE['id_ObraR']) { ?> selected <?php }  ?> >
                                     <?php  echo $ppO ['nombre_Campo'].' - '.$ppO ['tipoObra'].' - '.$ppO ['descObra'];

                                      $nombreObra=$ppO ['descObra']; ?>
                              </option>
                      <?php } ?>
                    </select>          
          </td>
    </tr>         
    <tr>
      <th colspan="2">Afectados Relacionados:<br>
        <select id="afecregPEdit" name="afecregPEdit" style="width:auto;">
        <option value="NULL">Seleccione una Afectado</option>
        <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                            mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!");                             

                            $eligeCroq = mysql_query("SELECT id_Propietario,apatP,amatP,nombreP,id_croqi  from croquisvalidados,propietariosgmaec where (id_croqi='".$ppE['id_D']."') and (id_afec=id_Propietario)",$conec); 
                            $Croqselec=mysql_fetch_array($eligeCroq); 

                            $numtodos = mysql_query("SELECT id_Propietario,apatP,amatP,nombreP,id_croqi from croquisvalidados,propietariosgmaec where (idObraC='".$ppE['id_ObraR']."') and (id_croqi not IN (select id_D from mpreclamantes where id_ObraR='".$ppE['id_ObraR']."')) and (id_afec=id_Propietario) order by apatP asc",$conec); 
                           
                           ?>
                            <option value="<?php  echo $Croqselec ['id_croqi']?>" selected><?php  echo $Croqselec['apatP'].'  '.$Croqselec['amatP'].'  '.$Croqselec['nombreP'].'. # Croqui: '.$Croqselec['id_croqi']?>
                                  </option>
                            <?php
                            while( $pp = mysql_fetch_array($numtodos) )
                            { ?>
                                <option value="<?php  echo $pp ['id_croqi']?>"><?php  echo $pp ['apatP'].'  '.$pp ['amatP'].'  '.$pp ['nombreP'].'. # Croqui: '.$pp ['id_croqi']?>
                                  </option>
                       <?php } ?>
      </select></th>
      <th colspan="2">Comunidad:<br>
        <select id="comuniPEdit" name="comuniPEdit" style="width:auto;" onChange="asignaEdo2(this);">
          <option value="NULL">Seleccione una Comunidad</option>
          <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                            mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!");                             
                           // $numtodos = mysql_query("SELECT id_Obras,campo,tipoObra,descObra FROM obrasgmaec where id_Obras = '".$ppE['id']."' order by campo,tipoObra,descObra desc",$conec); 
                            $numtodos = mysql_query("select * from comunidades order by Nombre asc",$conec); 
                            while( $pp = mysql_fetch_array($numtodos) )
                            { ?>
                            <option value="<?php  echo $pp ['id_Comunidad'].":".$pp['id_Mun']?>" 
                              <?php if ($pp ['id_Comunidad']==$ppE['link_Com']) { $comuniselected=$pp ['id_Mun'] ?> selected <?php  } else {$comuniselected="";}  ?> > 
                              <?php  echo $pp ['Nombre']?>
                            </option>
                      <?php } ?>
                        </select></th>  <script>  buscaMNun(<?php echo $comuniselected; ?>) </script>
      <th colspan="2" align="center" style="padding-left:3em;">Municipio:<br>
      <input name="munComuEdit" type="text" id="munComuEdit" size="35" maxlength="150"  disabled/></th>
      <th>Régimen de Propiedad:<br>
        <select name="regimenPEdit" id="regimenPEdit">
          <option value="NULL">Seleccione un Regímen</option>
          <option value="E"  <?php if ($ppE['reg_Prop']=='E') { ?> selected <?php  }  ?> >Ejido</option>
          <option value="P"  <?php if ($ppE['reg_Prop']=='P') { ?> selected <?php  }  ?> >Propiedad</option>
          <option value="Z"  <?php if ($ppE['reg_Prop']=='Z') { ?> selected <?php  }  ?> >Zona Federal</option>
          <option value="S"  <?php if ($ppE['reg_Prop']=='S') { ?> selected <?php  }  ?> >Posesión</option>
      </select></th>
    </tr>
    <tr>
        <th>Del<br>km:<br>
        <input name="dkEdit" type="text" id="dkEdit" size="9" maxlength="15" style="width:6em;" value="<?php  echo $ppE['del_km'];?>"/></th>
      <th>Al<br>km:<br>
      <input name="akEdit" type="text" id="akEdit" size="9" maxlength="15" style="width:6em;" value="<?php  echo $ppE['al_km'];?>"/></th>
        <th>Longitud<br>(ml):<br>
        <input name="longpEdit" type="text" id="longpEdit" size="9" maxlength="15" style="width:6em;" value="<?php  echo $ppE['longi'];?>"/></th>
        <th>Superficie<br>(m<sup>2</sup>):<br>
        <input name="suppEdit" type="text" id="suppEdit" size="9" maxlength="15" style="width:6em;" value="<?php  echo $ppE['sup'];?>"/></th>
      <th colspan="2">Superficie Áreas Adicionales<br>
        (m<sup>2</sup>):<br>
      <input name="supapEdit" type="text" id="supapEdit" size="9" maxlength="15" style="width:6em;" value="<?php  echo $ppE['supAd'];?>"/></th>
        <th>Subir Permiso Escaneado:<br> <input type="text" id="permisoEscaantEdit" name="permisoEscaantEdit" value="<?php  echo $ppE['filePermiso'];?>"/>
        <input type="file" name="permisoEscaEdit" id="permisoEscaEdit"></th>        
    </tr>
    <tr>
      <th>No. de Expediente:</th>
      <th><input name="exppEdit" type="text" id="exppEdit" size="9" maxlength="15" style="width:6em;" value="<?php  echo $ppE['numExp'];?>"/></th>
      <th>Tipo Permiso de Paso:</th>
      <th colspan="3"><select name="tipopEdit" id="tipopEdit" style="width:23em;">
        <option value="NULL">Seleccione un Tipo de Permiso</option>
        <option value="T" <?php if ($ppE['tipoPermiso']=='T') { ?> selected <?php  }  ?> >Topográfico</option>
        <option value="D" <?php if ($ppE['tipoPermiso']=='D') { ?> selected <?php  }  ?> >DDV</option>
        <option value="A" <?php if ($ppE['tipoPermiso']=='A') { ?> selected <?php  }  ?> >Áreas Adicionales</option>
      </select></th>
      <th>Monto Permiso : $<input name="montopEdit" type="text" id="montopEdit" size="9" maxlength="15" style="width:9em;" value="<?php  echo $ppE['monto'];?>"/></th>
    </tr>
    <tr>
      <th colspan="8" align="center">Estatus Permiso de Paso Actual:
        <select name="estatusPEdit" id="estatusPEdit">
          <option value="NULL">Estatus Actual?</option>
          <option value="P" <?php if ($ppE['estatusPermiso']=='P') { ?> selected <?php  }  ?> >Pendiente</option>
          <option value="O" <?php if ($ppE['estatusPermiso']=='O') { ?> selected <?php  }  ?> >Obtenido</option>
          <option value="N" <?php if ($ppE['estatusPermiso']=='N') { ?> selected <?php  }  ?> >N/A</option>
          <option value="4" <?php if ($ppE['estatusPermiso']=='4') { ?> selected <?php  }  ?> >Opc 4</option>
      </select></th>
    </tr>
    <tr>
      <th colspan="7" align="right"><input type="submit" name="submit" value="Guardar Permiso de Paso" class="btn btn-primary" />
       <input type="reset" name="reset" value="Cerrar Ventana" class="btn btn-primary" OnClick="cierraEdiPerms();"/></th>
    </tr>
  </table>
</form>
       </body>
    </html>