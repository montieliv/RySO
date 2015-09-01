function verPermisosObtenidos(obraaBuscar,cant){
  var $obra=obraaBuscar.id;
  var $tipo="Obtenidos";
  if (cant>0) {
  		window.open("muestraPermisosObt.php?id="+$obra+"&tip="+$tipo,"_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=200, width=1000, height=600");
	}
}

function verPermisosPendientes(obraaBuscar,cant){
  var $obra=obraaBuscar.id; 
  var $tip2="Pendientes";
   if (cant>0) {
  	window.open("muestraPermisosObt.php?id="+$obra+"&tip="+$tip2,"_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=200, width=1000, height=600");
  }
}

function verPermisosTotales(obraaBuscar,cant){
  var $obra=obraaBuscar.id; 
  var $tip2="Requeridos(Obt+Pend)";
   if (cant>0) {
      window.open("muestraPermisosObt.php?id="+$obra+"&tip="+$tip2,"_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=200, width=1000, height=600");
   }
}

function asignarFechaalCien(){	
	var x=document.getElementById("fechacien");

	var parametros = {
					"a" :x.value,
					"b" :x.name
	};
	$.ajax({
			data: parametros,
			url: 'saveobrafechacien.php',
			type: 'post',
			success: function (response) {		
			    alert("Se ha asignado Fecha de Recepción de Documentos al 100%");	
			  }
	});

}