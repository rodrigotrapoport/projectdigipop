function cargarDatos() {
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_serv.php',
        type: 'POST',
        success: function (response) {
            console.log(response);
            const lineas = JSON.parse(response);

            console.log("JSON esta cargado!");
            json_datos = lineas.config;
            console.log(json_datos);
            $('#codigo_messenger').val(json_datos.analisis.facebookMessenger);
        }
    });
};
$(document).ready(function () {
    console.log("ready");
    cargarDatos();
    $('.btn-fb-ms').click(function (e) {
        e.preventDefault();
        console.log("hiciste click en guardar");
        codigo_messenger = $('#codigo_messenger').val(); 
        console.log(codigo_messenger);
       
        //Enviando los datos al PHP
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                codigo_messenger: codigo_messenger
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