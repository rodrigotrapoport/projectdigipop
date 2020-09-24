<?php
$jsonServicios = 
'{
	"servicios" : {
		"servicios1" : {
			"id"          : "1",
			"nombre"      : "Plomeria profesional",
			"descripcion" : "Trabajo en casas, &quot;edificios&quot; y muchas cosas raras",
			"condi"       : "Entrevista gratuita, se emite un presupuesto donde debe ser pago 50% al comenzar, y 50% al finalizar.",
			"precioA"     : "199",
			"precioB"     : "99",
			"moneda"      : "USD",
			"visibilidad" : "si",
			"testimonio"  : {
							"id_referencia" : "servicio1",
							"cliente"       : "Alberto Perez",
							"posicion"      : "Dueño de tienda",
							"comentario"    : "Excelente servicio"
							},
							{
							"id_referencia" : "servicio1",
							"cliente"       : "Julieta Gomez",
							"posicion"      : "Dueño de tienda",
							"comentario"    : "Muy buen trato, excelente trato"
							},
			"equipo"      : {
							"id"      : "miembro1",
							"miembro" : "Alberto Tete",
							"frase"   : "Plomero de 30 años", 
							"titulo"  : "plomero"
							}, 
							{
							"id"      : "miembro2",
							"miembro" : "Julieta Toto",
							"frase"   : "Plomero de 30 años, con unos cuantos pirtulos", 
							"titulo"  : "plomera"
							},
			"prioridad"   : "Alta",
			"slide1"      : "Plomeros",
			"foto"        : "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.ytimg.com%2Fvi%2FDelnOgaCMvY%2Fmaxresdefault.jpg&f=1&nofb=1"
		},
		"servicios2" : {
			"id"          : "1",
			"nombre"      : "Plomeria profesional",
			"descripcion" : "Trabajo en casas, &quot;edificios&quot; y muchas cosas raras",
			"condi"       : "Entrevista gratuita, se emite un presupuesto donde debe ser pago 50% al comenzar, y 50% al finalizar.",
			"precioA"     : "199",
			"precioB"     : "99",
			"moneda"      : "USD",
			"visibilidad" : "si",
			"testimonio"  : 
							{
							"id_referencia" : "servicio2",
							"cliente"       : "Alberto Perez22",
							"posicion"      : "Dueño de tienda",
							"comentario"    : "Excelente servicio"
							},
							{
							"id_referencia" : "servicio2",
							"cliente"       : "Julieta Gomez22",
							"posicion"      : "Dueño de tienda",
							"comentario"    : "Muy buen trato, excelente trato"
							},
			"equipo"      : 
							{
							"id"       : "miembro3",
							"miembro"  : "Alberto Tete",
							"frase"    : "Plomero de 30 años", 
							"titulo"   : "plomero"
							}, 
							{
							"id"      : "miembro4",
							"miembro" : "Julieta Toto",
							"frase"   : "Plomero de 30 años, con unos cuantos pirtulos", 
							"titulo"  : "plomera"
							},
			"prioridad"   : "Alta",
			"slide2"      : "Plomeros",
			"foto"        : "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.ytimg.com%2Fvi%2FDelnOgaCMvY%2Fmaxresdefault.jpg&f=1&nofb=1"
		}
	}
}';


$jsonServicios2 = 
'{
	"servicios" : {
		"servicios1" : {
			"id"          : "1",
			"nombre"      : "Plomeria profesional",
			"descripcion" : "Trabajo en casas, &quot; edificios &quot; y muchas cosas raras",
			"condi"       : "Entrevista gratuita, se emite un presupuesto donde debe ser pago 50% al comenzar, y 50% al finalizar.",
			"precioA"     : "199",
			"precioB"     : "99",
			"moneda"      : "USD",
			"visibilidad" : "si",
			
			"testimonio"  : {
								"A" : {
									"id_referencia" : "servicio2",
									"cliente"       : "Alberto Perez22",
									"posicion"      : "Dueño de tienda",
									"comentario"    : "Excelente servicio"
								},
								"B" : {
									"id_referencia" : "servicio2",
									"cliente"       : "Julieta Gomez22",
									"posicion"      : "Dueño de tienda",
									"comentario"    : "Muy buen trato, excelente trato"
								}
			}
		}
    }
}' ;

$x = json_decode($jsonServicios2);
var_dump($x);	
?>