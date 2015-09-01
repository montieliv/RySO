<?php   
    if ($conexion = mysql_connect("localhost","root","123"))
    {
        $a= $_GET['ofi']; 
        mysql_select_db("rysobd",$conexion);        
        $consulta = "SELECT linkDescarga from oficiossolicitud WHERE idOficio=".$a;                
        $datos = mysql_query($consulta,$conexion);
        $pp = mysql_fetch_array($datos);        
        echo $pp['linkDescarga'];
       mysql_close();
    }
?>