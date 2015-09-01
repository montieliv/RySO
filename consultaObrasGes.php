<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Obras</title> <!-- Consulta del GEstor-->
    <script  src='js/tjquery/scripts/jquery-1.6.1.min.js'></script>
	<script src='js/tjquery/scripts/jquery.dataTables.min.js'></script>
	<script src='js/tjquery/scripts/jquery.dataTables.columnFilter.js'></script>
	<script src='js/tjquery/scripts/jquery.dataTables.pagination.js'></script>
	<script src='js/canvas.js'></script> 
  <script src='js/vistas.js'></script>
	<link  href='js/tjquery/css/demo_table_jui.css' rel='stylesheet'/>	
	<link  href='css/estilosJP.css' rel='stylesheet'/>	
	<style type="text/css">
		@import url("js/tjquery/css/custom/hot-sneaks/jquery.ui.all.css");
			#dataTable {padding: 0;margin:0;width:auto;}
			#dataTable_wrapper{width:100%;}
			#dataTable_wrapper th {cursor:pointer} 			
			#dataTable_wrapper tr:hover {color:#333333;  background-color:rgba(255,204,102,1);}			
			#dataTable_wrapper tr:hover td.sorting_1 {color:white; background-color:rgba(147,195,205,1);}			
		</style>
	</head>
<body>
<script>
 $(document).ready(function() {
	oTablegestor = $('#dataTableCoor').dataTable({
		"bJQueryUI": true, "bScrollCollapse": false, "sScrollY": "570px",
		"bAutoWidth": true, "bRetrieve":true, "bPaginate": true,
		"sPaginationType": "full_numbers", //full_numbers,two_button
		"bStateSave": true, "bInfo": true, "bFilter": true, "iDisplayLength": 30,
		"bLengthChange": true,
		"aLengthMenu": [[10, 30, 50, 100, -1], [10, 30, 50, 100, "All"]]
	});	
});
</script>
    <script>
  function openWinVerCroquis($x)
  {    
    window.open("verCroquisV.php?idov2="+$x,"_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=400, width=700, height=600");
  }
  
  var numObra=0;

  function asignaNumObra($obra){
    if ($obra.checked==false) {$obra.checked=false;} else {
        $('input[type=checkbox]').each( function() { this.checked = false;  });
        $obra.checked=true; }
    numObra=$obra.value;    
  }
</script>
<div id="obrasTodas">  	
				<table cellpadding="0px" cellspacing="0px" border="1px solid black" bordercolor="#EEEEEE" id="dataTableCoor">
					 <thead>
            <tr>
                <th align="center" width="7%">Status</th>
                <th align="center" width="7%">Tipo<br>Obra</th>         
                <th align="center" width="5%">Croquis</th>
                <th align="center" width="5%">Pre$.</th>
                <th align="center" width="21%">Obra</th>              
                <th align="center" width="10%">Oficios</th>                    
                <th align="center" width="10%">Req-Obt-Pend</th>
                <th align="center" width="21%">Observación</th> 
                <th align="center" width="4%">Alerta</th>
            </tr>
          </thead>
          <tbody>    
             <?php  
                  include('cap3/datefuncions.php');           
                  $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                  mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!");  
                  $numtodos = mysql_query("select * from obrasgmaec,croquisobras where (obrasgmaec.id_Obras=croquisobras.id_Obras) and (id_Gestor='".$_SESSION["idUsuario"]."') order by obrasgmaec.isPrioritaria desc, obrasgmaec.creada desc ",$conec); 
                    $ix=0;    
                  while( $pp = mysql_fetch_array($numtodos) )
                     { 
                             ?>  <tr>                     
                                  <td> <?php echo $pp['status'] ?> </td>
                                  <td> <?php echo $pp['tipoObra']; if ($pp['isPrioritaria']=="true"){ ?> <span class="icon-star-empty"></span>  <?php }?>
                                      <br><input id="obraselecGes" name="obraselecGes" type="Checkbox" style="width:2em; height:2em; margin-left:1em;" OnClick="asignaNumObra(this);" value="<?php echo $pp['id_Obras'];  ?> ">
                                  </td>
                                  <td><a href="#" class="btn btnvalidoC"  id="btnvalidoC" onClick="openWinVerCroquis(<?php echo $pp['0'] ?>);">Ver :&nbsp<?php echo $pp['21'] ?></a>
                                                     </td>
                                  <?php $obrpre=mysql_fetch_array(mysql_query("Select COUNT(id_presupuesto) From presupuestoobras Where id_ObraP=".$pp['id_Obras'],$conec));  ?>              
                                  <td align="center" <?php if ($obrpre['0'] != 0) { ?> style="background:green;"  <?php } else { ?> style="background:red;"  <?php } ?>><p id="<?php echo $pp['id_Obras']."txt"?>"> <?php if ($obrpre['0'] != 0) { echo "<b>$$$ OK</b>"; } else { echo "<b>$ :(</b>"; }?></p></td>
                                  <td> <?php echo $pp['descObra'] ?></td>
                                  <td style="font-size:.9em; mmarging:0; padding:0;"> <?php                                    
                                      $numI = mysql_query("select fechaO,numO,remitente,antecedente,linkDescarga,fechaAcuse,tipoOficio from 
                                      oficiossolicitud,oficiosobras where ((idOficio=idOfref) and (idObraref=".$pp['id_Obras'].")) order by fechaAcuse asc");
                                      $division=0;      
                                      while( $nI = mysql_fetch_array($numI)) {                                             
                                           if($division>0){echo "<hr id='dividef' style='margin:0; padding:0;'>";}
                                           //echo "#:".$nI[1]."<br>F.Elab.:".$nI[0]."<br>Área:";                                   
                                           echo "#:".$nI[1]."<br>";                                    
                                           $remi=mysql_fetch_array(mysql_query("SELECT nombre,titular FROM areas WHERE (id_area= ".$nI['2'].")",$conec)); echo $remi['0'] ?>
                                               <a href="<?php echo $nI[4] ?>"><span class="icon-download"></span></a>        
                                           <?php $division++; 
                                      } ?>      
                                      </td>
                                  <td align="center">
                                    <spam style="margin:0; padding:0; cursor:pointer;" id="<?php echo $pp['id_Obras'] ?>" OnClick="verPermisosTotales(this,<?php echo $pp['pObtenidos']+$pp['pPendientes']; ?>);"> <?php echo $pp['pObtenidos']+$pp['pPendientes']." = ";?></spam>
                                    <spam style="margin:0; padding:0; cursor:pointer;" id="<?php echo $pp['id_Obras'] ?>" OnClick="verPermisosObtenidos(this,<?php echo $pp['pObtenidos']; ?>);"><?php echo $pp['pObtenidos']; ?></spam>
                                    <spam style="margin:0; padding:0; cursor:pointer;" id="<?php echo $pp['id_Obras'] ?>" OnClick="verPermisosPendientes(this,<?php echo $pp['pPendientes']; ?>);"><?php if ($pp['pPendientes']>0) {echo " - <b style='color:red;'>".$pp['pPendientes']."</b>"; } else {echo " - ".$pp['pPendientes']; }?></spam> </td>
                                  <td> <a href="#" class="btn btnObserSup" id="btnObsSup" onClick="AgregarObsSup();">+Observación</a> <br>                                      
                                        <?php  $obtenerobser = mysql_query("select Observacion,autorObser from observacionesobras where idObraaObser=".$pp['id_Obras']);
                                        while( $nI4 = mysql_fetch_array($obtenerobser) ){ 
                                          if ($nI4[0] != NULL)  {
                                            echo "(".$nI4[0].","; ?> <br> <?php
                                            echo $nI4[1].")"; ?> <br> <?php 
                                            }                                                                 
                                        }
                                        ?>
                                   </td>
                                   <td align="center">                                       
                                      <?php                                
                                      if (($pp['croquisalcien'] != '0000-00-00') and ($pp['croquisalcien'] != NULL))
                                      {                                  
                                          if ($pp['tipoObra']=="Nueva") {$cantdias=90;} else {$cantdias=30;}
                                              echo "<em style='font-size:.8em;'>Croq:".$pp['croquisalcien']."</em>";   ?><br><?php
                                              $fechafin=calculafecha($pp['croquisalcien'],$cantdias);
                                              $habiles=calculafechahabil(date('Y-m-d'),$fechafin['9']);                                                      
                                              echo  "<em style='font-size:.8em;'>Tér:".$fechafin['9']."</em>";   ?><br><?php                                                                                                  
                                               $ix++; ?>
                                                  <button id="rojo<?php echo $ix?>"> 
                                                       <?php echo "<b>".$habiles."</b>"; if ($habiles >= 0){ echo" Días Restantes"; } else {echo " Días Vencido";}?>
                                                  </button> 
                                              <?php
                                                    $porcentaje=round(($habiles*100)/$cantdias);  
                                                    if ($porcentaje  <= 19) 
                                                    { 
                                                           if ($porcentaje >= 0) 
                                                            { ?> <script> activarR(<?php echo $ix ?>);</script>  <?php   } 
                                                            else { ?>
                                                                        <script> activarB(<?php echo $ix ?>);</script>                          
                                                          <?php  }
                                                     } elseif (($porcentaje  >= 20) and ($porcentaje <=59) )
                                                            { ?> <script> activarA(<?php echo $ix ?>);</script>    <?php }
                                                             else { ?>
                                                                    <script> activarV(<?php echo $ix ?>);</script> 
                                                            <?php  }                                          
                                      } else {     ?>        
                                              <div class="alert alert-warning" role="alert" style="margin:0; padding:0;">
                                                  <span class="sr-only">Sin Fecha Incial</span>                                              
                                              </div>
                                        <?php } ?>                          
                                    </td>                                
                        </tr>
                        <?php } ?>

          </tbody>
        </table>
</div>
</body>
</html>