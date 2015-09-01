<?php 
session_start();
  if (isset($_POST['submit']))
  {    
    $g = $_POST['campoObra'];
    $c = $_POST['tipoObra'];
    $i = $_POST['instalaObra'];
    $a = $_POST['descObra'];
    $e = $_POST['estatusobra'];	
    $f = $_POST['latitudObra'];	
    $h = $_POST['longitudObra'];	

    $superselec=$_POST['selecsupervisor'];
	
    if (isset($_POST['obraprioritaria']))
	 { $d="true"; } else { $d="false";}
	
    $con = mysql_connect("localhost","root","123");
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
    mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!");
    $sql = "INSERT INTO obrasgmaec (descObra,tipoObra,isPrioritaria,status,latitudO,longitudO,campo,instalacion) 
	                                VALUES ('$a','$c','$d','$e','$f','$h','$g','$i')";
    
      if (mysql_query($sql,$con)){ 
          $ultimo_id = mysql_insert_id($con); 
      }else{ 
          echo "La inserción no se realizó"; 
      }

    mysql_close($con);

   
    $con = mysql_connect("localhost","root","123");
    $g = $_POST['oficioobra'];  
   //buscar el id asignado a la obra anterior
    if (isset($_POST['oficioobra']))
	   {
		    mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!"); 
            $sql = "INSERT INTO oficiosobras (idOfref,idObraref) 
	                                VALUES ('$g','$ultimo_id')";
           mysql_query($sql,$con);
	   }
    
    mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!"); 
    $sql = "INSERT INTO supervisionobras (idObraa,idGesa,idsuperSuper)  VALUES ('$ultimo_id','28','$superselec')";
     mysql_query($sql,$con);

    // $sql = "INSERT INTO obrassupervisadas (idsuperObra,idsuperSuper)  VALUES ('$ultimo_id','$superselec')";
    //  mysql_query($sql,$con);

    mysql_close($con);
	  echo "<html><html lang='en'><head><meta charset='utf-8'><meta http-equiv='REFRESH' content='0; url=jefeProyecto.php?captura=paso2'></head><body><script>   alert('Obra almacenada con éxito');</script></body></html>";
        }
  else
  {	
    ?>  
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
    <title>Alta de Obras</title>
    <style type="text/css">
        #frmOficios01 .table-striped tr th {
          	text-align: center;
          }
    </style>
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
                            $('#instalaObra').append('<option value="'+data+'" selected="selected">'+res+'</option>');                            
                            });   
                        }                    
                      }); 
                  }
          }          
      </script>
    </head>
    <body>   
<form  name="frmOficios01" id="frmOficios01" action="altaobras.php" method="post">   
<table align="center" class="table-striped">
    <tr>
        <th>Campo:</th>
        <th><select id="campoObra" name="campoObra" style="width:20em;">
          <option value="NULL">Lista de Campos</option>
          <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); 
                      mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
                      $camptodos = mysql_query("SELECT * FROM campos order by nombre_Campo asc",$conec); 
                      while( $cam = mysql_fetch_array($camptodos) )
                      { ?>                
                        <option value="<?php  echo $cam['id_Campos']?>"><?php  echo $cam['nombre_Campo'].'.- '. $cam ['proyecto_Campo'];?></option>
                <?php } ?>   
        </select></th>
      <th>Tipo de Obra:</th>
        <th><select id="tipoObra" name="tipoObra">
          <option value="NULL">Tipos de Obras</option>
          <option value="Nueva">Nueva</option>
          <option value="Mantenimiento">Mantenimiento</option>
        </select></th>
      <th>Supervisor </th>
        <th colspan="2"><select id="selecsupervisor" name="selecsupervisor" style="width:20em;">
          <option value="NULL">Supervisores</option>
          <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); 
                      mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
                      $suptodos = mysql_query("SELECT * FROM supervisores WHERE nS=".$_SESSION["idUsuario"]." order by n asc",$conec); 
                      while( $sup = mysql_fetch_array($suptodos) )
                      { ?>   
                        <option value="<?php  echo $sup['id_S']?>"><?php  echo $sup['n'];?></option> 
                <?php } ?>   
          </select>        </th>
    </tr> 
    <tr>
      <th>Instalación:<br>        <a id="linkinstalaciones" name="linkinstalaciones" href="#"><span onclick="altainsta();" class="icon-plus"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>  
      <td ><select id="instalaObra" name="instalaObra">
        <option value="NULL">Lista de Instalaciones</option>
        <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); 
                      mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
                      $numtodos = mysql_query("SELECT * FROM mpinstalaciones where (id_insta > 28) order by nombre desc",$conec); 
                      while( $pp = mysql_fetch_array($numtodos) )
                      { ?>
                        <option value="<?php  echo $pp ['id_insta']?>"><?php  echo $pp ['nombre'].' - '.$pp ['tipo']?></option>
        <?php } ?>   

      </select>
      <th>Descripción <br>de la Obra:</th>
      <th colspan="4"><textarea name="descObra" cols="70" rows="3" id="descObra" style="width:98%;" required></textarea></th>
    </tr>
    <tr>
      <th>Estatus:</th>
      <td><select id="estatusobra" name="estatusobra">
        <option value="NULL">Estatus Obras</option>
        <option value="En proceso de Captura">En proceso de Captura</option>
        <option value="Inicia Atención en Campo">Inicia Atención en Campo</option>
        <option value="Continúa Atención en Campo">Continúa Atención en Campo</option>
        <option value="En espera de croquis">En espera de croquis</option>
        <option value="En proceso de asignación de datos presupuestales">En proceso de asignación de datos presupuestales</option>
        <option value="Permisos al 100%">Permisos al 100%</option>
        <option value="Suspendida por Falta de Presupuesto">Suspendida por Falta de Presupuesto</option>
      </select></td>
      <th>Latitud:</th>
      <th><input name="latitudObra" type="text" id="latitudObra" /></th>
      <th colspan="2">Longitud:</th>
      <th><input name="longitudObra" type="text" id="longitudObra" /></th>
    <tr>
      <th>Oficio <br>de Solicitud:<br>        </th>
        <td colspan="6"><select id="oficioobra" name="oficioobra" style="width:100%";>
          <option value="NULL">Oficios Capturados</option>
                      <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                            mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
                            $numtodos = mysql_query("SELECT idOficio,numO,fechaO FROM oficiossolicitud,oficiosobras,obrasgmaec,gestionobras where (idOficio=idOfref) and (idObraref=id_Obras) and (id_Obras=id_ObrasGestion) and (id_J='".$_SESSION["idUsuario"]."') order by fechaAcuse desc",$conec); 
                            while( $pp = mysql_fetch_array($numtodos) )
                            { ?>
                              <option value="<?php  echo $pp ['idOficio']?>"><?php  echo $pp ['numO'].' -Elaborado: '.$pp ['fechaO'];//.' -Acuse: '.$pp ['fechaAcuse'].' -Enviado Por: '.$pp ['remitente'] ?></option>
                      <?php } ?>
                    </select>           </td>
    <tr>
      <th>&nbsp;</th>
      <th colspan="3"><span style=" font-style:italic; text-shadow:inherit; font-weight:bold; color:red;">¿Es Prioritaria?</span>        <input type="checkbox" name="obraprioritaria" id="obraprioritaria"></th>
      <td align="right"><input type="submit" name="submit" id="button2" value="Guardar Obra" class="btn  btn-primary" /></td>      
      <td align="center">&nbsp;</td>
      <td align="center"><input type="reset" name="reset" value="Limpiar Datos" class="btn btn-primary"/></td>      
    </tr>             
</table>
</form>
   <div class="container-fluid" style=" overflow:scroll;  height:500px;   width:100%;"> 
<table class="table">
 <thead>
  <tr><td colspan="7">
     <span class="label label-warning pull-left">
     <h4>Obras Capturadas</h4></span>   
 </td></tr>
    <tr style="background-color:#f89406; color:white;" >
      <th>Campo</th>         
      <th>Tipo/Obra</th>              
      <th>Instalación</th>    
      <th>Actividad</th>
      <th>Estatus</th>
      <th>Oficio</th> 
      <th>Opciones</th>
    </tr> 
  </thead>
  <tbody>    
        <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
              mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
              $numtodos = mysql_query("SELECT id_Obras,nombre_Campo,tipoObra,instalacion,status,latitudO,longitudO,descObra FROM obrasgmaec,campos,gestionobras Where (id_Obras=id_ObrasGestion) and (id_J=".$_SESSION["idUsuario"].") and (id_Campos=campo) order by campo desc",$conec); 
              while( $pp = mysql_fetch_array($numtodos) )
              { ?>
                <tr>                     
                  <td> <?php echo $pp['1'] ?> </td>
                  <td> <?php echo $pp['2'] ?> </td> 
                  <td> <?php  $nomins=mysql_fetch_array(mysql_query("SELECT nombre FROM mpinstalaciones WHERE (id_insta= ".$pp['3'].")",$conec)); echo $nomins['0']; ?> 
                  </td> 
                 <td><?php echo $pp['7'] ?></td>                                
                  <td> <?php echo $pp['4'] ?></td>
                  <td style="marging:0; padding:0;"> <?php                                    
                                  $numI = mysql_query("select fechaO,numO,remitente,antecedente,linkDescarga,fechaAcuse,tipoOficio from 
                                  oficiossolicitud,oficiosobras where ((idOficio=idOfref) and (idObraref=".$pp['id_Obras'].")) order by fechaAcuse asc");
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
                <td> <button class="btn btn-info" type="button" OnClick="openWinEditObra(<?php echo $pp['0'] ?>);"><small>Editar</small><span class="icon-pencil icon-white"></span></button>
                                  <?php  if (($pp['5']!="S/L")&& ($pp['6']!="S/L")) { ?>   <a target="new" href="https://www.google.com.mx/maps/search/<?php echo $pp['5']?>,<?php echo $pp['6']?>/@<?php echo $pp['5']?>,<?php echo $pp['6']?>,2900m/data=!3m1!1e3!">
                                  <img src="imagenes/logomap.png" style="width:25px; height:25px;" title="Ubicar" alt="Mapa" /></a></td>  <?php } ?>
                </td>                                   
                </tr>
            <?php } ?>
    </tbody>
</table>
</div>
    </body>
    </html>
<?php } ?>