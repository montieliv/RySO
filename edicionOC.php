
<?php 
if (isset($_POST['submit']))
  {
    $id=$_POST['obrx'];
    if ($_POST['descarga'] != "") { 
           $g= "files/oficiosExternos/".$_POST['descarga']; } 
          else {
               $g=NULL;
              } 

      $conex = mysql_connect("localhost","root","123");
      if (!$conex)
      {
        die('Could not connect: ' . mysql_error());
      }
      mysql_select_db("rysobd",$conex) or die ("Imposible conectar a la base de datos!!!!"); 
     
      $idAR=$_POST['idafecreg'];  
      if ($idAR=="")
      {
         $n=strtoupper($_POST['nomr']);
         $p=strtoupper($_POST['apatr']);
         $m=strtoupper($_POST['amatr']);
         $sqlof = "INSERT INTO propietariosgmaec (nombreP,apatP,amatP) VALUES ('$n','$p','$m')";
        if (mysql_query($sqlof,$conex)){ 
            $idAR = mysql_insert_id($conex); 
          }else{ 
            echo "La inserción no se realizó"; 
           }    
      }

    
    //CHECAR EL PROCESO. SE NECESITA SABER EL ÚLTIMO ID SI SE REGISTRA UN NUEVO AFECTADO O EL ID DEL QUE SE ELIJA
     
      $sqlof = "INSERT INTO croquisvalidados (idObraC,filecroqui,id_afec) VALUES ('$id','$g','$idAR')";

      mysql_query($sqlof,$conex);
      mysql_close($con); 
      echo "<html><html lang='es'><head><meta charset='utf-8'><meta http-equiv='REFRESH' content='0; url=supervisor.php?idcroq=$id'></head><body><script>   alert('Actulizando padrón' );</script></body></html>";
 }
 else {
?>    

<!DOCTYPE html>
   <html lang="en">
   <head>
     <meta charset="UTF-8">
     <title>Validación de Croquis</title>
     <script>
$('html,body').animate({scrollTop:0},300);
  	 
         function verCroquis(id){     
           $.get("activacroq.php?idC="+id.value+"&idObrO="+id.name,function(data){
             var txt2 = data;   
             var caj= document.getElementById(id.value);            
             caj.value=txt2;     
             if (data !='Activado') {  caj.style.background = "red";   } 
                 else { caj.style.background = "green";  }
           });               

        }
        function activa(id){
               //id de afectado registrado
              if (id.value=="OTRO") 
              {
                $("#nomr").removeAttr("disabled");
                $("#apatr").removeAttr("disabled");
                $("#amatr").removeAttr("disabled");
                $("#nomr").attr("value","");
                $("#apatr").attr("value","");
                $("#amatr").attr("value","");
                 document.getElementById("idafecreg").value="";
                $("#nomr").focus();
              }   
              else if (id.value=="NULL") {
                $("#nomr").attr("value","");
                $("#apatr").attr("value","");
                $("#amatr").attr("value","");
                $("#nomr").attr("disabled","disabled");
                 $("#apatr").attr("disabled","disabled");
                 $("#amatr").attr("disabled","disabled"); 
                 document.getElementById("idafecreg").value="";
              }     
              else 
              {
                 $("#nomr").attr("disabled","disabled");
                 $("#apatr").attr("disabled","disabled");
                 $("#amatr").attr("disabled","disabled"); 
                 var str1 = id.value;                                 
                 var res = str1.substr(0,str1.search(":"));                 
                 document.getElementById("idafecreg").value=res;

                 str1.toString();
                 res = str1.substr(str1.search(":")+1,str1.search(";")-2); //apellido paterno de afectado registrado
                 $("#nomr").attr("value",res);

                
                 res = str1.substr(str1.search(";")+1,(str1.search("-")-str1.search(";"))-1); //apellido materno de afectado registrado
                 $("#apatr").attr("value",res);

                
                 res = str1.substr(str1.search("-")+1,str1.length); //nombre de afectado registrado
                $("#amatr").attr("value",res);
              }
        }
        function MM_validateForm() { //v4.0
          if (document.getElementById){
            var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
            for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
              if (val) { nm=val.name; if ((val=val.value)!="") {
                if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
                  if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
                } else if (test!='R') { num = parseFloat(val);
                  if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
                  if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
                    min=test.substring(8,p); max=test.substring(p+1);
                    if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
              } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' esta vacío.\n'; }
            } if (errors) alert('Faltan datos que agregar:\n'+errors);
            document.MM_returnValue = (errors == '');
        } }
     </script>
   </head>
   <body>
   <form action="edicionOC.php" method="post"  name="frmvalidaobra" class="form" id="frmvalidaobra" onSubmit="MM_validateForm('nomr','','R','apatr','','R','amatr','','R','descarga','','R');return document.MM_returnValue">           
    <input type="hidden" name="obrx" id="obrx" value="<?php echo  $_GET['idov']?>">
<table class="table-striped" align="center" border="2">
   <tr>
    <?php     $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
              mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!"); 
              $n = mysql_query("SELECT id_Obras,nombre_Campo,tipoObra,descObra,croquisalcien FROM obrasgmaec,campos WHERE (id_Obras=".$_GET['idov']." ) and (campo=id_Campos) order by campo,tipoObra,descObra desc",$conec);  ?>
      <th>Obras Registradas</th>
        <td align="center">        
        <select id="obrasrela" name="obrasrela" style="width:100%" disabled>
              <option value="NULL">Seleccione una obra</option>
              <?php           
              while( $ppO = mysql_fetch_array($n) )
              { ?>
                  <option value="<?php echo $_GET['idov']?>" <?php if ($_GET['idov'] == $ppO ['id_Obras']) { ?>selected <?php }  ?> > <?php  echo $ppO ['nombre_Campo'].' - '.$ppO ['tipoObra'].' - '.$ppO ['descObra'] ?>                
                  </option>
                  <?php //$fechant=$ppO['croquisalcien']; ?>  
              <?php } ?>
        </select>     
      </td>
    </tr>
    <th>Subir Archivo:</th>
      <td><input class="btn-small" type="file" id="descarga" name="descarga">
     </td>    
    </tr>
    <th>Afectados Registrados:</th>
      <td><select name="efecreg" id="efecreg" onChange="activa(this);" style="width:25em;">
        <option value="NULL">Seleccione un Afectado de la lista</option>
        <?php 
             $relaafec=mysql_query("SELECT id_Propietario,nombreP,apatP,amatP FROM propietariosgmaec order by apatP asc",$conec);          
             while( $totrelaafec = mysql_fetch_array($relaafec) )
             {
         ?>
           <option value="<?php echo $totrelaafec['0'].":".$totrelaafec['apatP'].";".$totrelaafec['amatP']."-".$totrelaafec['nombreP'] ?>"><?php echo $totrelaafec['apatP']." ".$totrelaafec['amatP']." ".$totrelaafec['nombreP'];?></option>
        <?php }  ?>
            <option value="OTRO">AGREGAR OTRO</option>
      </select>
     </td>    
    </tr>
    <th>Nombre:</th>
      <td>
        <input type="hidden" name="idafecreg" id="idafecreg">
        <input class="btn-small" disabled="disabled" type="text" id="nomr" name="nomr" style=" text-transform:uppercase">
     </td>    
    </tr>
    <th>Apellido Paterno:</th>
      <td><input class="btn-small" disabled="disabled" type="text" id="apatr" name="apatr" style=" text-transform:uppercase">
     </td>    
    </tr>
    <th>Apellido Materno:</th>
      <td><input class="btn-small" disabled="disabled" type="text" id="amatr" name="amatr" style=" text-transform:uppercase">
     </td>    
    </tr>
    <tr>
      <td colspan="2" align="center">
         <input type="submit" name="submit" value="Guardar Modificaciones del Oficio" class="btn btn-primary" />
         <input type="reset" name="reset" value="Cerrar Ventana" class="btn btn-primary" OnClick="cierravalidaC();"/>
      </td>
    </tr>
   </table>
    </form>   
<hr style="margin:0; padding:0;">
<div class="text-center" style=" overflow:auto;  height:auto;   width:60%; margin-left:15%; margin-top:0; padding-top:0; vertical-align:middle;"> 
<table class="table" align="center">
 <thead>
  <tr><td colspan="2">
     <span class="label label-warning pull-left">
     <h4>Croquis Vinculados</h4></span>   
 </td>
 <td colspan="2" style="text-align:right;  vertical-align:middle; ">
  <!-- <span class="label label-inverse">Fecha de<br>Croquis al 100%</span></td>
 <td style="vertical-align:middle; background:#CC3300;">     
     <input type="date" id="fechacien" name="<?php echo $_GET['idov'] ?>" value="<?php echo $fechant; ?>" style="width:9em;"/>
     <input style="width:1.5em; height:1.5em; margin-left:.5em;" type="checkbox" OnClick="asignarFechaalCien();">
     <span class=" icon-download-alt">
        <span class="label label-important">Confirmar<br>Fecha</span>
    </span> -->     
 </td>
</tr>
    <tr style="background-color:#f89406; color:white; margin:0; padding:0;" >
      <th style="vertical-align:middle; text-align:center" width="1%">No.</th>
      <th style="vertical-align:middle; text-align:center" width="1%">Descargas</th>          
      <th style="vertical-align:middle; text-align:center" width="30%">Nombre</th>            
      <th style="vertical-align:middle; text-align:center" width="10%">Borrar</th>
      <th style="vertical-align:middle; text-align:center" width="30%">Activar<br>Croquis Marcados</th>
    </tr> 
  </thead>
  <tbody>    
     <?php 
           $indice=0;
           $ante=mysql_query("SELECT id_croqi,idObraC,filecroqui,apatP,amatP,nombreP,activado FROM croquisvalidados,propietariosgmaec WHERE ((idObraC=".$_GET['idov']." ) and (id_afec=id_Propietario)) order by activado ASC",$conec);          
           while( $croqv = mysql_fetch_array($ante) )
           { ?><tr style="margin:0; padding:0">                     
                  <td style="text-align:center; vertical-align:middle;"> <?php echo "<b>".++$indice."</b>.".$croqv['0']  ?> </td>
                  <td style="text-align:center; vertical-align:middle;">  <a id="linkC" name="linkC" href="<?php echo $croqv['2'] ?>"><span class="icon-download"></span></a></td>
                  <td><?php echo $croqv['3']."\t".$croqv['4']."\t".$croqv['5'] ?></td>
                  <td style="text-align:center; vertical-align:middle;"> <form action="desvinculaObCR.php" method="POST" style="margin:0;">
                        <input type="hidden" value="<?php echo $croqv['1']?>" id="croqOdes" name="croqOdes">
                         <input type="hidden" value="<?php echo $croqv['0']?>" id="croqdes" name="croqdes">
                         <input type="submit" name="submit" id="button" value="Desvincular §"  class="btn btn-small" style="margin:0"/></form>  </td> 
                  <td style="text-align:center; vertical-align:middle;"> 
                     <input type="checkbox" id="<?php echo $croqv['1']?>" name="<?php echo $croqv['1']?>" value="<?php echo $croqv['0']?>" OnClick="verCroquis(this);" style="vertical-align:13%;" <?php if ($croqv['6']=='Y') { ?> checked  <?php } ?>>
                     <input type="text" id="<?php echo $croqv['0']?>" value="<?php if ($croqv['6']=='Y') {echo 'Activado';} else {echo 'Sin Activar';} ?>" readonly  <?php if ($croqv['6']=='N') { ?> style="width:40%; background:red; color:white; font-weight:bold;" <?php } else { ?> style="width:40%; background:green; color:white; text-align:center;" <?php } ?> >
                  </td>                          
    <?php  } ?> 
  </tbody>
</table>
</div>                                                      
</body>
</html>
<?php } ?>