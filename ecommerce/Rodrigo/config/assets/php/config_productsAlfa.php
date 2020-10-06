<?php
$jsonConfigProductos = '
{"config" : {
    "calendario" : {
	    "titulo"      : "titulo de calendario",
	    "explicacion" : "explicacion del calendario",
	    "script"      : "<codigo del script Js/>"   
	},
    "contacto" : {
	    "email" : "correo@xmail.com",  
        "formulario" : {
            "nombre"   : "si",
            "email"    : "no",
            "telefono" : "si",
            "motivo"   : "no"
            },
        "telefono"      : "123456789",
        "whatsapp"      : "987654321",
        "linkMessenger" : "link Facebook Messenger",
        "linkFacebook"  : "link de facebook" ,
        "linkInstagram" : "link de instagram",
        "linkTwitter"   : "link de twitter",
        "linkEdin"      : "link de linkedin" 
	    
	},
	"contadorExito" : {
		"exito1" : {
            "id": "1",
            "texto"  : "texto exito 1",
            "nombre" : "nombre del exito",
            "visibilidad" : "Si",
            "icono" : "fab fa-sellsy"
        },
        "exito2" : {
            "id": "2",
            "texto"  : "texto exito 2",
            "nombre" : "nombre del exito",
            "visibilidad" : "Si",
            "icono" : "fas fa-fingerprint"
        },
        "exito3" : {
            "id": "3",
            "texto"  : "texto exito 3",
            "nombre" : "nombre del exito",
            "visibilidad" : "Si",
            "icono" : "fas fa-handshake"
        },
        "exito4" : {
            "id": "4",
            "texto"  : "texto exito 4",
            "nombre" : "nombre del exito",
            "visibilidad" : "Si",
            "icono" : "fas fa-utensils"
        },
        "exito5" : {
            "id": "5",
            "texto"  : "texto exito 5",
            "nombre" : "nombre del exito",
            "visibilidad" : "Si",
            "icono" : "fas fa-thumbs-up"
        },
        "exito6" : {
            "id": "6",
            "texto"  : "texto exito 6",
            "nombre" : "nombre del exito",
            "visibilidad" : "No",
            "icono" : "fas fa-calendar-check"
        }
    },
    "tipografia" : {
        "parrafo"   : "fuenteParrafo",
        "titulo"    : "fuenteTitulos",
        "subtitulo" : "fuenteSubtitulos",
        "link"      : "fuenteLink"
    },
    "colores" : {
        "color1" : "#E8DAEF",
        "color2" : "#F2F3F4",
        "color3" : "#515A5A",
        "color4" : "#FFAE00"
    },
	"logos" : {
		"logo"    : "img/digiPop.svg",
	    "favicom" : "link favicom"
    },
    "slides" : {
        "slide1" : {
            "id" : "1",  
            "slideCategoria" : "categoria1",
            "foto"      : "img/buda.jpeg",
            "filtroFoto" : "Ninguno",
            "opacidad"  : "0.1",
            "titulo"    : "Disfruta de los nuevos productos de temporada",
            "subtitulo" : "Ingresa ya!!!",
            "texto"     : "texto 1", 
            "link"      : "link 1",
            "textoBtn"  : "Ofertas 1", 
            "colorBtn"  : "#000000",
            "tipoBtn"   : "Redondeado",
            "sombraBtn" : "si",
            "colorTxTitulo"    : "#000000",
            "colorTxSubtitulo" : "#000000",
            "colorTxBtn" : "#000000",
            "form" : "si"
        },
        "slide2" : {
            "id" : "2",  
            "slideCategoria" : "categoria2",
            "foto"      : "img/digiPop3.svg",
            "filtroFoto" : "Sepia",
            "opacidad"  : "0.9",
            "titulo"    : "La nueva temporada esta en camino",
            "subtitulo" : "disfruta ya!!!",
            "texto"     : "Ofertas 2", 
            "link"      : "link 2",
            "textoBtn"  : "btn 2", 
            "colorBtn"  : "#000000",
            "tipoBtn"   : "Cuadrado",
            "sombraBtn" : "no",
            "colorTxTitulo"    : "#000000",
            "colorTxSubtitulo" : "#000000",
            "colorTxBtn" : "#000000",
            "form" : "no"
        }
	},
	"catSlide" : {
        "catSlide1" : {
            "id"     : "1",
            "titulo" : "TELEFONOS IPHONE",
            "visibilidades" : "si"
        },
        "catSlide2" : {
            "id"     : "2",
            "titulo" : "TELEFONOS ANDROID",
            "visibilidades" : "si"
        },
        "catSlide3" : {
            "id"     : "3",
            "titulo" : "titulo tres",
            "visibilidades" : "si"

        },"catSlide4" : {
            "id"     : "4",
            "titulo" : "titulo cuatro",
            "visibilidades" : "no"
        }
	},
	"nosotros" : {
        "qOfrecemos"  : "ofrecemos esto",
        "diferencial" : "diferenciador xplus",
        "valores"     : "los mejores",   
        "vision"  : "vision 1",
        "mision"  : "mision 1",
        "foto1"   : "link selfie 1",
        "foto2"   : "link selfie 2",
        "foto3"   : "link selfie 3",
        "foto4"   : "link selfie 4"
	},
	"equipo" : {
        "miembro1" : {
            "id" : "1",
            "foto" : "link selfie 1",
            "nombre" : "Diego",
            "rol"    : "developer",
            "texto"  : "texto 1",
            "email"  : "gfhgfh@jgjh.com", 
            "linkedin"   : "link linkedin 1",
            "facebook"   : "link facebook1",
            "instagram"  : "link instagram1",
            "categoria"  : "servicio1"
        },
        "miembro2" : {
            "id" : "2",
            "foto" : "link selfie 2",
            "nombre" : "Rodrigo",
            "rol"    : "developer",
            "texto"  : "texto 2",
            "email"  : "gfhgfh@jgjh.com", 
            "linkedin"   : "link linkedin2",
            "facebook"   : "link facebook12",
            "instagram"  : "link instagram12",
            "categoria"  : "servicio2"
        }
    },
    "testimonios" : {
        "cliente1" : {
            "id" : "1",
            "nombreUsuario" : "juan testimonio1", 
            "comentario"    : "Muy bonito aqui va el primer comentario sobre las experiencias con la empresa",
            "socialFuente"  : "facebook",
            "socialLink"    : "link red social",
            "foto"          : "https://1.bp.blogspot.com/-b2WV7xXgR1g/Ucsb765Sg-I/AAAAAAAABxI/FTJXnz5OexU/s1600/IMG_1039.JPG",
            "estrellas"     : "3", 
            "nombreProducto": "producto1"
        },
        "cliente2" : {
            "id" : "2",
            "nombreUsuario" : "juan testimonio2", 
            "comentario"    : "Muy bonito el texto del segundo comentario.",
            "socialFuente"  : "twiter",
            "socialLink"    : "link red social",
            "foto"          : "https://i.ytimg.com/vi/ENbS7Y-j1kw/hqdefault.jpg",
            "estrellas"     : "5", 
            "nombreProducto": "producto2"
        },
        "cliente3" : {
            "id" : "3",
            "nombreUsuario" : "juan testimonio 3", 
            "comentario"    : "Muy bonito el texto del segundo comentario.",
            "socialFuente"  : "",
            "socialLink"    : "link red social",
            "foto"          : "https://i.ytimg.com/vi/ENbS7Y-j1kw/hqdefault.jpg",
            "estrellas"     : "5", 
            "nombreProducto": "productox1"
        }
    },
    "index" : {
        "categoriaSlide" : { 
            "id" : "1: titulo uno "
        },
        "medPago" : {
            "titulo"    : "titulo pagos",
            "subtitulo" : "subtitulo pagos"
        },    
        "equipo" : {
            "titulo"    : "titulo del equipo",
            "subtitulo" : "subtitulo del equipo"
        },    
        "contExito" : {
            "titulo"    : "titulo cont exito",
            "subtitulo" : "subtotilo cont exito"
        },
        "testimonios" : {
            "titulo"    : "titulo testimonios",
            "subtitulo" : "subtitulo testimonios"
        },
        "delivery" : {
            "titulo"    : "titulo delivery",
            "subtitulo" : "subtitulo delivery"
        }
    },
    
    
    "delivery" : {
        "rappy" : { 
            "user" : "rappy 1",
            "password" : "clave rappy"
        },
        "tabla" : { 
            "zona1" : { 
                "id" : "1",
                "barrios" : "Mazatlan, Tulum",
                "precio"  :"12"
            },
            "zona2" : { 
                "id" : "2",
                "barrios" : "Palermo, Colegiales",
                "precio"  : "20"
            },
            "zona3" : {
                "id" : "3",
                "barrios" : "Boedo, Flores",
                "precio"  : "30"
            },
            "zona4" : {
                "id" : "4",
                "barrios" : "Deboto, Villa Puyrredon",
                "precio"  : "40"
            }
        }
    },
    
    "analisis" : {
        "googleAnalitics" : "dato 1",
        "googleTargetHead" : "dato 2.1",
        "googleTargetBody" : "dato 2.2",
        "facebookPixel"   : "dato 3",
        "facebookMessenger" : "dato 4",
        "googleMaps"      : "23.2751104,-106.397696",
        "whatsapp"        : "dato 6"
    },
    "mediosPagos" : {
        "paypal"  : {
            "clienteId" : "xshwhwh",
            "apiKey"    : "1234"
        },    
        "mercadoPago" : {
            "clienteId" : "id mercado pago",
            "apiKey"    : "443556664"
        },
        "cripto" : {
            "bitcoin"   : "gguguguygu" ,
            "btcApiKey" : "hjhjhjhjhj" ,
            "ethereum"  : "jhgjgjgjhgj",
            "dai"  :  "jnkjkjkhk",
            "usdt" :  "jkjkjhkjhkjhkjh"
        }    
	}    
}   
}';
	                  
/* $jsonPrint = json_decode($jsonConfig);
var_dump($jsonPrint);	 */            
	            
?>	            
	            
	            
	            
	            
	                        
	            
	        
	        
	        
	        
	        
	        
	           	  
	 