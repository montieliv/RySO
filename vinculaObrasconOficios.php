<?php 
  if (isset($_POST['submit']))
  {
      $con = mysql_connect("localhost","root","123");
       if (!$con)
        {
        die('Could not connect: ' . mysql_error());
        }
       mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!");        
       $a = $_POST['idOficioVFO'];
       $b = $_POST['idObraVOF'];       
       $sql = "INSERT INTO oficiosobras (idOfref, idObraref) VALUES ('$a','$b')";       
      mysql_query($sql,$con);
      mysql_close($con);
      ?><script>alert("Los datos se vincularon Correctamente!!!"); location.replace("vinculaObrasconOficios.php"); //window.close();
       </script><?php
  }
  else
  { 
    ?>    
<div id="fondoOficios">    
    <link  href='../css/mistablas.css' rel='stylesheet'/>  
     <?php $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!");
      mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
      $numObrassinvincular = mysql_query("SELECT id_Obras,descObra,tipoObra FROM obrasgmaec WHERE id_Obras NOT IN (select idObraref from oficiosobras) order by descObra asc",$conec);   ?> 
                         
<table width="auto" height="auto" border="1" align="center" style="color:white;">
  <tr><td colspan="3" align="center" style="background-color:black"><p style="color:white;"> VINCULA OBRAS CON OFICIOS </p>  
      </td>
  </tr>
  <tr>
     <td>Obras</td>
     <td>Oficios:</td>
     <td>Vincular:</td>
  </tr>
  <tr>
      <?php while( $oo = mysql_fetch_array($numObrassinvincular) )
          { ?>
          <form name="frmOficiosasObr01" id="frmOficiosasObr01" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
          <input type="hidden" name="idObraVOF" id="idObraVOF" value="<?php echo $oo['0']; ?>">
              <td align="left"><textarea cols="50" rows="2"><?php echo $oo['1']."\n".$oo ['2'] ?></textarea>                        
              </td>     
              <td align="left"><select id="idOficioVFO" name="idOficioVFO">
                                 <option value="NULL" style="max-width:90%; width:80%;">Seleccione un No. de Oficio</option> <?php
                                         $numtodos = mysql_query("SELECT idOficio,numO,fechaO,remitente FROM oficiossolicitud order by fechaO desc",$conec); 
                                         while( $pp = mysql_fetch_array($numtodos) )
                                          { ?>
                                              <option value="<?php  echo $pp ['0']; ?>"><?php  echo $pp ['1'].' - '.$pp ['2'].' - '.$pp ['3'] ?></option>
                                    <?php } ?>
                                </select>                  
              </td>  
              <td height="31" align="center" valign="middle"> 
            <input type="submit" name="submit" id="button" value="Guardar" />
          </form> 
              </td> 
  </tr>
     <?php } ?>      
     <tr>
         <td height="31" colspan="3" align="center" valign="middle"> 
         <button onclick="window.close();">Cerrar Ventana</button>   </td> 
    </tr>
</table>   
<?php } ?>