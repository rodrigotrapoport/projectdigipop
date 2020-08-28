function cargarDatos() {
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_serv.php',
        type: 'POST',
        success: function (response) { 
            const lineas = JSON.parse(response);
            console.log("JSON esta cargado!");
            json_datos = lineas.config.contadorExito;
            console.log (json_datos);
            template_exitos =``;
            for (i in json_datos){
                template_exitos += `
                                    <tr idExito="${json_datos[i]['id']}">
                                        <td>exito${json_datos[i]['id']}</td>
                                        <td>${json_datos[i]['nombre']}</td>
                                        <td>${json_datos[i]['texto']}</td>
                                        <td><i class="${json_datos[i]['icono']}"></i></td>
                                        <td>${json_datos[i]['visibilidad']}</td> 
                                        <td>
                                            <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn_edit_serv"><i class="fas fa-edit" style="color:blue;"></i></a> 
                                            <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn_del_serv"><i class="fas fa-trash-alt" style="color:red;"></i></a> 
                                            <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn_cop_serv"><i class="fas fa-copy" style="color:orange;"></i></a>
                                        </td>
                                    </tr>`; 
            
                id_ultimo = `${json_datos[i]['id']}`;
                
            };
            console.log(id_ultimo);
            $('#tabla_exitos').html(template_exitos);
            id_ultimo_temp = parseInt(id_ultimo) + 1;
            id_ultimo_imp = "exito"+id_ultimo_temp;
            $('#id_exito').html(id_ultimo_imp); 
            $('#instruccion_exito').text("crear");
        }
    });
};
/* Función Editar Servicio */
$(document).on('click', '.btn_edit_serv', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_editar = $(element).attr('idExito');
    console.log("ID servicio a Editar: "+id_editar);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_serv.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            console.log("JSON esta cargado!");
            json_datos = lineas.config.contadorExito;
            console.log(json_datos);
            id_exito_editar = "exito" + id_editar;
            nombre=`${json_datos[id_exito_editar]['nombre']}`;
            texto = `${json_datos[id_exito_editar]['texto']}`;
            icono = `${json_datos[id_exito_editar]['icono']}`;
            mostrar = `${json_datos[id_exito_editar]['visibilidad']}`;
             
            console.log(id_exito_editar);
            console.log(nombre);
            console.log(texto);
            console.log(icono);
            console.log(mostrar);  
            
            if (mostrar == "Si") {
                tp_mostrar = `
                            <option value="Si" selected>Si</option>
                            <option value="No">No</option>
                        `;
            } else {
                tp_mostrar = `
                            <option value="Si">Si</option>
                            <option value="No" selected>No</option>
                        `;
            }; 
            
            //Imprimiendo en el HTMl
            $('#id_exito').html(id_exito_editar);
            $('#exito_titulo').val(nombre);
            $('#exito_descripcion').val(texto);
            $('#exito_icon').val(icono);
            $('#exito_visualizar').html(tp_mostrar);
            $('#instruccion_exito').text("editar"); 
        }
    });
});
/* Función Borrar Servicio */
$(document).on('click', '.btn_del_serv', function () {
    let element = $(this)[0].parentElement.parentElement;
    var id_borrar = $(element).attr('idExito');
    console.log("ID Servicio a borrar: "+id_borrar);
    //Confirmación de pedido de borrado
    var mensaje = confirm("¿Estas seguro que quieres borrarlo?");
    if (mensaje) {
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                id    : id_borrar,
                instruccion_exito: "borrar",
                nombre: "",
                texto : "",
                visibilidad: "",
                icono : ""
            },
            success: function (response1) {
                console.log(response1);
                if (response1 == '"OK"') {
                    console.log("Ingreso al IF  " + response1);
                    cargarDatos();
                } else {
                    console.log("Error en borrar exito");
                };
            }
        });
    } else {
        console.log("Cancelado en el borrado del exito");
    };
    

});
/* Función Copiar Servicio */
$(document).on('click', '.btn_cop_serv', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_copiar = $(element).attr('idExito');
    console.log("ID Servicio a Copiar: " + id_copiar);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_serv.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            console.log("JSON esta cargado!");
            json_datos = lineas.config.contadorExito;
            console.log(json_datos);
           
            for (inz in json_datos) {
                id_ultimo = `${json_datos[inz]['id']}`;
            };
            id_ultimo_temp = parseInt(id_ultimo) + 1;
            id_ultimo_imp = "exito" + id_ultimo_temp;
            console.log("El último exito a crear es: " + id_ultimo_imp);
            
            
            id_exito_copiar = "exito" + id_copiar;
            nombre = `${json_datos[id_exito_copiar]['nombre']}`;
            texto = `${json_datos[id_exito_copiar]['texto']}`;
            icono = `${json_datos[id_exito_copiar]['icono']}`;
            mostrar = `${json_datos[id_exito_copiar]['visibilidad']}`;
            console.log(id_exito_copiar);
            console.log(nombre);
            console.log(texto);
            console.log(icono);
            console.log(mostrar);
            
            /* Armado de Mostrar */
            if (mostrar == "Si") {
                tpc_mostrar = `
                            <option value="Si" selected>Si</option>
                            <option value="No">No</option>
                        `;
            } else {
                tpc_mostrar = `
                            <option value="Si">Si</option>
                            <option value="No" selected>No</option>
                        `;
            };
            
            //Imprimiendo en el HTMl
            $('#id_exito').html(id_ultimo_imp);
            $('#exito_titulo').val(nombre);
            $('#exito_descripcion').val(texto);
            $('#exito_icon').val(icono);
            $('#exito_visualizar').html(tpc_mostrar);
            $('#instruccion_exito').text("crear"); 
        }
    });

});

$(document).ready(function () {
    cargarDatos();
    $('.btn-exitos').click(function (e) {
        e.preventDefault();
        console.log("hiciste click en guardar");
        id_exito = $('#id_exito').text();
        titulo = $('#exito_titulo').val();
        texto = $('#exito_descripcion').val();
        icono = $('#exito_icon').val();
        mostrar = $('#exito_visualizar').val();
        instruccion = $('#instruccion_exito').text(); 
       
        console.log("ID Exito a enviar "+id_exito);
        console.log("Titulo "+titulo);
        console.log("Texto "+texto);
        console.log("Icono "+icono);
        console.log("Mostrar"+ mostrar);
        console.log("Instruccion "+instruccion);
        
        //Enviando los datos al PHP
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                id    : id_exito,
                nombre: titulo,
                texto : texto,
                icono : icono,
                visibilidad: mostrar,
                instruccion_exito: instruccion
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