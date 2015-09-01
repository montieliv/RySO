<?php 
        $con = mysql_connect("localhost","root","123");
       if (!$con)
        {
        die('Could not connect: ' . mysql_error());
        }
        $a = $_GET['idC'];     $b=$_GET['idObrO'];  

       mysql_select_db("rysobd",$con) or die ("Imposible conectar a la base de datos!!!!");               
       
       $sql = "SELECT activado from croquisvalidados where  id_croqi=".$a;       
       $consul=mysql_query($sql,$con);   $pp = mysql_fetch_array($consul);
       
       if ($pp['0'] == 'N') {
             $sql = "UPDATE croquisvalidados SET activado='Y' WHERE id_croqi=".$a;
             $consul=mysql_query($sql,$con);     

             $sql2 = "SELECT Count(*) from croquisobras where  id_Obras=".$b;                 
             $cons=mysql_query($sql2,$con);            $totc = mysql_fetch_array($cons); 
             if ($totc['0']==1) {                   

                   $sql3 = "UPDATE obrasgmaec SET croquisalcien='".Date('Y-m-d')."' WHERE id_Obras = ".$b;      
                   mysql_query($sql3,$con);
             }
             echo 'Activado';
          } 
          else 
             {
               $sql4 = "UPDATE croquisvalidados SET activado='N' WHERE id_croqi=".$a; 
               $consul=mysql_query($sql4,$con);    

                $sql5 = "UPDATE obrasgmaec SET croquisalcien='0000-00-00' WHERE id_Obras = ".$b;        
                mysql_query($sql5,$con);
                echo 'Sin Activar';
             }        
       mysql_close($con);
?>