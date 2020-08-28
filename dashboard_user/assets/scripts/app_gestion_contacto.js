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
            $('#contacto_mail').val(json_datos.contacto.email);
            if (json_datos.contacto.formulario.nombre =="si"){
                $('#form1').attr('checked', true);
            }else{
                $('#form1').attr('checked', false);
            };
            if (json_datos.contacto.formulario.email == "si") {
                $('#form2').attr('checked', true);
            } else {
                $('#form2').attr('checked', false);
            };
            if (json_datos.contacto.formulario.telefono == "si") {
                $('#form3').attr('checked', true);
            } else {
                $('#form3').attr('checked', false);
            };
            if (json_datos.contacto.formulario.motivo == "si") {
                $('#form4').attr('checked', true);
            } else {
                $('#form4').attr('checked', false);
            };
            $('#contacto_tel').val(json_datos.contacto.telefono);
            $('#contacto_whatsapp').val(json_datos.contacto.whatsapp);
            $('#contacto_messenger').val(json_datos.contacto.linkMessenger);
            $('#contacto_facebook').val(json_datos.contacto.linkFacebook);
            $('#contacto_instagram').val(json_datos.contacto.linkInstagram);
            $('#contacto_twitter').val(json_datos.contacto.linkTwitter);
            $('#contacto_linkedin').val(json_datos.contacto.linkEdin);
        }
    });
};
$(document).ready(function () {
    console.log("ready");
    cargarDatos();
    $('.btn-con').click(function (e) {
        e.preventDefault();
        console.log("hiciste click en guardar");
        mail = $('#contacto_mail').val();
        form = $('#contacto_form').val();
        tel = $('#contacto_tel').val();
        whatsapp = $('#contacto_whatsapp').val();
        messenger = $('#contacto_messenger').val();
        facebook = $('#contacto_facebook').val();
        instagram = $('#contacto_instagram').val();
        twitter = $('#contacto_twitter').val();
        linkedin = $('#contacto_linkedin').val();
        
        console.log(mail);
        console.log(form);
        console.log(tel);
        console.log(whatsapp);
        console.log(messenger);
        console.log(facebook);
        console.log(instagram);
        console.log(twitter);
        console.log(linkedin);
        //Enviando los datos al PHP
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'POST',
            data: {
                contactoEmail   : mail,
                contactoFormulario: form,
                contactoTelefono: tel,
                contactoWhatsapp: whatsapp,
                contactolinkMessenger: messenger,
                contactolinkFacebook : facebook,
                contactolinkInstagram: instagram,
                contactolinkTwitter: twitter,
                contactolinkEdin: linkedin
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