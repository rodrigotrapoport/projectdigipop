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
            $('#codigo_mapa').val(json_datos.analisis.googleMaps);
            code_map = `<iframe src="${json_datos.analisis.googleMaps}"></iframe>`;
            $('#mostrar_mapa').html(code_map);
        }
    });
};

$(document).ready(function () {
    console.log("ready");
    cargarDatos();
    $('.btn-cal').click(function (e) {
        
        e.preventDefault();
        console.log("hiciste click en guardar");
        mapa = $('#codigo_mapa').val();
        console.log(mapa);
       
        //Enviando los datos al PHP
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                mapa_codigo: mapa
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