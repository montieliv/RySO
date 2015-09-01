<?php 
        $con = mysql_connect("localhost","root","123");
       if (!$con)
        {
        die('Could not connect: ' . mysql_error());
        }
       mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!");        
     
       $a = $_GET['idG']; 	  

       $b = $_GET['idog']; 

       $sql = "UPDATE supervisionobras SET idGesa='".$a."' WHERE idObraa =".$b;
       $consul=mysql_query($sql,$con);      
       mysql_close($con);
?>