<?php 
include_once("conexion.class.php");

class Cliente{
 //constructor	
 	var $con;
 	function Cliente(){
 		$this->con=new DBManager;
 	}

	function mostrar_ObrasCoor(){
		if($this->con->conectar()==true){
			return "mysql_query("SELECT * FROM obrasgmaec")";
		}
	}
		
/*	function insertarMP($campos){
		if($this->con->conectar()==true){
			return mysql_query("INSERT INTO medidaspreventivas (numDictamen,numOficio,fecha_D,fecha_O,elaborado,fechaInspeccion,datosAdicionales,fileDictamen) 
				VALUES ('".$campos[0]."', '".$campos[1]."','".$campos[2]."','".$campos[3]."','".$campos[4]."','".$campos[5]."','".$campos[6]."','".$campos[7]."')");
		} 
	}

	function insertarCR($campos){	
		if($this->con->conectar()==true){
			return mysql_query("INSERT INTO mpreclacultivo (id_reclamante,nombre,supAcreditada,porcentajeAfec,ml,pU,montoErogado,fechmonto2,montoErogado2,cicloR) VALUES ('".$campos[0]."', '".$campos[1]."','".$campos[2]."','".$campos[3]."','".$campos[4]."','".$campos[5]."', '".$campos[6]."','".$campos[7]."','".$campos[8]."','".$campos[9]."')");
		} 		 
	}//	

	function insertarMPI($campos){	
		if($this->con->conectar()==true){
			return mysql_query("INSERT INTO mpinstalaciones (numDictamenI,nombre,concepto,lat,longi) VALUES ('".$campos[0]."', '".$campos[1]."','".$campos[2]."','".$campos[3]."','".$campos[4]."')");
		} 		 
	}//

	function insertarMPR($campos){	
		if($this->con->conectar()==true){
			return mysql_query("INSERT INTO mpreclamantes (id_D,reclamante,id_instalacion,estatus,veredicto,fexp,exp,parcela,tipoRecla,ciclo,comunidad,municipio) VALUES ('".$campos[0]."','".$campos[1]."','".$campos[2]."','". $campos[3]."','".$campos[4]."','".$campos[5]."', '".$campos[6]."','".$campos[7]."','".$campos[8]."','".$campos[9]."','".$campos[10]."','".$campos[11]."')");
		} 		 
	}//

	function insertar($campos){
		if($this->con->conectar()==true){	
			return mysql_query("INSERT INTO bsao2014 (Prioritaria, num_ObraS, proyecto, desc_Obra, nom_Gestor,permisos_Req,permisos_Obt,permisos_Pend,obser_Actual) VALUES ('".$campos[0]."', '".$campos[1]."','".$campos[2]."','".$campos[3]."','".$campos[4]."','".$campos[5]."','".$campos[6]."','".$campos[7]."','".$campos[8]."')");
		}
	}
	
	function insertarOficio($campos){
	if($this->con->conectar()==true){
            return mysql_query("INSERT INTO oficios (fecha,numO,destinatarios,numA,numE,fechaA,asunto,anexo,cuerpo,nAfect,aAfect2,dAfect2,alAfect3,sAfect4,cAfect,pAfect,nfirma,pfirma,cc,elaboro,tipo,src,lugarO) VALUES 
            	 ('".$campos[0]."','".$campos[1]."','".$campos[2]."','".$campos[3]."','".$campos[4]."','".$campos[5]."','".$campos[6]."','".$campos[7]."','".$campos[8]."','".$campos[9]."','".$campos[10]."','".$campos[11]."','".$campos[12]."','".$campos[13]."','".$campos[14]."','".$campos[15]."','".$campos[16]."','".$campos[17]."','".$campos[18]."','".$campos[19]."','".$campos[20]."','".$campos[21]."','".$campos[22]."')");
		}
	}
	function insertarp($campos){
		if($this->con->conectar()==true){
			return mysql_query("INSERT INTO propietarios (esquema, nombre, del_Km, al_Km, area_Afecmts, sup_Afectmts, comunidad, municipio, estado, gestor, permiso_Obt, ver_Oficio, oficio_Num, fech_Oficio, fech_Permiso, id_obra) VALUES ('".$campos[0]."', '".$campos[1]."','".$campos[2]."','".$campos[3]."','".$campos[4]."','".$campos[5]."','".$campos[6]."','".$campos[7]."','".$campos[8]."','".$campos[9]."','".$campos[10]."','".$campos[11]."','".$campos[12]."','".$campos[13]."','".$campos[14]."','".$campos[15]."')");
		}
	}

	function actualizaMPR($campos,$id)
	{
		if($this->con->conectar()==true){
			return mysql_query("UPDATE mpreclamantes SET id_D= '".$campos[0]."', reclamante= '".$campos[1]."',id_instalacion= '".$campos[2]."', estatus = '".$campos[3]."', veredicto = '".$campos[4]."', fexp = '".$campos[5]."', exp = '".$campos[6]."', parcela = '".$campos[7]."', tipoRecla = '".$campos[8]."', ciclo = '".$campos[9]."', comunidad = '".$campos[10]."', municipio = '".$campos[11]."' WHERE id_R = ".$id);
		}		
	}	

	function actualizaMCultivo($campos,$id)
	{
		if($this->con->conectar()==true){
			return mysql_query("UPDATE mpreclacultivo SET nombre= '".$campos[0]."', supAcreditada= '".$campos[1]."',porcentajeAfec= '".$campos[2]."', ml = '".$campos[3]."', pU = '".$campos[4]."', montoErogado = '".$campos[5]."', fechmonto2 = '".$campos[6]."', montoErogado2 = '".$campos[7]."', cicloR = '".$campos[8]."' WHERE id_Cultivo = ".$id);
		}		
	}	

	function actualizaMP($campos,$id)
	{
		if($this->con->conectar()==true){
			return mysql_query("UPDATE medidaspreventivas SET numOficio= '".$campos[0]."', fecha_D= '".$campos[1]."', fecha_O = '".$campos[2]."',  elaborado = '".$campos[3]."', fechaInspeccion = '".$campos[4]."',  datosAdicionales = '".$campos[5]."',  fileDictamen = '".$campos[6]."' WHERE id_dict = ".$id);
		}		
	}

	function actualizaMPI($campos,$id)
	{
		if($this->con->conectar()==true){
			return mysql_query("UPDATE mpinstalaciones SET nombre= '".$campos[0]."', concepto= '".$campos[1]."', lat = '".$campos[2]."', longi = '".$campos[3]."' WHERE id_insta	 = ".$id);
		}		
	}
		

	function modificarOficio($campos,$id){
	if($this->con->conectar()==true){
		return mysql_query("UPDATE oficios SET fecha= '".$campos[0]."', numO= '".$campos[1]."', destinatarios = '".$campos[2]."', numA = '".$campos[3]."', numE = '".$campos[4]."', fechaA = '".$campos[5]."', asunto = '".$campos[6]."', anexo = '".$campos[7]."', cuerpo = '".$campos[8]."', nAfect = '".$campos[9]."', aAfect2 = '".$campos[10]."', dAfect2 = '".$campos[11]."', alAfect3 = '".$campos[12]."', sAfect4 = '".$campos[13]."', cAfect = '".$campos[14]."', pAfect = '".$campos[15]."', nfirma = '".$campos[16]."', pfirma = '".$campos[17]."', cc = '".$campos[18]."', elaboro = '".$campos[19]."', src = '".$campos[20]."', lugarO = '".$campos[21]."' WHERE id_Oficio = ".$id);
		}
	}	
	
	function mostrar_Oficios(){
		if($this->con->conectar()==true){
			return mysql_query("SELECT * FROM oficios order by fecha desc");
		}
	}
	
	
	function actualizar($campos,$id){
		if($this->con->conectar()==true){
			return mysql_query("UPDATE bsao2014 SET Prioritaria = '".$campos[0]."', proyecto = '".$campos[1]."', desc_Obra = '".$campos[2]."', nom_Gestor = '".$campos[3]."', permisos_Req = '".$campos[4]."', permisos_Obt = '".$campos[5]."', permisos_Pend = '".$campos[6]."', obser_Actual = '".$campos[7]."' WHERE id_Obra = ".$id);
		}
	}
	
	function actualizarpro($campos,$id){
		if($this->con->conectar()==true){
			return mysql_query("UPDATE propietarios SET esquema = '".$campos[0]."', nombre = '".$campos[1]."', del_Km = '".$campos[2]."', al_Km = '".$campos[3]."', area_Afecmts = '".$campos[4]."', sup_Afectmts = '".$campos[5]."', comunidad = '".$campos[6]."', municipio = '".$campos[7]."', estado = '".$campos[8]."', gestor = '".$campos[9]."', permiso_Obt = '".$campos[10]."', ver_Oficio = '".$campos[11]."', oficio_Num = '".$campos[12]."', fech_Oficio = '".$campos[13]."', fech_Permiso = '".$campos[14]."' WHERE id_Propietario = ".$id);
		}
	}	
		
	function mostrar_cliente($id){
		if($this->con->conectar()==true){
			return mysql_query("SELECT * FROM bsao2014 WHERE id_Obra=".$id);
		}
	}

	function mostrar_clientes(){
		if($this->con->conectar()==true){
			return mysql_query("SELECT * FROM bsao2014 ORDER BY proyecto,Prioritaria DESC");
		}
	}
	
	function mostrar_ObrasM(){
		if($this->con->conectar()==true){
			return mysql_query("SELECT * FROM bsao2014 WHERE status = 1 ORDER BY proyecto,Prioritaria DESC");
		}
	}
	
	function mostrar_ObrasD(){
		if($this->con->conectar()==true){
			return mysql_query("SELECT * FROM bsao2014 WHERE status = 4 ORDER BY proyecto,Prioritaria DESC");
		}
	}
		
	function mostrar_ObrasNu(){
		if($this->con->conectar()==true){
			return mysql_query("SELECT * FROM bsao2014 WHERE status = 2 ORDER BY proyecto,Prioritaria DESC");
		}
	}

	function mostrar_ObrasC(){
		if($this->con->conectar()==true){
			return mysql_query("SELECT * FROM bsao2014 WHERE status = 3 ORDER BY proyecto,Prioritaria DESC");
		}
	}

	function mostrar_ObrasCa(){
		if($this->con->conectar()==true){
			return mysql_query("SELECT * FROM bsao2014 WHERE municipio != 'COMALCALCO' ORDER BY proyecto,Prioritaria DESC");
		}
	}		

	function mostrar_ObrasCo(){
		if($this->con->conectar()==true){
			return mysql_query("SELECT * FROM bsao2014 WHERE municipio = 'COMALCALCO' ORDER BY proyecto,Prioritaria DESC");
		}
	}	
	function mostrar_prioritarias(){
		if($this->con->conectar()==true){
			return mysql_query("SELECT * FROM bsao2014 WHERE Prioritaria = 1 ORDER BY proyecto ASC");
		}
	}
	
	function mostrar_Propietarios($id){
		if($this->con->conectar()==true){
			return mysql_query("SELECT * FROM propietarios WHERE id_obra = ".$id." and permiso_Obt = 1 ORDER BY del_Km");
		}
	}
	
	function mostrar_PropietariosP($id){
		if($this->con->conectar()==true){
			return mysql_query("SELECT * FROM propietarios WHERE id_obra = ".$id." and permiso_Obt = 0 ORDER BY del_Km");
		}
	}
	
	function mostrar_PropietariosT($id){
		if($this->con->conectar()==true){
			return mysql_query("SELECT * FROM propietarios WHERE id_obra = ".$id." ORDER BY del_Km");
		}
	}
	
	function mostrar_ObrasT($id){
		   if($this->con->conectar()==true){
    			if (strtoupper($id) != "*"){		
	        		return mysql_query("SELECT * FROM bsao2014 WHERE (num_ObraS LIKE '%".$id."%') or
			                          (proyecto LIKE '%".$id."%') or (desc_Obra LIKE '%".$id."%') or 
									  (nom_Gestor LIKE '%".$id."%') or (fecha_Solicitud LIKE '%".$id."%')");
				    }
                     else {
			              return mysql_query("SELECT * FROM bsao2014 WHERE Prioritaria = 1 ORDER BY proyecto ASC");
						 }
		   }
	}	
	
	function mostrar_PropietariosI($id){
		if($this->con->conectar()==true){
			return mysql_query("SELECT * FROM propietarios WHERE id_Propietario = ".$id);
		}
	}
	
		function mostrar_Pozos(){
		if($this->con->conectar()==true){
			return mysql_query("select * from map_pozos where ((longitud != '') && (latitud != ''))");
		}
	}
		
	function eliminar($id){
		if($this->con->conectar()==true){
			return mysql_query("UPDATE bsao2014 SET permisos_Pend = 444 WHERE id_Obra=".$id);
		}
	}
	
	function test_input($data)
	{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
	}
	
}*/

?>
