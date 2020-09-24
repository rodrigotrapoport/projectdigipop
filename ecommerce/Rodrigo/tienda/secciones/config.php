<?php
$jsonConfig = '
{"config" : {
	
    "calendario" : {
	    "titulo"      : "titulo de calendario",
	    "explicacion" : "explicacion del calendario",
	    "script"      : "codigo del script Js"   
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
        "linkEdin"      : "link de linkedin" 
	    
	},
	"contadorExito" : {
		"exito1" : {
            "texto"  : "texto exito 1",
            "nombre" : "nombre del exito",
            "visibilidad" : "si",
            "icono" : "link de la foto"
        },
        "exito2" : {
            "texto"  : "texto exito 2",
            "nombre" : "nombre del exito",
            "visibilidad" : "si",
            "icono" : "link de la foto"
        },
        "exito3" : {
            "texto"  : "texto exito 3",
            "nombre" : "nombre del exito",
            "visibilidad" : "si",
            "icono" : "link de la foto"
        },
        "exito4" : {
            "texto"  : "texto exito 4",
            "nombre" : "nombre del exito",
            "visibilidad" : "si",
            "icono" : "link de la foto"
        },
        "exito5" : {
            "texto"  : "texto exito 5",
            "nombre" : "nombre del exito",
            "visibilidad" : "si",
            "icono" : "link de la foto"
        },
        "exito6" : {
            "texto"  : "texto exito 6",
            "nombre" : "nombre del exito",
            "visibilidad" : "si",
            "icono" : "link de la foto"
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
            "categoria" : "categoria1",
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
        "slide2" : {
            "id" : "2",  
            "categoria" : "categoria2",
            "foto"      : "link foto 2",
            "filtroFoto" : "color1",
            "opacidad"  : "nivel1",
            "titulo"    : "titulo 1",
            "subtitulo" : "subtitulo 1",
            "texto"     : "texto 1", 
            "link"      : "link 2",
            "textoBtn"  : "btn 2", 
            "colorBtn"  : "cBtn 1",
            "tipoBtn"   : "circular",
            "sombraBtn" : "si",
            "colorTxTitulo"    : "#000000",
            "colorTxSubtitulo" : "#000000",
            "colorTxBtn" : "#000000"
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
            "foto" : "link selfie 1",
            "nombre" : "Diego",
            "rol"    : "developer",
            "texto"  : "hkhkuhkhkjhkhkhj bjbjhjb",
            "email"  : "gfhgfh@jgjh.com", 
            "linkedin"   : "link linkedin",
            "facebook"   : "link facebook",
            "instagram"  : "link instagram",
            "categoria"  : "categoria1"
        },
        "miembro2" : {
            "foto" : "link selfie 2",
            "nombre" : "Rodrigo",
            "rol"    : "developer",
            "texto"  : "hkhkuhkhkjhkhkhj bjbjhjb",
            "email"  : "gfhgfh@jgjh.com", 
            "linkedin"   : "link linkedin",
            "facebook"   : "link facebook",
            "instagram"  : "link instagram",
            "categoria"  : "categoria2"
        }
    },
    "testimonios" : {
        "cliente1" : {
            "nombreUsuario" : "juan testimonio1",
            "comentario"    : "muy bonito",
            "socialFuente"  : "facebook",
            "socialLink"    : "link red social",
            "foto"          : "foto x",
            "categoria"     : "categoria1"
        },
        "cliente2" : {
            "nombreUsuario" : "juan testimonio2",
            "comentario"    : "muy bonito",
            "socialFuente"  : "facebook",
            "socialLink"    : "link red social",
            "foto"          : "foto x",
            "categoria"     : "categoria2"
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
        "googleTarget"    : "dato 2",
        "facebookPixel"   : "dato 3",
        "facebookMessenger" : "dato 4",
        "googleMaps"      : "dato 5",
        "whatsapp"        : "dato 6"
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
	                  
$jsonPrint = json_decode($jsonConfig);
print_r($jsonPrint);	            


?>	            
	            
	            
	            
	            
	                        
	            
	        
	        
	        
	        
	        
	        
	           	  
	 