function inicio()
{	
	var cambioCSS2=
	{
		display : "none"
	};
	$("#seccGaleria").css(cambioCSS2);	
	$("#seccAvisos").css(cambioCSS2);	
	$("#seccContactanos").css(cambioCSS2);	
	$("#seccAyuda").css(cambioCSS2);	
	var cambioCSS2=
	{
		display : "block"
    };
	$("#secclogin").css(cambioCSS2);	
}

function avisos()
{	
	var cambioCSS2=
	{
		display : "none"
    };
	$("#secclogin").css(cambioCSS2);	
	$("#seccGaleria").css(cambioCSS2);	
	$("#seccContactanos").css(cambioCSS2);		
	$("#seccAyuda").css(cambioCSS2);	
	var cambioCSS2=
	{
		display : "block"
    };
	$("#seccAvisos").css(cambioCSS2);	
}

function imagenes()
{	
	var cambioCSS2=
	{
		display : "none"
    };
	$("#secclogin").css(cambioCSS2);	
	$("#seccAvisos").css(cambioCSS2);	
	$("#seccContactanos").css(cambioCSS2);		
	$("#seccAyuda").css(cambioCSS2);	
	var cambioCSS2=
	{
		display : "block"
    };
	$("#seccGaleria").css(cambioCSS2);	
}

function contacto()
{	
	var cambioCSS2=
	{
		display : "none"
    };
	$("#secclogin").css(cambioCSS2);	
	$("#seccAvisos").css(cambioCSS2);	
	$("#seccGaleria").css(cambioCSS2);		
	$("#seccAyuda").css(cambioCSS2);	
	var cambioCSS2=
	{
		display : "block"
    };
	$("#seccContactanos").css(cambioCSS2);	
}

function ayuda()
{	
	var cambioCSS2=
	{
		display : "none"
    };
	$("#secclogin").css(cambioCSS2);	
	$("#seccAvisos").css(cambioCSS2);	
	$("#seccGaleria").css(cambioCSS2);		
	$("#seccContactanos").css(cambioCSS2);	
	var cambioCSS2=
	{
		display : "block"
    };
	$("#seccAyuda").css(cambioCSS2);	
}

function fecha()
{

var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
var f=new Date();
document.write(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
}
