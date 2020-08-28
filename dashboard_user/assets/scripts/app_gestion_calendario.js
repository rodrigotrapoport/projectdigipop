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
            $('#calendario_titulo').val(json_datos.calendario.titulo);
            $('#calendario_texto').val(json_datos.calendario.explicacion);
            $('#calendario_codigo').val(json_datos.calendario.script);
        }
    });
};

$(document).ready(function () {
    console.log("ready");
    cargarDatos();
    $('.btn-cal').click(function (e) {
        
        e.preventDefault();
        console.log("hiciste click en guardar");
        titulo = $('#calendario_titulo').val();
        texto = $('#calendario_texto').val();
        codigo = $('#calendario_codigo').val();
        
        console.log(titulo);
        console.log(texto);
        console.log(codigo);
        //Enviando los datos al PHP
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'POST',
            data: {
                calendario_titulo: titulo,
                calendarioExplicacion : texto,
                calendarioScript: codigo
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