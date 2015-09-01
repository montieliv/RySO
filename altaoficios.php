<?php 
session_start();
  if (isset($_POST['submit']))
  {
    $a =  $_POST['numO'];
    $b = $_POST['fechaO'];
    $c = $_POST['remitente'];
    $d = $_POST['antecedente'];
    $e = $_POST['fechaAcuse'];
    $autor = $_SESSION["idUsuario"];
    $to= $_POST['tipoOficio'];

    if (isset ($_POST['linkDescarga'])) { 
      $g= "files/oficiosExternos/".$_POST['linkDescarga']; } 
      else {$g="";} 
      
    $con = mysql_connect("localhost","root","123");
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
    mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!"); 
    $sql = "INSERT INTO oficiossolicitud (numO,fechaO,remitente,antecedente,linkDescarga,fechaAcuse,tipoOficio,id_autor) VALUES ('$a','$b','$c','$d','$g','$e','$to','$autor')";
    
	if (mysql_query($sql,$con)){ 
          $ultimo_id = mysql_insert_id($con); 
      }else{ 
          echo "La inserción no se realizó"; 
      }

   
   if (isset($_POST['obrasreg'])) {
       $obrar = $_POST['obrasreg']; 
      if (isset($ultimo_id))
  	   {
  		      $sql = "INSERT INTO oficiosobras (idOfref,idObraref) VALUES ('$ultimo_id','$obrar')";
             mysql_query($sql,$con);
  	   }
   }
    mysql_close($con);
	  echo "<html><html lang='en'><head><meta charset='utf-8'><meta http-equiv='REFRESH' content='0; url=jefeProyecto.php?captura=paso2'></head><body><script>alert('Datos del Oficio fueron almacenados con éxito');</script></body></html>";
        }
  else
  {	
    ?>  
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Alta de Oficios</title>
      <script>
          function altadepto(){
           var depto;
           var titular;
            depto=prompt("Ingrese el nombre del nuevo Depto");
            titular=prompt("Ingrese el Titular del nuevo Depto");
            var res = depto.toUpperCase();

            if(!depto) 
            { event.preventDefault(); }
             else {                    
                      var parametros = {
                        "a" : depto,    
                        "b" : titular
                      }; 
                      $.ajax({
                        data: parametros,
                        url: 'savedepto.php',
                        type: 'post',  
                        success: function (response) {
                            $.get("buscaultimodepto.php?id="+parametros['a'],function(data){
                            $('#remitente').append('<option value="'+data+'" selected="selected">'+res+'</option>');                            
                            });   
                        }                    
                      }); 
                  }
          }          
      </script>
    </head>
    <body>   
      
<form  name="frmOficios01" id="frmOficios01" action="altaoficios.php" method="post">   
<table class="table-striped" align="center">
    <tr><th align="right">No. Oficio:</th>
        <td><input type="text" size="30" id="numO" name="numO" required></td>
        <th align="right">Fecha Oficio:</th>
        <td align="left"><input type="date" id="fechaO" name="fechaO" placeholder="Creación del Oficio" required/>          
    </tr> 
    <tr>
      <th align="right">Enviado Por:</th>  
      <td ><a id="linkremitente" name="linkremitente" href="#"><span onclick="altadepto();" class="icon-plus"></span></a>
            <select id="remitente" name="remitente" style="width:30em;">
              <option value="NULL">Seleccione el Departamento</option>
                    <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                            mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
                            $numtodos = mysql_query("SELECT * FROM areas order by nombre desc",$conec); 
                            while( $pp = mysql_fetch_array($numtodos) )
                            { ?>
                              <option value="<?php  echo $pp ['id_area']?>"><?php  echo $pp ['nombre'].' - '.$pp ['titular']?></option>
                      <?php } ?>            
            </select>
          </td>
      <th>Antecedente(s):</th>
      <td colspan="3">
            <select id="antecedente" name="antecedente">
              <option value="NULL">Seleccione un Oficio</option>
                      <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                            mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
                            $numtodos = mysql_query("SELECT * FROM oficiossolicitud where id_autor='".$_SESSION["idUsuario"]."' order by fechaO desc",$conec); 
                            while( $pp = mysql_fetch_array($numtodos) )
                            { ?>
                              <option value="<?php  echo $pp ['idOficio']?>"><?php  echo $pp ['numO'].' - '.$pp ['fechaO'].' - '.$pp ['remitente'] ?></option>
                      <?php } ?>
                    </select>           
      </td>   
    </tr>   
    <tr>
      <th align="right">Fecha Acuse:</th>
        <td><input type="date" id="fechaAcuse" name="fechaAcuse" required /></td>
      <th>Subir Archivo:</th>
            <td><input class="btn-small" type="file" id="linkDescarga" name="linkDescarga"></td>
     </tr>
    <tr>
         <th>Relación de Obras: </th>
      <td colspan="3">
            <select id="obrasreg" name="obrasreg" style="width:100%" required>
              <option value="NULL">Seleccione una obra</option>
                      <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                            mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
                            $numtodos = mysql_query("SELECT id_Obras,nombre_Campo,tipoObra,descObra FROM obrasgmaec,gestionobras,campos where (id_Obras=id_ObrasGestion) and (id_J='".$_SESSION["idUsuario"]."') and (campo=id_Campos) order by campo,tipoObra,descObra desc",$conec); 
                            while( $pp = mysql_fetch_array($numtodos) )
                            { ?>
                              <option value="<?php  echo $pp ['id_Obras']?>"><?php  echo $pp ['nombre_Campo'].' - '.$pp ['tipoObra'].' - '.$pp ['descObra'] ?></option>
                      <?php } ?>
                    </select>           
      </td> 
     </tr>
     <tr><th align="right">Tipo de Oficio:</th><td>
        <select id="tipoOficio" name="tipoOficio">
          <option value="NULL">Seleccione un Tipo de Oficios</option>
          <option value="Solicitud">Solicitud</option>
          <option value="Ampliación">Ampliación</option>
          <option value="SCorrección">SOL.- Corrección</option>
          <option value="RCorrección">RES.- Corrección</option>          
          <option value="Recordatorio">Recordatorio</option>
          <option value="Presupuesto">Presupuesto</option>
          <option value="Permiso">Envío de Permiso de Paso</option>      
          <option value="Cancelación">Cancelación</option>
        </select>
      </td>
      <td colspan="3" align="center"><input type="submit" name="submit" id="button" value="Guardar Nuevo Oficio" class="btn  btn-primary" />
       <input type="reset" name="reset" value="Limpiar Datos" class="btn btn-primary"/>
      </td>
      </tr>     
</table>
</form>
   <div class="container-fluid" style=" overflow:scroll;  height:300px;   width:100%;"> 
<table class="table" style="font-size:.9em;">
 <thead>
  <tr><td colspan="6">
     <span class="label label-warning pull-left"><h4>Oficios Capturados Sin Vinculación con Obras</h4></span>   
 </td></tr>
    <tr style="background-color:#f89406; color:white;" >
      <th>Tipo</th>
      <th>No. Oficio</th>
      <th>Acuse</th>         
      <th>Remitente</th>              
      <th>Antecedentes</th>          
      <th>Acciones</th>
    </tr> 
  </thead>
  <tbody>    
        <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
              mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
              $numtodos = mysql_query("SELECT oficiossolicitud.* FROM oficiossolicitud LEFT JOIN oficiosobras ON idOficio = idOfref WHERE (idOfref is NULL) and (id_autor='".$_SESSION["idUsuario"]."')",$conec); 
              //$numtodos = mysql_query("SELECT * FROM oficiossolicitud  order by fechaO desc",$conec);               
              while( $pp = mysql_fetch_array($numtodos) )
              { ?>
                <tr>  
                  <td> <?php if ($pp['8']="SCorrección") {echo "Solicitud<br>Correccíón";}else {echo "Contestación<br>Correccíón";} ?> </td>                   
                  <td> <?php echo $pp['1'];
                      if (strlen ($pp['5'])> 1) {
                         ?> <a href="<?php echo $pp['5']?>" target="new"> <span class="icon-download"></span> </a> <?php } ?>                        
                   </td>
                  <td> <?php echo $pp['7'] ?> </td>
                  <td><?php  if($pp['3']) { $ante=mysql_fetch_array(mysql_query("SELECT nombre,titular FROM areas WHERE (id_area= ".$pp['3'].")",$conec)); echo $ante['0']." .-".$ante['1']; }?> </td>                                   
                 <td><?php  if($pp['4']) { $ante=mysql_fetch_array(mysql_query("SELECT numO,linkDescarga FROM oficiossolicitud WHERE (idOficio= ".$pp['4'].")",$conec)); echo $ante['0'];?><a href="<?php echo $ante['1'];?>" target="new"> <span class="icon-download"></span> </a>   <?php }?> </td>                                                     
                <td> <button class="btn btn-info pull-right" type="button" OnClick="openWinEditOfic(<?php echo $pp['0'] ?>);"><small>Editar</small><span class="icon-pencil icon-white" aria-hidden="true"></span></button></td>
                </tr>
            <?php } ?>
    </tbody>
</table>
</div>
   <div class="container-fluid" style=" overflow:scroll;   height:300px;   width:100%;"> 
<table class="table" style="font-size:.9em;">
 <thead>
  <tr><td colspan="7">
     <span class="label label-success"><h4>Oficios Vinculados</h4></span>   
     </td>
  </tr>  
    <tr style="background-color:#468847; color:white;" >                        
      <th>Tipo</th>
      <th >No. Oficio</th>
      <th>Acuse</th>         
      <th>Remitente</th>              
      <th>Antecedentes</th>    
      <th>Obra Relacionada</th>       
      <th>Acciones</th>             
    </tr> 
  </thead>
  <tbody>       
        <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
              mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
              $numtodos = mysql_query("SELECT numO,fechaAcuse,remitente,antecedente,linkDescarga,descObra,idOfref,idObraref,tipoOficio from oficiossolicitud,oficiosobras,obrasgmaec,gestionobras where (idOficio=idOfref) and (idObraref=id_Obras) and (id_Obras=id_ObrasGestion) and (id_J='".$_SESSION["idUsuario"]."') order by fechaAcuse desc",$conec); 
              while( $pp = mysql_fetch_array($numtodos) )
              { ?>
                <tr>      
                <td> <?php if ($pp['8']=="SCorrección") {echo "Solicitud<br>Correccíón";}else {echo $pp['8'];} ?> </td>                                  
                  <td> <?php echo $pp['0'] ?> </td>
                  <td> <?php echo $pp['1'] ?>
                       <?php if (strlen ($pp['4'])> 1) {
                         ?> <a href="<?php echo $pp['4']?>" target="new"> <span class="icon-download"> </span> </a> <?php } ?> 
                   </td>
                  <td><?php  if($pp['2']) { $ante=mysql_fetch_array(mysql_query("SELECT nombre,titular FROM areas WHERE (id_area= ".$pp['2'].")",$conec)); echo $ante['0']." .-".$ante['1']; }?> </td> 
                  <td> <?php //echo $pp['3']; if($pp['3']) {echo "<br><b>"."Ver"; }?> 
                       <?php  if($pp['3']) { $Oante=mysql_fetch_array(mysql_query("SELECT numO,linkDescarga FROM oficiossolicitud WHERE (idOficio= ".$pp['3'].")",$conec)); echo $Oante['0']." .-"; ?>  <a href="<?php echo $Oante['1']?>" target="new"> <span class="icon-download"> </span> </a> <?php } ?> 
                  </td>                                    
                  <td> <?php echo $pp['5'] ?> </td>                                    
                 <td><form action="desvinculaObOF.php" method="POST" style="margin:0;">
                         <input type="hidden" value="<?php echo $pp['7']?>" id="obrades" name="obrades">
                         <input type="hidden" value="<?php echo $pp['6']?>" id="obradesof" name="obradesof">  
                         <input type="submit" name="submit" id="button" value="Desvincular §"  class="btn btn-small" style="margin:0"/></form>
                      <button class="btn btn-info" type="button" OnClick="openWinEditOfic(<?php echo $pp['6'] ?>);"><small>Editar</small><span class="icon-pencil icon-white"></span></button>
                 </td>                  
             </tr>
            <?php } ?>          
    </tbody> 
</table>
</div> 
   </body>
    </html>
<?php } ?>