<?php 
     $id=$_POST['obrasleccEdit']; 
     $idO=$_POST['obraEdit']; 
     $a=$_POST['afecregPEdit'];
     $b=$_POST['comuniPEdit'];
     $c=$_POST['regimenPEdit'];
     $d=$_POST['dkEdit'];
     $e=$_POST['akEdit'];
     $f=$_POST['longpEdit'];
     $g=$_POST['suppEdit'];
     $h=$_POST['supapEdit'];
     $i=$_POST['exppEdit'];
     $j=$_POST['tipopEdit'];
     $k=$_POST['montopEdit'];
     $l=$_POST['estatusPEdit']; 

    if (isset ($_POST['permisoEscaEdit'])) { 
      $m= "files/permisosP/".$_POST['permisoEscaEdit']; } 
      else {
        $m=$_POST['permisoEscaantEdit'];
        } 
   
    $conex = mysql_connect("localhost","root","123");
    if (!$conex)
      {
      die('Could not connect: ' . mysql_error());
      }

   mysql_select_db("rysobd",$conex) or die ("Imposible conectar a la base de datos!!!!"); 
   
      $sqlof = "UPDATE mpreclamantes SET "."id_D='".$a."',link_Com='".$b."',reg_Prop='".$c."',
      del_km='".$d."',al_km='".$e."',longi='".$f."',sup='".$g."',supAd='".$h."',numExp='".$i."',
      tipoPermiso='".$j."',monto='".$k."',estatusPermiso='".$l."',filePermiso='".$m."' WHERE id_R = ".$id;

   mysql_query($sqlof,$conex);
  
    mysql_close($conex); 
    
    echo "<html><html lang='es'><head><meta charset='utf-8'><meta http-equiv='REFRESH' content='0; url=gestor.php?permisosE=$idO'></head><body><script>   alert('Permiso Actualizado Correctamente!' );</script></body></html>";
?>   
      