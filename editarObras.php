<?php 
session_start();
$conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
$numtodos = mysql_query("SELECT * FROM obrasgmaec,gestionobras where (id_Obras=".$_GET['id'].") and (id_Obras=id_ObrasGestion)",$conec); 
$pp = mysql_fetch_array($numtodos);
    ?>
<!DOCTYPE html>
   <html lang="en">
   <head>
     <meta charset="UTF-8">
     <title>Document</title>
           <script>
          function altainsta(){
           var insta;
           var tipo;
            insta=prompt("Ingrese el nombre de la nueva instalación");
            tipo=prompt("Ingrese el Tipo de Instalación");
            var res = insta.toUpperCase();
            if(!insta) 
            { event.preventDefault(); }
             else {                    
                      var parametros = {
                        "a" : insta,    
                        "b" : tipo
                      }; 
                      $.ajax({
                        data: parametros,
                        url: 'saveinstalacion.php',
                        type: 'post',  
                        success: function (response) {
                            $.get("buscaultimainstalacion.php?id="+parametros['a'],function(data){
                            $('#instalaObra2').append('<option value="'+data+'" selected="selected">'+res+'</option>');                            
                            });   
                        }                    
                      }); 
                  }
          }          

          function errormessage()
          {
            alert("No se ha cargafo el oficio escaneado");
          }
      </script>
   </head>
   <body>
        
<table align="center" class="table-striped">
       <input type="hidden" value="<?php  echo $pp['0'] ?>" name="idobraedit2" id="idobraedit2">

    <tr>        
        <th>Campo:</th>
        <th><select id="campoObra2" name="campoObra2">
          <option value="NULL">Lista de Campos</option>
          <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); 
                      mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
                      $camptodos = mysql_query("SELECT * FROM campos order by nombre_Campo asc",$conec); 
                      while( $cam = mysql_fetch_array($camptodos) )
                      { ?>                
                        <option value="<?php  echo $cam['id_Campos']?>" <?php if  ($cam['id_Campos']==$pp['9'] ) { ?> selected  <?php } ?>> <?php  echo $cam['nombre_Campo'].'.- '. $cam ['proyecto_Campo'];?></option>
                <?php } ?>   
        </select></th>
        <th>Tipo de Obra:</th>
      <td>
        <select id="tipoObra2" name="tipoObra2">
          <option value="NULL">Tipos de Obras</option>
          <option value="Nueva"<?php if  ($pp['2']== "Nueva") { ?> selected  <?php } ?>>Nueva</option>
          <option value="Mantenimiento"<?php if  ($pp['2']== "Mantenimiento") { ?> selected  <?php } ?>>Mantenimiento</option>
        </select>
    </tr> 
    <tr>
      <th>Instalación:<br>  <a id="linkinstalaciones" name="linkinstalaciones" href="#"><span onclick="altainsta();" class="icon-plus"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>  
      <td ><select id="instalaObra2" name="instalaObra2">
        <option value="NULL">Lista de Instalaciones</option>
        <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); 
                      mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
                      $numtodosi = mysql_query("SELECT * FROM mpinstalaciones where (id_insta > 28) order by nombre desc",$conec); 
                      while( $ppi = mysql_fetch_array($numtodosi) )
                      { ?>
                         <option value="<?php  echo $ppi ['id_insta']?>" <?php if  ($pp['10']== $ppi ['id_insta']) { ?> selected  <?php } ?>><?php  echo $ppi ['nombre'].' - '.$ppi ['tipo']?></option>
                <?php } ?>  
      </select>
      <th>Descripción <br>de la Obra:</th>
      <th colspan="3"><textarea name="descObra2" cols="70" rows="3" id="descObra2" style="width:98%;"><?php  echo $pp ['1'] ?></textarea></th>
    </tr>
    <tr>
      <th>Estatus:</th>
      <td><select id="estatusobra2" name="estatusobra2">
        <option value="NULL">Estatus Obras</option>
        <option value="En proceso de Captura"<?php if  ($pp['6']== "En proceso de Captura") { ?> selected  <?php } ?>>En proceso de Captura</option>
        <option value="Inicia Atención en Campo"<?php if  ($pp['6']== "Inicia Atención en Campo") { ?> selected  <?php } ?>>Inicia Atención en Campo</option>
        <option value="Continúa Atención en Campo"<?php if  ($pp['6']== "Continúa Atención en Campo") { ?> selected  <?php } ?>>Continúa Atención en Campo</option>
        <option value="En espera de Croquis"<?php if  ($pp['6']== "En espera de Croquis") { ?> selected  <?php } ?>>En espera de croquis</option>
        <option value="En proceso de asignación de Datos Presupuestales"<?php if  ($pp['6']== "En proceso de asignación de Datos Presupuestales") { ?> selected  <?php } ?>>En proceso de asignación de datos presupuestales</option>
        <option value="Permisos al 100%"<?php if  ($pp['6']== "Permisos al 100%") { ?> selected  <?php } ?>>Permisos al 100%</option>
        <option value="Suspendida por Falta de Presupuesto"<?php if  ($pp['6']== "Suspendida por Falta de Presupuesto") { ?> selected  <?php } ?>>Suspendida por Falta de Presupuesto</option>
      </select></td>
      <th>Latitud:</th>
      <th><input name="latitudObra2" type="text" id="latitudObra2" value="<?php  echo $pp ['7'] ?>" /></th>
      <th>Longitud:</th>
      <th><input name="longitudObra2" type="text" id="longitudObra2" value="<?php  echo $pp ['8'] ?>"/></th>
    <tr>
      <th>Oficio <br>de Solicitud:<br>        
        <td colspan="5"><select id="oficioobra2" name="oficioobra2" style="width:100%"; onChange="eligioOficio2();">
          <option value="NULL">Oficios Capturados</option>
                      <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                            mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
                            $numtodosofio = mysql_query("SELECT idOficio,numO,fechaO FROM oficiossolicitud,oficiosobras,obrasgmaec,gestionobras where (idOficio=idOfref) and (idObraref=id_Obras) and (id_Obras=id_ObrasGestion) and (id_J='".$_SESSION["idUsuario"]."') order by fechaAcuse desc",$conec); 
                            while( $ptop = mysql_fetch_array($numtodosofio) )
                            { ?>
                              <option value="<?php  echo $ptop ['idOficio']?>"><?php  echo $ptop ['numO'].' -Elaborado: '.$ptop ['fechaO'];?></option>
                      <?php } ?>
                    </select>
          <a id="linkoficio" name="linkoficio" ><span class="icon-eye-open" aria-hidden="true"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <tr>
      
      <?php  
         $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
         mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
         $datossup = mysql_query("SELECT distinct idsuperSuper,n from gestionobras,supervisores  where idsuperSuper=id_S",$conec);
        
       ?>
      <th>Supervisor</th>
      <th><select id="selecsupervisoredit" name="selecsupervisoredit">
        <option value="NULL">Supervisores</option>
       <?php 
             while( $ppsup = mysql_fetch_array($datossup) )
                      { ?>                
                        <option value="<?php  echo $ppsup['idsuperSuper']?>" <?php if  ($ppsup['idsuperSuper']==$pp['15'] ) { ?> selected  <?php } ?>> <?php  echo $ppsup['n']; ?></option>
                <?php } ?>  
        ?>
     </select></th>
      <th colspan="2">Marcar Como Prioritaria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="obrapri2" id="obrapri2" <?php if  ($pp['5']!="false") { ?> checked  <?php } ?>></th>
      <td align="center"><input type="submit" name="button" id="button2" value="Guardar Obra" class="btn  btn-primary"  OnClick="guardaObra();"/></td>      
      <td align="center"><input type="reset" name="reset" value="Cerrar Ventana" class="btn btn-primary" OnClick="cierraEdicionObra();"/></td>
      <td align="center">&nbsp;</td>
    </tr>             
</table>
<hr>
 <div class="container-fluid" style=" overflow:scroll;   height:300px;   width:100%;"> 
<table class="table">
 <thead>
  <tr><td colspan="7">
     <span class="label label-success"><h4>Oficios Vinculados</h4></span>   
     </td>
  </tr>  
    <tr style="background-color:#468847; color:white;" >
      <th >Tipo</th>
      <th >No. Oficio</th>
      <th>Acuse</th>         
      <th>Remitente</th>              
      <th>Antecedentes</th>    
      <th>Ver</th> 
      <th>Acciones</th>             
    </tr> 
  </thead>
  <tbody>       
        <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
              mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
              $numtodos = mysql_query("SELECT numO,fechaAcuse,remitente,antecedente,linkDescarga,idOfref,idObraref,tipoOficio from oficiossolicitud,oficiosobras where (idObraref=".$_GET['id'].") and (idOfref=idOficio) order by fechaAcuse desc",$conec); 
              while( $pp = mysql_fetch_array($numtodos) )
              { ?>
                <tr>              
                  <td> <?php echo $pp['7'] ?> </td>       
                  <td> <?php echo $pp['0'] ?> </td>
                  <td> <?php echo $pp['1'] ?> </td>
                  <td><?php  if($pp['2']) { $remi=mysql_fetch_array(mysql_query("SELECT nombre,titular FROM areas WHERE (id_area= ".$pp['2'].")",$conec)); echo $remi['0']." .-".$remi['1']; }?> </td> 
                  <td> <?php  $ante=mysql_fetch_array(mysql_query("SELECT numO,linkDescarga FROM oficiossolicitud WHERE idOficio= ".$pp['3'],$conec));
                              if ($ante['1']) { ?>  
                              <?php  echo $ante['0']."<br><b>";?>                              
                                 <a id="linkoficio2" name="linkoficio2" href="<?php echo $ante['1'] ?>"><span class="icon-download"> </span></a>
                        <?php } ?>
                  </td>                                    
                  <td> <?php if (strlen ($pp['4'])> 1) {
                         ?> <a href="<?php echo $pp['4']?>" target="new"> <span class="icon-download"> </span> </a> <?php } ?> 
                 </td>
                 <td><form action="desvinculaObOF.php" method="POST" style="margin:0;">
                         <input type="hidden" value="<?php echo $pp['6']?>" id="obrades" name="obrades">
                         <input type="hidden" value="<?php echo $pp['5']?>" id="obradesof" name="obradesof">  
                         <input type="submit" name="submit" id="button" value="Desvincular §"  class="btn btn-small" style="margin:0" />                      
                     </form>                      
                 </td>                  
             </tr>
            <?php } ?>          
    </tbody> 
</table>
</div> 
</body>
   </html>