function vertodascoor()
{	
		$("#tituloCoor").text("Resumen de Obras");


	$("#relacioncoor").empty();
	$("#relacioncoor").load("consultaObrasCoor.php"); 

}

function vertodascoorsp()
{	
	$("#tituloCoor").text("Obras con Falta de Presupuesto");

	$("#relacioncoor").empty();
	$("#relacioncoor").load("consultaObrasCoorSP.php"); 
}

function vertodascoorsc()
{	
		$("#tituloCoor").text("Obras con Falta de Croquis");
	$("#relacioncoor").empty();
	$("#relacioncoor").load("consultaObrasCoorSC.php"); 
}

function vertodascoorsg()
{	
		$("#tituloCoor").text("Obras con Falta de Asignación de Gestor");

	$("#relacioncoor").empty();
	$("#relacioncoor").load("consultaObrasCoorSG.php"); 
}


function croquisValidado($obr){		
	    // if( !confirm('Confirma la validación de los Croquis?') ) 
     //       { event.preventDefault(); }
     //    else 
     //       {
           	var cambioCSS2=
			{
				visibility:"hidden",
			};
			$("#consultaobrasSup").css(cambioCSS2);		

			$("#edicionObrasC").empty();
			var cambioCSS3=
              {
                display : "block"
                };
            $("#edicionObrasC").css(cambioCSS3); 			
			$("#edicionObrasC").css("width","50%");
			$.get("edicionOC.php?idov="+$obr,function(data){
				var txt2 = data;
			 	 $("#edicionObrasC").append(txt2); 
			 	 $("#edicionObrasC").animate({ width: '99%' }, 1000);
			 });		
           // }
}
