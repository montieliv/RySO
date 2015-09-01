<?php 
        $con = mysql_connect("localhost","root","123");
       if (!$con)
        {
        die('Could not connect: ' . mysql_error());
        }
       mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!");        
       $a = $_GET['idP']; 	   
       $sql = "SELECT id_presupuesto from presupuestoobras where  id_ObraP=".$a;       
       $consul=mysql_query($sql,$con);
       $pp = mysql_fetch_array($consul);
       if ($pp > 0) {
             $sql = "DELETE FROM presupuestoobras WHERE  id_ObraP=".$a;
             $consul=mysql_query($sql,$con);
             $pp = mysql_fetch_array($consul);
            echo 'Sin Activar';} 
          else 
             {
               $sql = "INSERT INTO presupuestoobras (id_ObraP) VALUES ('$a')"; 
               $consul=mysql_query($sql,$con);
               $pp = mysql_fetch_array($consul);
               echo 'Activado';}
       mysql_close($con);
?>