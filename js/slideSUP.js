function fecha()
{

var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
var f=new Date();
document.write(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
}

function cierravalidaC(){
	var url = "supervisor.php";
	window.location.href = url;
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
