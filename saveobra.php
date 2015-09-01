<?php 	
    $id= $_POST['j'];    $a =  $_POST['a'];
    $c =  $_POST['c'];      
    $e = $_POST['e'];    $f =  $_POST['f'];
    $g =  $_POST['g'];   $h =  $_POST['h'];
    $i =  $_POST['i'];   $d=   $_POST['d'];

    $con = mysql_connect("localhost","root","123");
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
    mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!"); 
   $sql = "UPDATE obrasgmaec SET "."descObra='".$a."',tipoObra='".$c."',isPrioritaria='".$d."',status='".$e."',latitudO='".$f."',longitudO='".$g."',
   campo='".$h."',instalacion='".$i."' WHERE id_Obras = ".$id;        
   mysql_query($sql,$con);

   if (isset($_POST['k']))
     {
      $obrax = $_POST['k'];  
          $sqlof = "INSERT INTO oficiosobras (idOfref,idObraref) VALUES ('$obrax','$id')";
           mysql_query($sqlof,$con);
     }

 if (isset($_POST['l']))
     {
      $obray = $_POST['l'];  
          $sqlof = "UPDATE supervisionobras SET "."idsuperSuper='".$obray."' WHERE idObraa = ".$id;        
           mysql_query($sqlof,$con);
     }



   mysql_close($con); 
?>