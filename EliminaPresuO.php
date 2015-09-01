<?php 
    $id=$_POST['a'];  
    $conex = mysql_connect("localhost","root","123");
    if (!$conex)
      {
      die('Could not connect: ' . mysql_error());
      }

   mysql_select_db("rysobd",$conex) or die ("Imposible conectar a la base de datos!!!!");    
   $sqlP = "DELETE FROM presupuestosvalidados WHERE  (id_ObraP=".$id.")";        
   mysql_query($sqlP,$conex);
   mysql_close($conex);    
 ?>