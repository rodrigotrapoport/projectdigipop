function cargarServicios(){
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_serv.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            console.log("JSON esta cargado!");
            
            return temp_servicios;
        }
    });
    console.log("Afuera del AJAX " + temp_servicios);
    
};
function cargarDatos() {
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_serv.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            equipo = lineas.config.equipo;
            console.log("Equipo objetos: "+equipo);
            testimonios = lineas.config.testimonios;
            console.log("Testimonios objetos: "+testimonios);
            nosotros = lineas.config.nosotros;
            console.log("Nosotros Objeto: "+nosotros);
            console.log("Servicios objeto: " + lineas.servicios);
            template_equipo = ``;
            templete_testimonios = ``; 
            console.log("JSON esta cargado!")
            for (i in equipo) { 
                    template_equipo += `
                                <tr idEquipo="${equipo[i]['id']}">
                                    <td>miembro${equipo[i]['id']}</td>
                                    <td>${equipo[i]['nombre']}</td>
                                    <td>${equipo[i]['rol']}</td>
                                    <td>${equipo[i]['texto']}</td>
                                    <td><img src="${equipo[i]['foto']}" class="img-thumbnail" width="30%" alt=""></td>
                                    <td><a href="${equipo[i]['linkedin']}" target="_blank">${equipo[i]['linkedin']}</a></td>
                                    <td><a href="${equipo[i]['facebook']}" target="_blank">${equipo[i]['facebook']}</a></td>
                                    <td><a href="${equipo[i]['instagram']}" target="_blank">${equipo[i]['instagram']}</a></td>
                                    <td><a href="${equipo[i]['email']}" target="_blank">${equipo[i]['email']}</a></td>
                                    <td>${equipo[i]['categoria']}</td>
                                    <td>
                                        <a href="#collapseOne" class="btn_edit_eq"><i class="fas fa-edit" style="color:blue;"></i></a> 
                                        <a href="#collapseOne" class="btn_del_eq"><i class="fas fa-trash-alt" style="color:red;"></i></a> 
                                        <a href="#collapseOne" class="btn_cop_eq"><i class="fas fa-copy" style="color:orange;"></i></a>
                                    </td>
                                </tr>`; 
                /* Para tomar el último ID de Categoria */
                id_equipo_ultimo = `${equipo[i]['id']}`;   
            };
            /* Para imprimir listo el nuevo ID Categoria */
            indice_new_eq = parseInt(id_equipo_ultimo) + 1;
            nuevo_miembro = "miembro" + indice_new_eq;
            /* Para generar lista de Servicios */
            json_datos = lineas.servicios;
            console.log(json_datos);
            temp_servicios = ``;
            for (iserv in json_datos) {
                if (json_datos[iserv]['visibilidad'] == "si") {
                    temp_servicios += `<option value="servicio${json_datos[iserv]['id']}">servicio${json_datos[iserv]['id']}</option> `;
                    console.log(temp_servicios);
                };
            };
            template_servicios = temp_servicios;
            console.log("Template Servicios: "+ template_servicios);
            /* Para generar lista de Testimonios */ 
            for (z in testimonios) {  
                templete_testimonios += `
                                        <tr idTestimonio="${testimonios[z]['id']}">
                                            <td>${testimonios[z]['id']}</td>
                                            <td>${testimonios[z]['nombreUsuario']}</td>
                                            <td>${testimonios[z]['socialFuente']}</td>
                                            <td><a href="${testimonios[z]['socialLink']}" target="_blank">${testimonios[z]['socialLink']}</a></td>
                                            <td><img src="${testimonios[z]['foto']}" class="img-thumbnail" width="30%" alt=""></td>
                                            <td>${testimonios[z]['comentario']}</td>
                                            
                                            
                                            <td>${testimonios[z]['estrellas']}</td>
                                            <td>${testimonios[z]['categoria']}</td>
                                            <td>
                                                <a href="#collapseTwo" class="btn_edit_te"><i class="fas fa-edit" style="color:blue;"></i></a> 
                                                <a href="#collapseTwo" class="btn_del_te"><i class="fas fa-trash-alt" style="color:red;"></i></a> 
                                                <a href="#collapseTwo" class="btn_cop_te"><i class="fas fa-copy" style="color:orange;"></i></a>
                                            </td>
                                        </tr>
                        `;
                id_cliente_ultimo = `${testimonios[z]['id']}`;      
            };
            console.log("El template de Tabla Testimonio: "+templete_testimonios);
            indice_new_tes = parseInt(id_cliente_ultimo) + 1;
            nuevo_cliente = "cliente" + indice_new_tes;
            // Armar los datos pre-cargados en Nosotros
            qofrecemos = `${nosotros['qOfrecemos']}`;
            if (qofrecemos != ""){
                $('#nosotros_ofrecemos').val(qofrecemos);
            };
            diferencial = `${nosotros['diferencial']}`;
            if (diferencial != "") {
                $('#nosotros_diferencial').val(diferencial);
            };
            valores = `${nosotros['valores']}`;
            if (valores != "") {
                $('#nosotros_valores').val(valores);
            };
            vision = `${nosotros['vision']}`;
            if (vision != "") {
                $('#nosotros_futuro').val(vision);
            };
            foto1 = `${nosotros['foto1']}`;
            if (foto1 != "") {
                $('#foto1').val(foto1);
            };
            foto2 = `${nosotros['foto2']}`;
            if (foto2 != "") {
                $('#foto2').val(foto2);
            };
            foto3 = `${nosotros['foto3']}`;
            if (foto3 != "") {
                $('#foto3').val(foto3);
            };
            foto4 = `${nosotros['foto4']}`;
            if (foto4 != "") {
                $('#foto4').val(foto4);
            };
            /* Ingresar los valores pre-cargados en la sección Agregar o Editar Categoria */ 
            $('#tabla_equipo').html(template_equipo);
            $('#instruccion_equipo').text("crear");
            $('#id_miembro').text(nuevo_miembro); 
            $('#equipo_serv_relacionado').html(template_servicios);
            $('#tabla_testimonios').html(templete_testimonios);
            $('#testimonio_relacionado').html(template_servicios);
            $('#id_cliente').text(nuevo_cliente);    
        }
    })
};

// BOTONES
/* Función Editar Equipo */
$(document).on('click', '.btn_edit_eq', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_editar_equipo = $(element).attr('idEquipo');
    console.log("ID editar Equipo "+id_editar_equipo);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_serv.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            equipo = lineas.config.equipo;
            console.log("Equipo objetos: " + equipo);
            console.log("Servicios objeto: " + lineas.servicios); 
            console.log("JSON esta cargado!");
            editar_miembro = "miembro" + parseInt(id_editar_equipo);
            /* Para generar lista de Servicios */
            json_datos = lineas.servicios;
            console.log(json_datos);
            tempe_servicios = ``;
            for (iv in json_datos) {
                if (json_datos[iv]['visibilidad'] == "si") {  
                        tempe_servicios += `<option value="servicio${json_datos[iv]['id']}">servicio${json_datos[iv]['id']}</option> `;
                        console.log(tempe_servicios); 
                };
            };
            tempe_servicios += `<option value="${equipo[editar_miembro]['categoria']}" selected>${equipo[editar_miembro]['categoria']}</option> `;
            nombre = `${equipo[editar_miembro]['nombre']}`;
            rol = `${equipo[editar_miembro]['rol']}`;
            texto = `${equipo[editar_miembro]['texto']}`;
            foto = `${equipo[editar_miembro]['foto']}`;
            linkedin = `${equipo[editar_miembro]['linkedin']}`;
            facebook = `${equipo[editar_miembro]['facebook']}`;
            instagram = `${equipo[editar_miembro]['instagram']}`;
            email = `${equipo[editar_miembro]['email']}`;
            /* Ingresar los valores pre-cargados en la sección Agregar o Editar Categoria */
            $('#id_miembro').text(editar_miembro);
            $('#instruccion_equipo').text("editar");
            $('#equipo_serv_relacionado').html(tempe_servicios);
            $('#equipo_nombre').val(nombre);
            $('#equipo_rol').val(rol);
            $('#equipo_texto').val(texto);
            $('#equipo_linkedin').val(linkedin);
            $('#equipo_facebook').val(facebook);
            $('#equipo_instagram').val(instagram);
            $('#equipo_mail').val(email);
            $('#equipo_imagen').val(foto);
        }
    })  
});
/* Función Borrar Equipo */
$(document).on('click', '.btn_del_eq', function () {
    let element = $(this)[0].parentElement.parentElement;
    var id_borrar_equipo = $(element).attr('idEquipo');
    console.log("ID borrar Equipo " +id_borrar_equipo);
    var mensaje = confirm("¿Estas seguro que quieres borrarlo?");
    if (mensaje){
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                id_miembro: id_borrar_equipo,
                instruccion_equipo: "borrar",
                nombre_equipo : "",
                rol_equipo :  "",
                texto_equipo : "",
                foto_equipo : "",
                linkedin_equipo : "",
                facebook_equipo : "",
                instagram_equipo : "",
                email_equipo : ""
            },
            success: function (response1) {
                console.log(response1);
                if (response1 == '"OK"') {
                    console.log("Ingreso al IF  " + response1);
                    cargarDatos();
                } else {
                    console.log("Error en guardar categoria");
                };
            }
        });
    } else{
        console.log("Cancelaste el borrado del miembro");
    };   
});
/* Función Copiar Equipo */
$(document).on('click', '.btn_cop_eq', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_copiar_equipo = $(element).attr('idEquipo');
    console.log("ID copiar Equipo "+id_copiar_equipo);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_serv.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            equipo = lineas.config.equipo;
            console.log("Equipo objetos: " + equipo);
            console.log("Servicios objeto: " + lineas.servicios);
            console.log("JSON esta cargado!");
            id_equipo_ultimo=``;
            for (wi in equipo) {  
                id_equipo_ultimo = `${equipo[wi]['id']}`;
            };
            newid = parseInt(id_equipo_ultimo)+1;
            copiar_miembro = "miembro" + id_copiar_equipo;
            crear_miembro = "miembro" + newid;
            /* Para generar lista de Servicios */
            json_datos = lineas.servicios;
            console.log(json_datos);
            tempe_servicios = ``;
            for (ivz in json_datos) {
                if (json_datos[ivz]['visibilidad'] == "si") { 
                        tempe_servicios += `<option value="servicio${json_datos[ivz]['id']}">servicio${json_datos[ivz]['id']}</option> `;
                        console.log(tempe_servicios); 
                };
            };
            tempe_servicios += `<option value="${equipo[copiar_miembro]['categoria']}" selected>${equipo[copiar_miembro]['categoria']}</option> `;
            nombre = `${equipo[copiar_miembro]['nombre']}`;
            rol = `${equipo[copiar_miembro]['rol']}`;
            texto = `${equipo[copiar_miembro]['texto']}`;
            foto = `${equipo[copiar_miembro]['foto']}`;
            linkedin = `${equipo[copiar_miembro]['linkedin']}`;
            facebook = `${equipo[copiar_miembro]['facebook']}`;
            instagram = `${equipo[copiar_miembro]['instagram']}`;
            email = `${equipo[copiar_miembro]['email']}`;
            /* Ingresar los valores pre-cargados en la sección Agregar o Editar Categoria */
            $('#id_miembro').text(crear_miembro);
            $('#instruccion_equipo').text("crear");
            $('#equipo_serv_relacionado').html(tempe_servicios);
            $('#equipo_nombre').val(nombre);
            $('#equipo_rol').val(rol);
            $('equipo_texto').val(texto);
            $('#equipo_linkedin').val(linkedin);
            $('#equipo_facebook').val(facebook);
            $('#equipo_instagram').val(instagram);
            $('#equipo_mail').val(email);
            $('#equipo_imagen').val(foto);
        }
    })

});
/* Función Editar Testimonio */
$(document).on('click', '.btn_edit_te', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_editar_testimonio = $(element).attr('idTestimonio');
    console.log("ID editar Testimonio " +id_editar_testimonio);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_serv.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            testimonios = lineas.config.testimonios;
            console.log("Equipo objetos: " + testimonios);
            console.log("Servicios objeto: " + lineas.servicios);
            console.log("JSON esta cargado!");
            editar_cliente = "cliente" + parseInt(id_editar_testimonio);
            /* Para generar lista de Servicios */
            json_datos = lineas.servicios;
            console.log(json_datos);
            tempe_servicios = ``;
            for (iv in json_datos) {
                if (json_datos[iv]['visibilidad'] == "si") {
                    tempe_servicios += `<option value="servicio${json_datos[iv]['id']}">servicio${json_datos[iv]['id']}</option> `;
                    console.log(tempe_servicios);
                };
            };
            tempe_servicios += `<option value="${testimonios[editar_cliente]['categoria']}" selected>${testimonios[editar_cliente]['categoria']}</option> `;
            nombre = `${testimonios[editar_cliente]['nombreUsuario']}`;
            medio = `${testimonios[editar_cliente]['socialFuente']}`;
            link = `${testimonios[editar_cliente]['socialLink']}`;
            comentario = `${testimonios[editar_cliente]['comentario']}`;
            imagen = `${testimonios[editar_cliente]['foto']}`;
            calificacion = ``;
            for(num=1; num<6;num++){
               calificacion+= `<option value="${num}">${num}</option>`;
            };
            calificacion += `<option value="${testimonios[editar_cliente]['estrellas']}" selected>${testimonios[editar_cliente]['estrellas']}</option>`;
            /* Ingresar los valores pre-cargados en la sección Agregar o Editar Categoria */
            $('#id_cliente').text(editar_cliente);
            $('#instruccion_testimonio').text("editar");  
            $('#testimonio_nombre').val(nombre);
            $('#testimonio_medio').val(medio);
            $('#testimonio_link').val(link);
            $('#testimonio_comentario').val(comentario);
            $('#testimonio_relacionado').html(tempe_servicios);
            $('#testimonio_cal').html(calificacion);
            $('#testimonio_imagen').val(imagen);
            
        }
    })
     
});
/* Función Borrar Testimonio */
$(document).on('click', '.btn_del_te', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_borrar_testimonio = $(element).attr('idTestimonio');
    console.log("ID borrar Testimonio " +id_borrar_testimonio);
    var mensaje = confirm("¿Estas seguro que quieres borrarlo?");
    if (mensaje) {
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                id_testimonio: id_borrar_testimonio,
                instruccion_testimonio: "borrar",
                nombre_testimonio: "",
                medio_testimonio: "",
                link_testimonio: "",
                comentario_testimonio: "",
                relacion_testimonio: "",
                calificacion_testimonio: "",
                imagen_testimonio: "" 
            },
            success: function (response1) {
                console.log(response1);
                if (response1 == '"OK"') {
                    console.log("Ingreso al IF  " + response1);
                    cargarDatos();
                } else {
                    console.log("Error en guardar categoria");
                };
            }
        });
    } else {
        console.log("Cancelaste el borrado del miembro");
    };
});
/* Función Copiar Testimonio */
$(document).on('click', '.btn_cop_te', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_copiar_testimonio = $(element).attr('idTestimonio');
    console.log("ID copiar Testimonio " +id_copiar_testimonio);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_serv.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            testimonios = lineas.config.testimonios;
            console.log("Equipo objetos: " + testimonios);
            console.log("Servicios objeto: " + lineas.servicios);
            console.log("JSON esta cargado!"); 
            id_cliente_ultimo = ``;
            for (oi in testimonios) {
                id_cliente_ultimo = `${testimonios[oi]['id']}`;
            };
            newid = parseInt(id_cliente_ultimo) + 1;
            copiar_cliente = "cliente" + parseInt(id_copiar_testimonio);
            crear_cliente = "cliente" + newid;
            /* Para generar lista de Servicios */
            json_datos = lineas.servicios;
            console.log(json_datos);
            tempe_servicios = ``;
            for (iv in json_datos) {
                if (json_datos[iv]['visibilidad'] == "si") {
                    tempe_servicios += `<option value="servicio${json_datos[iv]['id']}">servicio${json_datos[iv]['id']}</option> `;
                    console.log(tempe_servicios);
                };
            };
            tempe_servicios += `<option value="${testimonios[copiar_cliente]['categoria']}" selected>${testimonios[copiar_cliente]['categoria']}</option> `;
            nombre = `${testimonios[copiar_cliente]['nombreUsuario']}`;
            medio = `${testimonios[copiar_cliente]['socialFuente']}`;
            link = `${testimonios[copiar_cliente]['socialLink']}`;
            comentario = `${testimonios[copiar_cliente]['comentario']}`;
            imagen = `${testimonios[copiar_cliente]['foto']}`;
            calificacion = ``;
            for (num = 1; num < 6; num++) {
                calificacion += `<option value="${num}">${num}</option>`;
            };
            calificacion += `<option value="${testimonios[copiar_cliente]['estrellas']}" selected>${testimonios[copiar_cliente]['estrellas']}</option>`;
            /* Ingresar los valores pre-cargados en la sección Agregar o Editar Categoria */
            $('#id_cliente').text(crear_cliente);
            $('#instruccion_testimonio').text("crear");
            $('#testimonio_nombre').val(nombre);
            $('#testimonio_medio').val(medio);
            $('#testimonio_link').val(link);
            $('#testimonio_comentario').val(comentario);
            $('#testimonio_relacionado').html(tempe_servicios);
            $('#testimonio_cal').html(calificacion);
            $('#testimonio_imagen').val(imagen);

        }
    })
});
$(document).ready(function () {
    cargarDatos();
    $('.btn-eq').click(function (e) {
        console.log("Hiciste click en el boton Guardar Miembro");
        id_equipo = $('#instruccion_equipo').text()
        instruccion_eq = $('#instruccion_equipo').text();
        miembro_nombre = $('#equipo_nombre').val();
        miembro_rol = $('#equipo_rol').val();
        miembro_texto = $('equipo_texto').val();
        miembro_foto = $('#equipo_imagen').val();
        miembro_linkedin = $('#equipo_linkedin').val();
        miembro_facebook = $('#equipo_facebook').val();
        miembro_instagram = $('#equipo_instagram').val();
        miembro_email = $('#equipo_mail').val();
        serv_relacion= $('#equipo_serv_relacionado').val();
        console.log(id_equipo);
        console.log(instruccion_eq);
        console.log(miembro_nombre);
        console.log(miembro_rol);
        console.log(miembro_texto);
        console.log(miembro_foto);
        console.log(miembro_linkedin);
        console.log(miembro_facebook);
        console.log(miembro_instagram);
        console.log(miembro_email);
        e.preventDefault();
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                id_miembro: id_equipo,
                instruccion_equipo: instruccion_eq,
                nombre_equipo: miembro_nombre,
                rol_equipo: miembro_rol,
                texto_equipo: miembro_texto,
                foto_equipo: miembro_foto,
                linkedin_equipo: miembro_linkedin,
                facebook_equipo: miembro_facebook,
                instagram_equipo: miembro_instagram,
                email_equipo: miembro_email,
                categoria_equipo: serv_relacion
            },
            success: function (response) {
                console.log(response);
                if ( response == '"OK"'){
                    console.log("Ingreso al IF  " + response);
                    cargarDatos();
                }else{
                    console.log("Error en guardar categoria");
                };
            }
        });   
        
    });
    $('.btn-te').click(function (e) {
        id_cliente = $('#id_cliente').text();
        instruccion_testimonio = $('#instruccion_testimonio').text();
        nombre_testimonio = $('#testimonio_nombre').val();
        medio_testimonio = $('#testimonio_medio').val();
        link_testimonio=$('#testimonio_link').val();
        comentario_testimonio= $('#testimonio_comentario').val();
        relacion_testimonio= $('#testimonio_relacionado').html();
        calif_testimonio = $('#testimonio_cal').val();
        imagen_testimonio= $('#testimonio_imagen').val();
        console.log(id_cliente);
        console.log(instruccion_testimonio);
        console.log(nombre_testimonio);
        console.log(medio_testimonio);
        console.log(link_testimonio);
        console.log(comentario_testimonio);
        console.log(relacion_testimonio);
        console.log(calif_testimonio);
        console.log(imagen_testimonio);
        e.preventDefault();
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                id_testimonio : id_cliente,
                instruccion_testimonio : instruccion_testimonio,
                nombre_testimonio : nombre_testimonio,
                medio_testimonio : medio_testimonio,
                link_testimonio : link_testimonio,
                comentario_testimonio : comentario_testimonio,
                relacion_testimonio : relacion_testimonio,
                calificacion_testimonio : calif_testimonio,
                imagen_testimonio : imagen_testimonio 
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
    $('.btn-nos').click(function (e) {
        nosotros_ofrecemos =   $('#nosotros_ofrecemos').val(qofrecemos);
        nosotros_deferencial =    $('#nosotros_diferencial').val(diferencial);
        nosotros_valores =    $('#nosotros_valores').val(valores);
        nosotros_futuro =    $('#nosotros_futuro').val(vision);
        nosotros_f1 =    $('#foto1').val(foto1); 
        nosotros_f2=    $('#foto2').val(foto2);
        nosotros_f3 =    $('#foto3').val(foto3); 
        nosotros_f4 =    $('#foto4').val(foto4);
        console.log(nosotros_ofrecemos);
        console.log(nosotros_deferencial);
        console.log(nosotros_valores);
        console.log(nosotros_futuro);
        console.log(nosotros_f1);
        console.log(nosotros_f2);
        console.log(nosotros_f3);
        console.log(nosotros_f4);
        e.preventDefault();
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                nosotros_ofrecemos: nosotros_ofrecemos,
                nosotros_deferencial: nosotros_deferencial,
                nosotros_valores: nosotros_valores,
                nosotros_futuro: nosotros_futuro,
                nosotros_f1: nosotros_f1,
                nosotros_f2: nosotros_f2,
                nosotros_f3: nosotros_f3,
                nosotros_f4: nosotros_f4
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