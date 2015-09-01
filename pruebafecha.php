<?php 
 $fecha="15/02/2015";
 $anio=substr($fecha, 0, 2);
 echo $anio."<BR>";
 $anio2=substr($fecha, 3, 2);
 echo $anio2."<BR>";
 $anio3=substr($fecha, 6, 4);
 echo $anio3."<BR>";
 echo "final=".$anio3."-".$anio2."-".$anio;
 ?>