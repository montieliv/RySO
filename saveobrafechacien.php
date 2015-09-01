<?php 	
    $fech= $_POST['a'];
      $id= $_POST['b'];    
    

    $con = mysql_connect("localhost","root","123");
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
  mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!"); 
  $sql = "UPDATE obrasgmaec SET "."croquisalcien='".$fech."' WHERE id_Obras = ".$id;        
  mysql_query($sql,$con);
  mysql_close($con); 
?>