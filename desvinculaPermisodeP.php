<?php 
        $con = mysql_connect("localhost","root","123");
       if (!$con)
        {
        die('Could not connect: ' . mysql_error());
        }
       mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!");        
       $a = $_POST['obradesof']; 	   
       $b = $_POST['obrades']; 
       $sql = "DELETE FROM mpreclamantes WHERE  (id_R=".$b.")";     
      mysql_query($sql,$con);
      mysql_close($con);
    echo "<html><html lang='es'><head><meta charset='utf-8'><meta http-equiv='REFRESH' content='0; url=gestor.php?permisosE=$a'></head><body>
    <script>   alert('Permiso Borrado Correctamente!' );</script></body></html>";
?>   
