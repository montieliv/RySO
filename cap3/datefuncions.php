<?php
function calculafechahabil($fechaI,$j) {   
          $fecha1 = strtotime($fechaI); 
          $fecha2 = strtotime($j);        
          if ($fecha1>$fecha2) { 
              $sum=0;         
              $fecha2 = strtotime($fechaI);           $fecha1 = strtotime($j); 
              for($fecha1;$fecha1<=$fecha2;$fecha1=strtotime('+1 day ' . date('Y-m-d',$fecha1))){ 
                        if((strcmp(date('D',$fecha1),'Sun')!=0) and (strcmp(date('D',$fecha1),'Sat')!=0)){
                            $sum--;
                        }
                    } 
             return ++$sum; break;
          }

          if ($fecha1==$fecha2) { return 0; break; } 
          else {
                    $sum=0;
                      for($fecha1;$fecha1<=$fecha2;$fecha1=strtotime('+1 day ' . date('Y-m-d',$fecha1))){ 
                        if((strcmp(date('D',$fecha1),'Sun')!=0) and (strcmp(date('D',$fecha1),'Sat')!=0)){
                            $sum++;
                        }
                    } 
                    return $sum; break;
                }
}
    
function calculafecha($fecha,$dias) {    
        $datestart= strtotime($fecha);               //1,439,848,800   fecha incial 
        $diasemana = date('N',$datestart);           //2  # DEL DÍA INICIAL DE LA SEM 2=MARTES
        $totaldias = $diasemana+$dias;               //12  SUMA  A DIA INICIAL +CANT DIAS
        $findesemana = intval($totaldias/5) *2 ;     //4   FINES DE SEM (SAB+DOM=2)
        $diasabado = $totaldias % 5 ;                //2  CALCULA CUANTOS SAB  
        if ($diasabado==6){ $findesemana++;}
        if ($diasabado==0){ $findesemana=$findesemana-2;}
        $total = (($dias+$findesemana) * 86400)+$datestart ; // CALCULA "CANT-DIAS"+"FINES DE SEM"+"FECHA INICIAL
        $rfechaf['9']= date('Y-m-d', $total);          //2015-08-18           
    return $rfechaf;      
}   
?>

