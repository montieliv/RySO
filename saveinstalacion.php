<?php 
    $a =  strtoupper($_POST['a']);
    $b =  strtoupper($_POST['b']);
    $con = mysql_connect("localhost","root","123");
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
    mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!"); 
    $sql = "INSERT INTO mpinstalaciones (nombre,tipo) VALUES ('$a','$b')"; 
    mysql_query($sql,$con);
    mysql_close($con); 
?>
