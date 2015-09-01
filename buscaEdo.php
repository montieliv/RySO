<?php   
    if ($conexion = mysql_connect("localhost","root","123"))
    {
        $a= $_GET['idM']; 
        mysql_select_db("rysobd",$conexion);        
        $consulta = "SELECT * from municipios WHERE id_Municipio=".$a;                
        $datos = mysql_query($consulta,$conexion);
        $pp = mysql_fetch_array($datos);        
        echo $pp['nombreMun'].", ". $pp['nomEstado'];
       mysql_close();
    }
?>