<?php

function formateaFecha($fecha) {

		//Reemplazamos la barras por guiones para normalizar la fecha
		$fecha = str_replace('/','-',$fecha);
		$fecha = str_replace('.','-',$fecha);
		$fecha = str_replace(':','-',$fecha);
		
		$posAnio = -1;
		
		//Nos aseguramos que posea 3 elementos
		$arrFecha = explode('-',$fecha,3);
		
		if(sizeof($arrFecha) == 3) {
			//Buscamos el anio para encontrar el resto de los elementos
			$i=0;
			while($i<sizeof($arrFecha)) {
				if(strlen($arrFecha[$i]) == 4) {
					$posAnio = $i;
					break;
				}
				$i++;
			}
		
		} else {
			return 'error';
		}
		
		if($posAnio < 0 ) {
			return 'error';
		}
	
		if($posAnio == 0) { $posDia = 2; $posMes = 1; }
		if($posAnio == 2) { $posDia = 0; $posMes = 1; }
		
		$rfecha['dia'] = $arrFecha[$posDia];
		$rfecha['mes'] = $arrFecha[$posMes];
		$rfecha['anio'] = $arrFecha[$posAnio];
		
		return $rfecha;
	}

function calculafechahabil($fechaI,$j) {	
		$i=0; $acumula=0;   if ($j<0) {$j=$j*-1; $act=-1;} else {$act=1;}
       while( $i < $j) {
		$fechaInicio = formateaFecha($fechaI);
		if(date('w',strtotime($fechaInicio['anio'].'-'.$fechaInicio['mes'].'-'.$fechaInicio['dia'])) == 0 || 
		 	date('w',strtotime($fechaInicio['anio'].'-'.$fechaInicio['mes'].'-'.$fechaInicio['dia'])) == 6 ) {
		 	$acumula++;
		 }
		   $tsInicio = mktime(0,0,0,$fechaInicio['mes'],$fechaInicio['dia'],$fechaInicio['anio']);
           $tsInicio=$tsInicio+(60 * 60 * 24);
           $fechaI=date('Y-m-d',$tsInicio);
           $i++;
	   }
		
		return ($i-$acumula)*$act;
	
	}

function restarFechas($fechaInicio,$fechaFin=false,$res='dias') {
	
		$fechaInicio = formateaFecha($fechaInicio);
		if(!$fechaFin) {
			$fechaFin = date('Y-m-d');
		} else {
			$fechaFin = formateaFecha($fechaFin);
		}
		
		$tsFin = mktime(0,0,0,$fechaFin['mes'],$fechaFin['dia'],$fechaFin['anio']);
		$tsInicio = mktime(0,0,0,$fechaInicio['mes'],$fechaInicio['dia'],$fechaInicio['anio']);
				
		switch(strtolower($res)) {
		case 'dias':
			//El resultado esta en segundos, lo pasamos a minutos, horas y dias
			return round(($tsFin - $tsInicio) / (60 * 60 * 24));
			break;
		case 'horas':
			//El resultado esta en segundos, lo pasamos a minutos, horas y dias
			return round(($tsFin - $tsInicio) / (60 * 60));
			break;
		case 'minutos':
			//El resultado esta en segundos, lo pasamos a minutos, horas y dias
			return round(($tsFin - $tsInicio) / (60));
			break;
		case 'segundos':
			//El resultado esta en segundos, lo pasamos a minutos, horas y dias
			return round(($tsFin - $tsInicio));
			break;				
		}

	}

function calculafecha($fechaI,$j) {			
		$i=-1; if ($j==90){$j++;} $diasnaturales=0; $diashabiles=0;
       while( $i < $j) {	
	        $i++;	
	       	$fechaInicio = formateaFecha($fechaI);
			if(date('w',strtotime($fechaInicio['anio'].'-'.$fechaInicio['mes'].'-'.$fechaInicio['dia'])) == 0 || 
			 	date('w',strtotime($fechaInicio['anio'].'-'.$fechaInicio['mes'].'-'.$fechaInicio['dia'])) ==  6) {
				 	$i--;	 	$diashabiles++;
				 } 		   
			   $tsInicio = mktime(0,0,0,$fechaInicio['mes'],$fechaInicio['dia'],$fechaInicio['anio']);
	           $tsInicio=$tsInicio+(60 * 60 * 24);
	           $fechaI=date('Y-m-d',$tsInicio);
	           $diasnaturales++;
	   }

	   	   $fechaInicio = formateaFecha($fechaI);
	   	   $tsInicio = mktime(0,0,0,$fechaInicio['mes'],$fechaInicio['dia'],$fechaInicio['anio']);
           $tsInicio=$tsInicio-(60 * 60 * 24);
           $fechaI=date('Y-m-d',$tsInicio);

           $diashabiles=$diasnaturales-$diashabiles;
           $rfechaf['fechI'] = $fechaI;
		   $rfechaf['dn'] = $diasnaturales;
		   $rfechaf['dh'] = $diashabiles;
			
			return $rfechaf;	
	}
?>