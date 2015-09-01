<?php   
    if ($conexion = mysql_connect("localhost","root","123"))
    {
        $a= $_GET['id']; 
        mysql_select_db("rysobd",$conexion);        
        $consulta = "SELECT id_area from areas WHERE nombre='".$a."'";                
        $datos = mysql_query($consulta,$conexion);
        $pp = mysql_fetch_array($datos);
        echo $pp['id_area'];
       mysql_close();
    }
?>