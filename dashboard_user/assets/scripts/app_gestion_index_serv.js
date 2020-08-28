function cargarDatos() {
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_productos.php',
        type: 'POST',
        success: function (response) {
            console.log(response);
            const lineas = JSON.parse(response);

            console.log("JSON esta cargado!");
            principal = lineas.config.index;
            categorias = lineas.config.catSlide;
            console.log("Index obj: " + principal);
            console.log("Catslides obj: " + categorias);
            temp_option_cat = ``;
            for (i in categorias) {
                temp_option_cat += `<option value="categoria${categorias[i]['id']}">categoria${categorias[i]['id']}: ${categorias[i]['titulo']}</option>`;
            };
            temp_option_cat += `<option value="categoria${principal.categoriaSlide.id}" selected>categoria${principal.categoriaSlide.id}</option>`;
            $('#principal_slide_categoria').html(temp_option_cat);
            $('#principal_metodopago_titulo').val(principal.medPago.titulo);
            $('#principal_metodopago_subtitulo').val(principal.medPago.subtitulo);
            $('#principal_equipo_titulo').val(principal.equipo.titulo);
            $('#principal_equipo_subtitulo').val(principal.equipo.subtitulo);
            $('#principal_contadorexito_titulo').val(principal.contExito.titulo);
            $('#principal_contadorexito_subtitulo').val(principal.contExito.subtitulo);
            $('#principal_testimonios_titulo').val(principal.testimonios.titulo);
            $('#principal_testimonios_subtitulo').val(principal.testimonios.subtitulo);
            $('#principal_delivery_titulo').val(principal.delivery.titulo);
            $('#principal_delivery_subtitulo').val(principal.delivery.subtitulo);
        }
    });
};
$(document).ready(function () {
    console.log("ready");
    cargarDatos();
    $('.btn-pri').click(function (e) {
        e.preventDefault();
        console.log("hiciste click en guardar");
        slide = $('#principal_slide_categoria').val();
        pago_t = $('#principal_metodopago_titulo').val();
        pago_s = $('#principal_metodopago_subtitulo').val();
        equipo_t = $('#principal_equipo_titulo').val();
        equipo_s = $('#principal_equipo_subtitulo').val();
        ce_t = $('#principal_contadorexito_titulo').val();
        ce_s = $('#principal_contadorexito_subtitulo').val();
        testimonio_t = $('#principal_testimonios_titulo').val();
        testimonio_s = $('#principal_testimonios_subtitulo').val();
        delivery_t = $('#principal_delivery_titulo').val();
        delivery_s = $('#principal_delivery_subtitulo').val();

        console.log(slide);
        console.log(pago_t);
        console.log(pago_s);
        console.log(equipo_t);
        console.log(equipo_s);
        console.log(ce_t);
        console.log(ce_s);
        console.log(testimonio_t);
        console.log(testimonio_s);
        console.log(delivery_t);
        console.log(delivery_s);
        //Enviando los datos al PHP
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                principal_slide: slide,
                principal_pago_t: pago_t,
                principal_pago_s: pago_s,
                principal_equipo_t: equipo_t,
                principal_equipo_s: equipo_s,
                principal_ce_t: ce_t,
                principal_ce_s: ce_s,
                principal_testimonio_t: testimonio_t,
                principal_testimonio_s: testimonio_s,
                principal_delivery_t: delivery_t,
                principal_delivery_s: delivery_s

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