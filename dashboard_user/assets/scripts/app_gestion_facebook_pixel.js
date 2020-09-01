$(document).ready(function () {
    console.log("ready");
    $('.btn-fb-ms').click(function (e) {
        e.preventDefault();
        console.log("hiciste click en guardar");
        codigo_pixel = $('#codigo_pixel').val(); 
        console.log(codigo_pixel);
       
        //Enviando los datos al PHP
        
        ///// RUTA  A LA CARPETA DE LA TIENDA ///////
        var tienda = 'Rodrigo';
	    var ruta = '../ecommerce/' + tienda +'/config/assets/php/guardar_JSON.php' ;
	    
        $.ajax({
            url: ruta, // 'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                codigo_pixel: codigo_pixel
            },
            success: function (response) {
                console.log(response);
                if (response == '"OK"') {
                    console.log("Ingreso al IF  " + response);
                    cargarDatos();
                } else {
                    console.log("Error en guardar categoria");
                };
            }
        });

    });
});