function cargarDatos() {
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_productos.php',
        type: 'POST',
        success: function (response) { 
            const lineas = JSON.parse(response);
            console.log("JSON esta cargado!");
            datos = lineas.config.delivery.tabla;
            rappi = lineas.config.delivery.rappy;
            usuario = rappi.user;
            psw = rappi.password;
            console.log ("Datos:"+datos);
            console.log("Rappi"+rappi)
            console.log("User:" + usuario);
            console.log("Psw:" + psw);
            template_delivery =``;
            for (i in datos){
                template_delivery += `
                                    <tr idZona="${datos[i]['id']}">
                                        <td>zona${datos[i]['id']}</td>
                                        <td>${datos[i]['barrios']}</td>
                                        <td>${datos[i]['precio']}</td>  
                                        <td>
                                            <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn_edit_zona"><i class="fas fa-edit" style="color:blue;"></i></a> 
                                            <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn_del_zona"><i class="fas fa-trash-alt" style="color:red;"></i></a> 
                                            <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn_cop_zona"><i class="fas fa-copy" style="color:orange;"></i></a>
                                        </td>
                                    </tr>`; 
            
                id_ultimo = `${datos[i]['id']}`;
                
            };
            console.log(id_ultimo);
            $('#tabla_delivery').html(template_delivery);
            id_ultimo_temp = parseInt(id_ultimo) + 1;
            id_ultimo_imp = "zona"+id_ultimo_temp;
            $('#id_zona').html(id_ultimo_imp); 
            $('#instruccion_delivery').text("crear");
            //$('delivery_rappi_usuario').val(usuario);
            //$('delivery_rappi_psw').val(psw);
        }
    });
};
/* Función Editar Zona */
$(document).on('click', '.btn_edit_zona', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_editar = $(element).attr('idZona');
    console.log("ID Zona a Editar: "+id_editar);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_productos.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            console.log("JSON esta cargado!");
            datos = lineas.config.delivery.tabla;
            console.log(datos);
            id_zona_editar = "zona" + id_editar;
            barrios = `${datos[id_zona_editar]['barrios']}`;
            costo = `${datos[id_zona_editar]['precio']}`; 
             
            console.log(id_zona_editar);
            console.log(barrios);
            console.log(costo);  
             
            
            //Imprimiendo en el HTMl
            $('#id_zona').html(id_zona_editar);
            $('#delivery_barrio').val(barrios);
            $('#delivery_precio').val(costo); 
            $('#instruccion_delivery').text("editar"); 
        }
    });
});
/* Función Borrar Zona */
$(document).on('click', '.btn_del_zona', function () {
    let element = $(this)[0].parentElement.parentElement;
    var id_borrar = $(element).attr('idZona');
    console.log("ID Zona a borrar: "+id_borrar);
    //Confirmación de pedido de borrado
    var mensaje = confirm("¿Estas seguro que quieres borrarlo?");
    if (mensaje) {
	    
	    ///// RUTA  A LA CARPETA DE LA TIENDA ///////
        var tienda = 'Rodrigo';
	    var ruta = '../ecommerce/' + tienda +'/config/assets/php/guardar_JSON.php' ;
	    
        $.ajax({
            url: ruta, //'assets/php/guardar_JSON.php',
            type: 'POST',
            data: {
                id_z    : id_borrar,
                instruccion_delivery: "borrar",
                barrios_z: "",
                precio_z : "" 
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
/* Función Copiar Zona */
$(document).on('click', '.btn_cop_zona', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_copiar = $(element).attr('idZona');
    console.log("ID Servicio a Copiar: " + id_copiar);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_productos.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            console.log("JSON esta cargado!");
            datos = lineas.config.delivery.tabla;
            console.log(datos);
           
            for (inz in datos) {
                id_ultimo = `${datos[inz]['id']}`;
            };
            id_ultimo_temp = parseInt(id_ultimo) + 1;
            id_ultimo_imp = "zona" + id_ultimo_temp;
            console.log("LA última zona a crear es: " + id_ultimo_imp);
            
            
            id_zona_copiar = "zona" + id_copiar;
            barrios = `${json_datos[id_zona_copiar]['barrios']}`;
            precio = `${json_datos[id_zona_copiar]['precio']}`;
            
            console.log(id_ultimo_imp);
            console.log(barrios);
            console.log(precio); 
             
            
            //Imprimiendo en el HTMl
            $('#id_zona').html(id_ultimo_imp); 
            $('#delivery_barrio').val(barrios);
            $('#delivery_precio').val(costo); 
            $('#instruccion_delivery').text("crear"); 
        }
    });

});

$(document).ready(function () {
    cargarDatos();
    $('.btn-tb-en').click(function (e) {
        e.preventDefault();
        console.log("hiciste click en guardar Zona");
        id_zona = $('#id_zona').text();
        barrios = $('#delivery_barrio').val();
        precio  = $('#delivery_precio').val(); 
        instruccion = $('#instruccion_delivery').text(); 
       
        console.log("ID Zona a enviar "+id_zona);
        console.log("Barrios "+barrios);
        console.log("Precio "+precio); 
        console.log("Instruccion "+instruccion);
        
        //Enviando los datos al PHP
        
        ///// RUTA  A LA CARPETA DE LA TIENDA ///////
        var tienda = 'Rodrigo';
	    var ruta   = '../ecommerce/' + tienda +'/config/assets/php/guardar_JSON.php' ;
	    
        $.ajax({
            url: ruta, //'assets/php/guardar_JSON.php',
            type: 'POST',
            data: {
                id_z: id_zona,
                instruccion_delivery: instruccion,
                barrios_z: barrios,
                precio_z: precio  
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
	
  //$('.btn-rappi').click(function (e) {
	$('#guardarRappi').click(function (e) {    
        e.preventDefault();
        
        alert('click'); 
        
        console.log("hiciste click en guardar Rappi");
        usuario = $('#delivery_rappi_usuario').val();
        psw     = $('#delivery_rappi_psw').val();

        //console.log("ID Zona a enviar " + id_zona);
        //console.log("Barrios " + barrios);
        //console.log("Precio " + precio);
        //console.log("Instruccion " + instruccion);

        //Enviando los datos al PHP
        
        ///// RUTA  A LA CARPETA DE LA TIENDA ///////
        var tienda = 'Rodrigo';
	    var ruta   = '../ecommerce/' + tienda +'/config/assets/php/guardar_JSON.php' ;
	    
        $.ajax({
            url: ruta, //'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                rappi_user : usuario,
                rappi_psw  : psw 
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


