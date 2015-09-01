<?php 
    $id=$_POST['idafecedit']; 
    $idO=$_POST['idobragesedit']; 
    $a =  $_POST['nomafec'];
    $b = $_POST['apatafec'];
    $c = $_POST['amatafec'];
    $d = $_POST['domafec'];
    $e = $_POST['telafec'];
    $f = $_POST['correoafec'];  
    $h = $_POST['extraafec']; 
   
    if ($_POST['fotoafec'] != "") { 
           $g= "images/fotos/".$_POST['fotoafec']; } 
          else {
               $g=  $_POST['aF2'];
              } 
    
    $conex = mysql_connect("localhost","root","123");
    if (!$conex)
      {
      die('Could not connect: ' . mysql_error());
      }

   mysql_select_db("rysobd",$conex) or die ("Imposible conectar a la base de datos!!!!"); 
   
      $sqlof = "UPDATE propietariosgmaec SET "."nombreP='".$a."',apatP='".$b."',amatP='".$c."',domicilioP='".$d."',telP='".$e."',foto='".$g."',correoP='".$f."',infoExtra='".$h."' WHERE id_Propietario = ".$id;

   mysql_query($sqlof,$conex);
  
    mysql_close($conex); 
    
    echo "<html><html lang='es'><head><meta charset='utf-8'><meta http-equiv='REFRESH' content='0; url=gestor.php?captura=$idO'></head><body><script>   alert('Afectado Actualizado Correctamente!' );</script></body></html>";
?>   
      