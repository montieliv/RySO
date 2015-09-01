<?php 
  if (isset($_POST['submit']))
  {
    $a =  $_POST['nomafec'];
    $b = $_POST['apatafec'];
    $c = $_POST['amatafec'];
    $d = $_POST['domafec'];
    $e = $_POST['telafec'];

    $f = $_POST['correoafec'];	
    $g = $_POST['extraafec'];	
    $h = $_POST['fotoafec'];		    

    if (isset ($_POST['fotoafec'])) { 
      $h= "images/fotos/".$_POST['fotoafec']; } 
      else {$h="";} 

    $con = mysql_connect("localhost","root","123");
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
    mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!");
    $sql = "INSERT INTO propietariosgmaec (nombreP,apatP,amatP,domicilioP,telP,foto,correoP,infoExtra) 
	                               VALUES ('$a','$b','$c','$d','$e','$h','$f','$g')";        
    
  
    if (mysql_query($sql,$con)){ 
          $ultimo_id = mysql_insert_id($con); 
      }else{ 
          echo "La inserción no se realizó"; 
      }

     $i = $_POST['obrasregafec'];        

     mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!"); 
    $sql = "INSERT INTO mpreclamantes (id_D,id_ObraR)  VALUES ('$ultimo_id','$i')";
     mysql_query($sql,$con);

     mysql_close($con);
	  echo "<html><html lang='en'><head><meta charset='utf-8'><meta http-equiv='REFRESH' content='0; url=gestor.php'></head><body><script>   alert('Obra almacenada con éxito');</script></body></html>";
        }
  else
  {	
    ?>  
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
    <title>Censo de afectados </title>
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
    </head>
    <body>   
<form action="altaAfectados.php" method="post" enctype="multipart/form-data"  name="frmOficios01" id="frmOficios01">   
<table align="center" class="table-striped">
    <!-- <tr>
        <th>Datos <br>
          Generales</th>
        <th width="213">Nombre:<br>
        <input name="nomafec" type="text" id="nomafec" size="35" maxlength="150" /></th>
        <th width="210" colspan="2">Apellido Paterno:<br>
        <input name="apatafec" type="text" id="apatafec" size="35" maxlength="150" /></th>
        <th colspan="2">Apellido Materno:<br>
        <input name="amatafec" type="text" id="amatafec" size="35" maxlength="150" /></th>
    </tr> 
    <tr>
      <th width="84">Domicilio:</th>  
      <th colspan="4"><textarea name="domafec" cols="30" rows="2" id="domafec" style="width:98%;"></textarea></th>
    </tr>
    <tr>
      <th height="25">Teléfono:</th>
      <th width="213"><input name="telafec" type="text" id="telafec" /></th>
      <th>Correo Electrónico:</th>
      <th colspan="2"><input name="correoafec" type="email" id="correoafec" /></th>
    
    <tr>
      <th>Información <br>
      Adicional:</th>
      <td align="center"><textarea name="extraafec" cols="20" rows="2" id="extraafec" style="width:98%;"></textarea></td>
      <td colspan="3" align="center">Foto:<br><input type="file" name="fotoafec" id="fotoafec"></td>
    </tr> -->
    <tr>
      <th>Obra <br>Relacionada:<br>        </th>
        <td colspan="6">
          <select id="obrasregafec" name="obrasregafec" style="width:100%" disabled>
              <option value="NULL">Seleccione una obra</option>
                      <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                            mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
                            $numtodos = mysql_query("SELECT id_Obras,nombre_Campo,tipoObra,descObra FROM obrasgmaec,campos where (id_Obras =  '".$_GET['id']."' ) and (campo=id_Campos) order by campo,tipoObra,descObra desc",$conec); 
                            while( $pp = mysql_fetch_array($numtodos) )
                            { ?>
                              <option value="<?php  echo $pp ['id_Obras']?>" <?php if ($pp ['id_Obras']==$_GET['id']) { ?> selected <?php }  ?> ><?php  echo $pp ['nombre_Campo'].' - '.$pp ['tipoObra'].' - '.$pp ['descObra'] ?></option>
                      <?php } ?>
                    </select>          
          </td>
    </tr>            
</table>
</form>
   <div class="container-fluid" style=" overflow:scroll;  height:500px;   width:100%;"> 
<table class="table">
 <thead>
  <tr><td colspan="5">
     <span class="label label-warning pull-left">
     <h4>Censo de Propietarios</h4></span>   
 </td></tr>
    <tr style="background-color:#f89406; color:white;" >
      <th>No. Croqui</th>
      <th>Nombre</th>
      <th>Domicilio</th>         
      <th>Teléfono</th>              
      <th>Correo</th>    
      <th>Extras</th>
      <th>Opciones</th>
    </tr> 
  </thead>
  <tbody>    
        <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
              mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
              //$numtodos = mysql_query("SELECT * FROM propietariosgmaec,mpreclamantes WHERE (id_ObraR='".$_GET['id']."') AND (id_D=id_Propietario) order by apatP asc",$conec); 
              $numtodos = mysql_query("SELECT id_Propietario,apatP,amatP,nombreP,domicilioP,telP,correoP,infoExtra,foto,id_croqi,filecroqui,idObraC FROM propietariosgmaec,croquisvalidados WHERE (idObraC='".$_GET['id']."') AND (id_afec=id_Propietario)  group by id_afec order by apatP asc",$conec); 
              while( $pp = mysql_fetch_array($numtodos) )
              { ?>
                <tr>  
                  <td> <?php echo $pp['9'];?> 
                        <?php if (strlen ($pp['10'])> 1) {
                         ?> <a href="<?php echo $pp['10']?>" target="new"> <span class="icon-download"> </span> </a> <?php } ?> 
                   </td>                   
                  <td> <?php echo $pp['1'].' '.$pp['2'].' '.$pp['3'] ?> 
                        <?php if (strlen ($pp['8'])> 1) {
                         ?> <a href="<?php echo $pp['8']?>" target="new"> <span class="icon-download"> </span> </a> <?php } ?> 
                   </td>
                  <td> <?php echo $pp['4'] ?> </td>
                  <td> <?php echo $pp['5'] ?> </td> 
                  <td> <?php echo $pp['6'] ?> </td> 
                  <td> <?php echo $pp['7'] ?></td>  <!--Se debe cambiar para imprimir instalación-->                                 
                  <td> <button class="btn btn-info" type="button" OnClick="openWinEditAfec(<?php echo $pp['0'] ?>,<?php echo $pp['11'] ?>);"><small>Editar</small><span class="icon-pencil icon-white"></span></button></td>
                </td>                                   
                </tr>
            <?php } ?>
    </tbody>
</table>
</div>
    </body>
    </html>
<?php } ?>