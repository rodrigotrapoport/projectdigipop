<?php
$jsonConfigServicios = '
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
            "texto"  : "10",
            "nombre" : "Exito 1",
            "visibilidad" : "Si",
            "icono" : "fab fa-sellsy"
        },
        "exito2" : {
            "id": "2",
            "texto"  : "20",
            "nombre" : "Exito 2",
            "visibilidad" : "Si",
            "icono" : "fab fa-apple"
        },
        "exito3" : {
            "id": "3",
            "texto"  : "30",
            "nombre" : "Exito 3",
            "visibilidad" : "Si",
            "icono" : "fas fa-handshake"
        },
        "exito4" : {
            "id": "4",
            "texto"  : "40",
            "nombre" : "Exito 4",
            "visibilidad" : "Si",
            "icono" : "fas fa-utensils"
        },
        "exito5" : {
            "id": "5",
            "texto"  : "50",
            "nombre" : "Exito 5",
            "visibilidad" : "Si",
            "icono" : "fas fa-thumbs-up"
        },
        "exito6" : {
            "id": "6",
            "texto"  : "60",
            "nombre" : "Exito 6",
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
            "foto"      : "img/digiPop3.svg",
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
            "titulo" : "Plomeria profesional",
            "visibilidades" : "si"
        },
        "catSlide2" : {
            "id"     : "2",
            "titulo" : "Plomeria industrial",
            "visibilidades" : "si"
        },
        "catSlide3" : {
            "id"     : "3",
            "titulo" : "titulo tres",
            "visibilidades" : "no"

        },"catSlide4" : {
            "id"     : "4",
            "titulo" : "titulo cuatro",
            "visibilidades" : "no"
        }
	},
	"nosotros" : {
        "qOfrecemos"  : "Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.",
        "diferencial" : "Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.",
        "valores"     : "Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.",   
        "vision"  : "Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.",
        "mision"  : "Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.",
        "foto1"   : "link selfie 1",
        "foto2"   : "link selfie 2",
        "foto3"   : "link selfie 3",
        "foto4"   : "link selfie 4"
	},
	"equipo" : {
        "miembro1" : {
            "id" : "1",
            "foto" : "./img/team1.png",
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
            "foto" : "./img/team2.png",
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
            "foto"          : "https://1.bp.blogspot.com/-b2WV7xXgR1g/Ucsb765Sg-I/AAAAAAAABxI/FTJXnz5OexU/s1600/IMG_1039.JPG",
            "estrellas"     : "3",
            "categoria"     : "servicio1"
        },
        "cliente2" : {
            "id" : "2",
            "nombreUsuario" : "juan testimonio2", 
            "comentario"    : "muy bonito",
            "socialFuente"  : "facebook",
            "socialLink"    : "link red social",
            "foto"          : "https://i.ytimg.com/vi/ENbS7Y-j1kw/hqdefault.jpg",
            "estrellas"     : "5",
            "categoria"     : "servicio2"
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
    "analisis" : {
        "googleAnalitics" : "dato 1",
        "googleTargetHead"    : "dato 2.1",
        "googleTargetBody"    : "dato 2.2",
        "facebookPixel"   : "dato 3",
        "facebookMessenger" : "dato 4",
        "googleMaps"      : "23.2751104,-106.397696",
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
	                  
/* $jsonPrint = json_decode($jsonConfig);
var_dump($jsonPrint);	 */            
	            
?>	            
	            
	            
	            
	            
	                        
	            
	        
	        
	        
	        
	        
	        
	           	  
	 