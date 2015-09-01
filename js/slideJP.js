function asignaObra()
{	
	var cambioCSS2=
	{
		display : "none"
    };
	$("#resumenObrasJP").css(cambioCSS2);	
	$("#capturaOficiosJP").css(cambioCSS2);	
	$("#capturaPresupuestosJP").css(cambioCSS2);	
	$("#asignaGestorJP").css(cambioCSS2);	
	$("#capturaPermisoJP").css(cambioCSS2);	
	$("#observacionesJP").css(cambioCSS2);		
	cambioCSS2=
	{
		display : "block"
    };
	$("#capturaObraJP").css(cambioCSS2);	
	$("#muestraobras").load("altaobras.php?id="); 
}

function asignaOficio()
{	
	var cambioCSS2=
	{
		display : "none"
    };
	$("#resumenObrasJP").css(cambioCSS2);	
	$("#capturaObraJP").css(cambioCSS2);	
	$("#capturaPresupuestosJP").css(cambioCSS2);	
	$("#asignaGestorJP").css(cambioCSS2);	
	$("#capturaPermisoJP").css(cambioCSS2);	
	$("#observacionesJP").css(cambioCSS2);	
	
	var cambioCSS2=
	{
		display : "block"
    };
	$("#capturaOficiosJP").css(cambioCSS2);	
	$("#muestraoficios").load("altaoficios.php"); 	
	//checar si no se debe hacer $("#muestraoficios").empty();
}


function asignaGestor()
{	
	var cambioCSS2=
	{
		display : "none"
    };
	$("#resumenObrasJP").css(cambioCSS2);	
	$("#capturaObraJP").css(cambioCSS2);	
	$("#capturaOficiosJP").css(cambioCSS2);	
	$("#capturaPresupuestosJP").css(cambioCSS2);	
	$("#capturaPermisoJP").css(cambioCSS2);	
	$("#observacionesJP").css(cambioCSS2);		
	var cambioCSS2=
	{
		display : "block"
    };
	$("#asignaGestorJP").css(cambioCSS2);
	$("#muestraobrasG").load("asignaGestor.php"); 		
}

function asignaPermiso()
{	
	var cambioCSS2=
	{
		display : "none"
    };
	$("#resumenObrasJP").css(cambioCSS2);	
	$("#capturaObraJP").css(cambioCSS2);	
	$("#capturaOficiosJP").css(cambioCSS2);	
	$("#asignaGestorJP").css(cambioCSS2);	
	$("#capturaPresupuestosJP").css(cambioCSS2);	
	$("#observacionesJP").css(cambioCSS2);		
	var cambioCSS2=
	{
		display : "block"
    };
	$("#capturaPermisoJP").css(cambioCSS2);	
}

function cierraEdicionOficio(){
	$("#edicionOficio").empty();
	var cambioCSS2=
	{
		visibility:"visible",		
	};
	$("#muestraoficios").css(cambioCSS2);	
	$("#muestraoficios").css("width","30%");
	$("#muestraoficios").animate({ width: '99%' }, 1000);
}

function cierraEdicionObra(){
	$("#edicionObras").empty();
			var cambioCSS2=
	{
		visibility:"visible"		
	};
	$("#muestraobras").css(cambioCSS2);	
	$("#muestraobras").css("width","30%");
	$("#muestraobras").animate({ width: '99%' }, 1000);	
}

function checa() {
    if( !confirm('Los datos son correctos!!') ) 
           { event.preventDefault(); }
}

function eligioOficio(){	
	$.get("buscaoficio.php?ofi="+document.getElementById("oficioobra").value,function(data){	
	var txt2 = data;
	 	$("#linkoficio").attr("href",txt2) 
	 });				
		

}

function eligioOficio2(){	
	$.get("buscaoficio.php?ofi="+document.getElementById("oficioobra2").value,function(data){					
		var txt2 = data; 
		if (txt2=="") { $("#linkoficio").attr("enable","false"); } 
			else {
				$("#linkoficio").attr("enable","true");
	 			$("#linkoficio").attr("href",txt2); 	 			
	 		     }
	 });
}

function fecha()
{

var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
var f=new Date();
document.write(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
}

function guardaOficio()
{
	

	if( !confirm('Los datos son correctos!!') ) 
            {event.preventDefault(); }
       else{
	var parametros2 = {
		"a1" : document.getElementById("idoficioedit").value,
		"b1" : document.getElementById("numO").value,
		"c1" : document.getElementById("fechaO").value,		 
		"d1" : document.getElementById("remitente").value,
		"e1" : document.getElementById("antecedente").value,				 
		"f1" : document.getElementById("fechaAcuse").value,				 
		"g1" : document.getElementById("linkDescarga").value,
		"h1" : document.getElementById("actualfile").value
	}; 
	$.ajax({
		data: parametros2,
		url: 'saveoficio.php',
		type: 'post',
		success: function (response) {
			alert("Los datos del oficio actualizaron correctamente!");					
		}
	}); 


//agregar al metodo saveoficio

   	if (document.getElementById("obrasreg").value != "NULL"){
			var parametros = {
			"a" : document.getElementById("idoficioedit").value,
			"b" : document.getElementById("obrasreg").value		 
			}; 
			$.ajax({
				data: parametros,
				url: 'saveoficiobras.php',
				type: 'post',
				success: function (response) {
					alert("Los datos del vinculo del oficio con la obra se actualizaron correctamente!");					
				}
			});
    }
    var url = "jefeProyecto.php?captura=postedicion";
	        window.location.href = url;	
}
}

function guardaObra()
{
	    if( !confirm('Los datos son correctos!!') ) 
            event.preventDefault(); 
       else{
				var parametros = {
					"a" : document.getElementById("descObra2").value,
					"c" : document.getElementById("tipoObra2").value,		 
					"d" : document.getElementById("obrapri2").checked,
					"e" : document.getElementById("estatusobra2").value,				 
					"f" : document.getElementById("latitudObra2").value,				 
					"g" : document.getElementById("longitudObra2").value,				 
					"h" : document.getElementById("campoObra2").value,				 
					"i" : document.getElementById("instalaObra2").value,
					"j" : document.getElementById("idobraedit2").value,
					"k" : document.getElementById("oficioobra").value,		
					"l" : document.getElementById("selecsupervisoredit").value	
				}; 
				$.ajax({
					data: parametros,
					url: 'saveobra.php',
					type: 'post',
					success: function (response) {		
					    alert("Los Datos de la Obra fueron Actualizados Exitosamente");	
						var url = "jefeProyecto.php?captura=postedicionobra";
				        window.location.href = url;	
					  }
				});
			}
}

function inicioJP()
{	
	var cambioCSS2=
	{
		display : "none"
	};
	$("#capturaObraJP").css(cambioCSS2);	
	$("#capturaOficiosJP").css(cambioCSS2);	
	$("#capturaPresupuestosJP").css(cambioCSS2);	
	$("#asignaGestorJP").css(cambioCSS2);	
	$("#capturaPermisoJP").css(cambioCSS2);	
	$("#observacionesJP").css(cambioCSS2);	
	var cambioCSS2=
	{
		display : "block"
    };
	$("#resumenObrasJP").css(cambioCSS2);	
}

function inicioJPs()
{	
	$("#consultaobras").empty();
	var cambioCSS2=
	{
		display : "none"
	};
	$("#capturaObraJP").css(cambioCSS2);	
	$("#capturaOficiosJP").css(cambioCSS2);	
	$("#capturaPresupuestosJP").css(cambioCSS2);	
	$("#asignaGestorJP").css(cambioCSS2);	
	$("#capturaPermisoJP").css(cambioCSS2);	
	$("#observacionesJP").css(cambioCSS2);	
	var cambioCSS2=
	{
		display : "block"
    };
	$("#resumenObrasJP").css(cambioCSS2);	
	
	$("#consultaobras").load("consultaObrasgral.php");
}

function observaciones()
{	
	var cambioCSS2=
	{
		display : "none"
    };
	$("#resumenObrasJP").css(cambioCSS2);	
	$("#capturaObraJP").css(cambioCSS2);	
	$("#capturaOficiosJP").css(cambioCSS2);	
	$("#capturaPresupuestosJP").css(cambioCSS2);	
	$("#asignaGestorJP").css(cambioCSS2);	
	$("#capturaPermisoJP").css(cambioCSS2);	
	var cambioCSS2=
	{
		display : "block"
    };
	$("#observacionesJP").css(cambioCSS2);	
}

function openWinEditOfic($ofic)
{
	var cambioCSS2=
	{
		visibility:"hidden"		
	};
	$("#muestraoficios").css(cambioCSS2);	

	$("#edicionOficio").empty();
	$("#edicionOficio").css("width","30%");
	$.get("editarOficios.php?id="+$ofic,function(data){
		var txt2 = data;
	 	 $("#edicionOficio").append(txt2); 
	 	 $("#edicionOficio").animate({ width: '99%' }, 1000);
	 });		

} 

function openWinEditObra($ofic)
{
	var cambioCSS2=
	{
		visibility:"hidden",		
	};
	$("#muestraobras").css(cambioCSS2);	

	$("#edicionObras").empty();
	$("#edicionObras").css("height","50%");	
	$.get("editarObras.php?id="+$ofic,function(data){
		var txt2 = data;
	 	 $("#edicionObras").append(txt2);  
	 	 $("#edicionObras").animate({ width: '99%' }, 1000);
	 	  });		
} 
