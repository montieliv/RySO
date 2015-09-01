<?php 
        $con = mysql_connect("localhost","root","123");
       if (!$con)
        {
        die('Could not connect: ' . mysql_error());
        }
       mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!");        
       $a = $_POST['obradesof']; 	   
       $b = $_POST['obrades']; 
       $sql = "DELETE FROM oficiosobras WHERE  (idOfref=".$a.") and  (idObraref=".$b.")";     
      mysql_query($sql,$con);
      mysql_close($con);
      ?><script>alert("Los datos se Desvincularon Correctamente!!!");       
          var url = "jefeProyecto.php?captura=postedicion";
          window.location.href = url; 
       </script>
?>       