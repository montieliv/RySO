function verObrasGes()
{	
    $("#obrasGes").empty();

	var cambioCSS2=
	{
		display : "none"
	};
	$("#capturaAfec").css(cambioCSS2);	
	$("#capturaPermisos").css(cambioCSS2);	
	
	var cambioCSS2=
	{
		display : "block"
    };
	$("#resumenObrasGes").css(cambioCSS2);	
	
	$("#obrasGes").load("consultaObrasGes.php");	
}

function verObrasGes2($idO)
{	
    $("#obrasGes").empty();
    $("#capturaAfec").empty();
    $("#capturaPermisos").empty();
 	$("#muestraAfecs").empty();		
	cambioCSS2=
	{
		display : "block"
    };
	$("#capturaAfec").css(cambioCSS2);	


	$.get("altaAfectados.php?id="+$idO,function(data){
	   var cambioCSS2=
		{
			display : "none"
    	};
		$("#resumenObrasGes").css(cambioCSS2);	
		$("#capturaPermisos").css(cambioCSS2);		
		var txt2 = data;
	 	 $("#muestraAfecs").append(txt2); 
	 	 $("#muestraAfecs").animate({ width: '99%' }, 1000);
	 });
}


function agregaAfectado()
{		
	//alert(numObra);
	if (numObra != 0){
	 $("#muestraAfecs").empty();
	var cambioCSS2=
	{
		display : "none"
    };
	$("#resumenObrasGes").css(cambioCSS2);
	$("#capturaPermisos").css(cambioCSS2);		
		
	cambioCSS2=
	{
		display : "block"
    };
	$("#capturaAfec").css(cambioCSS2);	
//4	$("#muestraAfecs").load("altaAfectados.php");

	$.get("altaAfectados.php?id="+numObra,function(data){
		var txt2 = data;
	 	 $("#muestraAfecs").append(txt2); 
	 	 $("#muestraAfecs").animate({ width: '99%' }, 1000);
	 });
	}else
	{ alert("Debe elegir una obra");}
}

function agregaPermisodePaso()
{		
	//alert(numObra);
	if (numObra != 0){
	   $("#muestraPermis").empty();
		var cambioCSS2=
		{
			display : "none"
	    };
		$("#resumenObrasGes").css(cambioCSS2);	
		$("#capturaAfec").css(cambioCSS2);	
			
		cambioCSS2=
		{
			display : "block"
	    };
		$("#capturaPermisos").css(cambioCSS2);	
	

		$.get("altaPermisos.php?id="+numObra,function(data){
			var txt2 = data;
		 	 $("#muestraPermis").append(txt2); 
		 	 $("#muestraPermis").animate({ width: '99%' }, 1000);
		 });
	}else
	{ alert("Debe elegir una obra");}
}

function agregaPermisodePaso2($numObrax)
{		
		$("#muestraPermis").empty();
		$("#resumenObrasGes").empty();
        $("#capturaAfec").empty();
		
		$.get("altaPermisos.php?id="+$numObrax,function(data){
			var cambioCSS2=
		{
			display : "block"
	    };
		$("#capturaPermisos").css(cambioCSS2);

		var cambioCSS2=
		{
			display : "none"
	    };
		$("#resumenObrasGes").css(cambioCSS2);	
		$("#capturaAfec").css(cambioCSS2);	
			var txt2 = data;
		 	 $("#muestraPermis").append(txt2); 
		 	 $("#muestraPermis").animate({ width: '99%' }, 1000);
		 });
}

function fecha()
{

var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
var f=new Date();
document.write(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
}

function openWinEditAfec($ofic,$obraf)
{
	var cambioCSS2=
	{
		visibility:"hidden"		
	};
	$("#muestraAfecs").css(cambioCSS2);	

	$("#edicionAfec").empty();
	$("#edicionAfec").css("width","30%");
	$.get("editarAfect.php?id="+$ofic+"&obr="+$obraf,function(data){
		var txt2 = data;
	 	 $("#edicionAfec").append(txt2); 
	 	 $("#edicionAfec").animate({ width: '99%' }, 1000);
	 });		
}

function openWinEditPermi($pId)
{
	var cambioCSS2=
	{
		visibility:"hidden"		
	};
	$("#muestraPermis").css(cambioCSS2);	

	$("#edicionPerm").empty();
	$("#edicionPerm").css("width","30%");
	$.get("editarPermisos.php?permId="+$pId,function(data){
		var txt2 = data;
	 	 $("#edicionPerm").append(txt2); 
	 	 $("#edicionPerm").animate({ width: '99%' }, 1000);
	 });	
}

function cierraEdiPerms(){
	$("#edicionPerm").empty();
	var cambioCSS2=
	{
		visibility:"visible",		
	};
	$("#muestraPermis").css(cambioCSS2);	
	$("#muestraPermis").css("width","30%");
	$("#muestraPermis").animate({ width: '99%' }, 1000);
}

function cierraEdicionAfec(){
	$("#edicionAfec").empty();
	var cambioCSS2=
	{
		visibility:"visible",		
	};
	$("#muestraAfecs").css(cambioCSS2);	
	$("#muestraAfecs").css("width","30%");
	$("#muestraAfecs").animate({ width: '99%' }, 1000);
}

function cierraEdicionPermiso(){
	
	$("#muestraPermis").empty();
	var cambioCSS2=
	{
		visibility:"none",		
	};
	$("#capturaPermisos").css(cambioCSS2);	
	verObrasGes();	
}
