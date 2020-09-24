<?php
$tituloGalerias = 
'{ "galerias" : {
		"galeria1" : "TELEFONOS IPHONE",
	    "galeria2" : "ANDROID"
	},
	"fotos"   : {
	    "foto1" : ["img/digiPopProductosV.svg","img/digiPopProductosH.svg"],
	    "foto2" : ["img/digiPopProductosV.svg","img/digiPopProductosH.svg"]	
	},
	"botones" : {
	    "boton1" : "Consulta Uno",
	    "boton2" : "Consulta Dos"	
	},
	"links"    : {
	    "link1"	 : "#",
	    "link2"  : "#"
	},
	"prioridades"    : {
	    "prioridad1"  : "Ninguna",
	    "prioridad2"  : "Alta"
	},
	"visibilidades"    : {
	    "galeria1"  : "si",
		"galeria2"  : "si"
	}
}';
	
$jsonProductos = 	 // productos
'{ "productos" :  {
	
	    "galeria1" : {
	
		    "producto1"   : {
			    "galeria" : "galeria1",
			    "codigo"  : "123",
			    "nombre"  : "zapatillas bonitas",
			    "descrip" : " Bonita zapatilla de plastico medio chafona",
			    "foto1"   : "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.ytimg.com%2Fvi%2FRHAMCrOKZck%2Fmaxresdefault.jpg",
			    "foto2"   : "img/tomas.jpeg",
			    "foto3"   : "img/tomas.jpeg",
			    "marca"   : "adidas",
			    "tamaños" : "1-2-3-4-5-6-7-8-9-10-11-12-13-14",
			    "colores" : "blanco-negro-rojo-azul-violeta-etc",
			    "precioA" : "199",
				"precioB" : "99",
				"moneda"  : "USD",
			    "oferta"  : "si",
			    "calif"   : "3",
				"unidad"  : "par",
				"prioridad":"Alta",
				"condi"   : "condiciones del servicio como garantia o devolucion",
				"visibilidades": "si"
				
			},
			
			"producto2"   :  {
				"galeria" : "galeria1",
				"codigo"  : "123",
			    "nombre"  : "cemento blanco",
			    "descrip" : "Detalles del cemento",
			    "foto1"   : "https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fs3.amazonaws.com%2Fdigitaltrends-uploads-prod%2F2013%2F09%2FiPhone-5S-hands-on-home-angle.jpg",
			    "foto2"   : "img/tomas.jpeg",
			    "foto3"   : "img/tomas.jpeg",				
			    "marca"   : "cruz azul",
				"tamaños" : "10kgr-20kgr-40kgr",
				"colores" : "blanco",
				"precioA" : "$400",
				"precioB" : "$250",
				"moneda"  : "USD",
				"oferta"  : "si",
				"calif"   : "5",
				"unidad"  : "Bolsa",
				"prioridad":"Alta",
				"condi"   : "condiciones del servicio como garantia o devolucion",
				"visibilidades": "si"
			},
			
			"producto3"   :   {
				"galeria" : "galeria1",
				"codigo"  : "123",
			    "nombre"  : "pañales talla 51",
			    "descrip" : "Detalle de los pañales",
			    "foto1"   : "https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fs3.amazonaws.com%2Fdigitaltrends-uploads-prod%2F2013%2F09%2FiPhone-5S-hands-on-home-angle.jpg&f=1&nofb=1",
			    "foto2"   : "img/tomas.jpeg",
			    "foto3"   : "img/tomas.jpeg",				
			    "marca"   : "pañal",
				"tamaños" : "160p-120p-140p",
				"colores" : "blanco",
				"precioA" : "$399",
				"precioB" : "",
				"moneda"  : "USD",
				"oferta"  : "",
				"calif"   : "1",
				"unidad"  : "Paquete",
				"prioridad":"Ninguna",
				"condi"   : "condiciones del servicio como garantia o devolucion",
				"visibilidades": "si"
			},
			
			"producto4"   :   {
				"galeria" : "galeria1",
				"codigo"  : "123",
			    "nombre"  : "pañales talla 52",
			    "descrip" : "Detalle de los pañales",
			    "foto1"   : "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.ytimg.com%2Fvi%2FQikM-2VV6JE%2Fmaxresdefault.jpg&f=1&nofb=1",
			    "foto2"   : "img/tomas.jpeg",
			    "foto3"   : "img/tomas.jpeg",				
			    "marca"   : "pañal",
				"tamaños" : "160p-120p-140p",
				"colores" : "blanco",
				"precioA" : "$399",
				"precioB" : "",
				"moneda"  : "USD",
				"oferta"  : "",
				"calif"   : "1",
				"unidad"  : "Paquete",
				"prioridad":"Ninguna",
				"condi"   : "condiciones del servicio como garantia o devolucion",
				"visibilidades": "si"
			},
			
			"producto5"   :   {
				"galeria" : "galeria1",
				"codigo"  : "123",
			    "nombre"  : "pañales talla 53",
			    "descrip" : "Detalle de los pañales",
			    "foto1"   : "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.ytimg.com%2Fvi%2FQikM-2VV6JE%2Fmaxresdefault.jpg&f=1&nofb=1",
			    "foto2"   : "img/tomas.jpeg",
			    "foto3"   : "img/tomas.jpeg",				
			    "marca"   : "pañal",
				"tamaños" : "160p-120p-140p",
				"colores" : "blanco",
				"precioA" : "$399",
				"precioB" : "",
				"moneda"  : "USD",
				"oferta"  : "",
				"calif"   : "1",
				"unidad"  : "Paquete",
				"prioridad":"Ninguna",
				"condi"   : "condiciones del servicio como garantia o devolucion",
				"visibilidades": "si"
			},
			
			"producto6"   :   {
				"galeria" : "galeria1",
				"codigo"  : "123",
			    "nombre"  : "pañales talla 54",
			    "descrip" : "Detalle de los pañales",
			    "foto1"   : "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.ytimg.com%2Fvi%2FTQ-gySKFYFQ%2Fmaxresdefault.jpg&f=1&nofb=1",
			    "foto2"   : "img/tomas.jpeg",
			    "foto3"   : "img/tomas.jpeg",				
			    "marca"   : "pañal",
				"tamaños" : "160p-120p-140p",
				"colores" : "blanco",
				"precioA" : "$399",
				"precioB" : "",
				"moneda"  : "USD",
				"oferta"  : "",
				"calif"   : "1",
				"unidad"  : "Paquete",
				"prioridad":"Ninguna",
				"condi"   : "condiciones del servicio como garantia o devolucion",
				"visibilidades": "si"
			},
			
			"producto7"   :   {
				"galeria" : "galeria1",
				"codigo"  : "123",
			    "nombre"  : "pañales talla 55",
			    "descrip" : "Detalle de los pañales",
			    "foto1"   : "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.ytimg.com%2Fvi%2FTQ-gySKFYFQ%2Fmaxresdefault.jpg&f=1&nofb=1",
			    "foto2"   : "img/tomas.jpeg",
			    "foto3"   : "img/tomas.jpeg",				
			    "marca"   : "pañal",
				"tamaños" : "160p-120p-140p",
				"colores" : "blanco",
				"precioA" : "$399",
				"precioB" : "",
				"moneda"  : "USD",
				"oferta"  : "",
				"calif"   : "1",
				"unidad"  : "Paquete",
				"prioridad":"Ninguna",
				"condi"   : "condiciones del servicio como garantia o devolucion",
				"visibilidades": "si"
			},
			
			"producto8"   :   {
				"galeria" : "galeria1",
				"codigo"  : "123",
			    "nombre"  : "pañales talla 56",
			    "descrip" : "Detalle de los pañales",
			    "foto1"   : "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.ytimg.com%2Fvi%2FTQ-gySKFYFQ%2Fmaxresdefault.jpg&f=1&nofb=1",
			    "foto2"   : "img/tomas.jpeg",
			    "foto3"   : "img/tomas.jpeg",				
			    "marca"   : "pañal",
				"tamaños" : "160p-120p-140p",
				"colores" : "blanco",
				"precioA" : "$599",
				"precioB" : "",
				"moneda"  : "USD",
				"oferta"  : "si",
				"calif"   : "4",
				"unidad"  : "Paquete",
				"prioridad":"Alta",
				"condi"   : "condiciones del servicio como garantia o devolucion",
				"visibilidades": "si"
			}
		},
		
		
		"galeria2" : {
	
		    "producto1"   : {
			    "galeria" : "galeria2",
			    "codigo"  : "123",
			    "nombre"  : "zapatillas bonitas adidas",
			    "descrip" : "Bonita zapatilla de plastico medio chafona",
			    "foto1"   : "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fcdn.vox-cdn.com%2Fthumbor%2FJmd2pjYeYUhw5jKRBDhbUBtoeVM%3D%2F0x0%3A2040x1360%2F1200x800%2Ffilters%3Afocal(857x517%3A1183x843)%2Fcdn.vox-cdn.com%2Fuploads%2Fchorus_image%2Fimage%2F59667263%2Fwjoel_180413_1777_android_002.0.jpg",
			    "foto2"   : "img/tomas.jpeg",
			    "foto3"   : "img/tomas.jpeg",
			    "marca"   : "adidas",
			    "tamaños" : "1-2-3-4-5-6-7-8-9-10-11-12-13-14",
			    "colores" : "blanco-negro-rojo-azul-violeta-etc",
			    "precioA" : "$199",
				"precioB" : "$99",
				"moneda"  : "USD",
			    "oferta"  : "si",
			    "calif"   : "3",
				"unidad"  : "par",
				"prioridad":"Alta",
				"condi"   : "condiciones del servicio como garantia o devolucion",
				"visibilidades": "no"
			},
			
			"producto2"   :  {
				"galeria" : "galeria2",
				"codigo"  : "123",
			    "nombre"  : "cemento blanco especial",
			    "descrip" : "Bolsa de semento para reboque",
			    "foto1"   : "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.ytimg.com%2Fvi%2FwSWplFh-E-E%2Fmaxresdefault.jpg&f=1&nofb=1",
			    "foto2"   : "img/tomas.jpeg",
			    "foto3"   : "img/tomas.jpeg",				
			    "marca"   : "cruz azul",
				"tamaños" : "10kgr-20kgr-40kgr",
				"colores" : "blanco",
				"precioA" : "$400",
				"precioB" : "$250",
				"moneda"  : "USD",
				"oferta"  : "si",
				"calif"   : "5",
				"unidad"  : "Bolsa",
				"prioridad":"Ninguna",
				"condi"   : "condiciones del servicio como garantia o devolucion",
				"visibilidades": "si"
			},
			
			"producto3"   :   {
				"galeria" : "galeria2",
				"codigo"  : "123",
			    "nombre"  : "pañales talla 533",
			    "descrip" : "Pañales grandes de plastico ",
			    "foto1"   : "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.ytimg.com%2Fvi%2FDelnOgaCMvY%2Fmaxresdefault.jpg&f=1&nofb=1",
			    "foto2"   : "img/tomas.jpeg",
			    "foto3"   : "img/tomas.jpeg",
				"marca"   : "pañal",
				"tamaños" : "160p-120p-140p",
				"colores" : "blanco",
				"precioA" : "$399",
				"precioB" : "$299",
				"moneda"  : "USD",
				"oferta"  : "si",
				"calif"   : "1",
				"unidad"  : "Paquete",
				"prioridad":"Alta",
				"condi"   : "condiciones del servicio como garantia o devolucion",
				"visibilidades": "si"
			}
		}    
	}
	
	
}';
		
?>