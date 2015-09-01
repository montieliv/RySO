<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php 
	    require('cap3/clsDateUtils.php');
	     $a=new dateUtils;
	     echo "fecha inicial 2015-08-1   +  10 días hábiles=  	";
	     $fechafin=$a->calculafecha("2015-08-1",10);
	     echo $fechafin['fechI']."<br>";
	     echo $fechafin['dn']."<br>";
	     echo $fechafin['dh']."<br>";
	     //$dias=$a->restarFechas(date('Y-m-d'),$fechafin); 	    
	     //$habiles=$a->calculafechahabil(date('Y-m-d'),$dias+1);
	     //echo "días hábiles =".$habiles;
	 ?>	 
</body>
</html>