<?php
//************************************************	
Header ("Content-type: text/css; charset=utf-8");
	
	
    ///////// COLORES DE FONDO /////////	
require('../../config/assets/php/config_serv.php');
$colores = json_decode($jsonConfigServicios, true);
$colorA = $colores['config']['colores']['color1'];
$colorB = $colores['config']['colores']['color2'];
$colorC = $colores['config']['colores']['color3'];
$colorD = $colores['config']['colores']['color4'];

//var_dump($colores['config']['colores']);


//**************   Fuentes Cargadas	**************
echo "@import url('https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Alegreya+Sans:wght@400;500;800&".
"family=Archivo:wght@400;600;700&".
"family=Arvo:wght@400;700&".
"family=B612:wght@400;700&".
"family=BioRhyme:wght@300;400;700&".
"family=Cairo:wght@400;700&".
"family=Cardo:wght@400;700&".
"family=Concert+One&".
"family=Cormorant:wght@400;500;700&".
"family=Crimson+Text:wght@400;600;700&".
"family=Exo+2:wght@300;400;500;600&".
"family=Fira+Sans:wght@200;400;600&".
"family=Fjalla+One&".
"family=Frank+Ruhl+Libre:wght@400;500;700&".
"family=IBM+Plex+Sans:wght@300;400;500;600;700&".
"family=Karla:wght@400;700&".
"family=Lato:wght@300;400;700;900&".
"family=Lora:wght@400;500;700&".
"family=Merriweather:wght@300;400;700;900&".
"family=Montserrat:wght@400;500;600&".
"family=Muli:wght@300;500;700&".
"family=Noto+Sans+JP:wght@400;500;700;900&".
"family=Nunito:wght@300;400;600;800&".
"family=Old+Standard+TT:wght@400;700&".
"family=Open+Sans:wght@300;400;600;700;800&".
"family=Oswald:wght@300;500;700&".
"family=Oxygen:wght@300;400;700&".
"family=PT+Sans:wght@400;700&".
"family=PT+Serif:wght@400;700&".
"family=Playfair+Display:wght@400;500;600&".
"family=Poppins:wght@200;300;400;600;800&".
"family=Rakkas&".
"family=Roboto:wght@300;400;500;700&".
"family=Rubik:wght@300;400;500;700&".
"family=Source+Sans+Pro:wght@300;400;600;700;900&".
"family=Spectral:wght@300;400;500;600;700&".
"family=Titillium+Web:wght@300;400;600&".
"family=Ubuntu:wght@300;400;500;700&".
"family=Varela+Round&".
"family=Vollkorn:wght@400;500;700;800&".
"family=Work+Sans:wght@300;400;500;600&".
"family=Yatra+One&display=swap');";	
	
//////////////////////////////////////

$f1  = "font-family: 'Abril Fatface', cursive;";
$f2  = "font-family: 'Archivo', sans-serif;";
$f3  = "font-family: 'Arvo', serif;";
$f4  = "font-family: 'B612', sans-serif;";
$f5  = "font-family: 'BioRhyme', serif;";
$f6  = "font-family: 'Cairo', sans-serif;";
$f7  = "font-family: 'Cardo', serif;";
$f8  = "font-family: 'Concert One', cursive;";
$f9  = "font-family: 'Cormorant', serif;";
$f10 = "font-family: 'Crimson Text', serif;";
$f11 = "font-family: 'Exo 2', sans-serif;";
$f12 = "font-family: 'Fira Sans', sans-serif;";
$f13 = "font-family: 'Fjalla One', sans-serif;";
$f14 = "font-family: 'Frank Ruhl Libre', serif;";
$f15 = "font-family: 'IBM Plex Sans', sans-serif;";
$f16 = "font-family: 'Karla', sans-serif;";
$f17 = "font-family: 'Lato', sans-serif;";
$f18 = "font-family: 'Lora', serif;";
$f19 = "font-family: 'Merriweather Sans', sans-serif;";
$f20 = "font-family: 'Montserrat', sans-serif;";
$f21 = "font-family: 'Mulish', sans-serif;";
$f22 = "font-family: 'Noto Sans JP', sans-serif;";
$f23 = "font-family: 'Nunito', sans-serif;";
$f24 = "font-family: 'Old Standard TT', serif;";
$f25 = "font-family: 'Open Sans', sans-serif;";
$f26 = "font-family: 'Oswald', sans-serif;";
$f27 = "font-family: 'Oxygen', sans-serif;";
$f28 = "font-family: 'PT Sans', sans-serif;";
$f29 = "font-family: 'PT Serif', serif;";
$f30 = "font-family: 'Playfair Display', serif;";
$f31 = "font-family: 'Poppins', sans-serif;";
$f32 = "font-family: 'Rakkas', cursive;";
$f33 = "font-family: 'Roboto', sans-serif;";
$f34 = "font-family: 'Rubik', sans-serif;";
$f35 = "font-family: 'Source Sans Pro', sans-serif;";
$f36 = "font-family: 'Spectral', serif;";
$f37 = "font-family: 'Titillium Web', sans-serif;";
$f38 = "font-family: 'Ubuntu', sans-serif;";
$f39 = "font-family: 'Varela Round', sans-serif;";
$f40 = "font-family: 'Vollkorn', serif;";
$f41 = "font-family: 'Work Sans', sans-serif;";
$f42 = "font-family: 'Yatra One', cursive;";

$x = 'f'.rand(1,42);
$fuenteSeleccionada = "${$x}"; // selecciona la fuente de la lista	


///// COLORES PAGINA ///////


$colorPrincipal = ''; // 1 de entre 15 opciones
$gama = 1;            // 1  de entre 6 convinaciones 


$color1 = $colorA; //'#1239AC'; // background
$color2 = $colorB; //'#3D12AF'; //
$color3 = $colorC; //'#FFD700'; //
$color4 = $colorD; //'#FFAE00'; //
$color5 = '#FFFFFF'; //
$color6 = '#000000'; //

echo   ".cFondo {
            background-color: ". $color1 .";
        }";

echo   ".cBarra {
            background-color: ". $color2 .";
       }";

echo   ".cPie {
            background-color: ". $color3 .";
       }";

//////////// FUENTES DE LETRAS /////////////

// FUENTE TITULOS		
echo   ".fTitulo {
			".$fuenteSeleccionada."
			font-weight:800;
		}";

// FUENTE SUBTITULOS		
echo   ".fSubtitulo {
			".$fuenteSeleccionada."
			font-weight:600;
		}";

// FUENTE PARRAFO		
echo   ".fParrafo {
			".$fuenteSeleccionada."
			font-weight:400;
		}";

// FUENTE BARRA DE NAVEGACION
echo   ".fBarra {
			".$fuenteSeleccionada."
			font-weight:200;
		}";

// FUENTE PIE
echo   ".fPie {
			".$fuenteSeleccionada."
			font-weight:100;
		}";

/////////////////////////////////////////


echo   ".blanco h2 {
			color: #FFFFFF !important;
		}
		
		html, body {
			height: 100%;
			width: 100%;
		    color: #222;
		}";	
		
echo   "#gal1, #gal2, #gal3 {  /* titulos galeria */
			font-family: 'Roboto', sans-serif;
		}";
		
echo   ".pie {  /* texto pie de pagina */
			font-family: 'Karla', sans-serif;
		}";
/////////////////////////////////////////////////////
// FUENTE TITULOS		
echo   ".fuenteTi {
			font-family: 'Karla', sans-serif;
			font-weight:700;
		}";

// FUENTE TEXTOS 2		
echo   ".fuenteTx1 {
			font-family: 'Karla', sans-serif;
			font-weight:400;
		}";

// FUENTE TEXTOS 3		
echo   ".fuenteTx2 {
			font-family: 'Karla', sans-serif;
			font-weight:400;
		}";
/*
.fu2 {
	font-family: 'Noto Sans JP', sans-serif;
}
*/		

////////////////// FOTOS TESTIMONIOS /////////////////////////////////
echo '
.imageA{
    position:relative;
    overflow:hidden;
    padding-bottom:100%;
}
.imageA img{
      position: absolute;
      max-width: 100%;
      max-height: 100%;
      top: 50%;
      left: 50%;
      transform: translateX(-50%) translateY(-50%);
}';



echo "

.sombras {
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}


.navbar {
	padding: .8rem;
}
.navbar-nav li {
	padding-right: 20px;
}
.nav-link {
	 font-size: 1.1em !important; 
}

/* acomoda las imagenes de slider */

.carousel-inner img {
	width: 100%;
	height: 100%;
} 

/* centrar titulo */

.carousel-caption {
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
}

/* sombra del titulo */

.carousel-caption h1 {  
	font-size: 500%;
	text-transform: uppercase;
	text-shadow: 1px 1px 15px #000;
}

/* sombra del subtitulo */

.carousel-caption h3 {
	font-size: 200%;
	font-weight: 500%;
	text-shadow: 1px 1px 10px #000;
}
.texto { /* sombra de texto de carousel */
	text-shadow: 1px 1px 10px #000;
}

/* prev boton circular */

.owl-nav button[type=button] {
	display: inline-block;
	height: 68px;
	width: 68px;
	background: #B0BCC2;
	font-size: 35px;
	color: #fff;
	border-radius: 50%;
	text-align: center;
	position: absolute;
	left: 60px;
	top: 345px;
}




/* botones PILL */

.nav-pills > li > a.active {
  background-color: #424242 !important;
  color: #ffffff !important;
}

.nav-pills > li > a:hover {
  color: #ffffff !important;
  background-color: #424242 !important;
}

.nav-pills > li > a:visited {
  color: #848484 !important;
  background-color: #ffffff !important;
}

.nav-pills > li > a {
  color: #3b3c36 !important;
  background-color: #c2c2c2 !important;
}

.nav-link-color {
  color:  #424242;
}


/* vista de productos seccion 2 */

.product_view .modal-dialog{max-width: 800px; width: 100%;}
.pre-cost{text-decoration: line-through; color: #a5a5a5;}
.space-ten{padding: 10px 0;}    




/* margenes del jumbotron */

.jumbotron {
	padding: 1rem;
	border-radius: 0;
}

/* espaciado inferior padding */ 

.padding {
	padding-bottom: 2rem;
}

/* centrar y achicar welcome */

.welcome {
	width: 75%;
	margin: 0 auto;
	padding-top: 2rem;
}

/* estilo del guion en welcome */

.welcome hr {
	border-top: 2px solid #b4b4b4;
	width: 95%;
	margin-top: .3rem;
	margin-bottom: 1rem;
}

/* cambiar colores de los logos */

.fa-code {
	color: #e58014;
}
.fa-bold {
	color: #8c0e94;
}
.fa-css3 {
	color: #1810f5;
}

/* cambiar tamaño */

.fa-code, .fa-bold, .fa-css3 {
	font-size: 4em;
	margin: 1rem;
}

/* boton que muestra los gif  ancho 100% */

.fun {
	width: 100%;
	margin-bottom: 2rem;
}

/* hace que los iconos animados se vean correctamente */

.gif {
	max-width: 100%;
}

/* define el tamaño de los iconos de redes sociales */

.social a {
	font-size: 4.5em;
	padding: 3rem;
}
.fa-facebook {
	color: #0f42e8;
}
.fa-twitter {
	color: #73a3dc;
}
.fa-google-plus-g {
	color: red;
}
.fa-instagram {
	color: blue;
}
.fa-youtube {
	color: #bb0000;
}

/* hover */

.fa-facebook:hover, .fa-twitter:hover, .fa-google-plus-g:hover, .fa-instagram:hover, .fa-youtube:hover {
	color: #d5d5d5;
}

footer {
	background-color: #3f3f3f; /* color de fondo */
	color: #d5d5d5; /* color de las letras */
	padding-top: 2rem;
}

hr.light {
	border-top: 1px solid #d5d5d5;
	width: 75%;
	margin-top: .8rem;
	margin-bottom: 1rem;
}
hr.light-100{
	border-top: 1px solid #d5d5d5;
	width: 100%;
	margin-top: .8rem;
	margin-bottom: 1rem;
}

/* psicionar la div toast */
.ventana_flotante {
    position:absolute;
    top:0;
    right:0;
    width:300px;
}

/*----- REDES SOCIALES ----*/

.container-redes {
	position: fixed;
	bottom: 20px;
	right: 20px;
	display: flex;
	flex-direction: column;
}
.container-redes a{
	margin-top: 7px;
}


/*---Media Queries --*/

/* tamaño tablet */

@media (max-width: 992px) {  
	.social a {
		font-size: 4em;
		padding: 2rem;
	}
	
	
	
  }

/* tamaño tablet y cel */  
  
@media (max-width: 768px) {
	#ventana {
		height: auto;
	}

	.carousel-caption {
	top: 50%;
	}
	
	/* sombre del titulo */
	
	.carousel-caption h1 {
		font-size: 350%;
	}
	
	/* sombra del subtitulo */
	
	.carousel-caption h3 {
		font-size: 140%;
		font-weight: 400%;
		padding-bottom: .2rem;
	}
	
	.carousel-caption .btn {
		font-size: 95%;
		padding: 8px 14px;
	}
	
    .display-4 {
	    font-size: 200%;
    }
    
    .social a {
		font-size: 2.5em;
		padding: 1.2rem;
	}
	
}

/* movil */

@media (max-width: 576px) { 

    #ventana {
		height: auto;
	}

    .carousel-caption {
	top: 40%;
	}
	
	/* sombre del titulo */
	
	.carousel-caption h1 {
		font-size: 250%;
	}
	
	/* sombra del subtitulo */
	
	.carousel-caption h3 {
		font-size: 110%
	}
	
	.carousel-caption .btn {
		font-size: 90%;
		padding: 4px 8px;
	}
	
	.carousel-indicators {
		display: none;
	}
	
	.display-4 {
	    font-size: 160%;
    }
    
    .social a {
		font-size: 2em;
		padding: .7rem;
	}
}


/*---Firefox Bug Fix --*/

.carousel-item {
  transition: -webkit-transform 0.5s ease;
  transition: transform 0.5s ease;
  transition: transform 0.5s ease, -webkit-transform 0.5s ease;
  -webkit-backface-visibility: visible;
  backface-visibility: visible;
}

/*--- Fixed Background Image --*/

figure {
  position: relative;
  width: 100%;
  height: 100%;
  margin: 0!important;
}

.fixed-wrap {
  clip: rect(0, auto, auto, 0);
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

#fixed1 {
  /*background-image: url(../img/mac.png);*/
  position: fixed;
  display: block;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center center;
  -webkit-transform: translateZ(0);
          transform: translateZ(0);
  will-change: transform;
}

#fixed2 {
  
  position: fixed;
  display: block;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  -webkit-transform: translateZ(0);
          transform: translateZ(0);
  will-change: transform;
}

/*--- Bootstrap Padding Fix --*/

[class*=".'"col-"'."] {
    padding: 1rem;
}




/* CCCCCC */

.cta-100 {
  margin-top: 100px;
  padding-left: 8%;
  padding-top: 7%;
}
.col-md-4{
    padding-bottom:20px;
}

.white {
  color: #fff !important;
}

.mt { float: left; margin-top: -20px; padding-top: 20px; }

.bg-blue-ui {
  background-color: #708198 !important;
}

figure img { width:300px; }

#blogCarousel {
  padding-bottom: 100px;
}

.blog .carousel-indicators {
  left: 0;
  top: -50px;
  height: 50%;
}


/* slider slider no funciona */

.blog .carousel-indicators li {
  
  background: #708198;
  border-radius: 50%;
  width: 20px;
  height: 20px;
}

.blog .carousel-indicators .active {
  background: #0fc9af;
}

.item-carousel-blog-block {
  outline: medium none;
  padding: 15px;
}





/*
Extra small (xs) devices (portrait phones, less than 576px)
No media query since this is the default in Bootstrap

Small (sm) devices (landscape phones, 576px and up)
@media (min-width: 576px) { ... }

Medium (md) devices (tablets, 768px and up)
@media (min-width: 768px) { ... }

Large (lg) devices (desktops, 992px and up)
@media (min-width: 992px) { ... }

Extra (xl) large devices (large desktops, 1200px and up)
@media (min-width: 1200px) { ... }
*/


 ";
	
?>
