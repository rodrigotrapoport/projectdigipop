<?php
$jsonConfig = '
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
	"logos" : {
		"logo"    : "link logo",
	    "favicom" : "link favicom"
    },
    "slides" : {
        "slide1" : {
            "id" : "1",  
            "slideCategoria" : "categoria1",
            "foto"      : "link foto 1",
            "filtroFoto" : "Ninguno",
            "opacidad"  : "0.1",
            "titulo"    : "titulo 1",
            "subtitulo" : "subtitulo 1",
            "texto"     : "texto 1", 
            "link"      : "link 1",
            "textoBtn"  : "btn 1", 
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
            "foto"      : "link foto 2",
            "filtroFoto" : "Sepia",
            "opacidad"  : "0.9",
            "titulo"    : "titulo 1",
            "subtitulo" : "subtitulo 1",
            "texto"     : "texto 1", 
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
            "titulo" : "titulo uno"
        },
        "catSlide2" : {
            "id"     : "2",
            "titulo" : "titulo dos"
        },
        "catSlide3" : {
            "id"     : "3",
            "titulo" : "titulo tres"
        },"catSlide4" : {
            "id"     : "4",
            "titulo" : "titulo cuatro"
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
            "comentario"    : "muy bonito",
            "socialFuente"  : "facebook",
            "socialLink"    : "link red social",
            "foto"          : "foto x",
            "estrellas"     : "3", 
            "nombreProducto"     : "producto1"
        },
        "cliente2" : {
            "id" : "2",
            "nombreUsuario" : "juan testimonio2", 
            "comentario"    : "muy bonito",
            "socialFuente"  : "facebook",
            "socialLink"    : "link red social",
            "foto"          : "foto x",
            "estrellas"     : "5", 
            "nombreProducto"     : "producto2"
        }
    },
    "index" : {
        "slides" : {
            "id" : "1",  
            "categoria" : "categoria0",
            "foto"      : "link foto 1",
            "filtroFoto" : "color1",
            "opacidad"  : "nivel1",
            "titulo"    : "titulo 1",
            "subtitulo" : "subtitulo 1",
            "texto"     : "texto 1", 
            "link"      : "link 1",
            "textoBtn"  : "btn 1", 
            "colorBtn"  : "cBtn 1",
            "tipoBtn"   : "circular",
            "sombraBtn" : "si",
            "colorTxTitulo"    : "#000000",
            "colorTxSubtitulo" : "#000000",
            "colorTxBtn" : "#000000"
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
    "analisis" : {
        "googleAnalitics" : "dato 1",
        "googleTargetHead"    : "dato 2.1",
        "googleTargetBody"    : "dato 2.2",
        "facebookPixel"   : "dato 3",
        "facebookMessenger" : "dato 4",
        "googleMaps"      : "https://www.google.com.mx/maps/@23.2751104,-106.397696,14z",
        "whatsapp"        : "dato 6"
    },
    "delivery" : {
        "rappy" : {
            "user" : "usuario",
            "password" : "clave"
        },
        "tabla": {
            "zona1" : {
                "id"     : "1",
                "barrios" : "Belgrano, Nuñes",
                "precio" : "precio uno"
            },
            "zona2" : {
                "id"     : "2",
                "barrios" : "Palermo, Colegiales",
                "precio" : "precio dos"
            },
            "zona3" : {
                "id"     : "3",
                "barrios" : "Boedo, Flores",
                "precio" : "precio tres"
            },
            "zona4" : {
                "id"     : "4",
                "barrios" : "Deboto, Villa Puyrredon",
                "precio" : "precio cuatro"
            }
        }
	},
    "mediosPagos" : {
        "paypal" : {
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
	            
	            
	            
	            
	                        
	            
	        
	        
	        
	        
	        
	        
	           	  
	 