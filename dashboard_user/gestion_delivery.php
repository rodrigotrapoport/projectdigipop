<?php
session_start();	
$text = $_SESSION["setCookie"];		
	
?>

<!doctype html>
<html lang="es">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-168750718-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-168750718-1');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="es">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Panel de Control de Usuario - Digipop.</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Panel de control de usuarios para administrar las paginas web.">
    <meta name="msapplication-tap-highlight" content="no">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link href="./main.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/estilos.css">
    <!-- <link rel="stylesheet" href="assets/estilos_favicon.css"> -->
    <script src="assets/scripts/app_gestion_delivery.js" type="text/javascript"></script>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <a href="/dashboard_user/index.html"><img src="/dashboard_user/assets/images/logo.png" alt=""></a>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <a type="a" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <a type="a" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </a>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Buscar">
                            <a class="search-icon"><span></span></a>
                        </div>

                        <button class="close"></button>
                    </div>
                    <div>
                        <div>
                            <a class="btn btn-primary" style="color: white;"><span><i class="fas fa-eye"></i> Ver Vista
                                    Previa</span></a>
                        </div>

                    </div>
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg"
                                                alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="dropdown-menu dropdown-menu-right">
                                            <a type="button" tabindex="0" class="dropdown-item">Cuenta de
                                                usuario</a>
                                            <a type="button" tabindex="0" class="dropdown-item">Seguridad</a>
                                            <a type="button" tabindex="0" class="dropdown-item">Backup</a>
                                            <a type="button" tabindex="0" class="dropdown-item">Pagos</a>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a type="button" tabindex="0" class="dropdown-item">Asesoramiento</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        Alina Mclourd
                                    </div>
                                    <div class="widget-subheading">
                                        Manager
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button"
                                        class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Dashboards</li>
                            <li>
                                <a href="index.html">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Tráfico Web
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Web</li>
                            <li>
                                <a href="#" lass="mm-active">
                                    <i class="metismenu-icon pe-7s-diamond"></i>
                                    Selección de Plantilla
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="plantilla_servicios.html" class="mm-active">
                                            <i class="metismenu-icon"></i>
                                            Servicios
                                        </a>
                                    </li>
                                    <li>
                                        <a href="plantilla_ecommerce_nacional.html">
                                            <i class="metismenu-icon">
                                            </i>E-commerce Nacional
                                        </a>
                                    </li>
                                    <li>
                                        <a href="plantilla_ecommerce_internacional.html">
                                            <i class="metismenu-icon">
                                            </i>E-commerce Internacional
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="gestion_de_configuracion_general.html">
                                    <i class="metismenu-icon fas fa-sliders-h"></i>
                                    Configuración General
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="gestion_de_colores.html">
                                            <i class="metismenu-icon"></i>
                                            Colores
                                        </a>
                                    </li>
                                    <li>
                                        <a href="gestion_de_tipografia.html">
                                            <i class="metismenu-icon">
                                            </i>Tipografía
                                        </a>
                                    </li>
                                    <li>
                                        <a href="gestion_de_logos.html">
                                            <i class="metismenu-icon">
                                            </i>Logo y Favicon
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon fas fa-puzzle-piece"></i>
                                    Secciones
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="gestion_landing_productos.html">
                                            <i class="metismenu-icon">
                                            </i>Landing Page de Productos
                                        </a>
                                    </li>
                                    <li>
                                        <a href="gestion_landing_servicios.html">
                                            <i class="metismenu-icon">
                                            </i>Landing Page de Servicios
                                        </a>
                                    </li>
                                    <li>
                                        <a href="gestion_menu.html">
                                            <i class="metismenu-icon">
                                            </i>Menu
                                        </a>
                                    </li>
                                    <li>
                                        <a href="gestion_index.html">
                                            <i class="metismenu-icon">
                                            </i>Página Principal
                                        </a>
                                    </li>
                                    <li>
                                        <a href="gestion_nosotros_testimonios.html">
                                            <i class="metismenu-icon">
                                            </i>Nosotros / Equipo / Clientes
                                        </a>
                                    </li>
                                    <li>
                                        <a href="gestion_contador_de_exito.html">
                                            <i class="metismenu-icon">
                                            </i>Contador de Exitos
                                        </a>
                                    </li>
                                    <li>
                                        <a href="gestion_contacto.html">
                                            <i class="metismenu-icon">
                                            </i>Contacto
                                        </a>
                                    </li>
                                    <li>
                                        <a href="gestion_slides.html">
                                            <i class="metismenu-icon">
                                            </i>Carousel / Slides
                                        </a>
                                    </li>
                                    <li>
                                        <a href="gestion_calendario.html">
                                            <i class="metismenu-icon">
                                            </i>Calendario
                                        </a>
                                    </li>
                                    <li>
                                        <a href="gestion_mapa.html">
                                            <i class="metismenu-icon">
                                            </i>Mapas
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="app-sidebar__heading">Integraciones</li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon fab fa-google"></i>
                                    Google
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="dashboard-boxes.html">
                                            <i class="metismenu-icon"></i>
                                            Google Analytics
                                        </a>
                                    </li>
                                    <li>
                                        <a href="dashboard-boxes.html">
                                            <i class="metismenu-icon pe-7s-display2"></i>
                                            Google Tag Manager
                                        </a>
                                    </li>
                                    <li>
                                        <a href="dashboard-boxes.html">
                                            <i class="metismenu-icon fa-copy"></i>
                                            Google Calendar
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon fab fa-facebook"></i>
                                    Facebook
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="dashboard-boxes.html">
                                            <i class="metismenu-icon"></i>
                                            Facebook Pixel
                                        </a>
                                    </li>
                                    <li>
                                        <a href="dashboard-boxes.html">
                                            <i class="metismenu-icon pe-7s-display2"></i>
                                            Facebook Messenger
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon fas fa-paper-plane"></i>
                                    Otros
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="dashboard-boxes.html">
                                            <i class="metismenu-icon"></i>
                                            Whatsapp Negocios
                                        </a>
                                    </li>
                                    <li>
                                        <a href="dashboard-boxes.html">
                                            <i class="metismenu-icon pe-7s-display2"></i>
                                            Mailchimp
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="app-sidebar__heading">Medios de Pago</li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon fas fa-cash-register"></i>
                                    Medios de Pago
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="dashboard-boxes.html">
                                            <i class="metismenu-icon"></i>
                                            PayPal
                                        </a>
                                    </li>
                                    <li>
                                        <a href="dashboard-boxes.html">
                                            <i class="metismenu-icon pe-7s-display2"></i>
                                            Mercado Pago
                                        </a>
                                    </li>
                                    <li>
                                        <a href="dashboard-boxes.html">
                                            <i class="metismenu-icon fa-copy"></i>
                                            Criptomoneas
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="app-sidebar__heading">Delivery</li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon fas fa-shipping-fast"></i>
                                    Medios de Entregas
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="dashboard-boxes.html">
                                            <i class="metismenu-icon"></i>
                                            PayPal
                                        </a>
                                    </li>
                                    <li>
                                        <a href="dashboard-boxes.html">
                                            <i class="metismenu-icon pe-7s-display2"></i>
                                            Mercado Pago
                                        </a>
                                    </li>
                                    <li>
                                        <a href="dashboard-boxes.html">
                                            <i class="metismenu-icon fa-copy"></i>
                                            Criptomonedas
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="app-sidebar__heading">Control de usuarios</li>
                            <li>
                                <a href="dashboard-boxes.html">
                                    <i class="metismenu-icon fas fa-users-cog"></i>
                                    Gestión de usuarios
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Inicio del Panel de Control -->
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="row">
                        <h2><i class="fas fa-flag-checkered" style="color: blue;"></i> Panel de Control - Configuración
                            de Medios de Entrega</h2>
                        <div class="page-title-subheading">
                            <p><?php echo $text;?> Si es tu primera vez aquí vas a encontrar todo lo que es relacionado con la configuración
                                de Medios de Entrega de los productos. Actualmente tenemos dos medios de integración con los costos del delivery, el
                            primero es utilizando la tabla de costos donde puedes determinar zonas y los barrios que estan incluidos con su respectivo costo. Esto
                        es ideal para locales que utilizan medios independientes. El segundo forma es utilizando Rappi Entregas, para eso debes tener un alta tu empresa en el sistema de ellos. </p>
                        <p>Para integrar Rappi Entregas a tu pagina debes ingresar tu usuario con tu respectivo password. Tus clientes obtendrán a la hora de la compra el costo de envio. Entonces
                            pagaran por el producto y el costo de envio por Rappi Entregas. Tu empresa va estar encargada de enviar el Rappi. 
                        </p>    
                            <p>Recuerda que sino entiendes algo podes consultar <a href="" target="_blank">los
                                    tutoriales de configuración</a>
                                o pedir asistencia técnica a nuestro equipo a través de <a href="http://"
                                    target="_blank">Messenger</a>. Te
                                recomendamos para que hagas la configuración completa y de forma exitosa.</p> <br>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="mb-3 card card-body">
                                <div>
                                    <a href="#accordion">
                                        <p class="btn btn-success collapsed" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo"><i class="fas fa-flag-checkered"></i> Agregar
                                            una Zona de Entrega
                                        </p>
                                    </a>

                                </div>
                                <h3>Gestión del Contador de Éxitos</h3>
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Barrios o Vecindades comprendidas</th>
                                            <th scope="col">Precio</th> 
                                            <th scope="col">Acciones</th> 
                                        </tr>
                                    </thead>
                                    <tbody id="tabla_delivery" class="thead-dark">
                                        
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="mb-3 card card-body">
                                <h5 class="card-title">Elegi según tu necesidad</h5>
                                <div id="accordion">

                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#collapseTwo" aria-expanded="false"
                                                    aria-controls="collapseTwo">
                                                    <i class="fas fa-flag-checkered"></i> Agregar o Editar una Zona de Entrega
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-center m-3">
                                                    <form id="menu" class="">
                                                        <div class="form-row">
                                                            <div class="col-md-12 col-lg-12">
                                                                <div class="position-relative form-group"><label>ID Zona de Entrega</label>
                                                                    <p id="id_zona" style="background-color: black; color:white;"></p>
                                                                    <small>La ZONA DE ENTREGA es un campo que se genera de forma automática.</small>
                                                                    <p id="instruccion_delivery" style="visibility: hidden;">crear</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-lg-12">
                                                                <div class="position-relative form-group"><label for="delivery_barrio" class="">Barrios o Vecindades comprendidas</label><input name="delivery_barrio" id="delivery_barrio"
                                                                        placeholder="Escribi los barrios o vecindades comprendidas separadas por una coma , " type="text" class="form-control">
                                                                </div>
                                                                 
                                                            </div>
                                                            
                                                            <div class="col-md-12 col-lg-12">
                                                                <div class="position-relative form-group"><label for="delivery_precio" class="">Costo del delivery</label><input name="delivery_precio" id="delivery_precio"
                                                                        placeholder="Escribi el costo / precio del delivery de esta zona " type="text"
                                                                        class="form-control">
                                                                </div> 
                                                            </div>
                                                            
                                                        </div>
                                                        <button class="btn-tb-en mt-2 btn btn-success">Guardar Zona</button>
                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <i class="fas fa-boxes"></i> Agregar o Editar Rappi Entregas
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-center m-3">
                                                    
                                                    <form id="rappi_entregas" class="" method="post"> 
                                                        <div class="col-md-12 col-lg-12">
                                                            <div class="position-relative form-group"><label for="delivery_rappi_usuario" class="">Usuario de Rappi Entregas</label><input
                                                                    name="delivery_rappi_usuario" id="delivery_rappi_usuario" placeholder="Escribi el usuario de Rappi Entregas"
                                                                    type="text" class="form-control">
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-12 col-lg-12">
                                                            <div class="position-relative form-group"><label for="delivery_rappi_psw" class="">Contraseña de Rappi Entregas</label><input name="delivery_rappi_psw" id="delivery_rappi_psw"
                                                                    placeholder="Escribi el password / contraseña de Rappi Entregas" type="text" class="form-control">
                                                            </div> 
                                                        </div> 
                                                        <button class="btn-rappi mt-2 btn btn-success" id="guardarRappi" type="button">Guardar</button>
                                                    </form>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- <a href="gestion_de_colores.html" class="btn btn-primary" style="color: white;"> Ir a configuración<br> de colores</a> -->
                        </div>
                    </div>

                </div>

            </div>
            <!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
        </div>
    </div>
    <script type="text/javascript" src="./assets/scripts/main.js"></script>
    
</body>

</html>