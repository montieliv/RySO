<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <title>Asignar Gestor a las Obras con Croquis</title> <!-- Consulta del JP para asignar Gestor -->
    <script  src='js/tjquery/scripts/jquery-1.6.1.min.js'></script>
  <script src='js/tjquery/scripts/jquery.dataTables.min.js'></script>
  <script src='js/tjquery/scripts/jquery.dataTables.columnFilter.js'></script>
  <script src='js/tjquery/scripts/jquery.dataTables.pagination.js'></script>
  <script src='js/canvas.js'></script>
  <link  href='js/tjquery/css/demo_table_jui.css' rel='stylesheet'/>  
  <link  href='css/slideJP.css' rel='stylesheet'/>  
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
  oTableG = $('#tableGest').dataTable({
    "bJQueryUI": true, "bScrollCollapse": false, "sScrollY": "570px",
    "bAutoWidth": true, "bRetrieve":true, "bPaginate": true,
    "sPaginationType": "full_numbers", //full_numbers,two_button
    "bStateSave": true, "bInfo": true, "bFilter": true, "iDisplayLength": 30,
    "bLengthChange": true,
    "aLengthMenu": [[10, 30, 50, 100, -1], [10, 30, 50, 100, "All"]]
  }); 
});

 function geselec(id,obra){   
   var x = document.getElementById("gestorV").options[id.selectedIndex].text;
   var y = document.getElementById("ges"+obra);
   y.innerHTML=x;
   var z=id.value;   
    $.get("actualizagestor.php?idG="+z+"&idog="+obra);    
  
 }
</script>
<div id="obrasTodas">   
        <table cellpadding="0px" cellspacing="0px" border="1px solid black" bordercolor="#EEEEEE" id="tableGest">
          <thead>
            <tr>
                <th align="center" width="10%">Status</th>
                <th align="center" width="10%">Tipo Obra</th>         
                <th align="center" width="30%">Obra</th>                              
                <th align="center" width="15%">Gestor Asigndo</th>                                               
                <th align="center" width="15%">Asignar/Actualizar</th>                                               
          </tr>
          </thead>
          <tbody>    
             <?php  
                  $conec= mysql_connect("localhost","root","123") or die ("No se pudo establecer la conexion!!!!"); //Conexiones por default del servidor de wampp    
                  mysql_select_db("rysobd",$conec) or die ("Imposible conectar a la base de datos!!!!");  
                  $numtodos = mysql_query("SELECT * FROM croquisobras where id_J=".$_SESSION["idUsuario"],$conec); 
                  $ix=0;                        
                  while( $pp = mysql_fetch_array($numtodos) )
                     { 
                       //$identificaO=$pp['id_Obras'];  $identificato=$pp['tipoObra'];
                     //  $cv=mysql_fetch_array(mysql_query("Select COUNT(activado) as total From croquisvalidados Where (activado='Y') and (idObraC=".$pp['id_Obras'].")",$conec)); 
                       //$iscroq=mysql_fetch_array(mysql_query("Select COUNT(idObraC) as total From croquisvalidados Where (idObraC=".$pp['id_Obras'].")",$conec)); ?>                                          
                      <tr>                     
                        <td> <?php echo $pp['status']; ?> </td>
                        <td> <?php echo $pp['tipoObra']; if ($pp['isPrioritaria']=="true"){ ?> <span class="icon-star-empty"></span>  <?php }?></td>
                        <td> <?php echo $pp['descObra']; ?></td>                                  
                         <td align="center">
                            <p id="ges<?php echo $pp['id_Obras']; ?>" > <?php echo $pp['nomber']; ?>    
                        </td>    
                        <td>
                              <select id="gestorV" name="gestorV" onChange="geselec(this,<?php echo $pp['id_Obras']; ?>);">
                               <option value="NULL" style="max-width:90%; width:70%;">Seleccione un Gestor</option> 
                               <?php  $numtodosx = mysql_query("SELECT id_Gestor,nomber FROM gestores WHERE supervisor='".$pp['idsuperSuper']."' order by nomber asc",$conec); 
                                      while( $pxp = mysql_fetch_array($numtodosx) )
                                      { ?>
                                        <option value="<?php  echo $pxp['0']?>" <?php if ( $pxp['1'] == $gestorr) { ?> selected <?php } ?> ><?php  echo $pxp ['1'] ?></option>
                                <?php } ?>
                            </select>
                        </td>                                                                                                 
                        </tr>                         
              <?php   } ?>

          </tbody>
        </table>
</div>
</body>
</html>