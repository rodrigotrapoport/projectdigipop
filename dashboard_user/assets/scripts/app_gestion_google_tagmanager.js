function cargarDatos(){
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_serv.php',
        type: 'POST',
        success: function (response) {
            console.log(response);
            const lineas = JSON.parse(response);
            
            console.log("JSON esta cargado!");
            json_datos = lineas.config;
            console.log(json_datos);
            $('#gtm_head').val(json_datos.analisis.googleTargetHead);
            $('#gtm_body').val(json_datos.analisis.googleTargetBody);
            
        }
    });
};

$(document).ready(function () {
    console.log("ready");
    cargarDatos();
    $('.btn-cal').click(function (e) {
        
        e.preventDefault();
        console.log("hiciste click en guardar");
        codigo_tmh = $('#gtm_head').val();
        codigo_tmb = $('#gtm_body').val();
        console.log(codigo_analytics);
        //Enviando los datos al PHP
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                codigo_tmh: codigo_tmh,
                codigo_tmb: codigo_tmb
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