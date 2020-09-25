function cargarDatos() {
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_serv.php',
        type: 'POST',
        success: function (response) { 
            const lineas = JSON.parse(response);
            console.log("JSON esta cargado!");
            json_datos = lineas.servicios;
            catslides = lineas.catslides;
            console.log (json_datos);
            console.log("Soy catslides"+catslides);
            template_servicios =``;
            temp_testimonios = ``;
            temp_equipo = ``;
            temp_op_testimonios = ``;
            temp_op_equipo = ``; 
            temp_slides = ``; 
            for (j in catslides){
                console.log(catslides[j]['visibilidades']);
                if (catslides[j]['visibilidades'] == "si"){
                    temp_slides += `<option value="${catslides[j]['titulo']}">${catslides[j]['titulo']}</option>`; 
                    console.log("TEMP SLIDES acum: " + temp_slides);
                };
            }; 
            for (i in json_datos){
                if (json_datos[i]['visibilidad'] == "si") {
                    for(z in json_datos[i]['testimonio']){
                                temp_testimonios +=`-${json_datos[i]['testimonio'][z]['cliente']}-`;
                    };
                    for (y in json_datos[i]['equipo']) {
                        temp_equipo += `-${json_datos[i]['equipo'][y]['miembro']}-`;
                    };
                    template_servicios += `
                                        <tr idServ="${json_datos[i]['id']}">
                                            <td> ${json_datos[i]['id']} </td>
                                            <td> ${json_datos[i]['nombre']} </td>
                                            <td> ${json_datos[i]['descripcion']} </td>
                                            <td> ${json_datos[i]['condi']}</td>
                                            <td> ${json_datos[i]['precioA']}</td>
                                            <td> ${json_datos[i]['precioB']}</td>
                                            <td> ${json_datos[i]['moneda']}</td>
                                            <td> ${json_datos[i]['mostrarPrecio']}</td>
                                            <td>  ${temp_testimonios} </td>
                                            <td> ${temp_equipo} </td>
                                            <td> ${json_datos[i]['slide']} </td>
                                            <td> ${json_datos[i]['prioridad']} </td>
                                            <td> <img class="img-thumbnail" width="30%" src="${json_datos[i]['foto']}"> </td>
                                    
                                            <td>
                                                <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn_edit_serv"><i class="fas fa-edit" style="color:blue;"></i></a> 
                                                <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn_del_serv"><i class="fas fa-trash-alt" style="color:red;"></i></a> 
                                                <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn_cop_serv"><i class="fas fa-copy" style="color:orange;"></i></a>
                                            </td>
                                        </tr>`; 
                };
                id_ultimo = `${json_datos[i]['id']}`;
                temp_testimonios = ``;  
                temp_equipo = ``; 
                
                for (q in json_datos[i]['testimonio']) {
                    temp_op_testimonios += `<option value="${json_datos[i]['testimonio'][q]['cliente']}">${json_datos[i]['testimonio'][q]['cliente']}</option>`;
                };
                for (p in json_datos[i]['equipo']) {
                    temp_op_equipo += `<option value="${json_datos[i]['equipo'][p]['miembro']}">${json_datos[i]['equipo'][p]['miembro']}</option>`;
                };
                
            };
            $('#tabla_servicios').html(template_servicios);
            id_ultimo_temp = parseInt(id_ultimo) + 1;
            id_ultimo_imp = "servicio"+id_ultimo_temp;
            $('#id_servicio').html(id_ultimo_imp);
            $('#servicios_testimonios').html(temp_op_testimonios);
            $('#servicios_equipo').html(temp_op_equipo);
            $('#servicio_slider').html(temp_slides);
            $('#instruccion_serv').text("crear");
        }
    });
};
/* Función Editar Servicio */
$(document).on('click', '.btn_edit_serv', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_editar = $(element).attr('idServ');
    console.log("ID servicio a Editar: "+id_editar);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_serv.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            console.log("JSON esta cargado!");
            json_datos = lineas.servicios; 
            catslides = lineas.catslides;
            console.log(json_datos);
            id_servicio_editar = "servicios" + id_editar;
            nombre=`${json_datos[id_servicio_editar]['nombre']}`;
            descripcion = `${json_datos[id_servicio_editar]['descripcion']}`;
            condi = `${json_datos[id_servicio_editar]['condi']}`;
            precioA = `${json_datos[id_servicio_editar]['precioA']}`;
            precioB = `${json_datos[id_servicio_editar]['precioB']}`;
            moneda = `${json_datos[id_servicio_editar]['moneda']}`;
            mostrarPrecio = `${json_datos[id_servicio_editar]['mostrarPrecio']}`;
            slide = `${json_datos[id_servicio_editar]['slide']}`;
            prioridad = `${json_datos[id_servicio_editar]['prioridad']}`;
            console.log(id_servicio_editar);
            console.log(nombre);
            console.log(descripcion);
            console.log(condi);
            console.log(precioA);
            console.log(precioB);
            console.log(moneda);
            console.log(mostrarPrecio);
            console.log(slide);
            console.log(prioridad);
            /* Armado de Slides */ 
            tp_slides = ``;
            for (j in catslides) {
                if (catslides[j]['visibilidades'] == "si") {
                    tp_slides += `<option value="${catslides[j]['titulo']}">${catslides[j]['titulo']}</option>`;
                    console.log(tp_slides);
                };
            };
            tp_slides += `<option value="${json_datos[id_servicio_editar]['slide']}" selected>${json_datos[id_servicio_editar]['slide']}</option>`;
            console.log(tp_slides);
            /* Armado de Testimonios */
            tp_testimonios = ``;
            for (idf in json_datos) {
                if (json_datos[idf]['visibilidad'] == "si") {
                    for (zdf in json_datos[idf]['testimonio']) {
                        if (json_datos[id_servicio_editar]['testimonio'] != json_datos[idf]['testimonio']) {
                            tp_testimonios += `<option value = "${json_datos[idf]['testimonio'][zdf]['cliente']}"> ${json_datos[idf]['testimonio'][zdf]['cliente']}</option>`;
                            console.log("Testimonios: "+tp_testimonios);
                        };
                    };
                };
            };
            for (qa in json_datos[id_servicio_editar]['testimonio']) {
                tp_testimonios += `<option value="${json_datos[id_servicio_editar]['testimonio'][qa]['cliente']}" selected>${json_datos[id_servicio_editar]['testimonio'][qa]['cliente']}</option>`;
                console.log("Testimonios: "+tp_testimonios);
            };
            console.log("Testimonios final: " + tp_testimonios);
            /* Armado de Equipos */
            tp_equipos = ``;
            for (iz in json_datos) {
                if (json_datos[iz]['visibilidad'] == "si") {
                    for (zz in json_datos[iz]['equipo']) {
                        if (json_datos[id_servicio_editar]['equipo'] != json_datos[iz]['equipo']) {
                            tp_equipos += `<option value = "${json_datos[iz]['equipo'][zz]['miembro']}"> ${json_datos[iz]['equipo'][zz]['miembro']}</option>`;
                            console.log(tp_equipos);
                        };
                    };
                };
            };
            for (qz in json_datos[id_servicio_editar]['equipo']) {
                tp_equipos += `<option value="${json_datos[id_servicio_editar]['equipo'][qz]['miembro']}" selected>${json_datos[id_servicio_editar]['equipo'][qz]['miembro']}</option>`;
                console.log(tp_equipos);
            };
            /* Armado de Prioridad */
            if (prioridad == "Alta") {
                tp_prioridad = `
                            <option value="Alta" selected>Alta</option>
                            <option value="Ninguna">Ninguna</option>
                        `;
            } else {
                tp_prioridad = `
                            <option value="Alta">Alta</option>
                            <option value="Ninguna" selected>Ninguna</option>
                        `;
            };
            /* Armado de Mostrar o no precio */
            if (mostrarPrecio == "si") {
                tp_mostrarPrecio = `
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="si_mostrar" id="si_mostrar" value="true" checked>
                                <label class="form-check-label" for="si_mostrar">
                                    Si quiero mostrar precio de referencia.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="no_mostrar" id="no_mostrar" value="false">
                                <label class="form-check-label" for="no_mostrar">
                                    No, quiero que los clientes me llamen para pedirme presupuestos especificos.
                                </label>
                            </div>
                        `;
            } else {
                tp_mostrarPrecio = `
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="si_mostrar" id="si_mostrar" value="true" >
                                <label class="form-check-label" for="si_mostrar">
                                    Si quiero mostrar precio de referencia.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="no_mostrar" id="no_mostrar" value="false" checked>
                                <label class="form-check-label" for="no_mostrar">
                                    No, quiero que los clientes me llamen para pedirme presupuestos especificos.
                                </label>
                            </div>
                        `;
            };
            
            //Imprimiendo en el HTMl
            $('#id_servicio').html(id_servicio_editar);
            $('#servicios_testimonios').html(tp_testimonios);
            $('#servicios_equipo').html(tp_equipos);
            $('#servicio_slider_prioridad').html(tp_prioridad);
            $('#servicio_slider').html(tp_slides);
            $('#nombre_servicio').val(nombre);
            $('#servicio_descripcion').val(descripcion);
            $('#servicio_condiciones').val(condi);
            $('#precio_anterior').val(precioA);
            $('#precio_actual').val(precioB);
            $('#moneda').val(moneda);
            $('#sub_mostrarPrecio').html(tp_mostrarPrecio);
            $('#instruccion_serv').text("editar");
        }
    });
});
/* Función Borrar Servicio */
$(document).on('click', '.btn_del_serv', function () {
    let element = $(this)[0].parentElement.parentElement;
    var id_borrar = $(element).attr('idServ');
    console.log("ID Servicio a borrar: "+id_borrar);
    //Confirmación de pedido de borrado
    var mensaje = confirm("¿Estas seguro que quieres borrarlo?");
    if (mensaje) {
	    
	    ///// RUTA  A LA CARPETA DE LA TIENDA ///////
        var tienda = 'Rodrigo';
	    var ruta = '../ecommerce/' + tienda +'/config/assets/php/guardar_JSON.php' ;
	    
        $.ajax({
            url: ruta, //'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                id_nueva_cat: id_borrar,
                instruccion_cat: "borrar",
                slide: "",
                prioridad: ""
            },
            success: function (response1) {
                console.log(response1);
                if (response1 == '"OK"') {
                    console.log("Ingreso al IF  " + response1);
                    cargarDatos();
                } else {
                    console.log("Error en borrar el servicio");
                };
            }
        });
        
    } else {
        console.log("Cancelaste el borrado del servicio");
    };
    //Envio de datos al PHP
    

});
/* Función Copiar Servicio */
$(document).on('click', '.btn_cop_serv', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_copiar = $(element).attr('idServ');
    console.log("ID Servicio a Copiar: " + id_copiar);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_serv.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            console.log("JSON esta cargado!");
            json_datos = lineas.servicios;
            //Captura del ultimo servicio
            for (tinz in json_datos) {
                id_ultimo = `${json_datos[tinz]['id']}`;
            };
            id_ultimo_temp = parseInt(id_ultimo) + 1;
            id_ultimo_imp = "servicio" + id_ultimo_temp;
            console.log("El último servicio a crear es: " + id_ultimo_imp);
            
            //Datos para copiar
            id_servicio_copiar = "servicios" + id_copiar;
            nombre = `${json_datos[id_servicio_copiar]['nombre']}`;
            descripcion = `${json_datos[id_servicio_copiar]['descripcion']}`;
            condi = `${json_datos[id_servicio_copiar]['condi']}`;
            precioA = `${json_datos[id_servicio_copiar]['precioA']}`;
            precioB = `${json_datos[id_servicio_copiar]['precioB']}`;
            moneda = `${json_datos[id_servicio_copiar]['moneda']}`;
            mostrarPrecio = `${json_datos[id_servicio_copiar]['mostrarPrecio']}`;
            slide = `${json_datos[id_servicio_copiar]['slide']}`;
            prioridad = `${json_datos[id_servicio_copiar]['prioridad']}`;
            console.log(id_servicio_copiar);
            console.log(nombre);
            console.log(descripcion);
            console.log(condi);
            console.log(precioA);
            console.log(precioB);
            console.log(moneda);
            console.log(mostrarPrecio);
            console.log(slide);
            console.log(prioridad);
            /* Armado de Testimonios */
            tpc_testimonios = ``;
            for (iitem in json_datos) {
                if (json_datos[iitem]['visibilidad'] == "si") {
                    for (zitem in json_datos[iitem]['testimonio']) {
                        if (json_datos[id_servicio_copiar]['testimonio'] != json_datos[iitem]['testimonio']) {
                            tpc_testimonios += `<option value = "${json_datos[iitem]['testimonio'][zitem]['cliente']}"> ${json_datos[iitem]['testimonio'][zitem]['cliente']}</option>`;
                            console.log("Testimonios: " + tpc_testimonios);
                        };
                    };
                };
            };
            for (itemqa in json_datos[id_servicio_copiar]['testimonio']) {
                tpc_testimonios += `<option value="${json_datos[id_servicio_copiar]['testimonio'][itemqa]['cliente']}" selected>${json_datos[id_servicio_copiar]['testimonio'][itemqa]['cliente']}</option>`;
                console.log("Testimonios: " + tpc_testimonios);
            };
            /* Armado de Equipos */
            tpc_equipos = ``;
            for (itemiz in json_datos) {
                if (json_datos[itemiz]['visibilidad'] == "si") {
                    for (itemzz in json_datos[itemiz]['equipo']) {
                        if (json_datos[id_servicio_copiar]['equipo'] != json_datos[itemiz]['equipo']) {
                            tpc_equipos += `<option value = "${json_datos[itemiz]['equipo'][itemzz]['miembro']}"> ${json_datos[itemiz]['equipo'][itemzz]['miembro']}</option>`;
                            console.log(tpc_equipos);
                        };
                    };
                };
            };
            for (itemqz in json_datos[id_servicio_copiar]['equipo']) {
                tpc_equipos += `<option value="${json_datos[id_servicio_copiar]['equipo'][itemqz]['miembro']}" selected>${json_datos[id_servicio_copiar]['equipo'][itemqz]['miembro']}</option>`;
                console.log(tpc_equipos);
            };
            /* Armado de Prioridad */
            if (prioridad == "Alta") {
                tpc_prioridad = `
                            <option value="Alta" selected>Alta</option>
                            <option value="Ninguna">Ninguna</option>
                        `;
            } else {
                tpc_prioridad = `
                            <option value="Alta">Alta</option>
                            <option value="Ninguna" selected>Ninguna</option>
                        `;
            };
            /* Armado de Mostrar o no precio */
            if (mostrarPrecio == "si") {
                tpc_mostrarPrecio = `
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="servicio_mostrarPrecio" id="si_mostrar" value="true" checked>
                                <label class="form-check-label" for="si_mostrar">
                                    Si quiero mostrar precio de referencia.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="servicio_mostrarPrecio" id="no_mostrar" value="false">
                                <label class="form-check-label" for="no_mostrar">
                                    No, quiero que los clientes me llamen para pedirme presupuestos especificos.
                                </label>
                            </div>
                        `;
            } else {
                tpc_mostrarPrecio = `
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="servicio_mostrarPrecio" id="si_mostrar" value="true" >
                                <label class="form-check-label" for="si_mostrar">
                                    Si quiero mostrar precio de referencia.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="servicio_mostrarPrecio" id="no_mostrar" value="false" checked>
                                <label class="form-check-label" for="no_mostrar">
                                    No, quiero que los clientes me llamen para pedirme presupuestos especificos.
                                </label>
                            </div>
                        `;
            };
            /* Armado de Slides */
            catslides = lineas.catslides;
            tpc_slides = ``;
            for (ij in catslides) {
                if (catslides[ij]['visibilidades'] == "si") {
                    tpc_slides += `<option value="${catslides[ij]['titulo']}">${catslides[ij]['titulo']}</option>`;
                    console.log(tpc_slides);
                };
            }; 
            tpc_slides += `<option value="${json_datos[id_servicio_copiar]['slide']}" selected>${json_datos[id_servicio_copiar]['slide']}</option>`;
            console.log(tpc_slides);
            //Imprimir en el HTML
            $('#id_servicio').html(id_ultimo_imp);
            $('#servicios_testimonios').html(tpc_testimonios);
            $('#servicios_equipo').html(tpc_equipos);
            $('#instruccion_serv').text("crear");
            $('#servicio_slider_prioridad').html(tpc_prioridad);
            $('#sub_mostrarPrecio').html(tpc_mostrarPrecio);
            $('#servicio_slider').html(tpc_slides);
            $('#nombre_servicio').val(nombre);
            $('#servicio_descripcion').val(descripcion);
            $('#servicio_condiciones').val(condi);
            $('#precio_anterior').val(precioA);
            $('#precio_actual').val(precioB);
            $('#moneda').val(moneda);
        }
    });

});

$(document).ready(function () {
    cargarDatos();
    $('.btn-serv').click(function (e) {
        e.preventDefault();
        console.log("hiciste click en guardar");
        id_servicio = $('#id_servicio').text();
        testimonios = $("#servicios_testimonios option:selected").val();
        equipos = $("#servicios_equipo option:selected").val();
        instruccion = $('#instruccion_serv').text();
        prioridad = $("#servicio_slider_prioridad option:selected").val();
        mostrarPrecio = $("#servicio_mostrarPrecio option:selected").text();
        slide = $("#servicio_slider option:selected").val();
        nombre = $('#nombre_servicio').val();
        descripcion = $('#servicio_descripcion').val();
        condi = $('#servicio_condiciones').val();
        precioA = $('#precio_anterior').val();
        precioB = $('#precio_actual').val();
        moneda = $('#moneda').val();
        console.log("ID SERVCIO a enviar "+id_servicio);
        console.log("Testimonios "+testimonios);
        console.log("Equipos "+equipos);
        console.log("Instruccion "+instruccion);
        console.log("Prioridad "+prioridad);
        console.log("Mostrar "+mostrarPrecio);
        console.log("Slide "+slide);
        console.log("Nombre "+nombre);
        console.log("Descripcion "+descripcion);
        console.log("Condiciones "+condi);
        console.log(precioA);
        console.log(precioB);
        console.log(moneda);
        //Enviando los datos al PHP
        
        ///// RUTA  A LA CARPETA DE LA TIENDA ///////
        var tienda = 'Rodrigo';
	    var ruta = '../ecommerce/' + tienda +'/config/assets/php/guardar_JSON.php' ;
	    
        $.ajax({
            url: ruta, //'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                id_servicio: id_servicio,
                testimonios_serv: testimonios,
                equipos_serv: equipos,
                instruccion_serv: instruccion,
                prioridad_serv: prioridad,
                mostrarPrecio: mostrarPrecio,
                slide_serv: slide,
                nombre_serv: nombre,
                descripcion_serv: descripcion,
                condi_serv: condi,
                precioA_serv: precioA,
                precioB_serv: precioB,
                moneda_serv: moneda
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