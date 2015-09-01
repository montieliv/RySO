<?php 
    $id=$_POST['idoficioedit'];
    $a = $_POST['numO'];
    $b = $_POST['fechaO'];
    $c = $_POST['remitente'];
    $d = $_POST['antecedente'];
    $e = $_POST['fechaAcuse'];
   // $e2 = $_POST['fechaAcuse2'];
    $to= $_POST['editipoof'];

    if ($_POST['descarga'] != "") { 
           $g= "files/oficiosExternos/".$_POST['descarga']; } 
          else {
               $g=  $_POST['aF'];
              } 
    
    $conex = mysql_connect("localhost","root","123");
    if (!$conex)
      {
      die('Could not connect: ' . mysql_error());
      }

   mysql_select_db("rysobd",$conex) or die ("Imposible conectar a la base de datos!!!!"); 
   
   $sqlof = "UPDATE oficiossolicitud SET numO='".$a."',fechaO='".$b."',remitente=".$c.",antecedente='".$d."',linkDescarga='".$g."',fechaAcuse='".$e."',tipoOficio='".$to."' WHERE idOficio = ".$id;
   mysql_query($sqlof,$conex);

   
    if (isset($_POST['obrasreg2']))
     {
      $obrax = $_POST['obrasreg2'];  
          $sqlof = "INSERT INTO oficiosobras (idOfref,idObraref) VALUES ('$id','$obrax')";
           mysql_query($sqlof,$conex);
     }
    mysql_close($conex); 
    echo "<html><html lang='es'><head><meta charset='utf-8'><meta http-equiv='REFRESH' content='0; url=jefeProyecto.php?captura=postedicion'></head><body><script>   alert('Oficio Actualizado Correctamente!' );</script></body></html>";
?>        