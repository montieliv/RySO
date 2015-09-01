<?php 
        $con = mysql_connect("localhost","root","123");
       if (!$con)
        {
        die('Could not connect: ' . mysql_error());
        }
       mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!");        
       $a = $_POST['croqdes']; 	   $idOC=$_POST['croqOdes'];
       $sql = "DELETE FROM croquisvalidados WHERE  (id_croqi=".$a.")";     
      mysql_query($sql,$con);
      mysql_close($con);
      echo "<html><html lang='es'><head><meta charset='utf-8'><meta http-equiv='REFRESH' content='0; url=supervisor.php?idcroq=$idOC'></head><body><script>   alert('Croqui Desvinculado' );</script></body></html>";   
?>