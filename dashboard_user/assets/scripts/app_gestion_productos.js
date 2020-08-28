// FUNCIONES 
function contarUltimaCat() {
    $.ajax({
        url: '/dashboard_user/assets/php/traductor.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            for (i in lineas.galeria) {
                id_ultimo = `${i}`;
            };

            console.log("Soy la última categoría " + id_ultimo);
            resto = id_ultimo.length - 7;
            console.log("resto " + resto);
            if (resto == 1) {
                posicion = id_ultimo.substr(7);
                console.log(posicion);
            } else if (resto == 2) {
                posicion = id_ultimo.substr(7, 8);
                console.log(posicion);
            } else if (resto == 3) {
                posicion = id_ultimo.substr(7, 8, 9);
                console.log(posicion);
            } else if (resto == 4) {
                posicion = id_ultimo.substr(7, 8, 9, 10);
                console.log(posicion);
            } else {
                console.log("Error");
            };
            indice_new_cat = parseInt(posicion) + 1;
            nueva_cat = "galeria" + indice_new_cat;
        }
    });
    return indice_new_cat;
};
 
function cargarDatos() {
    $.ajax({
        url: '/dashboard_user/assets/php/traductor.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            template_categoria = ``;
            template_productos = ``;
            temp_gal =``;
            ix = 1;
            console.log("JSON esta cargado!")
            for (i in lineas.galeria) {
                if (lineas['visibilidades'][i]=="si"){
                    template_categoria += `
                                <tr idcat="${i}">
                                    <td>
                                        ${ix}
                                    </td>
                                    <td>
                                        ${i}
                                    </td>
                                    <td>
                                       ${lineas.galeria[i]}  
                                    </td>
                                    <td>${lineas['prioridades']['prioridad' + ix]}</td>
                                    <td>
                                        <a href="#collapseOne" class="btn_edit_cat"><i class="fas fa-edit" style="color:blue;"></i></a> 
                                        <a href="#collapseOne" class="btn_del_cat"><i class="fas fa-trash-alt" style="color:red;"></i></a> 
                                        <a href="#collapseOne" class="btn_cop_cat"><i class="fas fa-copy" style="color:orange;"></i></a>
                                    </td>
                                </tr>`;
                    temp_gal += `<option value="${i}">${i}</option>`;
                } else{
                    console.log("No tiene visibilidad la categoria: "+i);
                };
                /* Para tomar el último ID de Categoria */
                id_ultimo = `${i}`;
                /* Para generar lista de Categorias */
                ix = ix + 1;    
            };
            /* Para imprimir listo el nuevo ID Categoria */
            resto = id_ultimo.length - 7;
            if (resto == 1) {
                posicion = id_ultimo.substr(7);
                console.log(posicion);
            } else if (resto == 2) {
                posicion = id_ultimo.substr(7, 8);
                console.log(posicion);
            } else if (resto == 3) {
                posicion = id_ultimo.substr(7, 8, 9);
                console.log(posicion);
            } else if (resto == 4) {
                posicion = id_ultimo.substr(7, 8, 9, 10);
                console.log(posicion);
            } else {
                console.log("Error");
            };
            indice_new_cat = parseInt(posicion) + 1;
            nueva_cat = "galeria" + indice_new_cat;
            /* Para generar lista de prioridades */
            templete_prioridad = `
                            <option value="Alta">Alta</option>
                            <option value="Ninguna" selected>Ninguna</option>
                        `;
            /* Para generar lista de Slides en Categorias */
            templete_sel_slide = ``;
            for (z in lineas.galeria) {
                if (lineas['visibilidades'][z] == "si") {
                templete_sel_slide += `
                            <option value="${lineas.galeria[z]}">${lineas.galeria[z]}</option>
                        `;
                };
            };
            /* Ingresar los valores pre-cargados en la sección Agregar o Editar Categoria */
            

            $('#nombre_categoria').html(nueva_cat);
            $('#categoria_slide').html(templete_sel_slide);
            $('#categoria_prioridad').html(templete_prioridad);
            templete_ins_cat = `crear`
            $('#instruccion_cat').text(templete_ins_cat); 
            /* Para generar lista de Productos */
            for (i in lineas['productos']) {
                for (k in lineas['productos'][i]) {
                    if (lineas['productos'][i][k]['visibilidades'] == "si"){
                        template_productos += `
                            <tr prodnom="${lineas['productos'][i][k]['nombre']}">
                                <td>
                                    ${lineas['productos'][i][k]['nombre']}
                                </td>
                                <td>
                                    ${lineas['productos'][i][k]['unidad']}
                                </td>
                                <td>
                                    ${lineas['productos'][i][k]['precioA']}
                                </td>
                                <td>
                                    ${lineas['productos'][i][k]['precioB']}
                                </td>
                                <td>
                                    ${lineas['productos'][i][k]['galeria']}
                                </td>
                                <td>
                                    ${lineas['productos'][i][k]['marca']}
                                </td>
                                <td>
                                    ${lineas['productos'][i][k]['oferta']}
                                </td>
                                <td>
                                    ${lineas['productos'][i][k]['codigo']}
                                </td>
                                <td>
                                    ${lineas['productos'][i][k]['calif']}
                                </td>
                                <td>
                                    ${lineas['productos'][i][k]['colores']}
                                </td>
                                <td>
                                    ${lineas['productos'][i][k]['tamaños']}
                                </td>
                                <td>
                                    ${lineas['productos'][i][k]['descrip']}
                                </td>
                                <td>
                                    ${lineas['productos'][i][k]['condi']}
                                </td>
                                <td>
                                    ${lineas['productos'][i][k]['prioridad']}
                                </td>
                                <td>
                                    <img class="img-thumbnail" width="30%" src="${lineas['productos'][i][k]['foto1']}">
                                    <img class="img-thumbnail" width="30%" src="${lineas['productos'][i][k]['foto2']}">
                                    <img class="img-thumbnail" width="30%" src="${lineas['productos'][i][k]['foto3']}">
                                </td>
                                <td>
                                    <a href="#collapseTwo" class="btn_edit_pr"><i class="fas fa-edit" style="color:blue;"></i></a> 
                                    <a href="#collapseTwo" class="btn_del_pr"><i class="fas fa-trash-alt" style="color:red;"></i></a> 
                                    <a href="#collapseTwo" class="btn_cop_pr"><i class="fas fa-copy" style="color:orange;"></i></a>
                                </td>
                            </tr>`;
                    }else{
                        console.log("No tiene visibilidad el producto: "+lineas['productos'][i][k]['nombre']);
                    };
                    
                }
            };
            // Contador del nuevo ID producto
            id_contador = 1;
            for (i in lineas['productos']) {
                for (k in lineas['productos'][i]) {
                    if (lineas['productos'][i][k]) {
                        id_contador = id_contador + 1;
                    };
                };
            };
            console.log("Soy el último producto " + id_contador);
            id_contador = id_contador + 1;
            console.log("Soy el new producto " + id_contador);
            var nuevo_id_producto = id_contador;
            console.log("El nuevo ID producto es: " + nuevo_id_producto);
            temp_id_producto = `<p id="id_producto" style="background-color: black; color:white;">producto${nuevo_id_producto}</p>`;
            
            /* Datos Pre-cargados en las Tablas */
            $('#tabla_categorias').html(template_categoria);
            $('#tabla_productos').html(template_productos);
            /* Datos Pre-cargados en Productos */
            $('#producto_categoria').html(temp_gal);
            $('#id_producto').html(temp_id_producto);
            templete_ins_pro = `crear`;
            $('#instruccion_pro').text(templete_ins_pro);
        }
    })
};

// BOTONES
/* Función Editar Categoria */
$(document).on('click', '.btn_edit_cat', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('idcat');
    console.log(id);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            console.log("Soy " + id);
            nombre_slide = lineas['galeria'][id];
            console.log(nombre_slide);
            resto = id.length - 7;
            console.log("resto " + resto);
            if (resto == 1) {
                posicion = id.substr(7);
                console.log(posicion);
            } else if (resto == 2) {
                posicion = id.substr(7, 8);
                console.log(posicion);
            } else if (resto == 3) {
                posicion = id.substr(7, 8, 9);
                console.log(posicion);
            } else if (resto == 4) {
                posicion = id.substr(7, 8, 9, 10);
                console.log(posicion);
            } else {
                console.log("Error");
            };
            prioridad = lineas['prioridades']['prioridad' + posicion];
            console.log(prioridad);
            $('#nombre_categoria').html(id);
            templete_sel_slide = ``;
            for (z in lineas.galeria) {
                if (lineas['visibilidades'][z] == "si") {
                    templete_sel_slide += `
                            <option value="${lineas.galeria[z]}">${lineas.galeria[z]}</option>
                        `;
                };
            };
            templete_sel_slide += `
                        <option value = "${lineas.galeria[id]}" selected> ${lineas.galeria[id]}</option>
                    `;
            $('#categoria_slide').html(templete_sel_slide);
            if (prioridad == "Alta") {
                templete_prioridad = `
                            <option value="Alta" selected>Alta</option>
                            <option value="Ninguna">Ninguna</option>
                        `;
            } else {
                templete_prioridad = `
                            <option value="Alta">Alta</option>
                            <option value="Ninguna" selected>Ninguna</option>
                        `;
            };
            
            $('#categoria_prioridad').html(templete_prioridad);
            
            templete_ins_cat = `editar`
            $('#instruccion_cat').text(templete_ins_cat);  
        }
    });
});
/* Función Borrar Categoria */
$(document).on('click', '.btn_del_cat', function () {
    let element = $(this)[0].parentElement.parentElement;
    var id_borrar = $(element).attr('idcat');
    console.log(id_borrar);
    var mensaje = confirm("¿Estas seguro que quieres borrarlo?");
    if (mensaje){
        $.ajax({
            url: '/dashboard_user/assets/php/traductor.php',
            type: 'POST',
            success: function (response) {
                const lineas = JSON.parse(response);
                console.log("Soy " + id_borrar);
                nombre_slide = lineas['galeria'][id_borrar];
                console.log(nombre_slide);
                
            }
        });
    } else{
        console.log("No se borro la categoria");
    };
    $.ajax({
        url: 'assets/php/guardar_JSON.php',
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
                console.log("Error en guardar categoria");
            };  
        }
    });
    
});
/* Función Copiar Categoria */
$(document).on('click', '.btn_cop_cat', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('idcat');
    console.log("Soy la selección: "+id);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            for (iz in lineas.galeria) {
                id_ultimo = `${iz}`;
            };
            console.log("La última categoría es: " + id_ultimo);
            resto = id.length - 7;
            console.log("resto " + resto);
            if (resto == 1) {
                posicion = id.substr(7);
                console.log(posicion);
            } else if (resto == 2) {
                posicion = id.substr(7, 8);
                console.log(posicion);
            } else if (resto == 3) {
                posicion = id.substr(7, 8, 9);
                console.log(posicion);
            } else if (resto == 4) {
                posicion = id.substr(7, 8, 9, 10);
                console.log(posicion);
            } else {
                console.log("Error");
            };
            resto_ul = id_ultimo.length - 7;
            console.log("resto " + resto_ul);
            if (resto_ul == 1) {
                posicion_ul = id_ultimo.substr(7);
                console.log(posicion_ul);
            } else if (resto_ul == 2) {
                posicion_ul = id_ultimo.substr(7, 8);
                console.log(posicion_ul);
            } else if (resto_ul == 3) {
                posicion_ul = id_ultimo.substr(7, 8, 9);
                console.log(posicion_ul);
            } else if (resto_ul == 4) {
                posicion = id_ultimo.substr(7, 8, 9, 10);
                console.log(posicion_ul);
            } else {
                console.log("Error");
            };

            console.log("Soy la posición: "+ posicion);
            posicion_vieja = parseInt(posicion);
            console.log("Soy la VIEJA posicion: "+ posicion_vieja);
            indice_new_cat = parseInt(posicion_ul) + 1;
            nueva_cat = "galeria" + indice_new_cat;
            console.log("Soy la NUEVA posicion: " + indice_new_cat);
            $('#nombre_categoria').html(nueva_cat);
            console.log("Soy la nueva categoria: " + nueva_cat);

            prioridad = lineas['prioridades']['prioridad' + posicion_vieja];
            console.log("Mi prioridad es: "+prioridad);

            templete_sel_slide = ``;
            for (z in lineas.galeria) {
                if (lineas['visibilidades'][z] == "si") {
                    templete_sel_slide += `
                            <option value="${lineas.galeria[z]}">${lineas.galeria[z]}</option>
                        `;
                };
            };
            templete_sel_slide += `
                        <option value = "${lineas.galeria[id]}" selected> ${lineas.galeria[id]}</option>
                    `;
            $('#categoria_slide').html(templete_sel_slide);
            if (prioridad == "Alta") {
                templete_prioridad = `
                            <option value="Alta" selected>Alta</option>
                            <option value="Ninguna">Ninguna</option>
                        `;
            };
            if (prioridad == "Ninguna")  {
                templete_prioridad = `
                            <option value="Ninguna" selected>Ninguna</option>
                            <option value="Alta">Alta</option>
                        `;
            };
            $('#categoria_prioridad').html(templete_prioridad);
            templete_ins_cat = `crear`
            $('#instruccion_cat').text(templete_ins_cat);  

        }
    });

});
/* Función Editar Producto */
$(document).on('click', '.btn_edit_pr', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('prodnom');
    console.log(id);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            console.log("Soy el producto: " + id);
            for (i in lineas['productos']) {
                for (k in lineas['productos'][i]) {
                    if (lineas['productos'][i][k]['nombre'] === id){
                        id_producto = `${k}`;
                        nombre = lineas['productos'][i][k]['nombre'];
                        galeria = lineas['productos'][i][k]['galeria'];
                        unidad = lineas['productos'][i][k]['unidad'];
                        precioA = lineas['productos'][i][k]['precioA'];
                        precioB = lineas['productos'][i][k]['precioB'];
                        moneda = lineas['productos'][i][k]['moneda'];
                        marca = lineas['productos'][i][k]['marca'];
                        oferta = lineas['productos'][i][k]['oferta'];
                        codigo = lineas['productos'][i][k]['codigo'];
                        calif = lineas['productos'][i][k]['calif'];
                        colores = lineas['productos'][i][k]['colores'];
                        tamanos = lineas['productos'][i][k]['tamaños'];
                        descrip = lineas['productos'][i][k]['descrip'];
                        condi = lineas['productos'][i][k]['condi'];
                        prioridad = lineas['productos'][i][k]['prioridad'];
                        foto1 = lineas['productos'][i][k]['foto1'];
                        foto2 = lineas['productos'][i][k]['foto2'];
                        foto3 = lineas['productos'][i][k]['foto3'];
                    };
                };  
            };
            console.log ("ID PRODUCTO: "+ id_producto);
            console.log("Nombre del producto: "+nombre);
            console.log("Galeria del producto: " + galeria);
            console.log("Unidad del producto: " + unidad);
            console.log("Precion Anterior del producto: " + precioA);
            console.log("Precion Actual del producto: " + precioB);
            console.log("Moneda del producto: " + moneda);
            console.log("Marca del producto: " + marca);
            console.log("Oferta del producto: " + oferta);
            console.log("Codigo del producto: " + codigo);
            console.log("Colores del producto: " + colores);
            console.log("Tamaños del producto: " + tamanos);
            console.log("Descripción del producto: " + descrip);
            console.log("Condiciones del producto: " + condi);
            console.log("Prioridad del producto: " + prioridad);
            console.log("Foto1 del producto: " + foto1);
            console.log("Foto2 del producto: " + foto2);
            console.log("Foto3 del producto: " + foto3);
            temp_id_producto = `${id_producto}`;
            temp_nombre = `${nombre}`;
            temp_moneda = `${moneda}`
            temp_galeria = ``;
            
            for (item in lineas.galeria) { 
                if (lineas['visibilidades'][item] == "si") {
                    temp_galeria += `<option value="${item}">${item}</option>`;
                };
            };
            temp_galeria += `<option selected value="${galeria}">${galeria}</option>`;
            temp_unidad = `${unidad}`;
            temp_precioA = `${precioA}`;
            temp_precioB = `${precioB}`;
            temp_marca = `${marca}`;
            if (oferta == "si"){
                temp_oferta = `<div class="form-check">
                                    <input class="form-check-input" type="radio" name="ofertas_productos" id="ofertas_productos_si" value="true"
                                        checked>
                                    <label class="form-check-label" for="si_oferta">
                                        Si, quiero que este producto aparezca como oferta.
                                    </label>    
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ofertas_productos" id="ofertas_productos_no" value="false">
                                    <label class="form-check-label" for="no_oferta">
                                        No, no quiero que este producto aparezca como oferta.
                                    </label>
                                </div>`;
            }else{
                temp_oferta = `<div class="form-check">
                                    <input class="form-check-input" type="radio" name="ofertas_productos" id="ofertas_productos_si" value="true"
                                        >
                                    <label class="form-check-label" for="si_oferta">
                                        Si, quiero que este producto aparezca como oferta.
                                    </label>    
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ofertas_productos" id="ofertas_productos_no" value="false" checked>
                                    <label class="form-check-label" for="no_oferta">
                                        No, no quiero que este producto aparezca como oferta.
                                    </label>
                                </div>`;
            };
            
            temp_codigo = `${codigo}`;
            temp_colores = `${colores}`;
            temp_tamanos = `${tamanos}`;
            temp_descrip = `${descrip}`;
            temp_condi = `${condi}`;
            temp_prioridad = ``;
            if (prioridad == "Alta") {
                temp_prioridad = `
                            <option value="Alta" selected>Alta</option>
                            <option value="Ninguna">Ninguna</option>
                        `;
            } else {
                temp_prioridad = `
                            <option value="Alta">Alta</option>
                            <option value="Ninguna" selected>Ninguna</option>
                        `;
            };
            temp_calif=``;
            if (calif==1){
                temp_calif = `
                <option selected value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                `;

            }else if(calif==2){
                temp_calif = `
                <option value="1">1</option>
                <option selected value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                `;

            }else if (calif==3){
                temp_calif = `
                <option value="1">1</option>
                <option value="2">2</option>
                <option selected value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                `;

            }else if(calif==4){
                temp_calif = `
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option selected value="4">4</option>
                <option value="5">5</option>
                `;

            }else{
                temp_calif = `
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option selected value="5">5</option>
                `;

            };
            temp_foto1 = `<img src="${foto1}" class="img-thumbnail">`;
            temp_foto2 = `<img src="${foto2}" class="img-thumbnail">`;
            temp_foto3 = `<img src="${foto3}" class="img-thumbnail">`;
            $('#id_producto').html(temp_id_producto);
            $('#nombre_producto').val(temp_nombre);
            $('#unidad_producto').val(temp_unidad);
            $('#precio_anterior').val(temp_precioA);
            $('#precio_actual').val(temp_precioB);
            $('#producto_categoria').html(temp_galeria);
            $('#sub_ofertas_productos').html(temp_oferta);
            $('#moneda').val(temp_moneda);
            $('#producto_prioridad').html(temp_prioridad);
            $('#producto_marca').val(temp_marca);
            $('#producto_codigo').val(temp_codigo);
            $('#producto_cal').html(temp_calif);
            $('#producto_colores').val(temp_colores);
            $('#producto_tamano').val(temp_tamanos);
            $('#producto_descripcion').val(temp_descrip);
            $('#producto_condiciones').val(temp_condi);
            $('#preview_img').html(temp_foto1);
            $('#preview_img1').html(temp_foto2);
            $('#preview_img2').html(temp_foto3);
            templete_ins_pro = `editar`
            $('#instruccion_pro').text(templete_ins_pro);
        }
    });

});
/* Función Borrar Producto */
$(document).on('click', '.btn_del_pr', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('prodnom');
    console.log(id);
    var mensaje = confirm("¿Estas seguro que quieres borrarlo?");
    if (mensaje) {
        $.ajax({
            url: '/dashboard_user/assets/php/traductor.php',
            type: 'POST',
            success: function (response) {
                const lineas = JSON.parse(response);
                console.log("Soy el producto: " + id);
                for (i in lineas['productos']) {
                    for (k in lineas['productos'][i]) {
                        if (lineas['productos'][i][k]['nombre'] === id) {
                            id_producto = `${k}`;
                            nombre = lineas['productos'][i][k]['nombre'];
                            galeria = lineas['productos'][i][k]['galeria'];
                        };
                    };
                };
                console.log("ID PRODUCTO a borrar: " + id_producto);
                console.log("Nombre del producto a borrar: " + nombre);
                console.log("Galeria del producto a borrar: " + galeria);   
            }
        });
    } else {
        console.log("No se borro el producto");
    }; 
    $.ajax({
        url: 'assets/php/guardar_JSON.php',
        type: 'GET',
        data: {
            id_producto: id_producto,
            nombre_producto: nombre,
            unidad_producto: "",
            precioA: "",
            precioB: "",
            producto_categoria: galeria,
            oferta: "",
            moneda: "",
            producto_prioridad: "",
            marca: "",
            codigo: "",
            calif: "",
            colores: "",
            tamanos: "",
            descrip: "",
            condi: "",
            foto1: "",
            foto2: "",
            foto3: "",
            instruccion: borrar
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
/* Función Copiar Producto */
$(document).on('click', '.btn_cop_pr', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('prodnom');
    console.log(id);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            console.log("Soy el producto: " + id);
            for (i in lineas['productos']) {
                for (k in lineas['productos'][i]) {
                    if (lineas['productos'][i][k]['nombre'] === id) {
                        id_producto = `${k}`;
                        nombre = lineas['productos'][i][k]['nombre'];
                        galeria = lineas['productos'][i][k]['galeria'];
                        unidad = lineas['productos'][i][k]['unidad'];
                        precioA = lineas['productos'][i][k]['precioA'];
                        precioB = lineas['productos'][i][k]['precioB'];
                        moneda = lineas['productos'][i][k]['moneda'];
                        marca = lineas['productos'][i][k]['marca'];
                        oferta = lineas['productos'][i][k]['oferta'];
                        codigo = lineas['productos'][i][k]['codigo'];
                        calif = lineas['productos'][i][k]['calif'];
                        colores = lineas['productos'][i][k]['colores'];
                        tamanos = lineas['productos'][i][k]['tamaños'];
                        descrip = lineas['productos'][i][k]['descrip'];
                        condi = lineas['productos'][i][k]['condi'];
                        prioridad = lineas['productos'][i][k]['prioridad'];
                        foto1 = lineas['productos'][i][k]['foto1'];
                        foto2 = lineas['productos'][i][k]['foto2'];
                        foto3 = lineas['productos'][i][k]['foto3'];
                    };
                };
            };
            console.log("ID PRODUCTO: " + id_producto);
            console.log("Nombre del producto: " + nombre);
            console.log("Galeria del producto: " + galeria);
            console.log("Unidad del producto: " + unidad);
            console.log("Precion Anterior del producto: " + precioA);
            console.log("Precion Actual del producto: " + precioB);
            console.log("Marca del producto: " + marca);
            console.log("Oferta del producto: " + oferta);
            console.log("Codigo del producto: " + codigo);
            console.log("Colores del producto: " + colores);
            console.log("Tamaños del producto: " + tamanos);
            console.log("Descripción del producto: " + descrip);
            console.log("Condiciones del producto: " + condi);
            console.log("Prioridad del producto: " + prioridad);
            console.log("Foto1 del producto: " + foto1);
            console.log("Foto2 del producto: " + foto2);
            console.log("Foto3 del producto: " + foto3);
            // Contador del nuevo ID producto
            id_contador = 1;
            for (i in lineas['productos']) {
                for (k in lineas['productos'][i]) {
                    if (lineas['productos'][i][k]) {
                        id_contador = id_contador + 1;
                    };
                };
            };
            console.log("Soy el último producto " + id_contador);
            id_contador = id_contador + 1;
            console.log("Soy el new producto " + id_contador);
            var nuevo_id_producto = id_contador;
            console.log("El nuevo ID producto es: " + nuevo_id_producto);
            //Se comienza armar los template para integrar
            temp_id_producto = `producto${nuevo_id_producto}`;
            temp_nombre = `${nombre}`;
            temp_moneda = `${moneda}`
            temp_galeria = ``;
            for (item in lineas.galeria) {
                if (lineas['visibilidades'][item] == "si") {
                    temp_galeria += `<option value="${item}">${item}</option>`
                };
            };
            temp_galeria += `<option selected value="${galeria}">${galeria}</option>`;
            temp_unidad = `${unidad}`;
            temp_precioA = `${precioA}`;
            temp_precioB = `${precioB}`;
            temp_marca = `${marca}`;
            if (oferta == "si") {
                temp_oferta = `<div class="form-check">
                                    <input class="form-check-input" type="radio" name="ofertas_productos" id="ofertas_productos_si" value="true"
                                        checked>
                                    <label class="form-check-label" for="si_oferta">
                                        Si, quiero que este producto aparezca como oferta.
                                    </label>    
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ofertas_productos" id="ofertas_productos_no" value="false">
                                    <label class="form-check-label" for="no_oferta">
                                        No, no quiero que este producto aparezca como oferta.
                                    </label>
                                </div>`;
            } else {
                temp_oferta = `<div class="form-check">
                                    <input class="form-check-input" type="radio" name="ofertas_productos" id="ofertas_productos_si" value="true"
                                        >
                                    <label class="form-check-label" for="si_oferta">
                                        Si, quiero que este producto aparezca como oferta.
                                    </label>    
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ofertas_productos" id="ofertas_productos_no" value="false" checked>
                                    <label class="form-check-label" for="no_oferta">
                                        No, no quiero que este producto aparezca como oferta.
                                    </label>
                                </div>`;
            };

            temp_codigo = `${codigo}`;
            temp_colores = `${colores}`;
            temp_tamanos = `${tamanos}`;
            temp_descrip = `${descrip}`;
            temp_condi = `${condi}`;
            temp_prioridad = ``;
            if (prioridad == "Alta") {
                temp_prioridad = `
                            <option value="Alta" selected>Alta</option>
                            <option value="Ninguna">Ninguna</option>
                        `;
            } else {
                temp_prioridad = `
                            <option value="Alta">Alta</option>
                            <option value="Ninguna" selected>Ninguna</option>
                        `;
            };
            temp_calif = ``;
            if (calif == 1) {
                temp_calif = `
                <option selected value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                `;

            } else if (calif == 2) {
                temp_calif = `
                <option value="1">1</option>
                <option selected value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                `;

            } else if (calif == 3) {
                temp_calif = `
                <option value="1">1</option>
                <option value="2">2</option>
                <option selected value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                `;

            } else if (calif == 4) {
                temp_calif = `
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option selected value="4">4</option>
                <option value="5">5</option>
                `;

            } else {
                temp_calif = `
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option selected value="5">5</option>
                `;

            };
            temp_foto1 = `<img src="${foto1}" class="img-thumbnail">`;
            temp_foto2 = `<img src="${foto2}" class="img-thumbnail">`;
            temp_foto3 = `<img src="${foto3}" class="img-thumbnail">`;
            $('#id_producto').html(temp_id_producto);
            $('#nombre_producto').val(temp_nombre);
            $('#unidad_producto').val(temp_unidad);
            $('#precio_anterior').val(temp_precioA);
            $('#precio_actual').val(temp_precioB);
            $('#producto_categoria').html(temp_galeria);
            $('#sub_ofertas_productos').html(temp_oferta);
            $('#moneda').val(temp_moneda);
            $('#producto_prioridad').html(temp_prioridad);
            $('#producto_marca').val(temp_marca);
            $('#producto_codigo').val(temp_codigo);
            $('#producto_cal').html(temp_calif);
            $('#producto_colores').val(temp_colores);
            $('#producto_tamano').val(temp_tamanos);
            $('#producto_descripcion').val(temp_descrip);
            $('#producto_condiciones').val(temp_condi);
            $('#preview_img').html(temp_foto1);
            $('#preview_img1').html(temp_foto2);
            $('#preview_img2').html(temp_foto3);
            templete_ins_pro = `crear`
            $('#instruccion_pro').text(templete_ins_pro);
        }
    });
});
$(document).ready(function () {
    cargarDatos();
    $('.btn-cat').click(function (e) {
        console.log("Hiciste click en el boton Guardar Categoria");
        id_nueva_cat = $('#nombre_categoria').text();
        slide = $("#categoria_slide option:selected").text();
        prioridad = $("#categoria_prioridad option:selected").text();
        instruccion = $('#instruccion_cat').text();
        console.log("Soy la ultima ID categoria a enviar " + id_nueva_cat);
        console.log("Soy la ultimo slide a enviar " + slide);
        console.log("Soy la ultima prioridad a enviar " + prioridad);
        console.log("La instruccion es: "+instruccion);
        e.preventDefault();
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                id_nueva_cat: id_nueva_cat,
                slide: slide,
                prioridad: prioridad,
                instruccion_cat: instruccion
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
    $('.btn-pro').click(function (e) {
        console.log("Hiciste click en el boton Guardar Producto");
        id_producto = $('#id_producto').val();
        nombre_producto = $('#nombre_producto').val();
        unidad_producto =$('#unidad_producto').val();
        precioA = $('#precio_anterior').val();
        precioB = $('#precio_actual').val();
        producto_categoria = $("#producto_categoria option:selected").text();
        oferta = $("#ofertas_productos option:selected").text();
        moneda = $('#moneda').val();
        producto_prioridad = $("#producto_prioridad option:selected").val();
        marca = $('#producto_marca').val();
        codigo = $('#producto_codigo').val();
        calif = $("#producto_cal option:selected").text();
        colores = $('#producto_colores').val();
        tamanos = $('#producto_tamano').val();
        descrip = $('#producto_descripcion').val();
        condi = $('#producto_condiciones').val();
        foto1 = $('#file').val();
        foto2 = $('#file1').val();
        foto3 = $('#file2').val();
        instruccion = $('#instruccion_pro').text();
        console.log("Soy la ultima ID producto a enviar " + id_producto);
        console.log("Nombre del producto a enviar: " + nombre_producto);
        console.log("Galeria del producto a enviar: " + producto_categoria);
        console.log("Unidad del producto a enviar: " + unidad_producto);
        console.log("Precion Anterior del producto a enviar: " + precioA);
        console.log("Precion Actual del producto a enviar: " + precioB);
        console.log("Moneda del producto a enviar: " + moneda);
        console.log("Marca del producto a enviar: " + marca);
        console.log("Oferta del producto a enviar: " + oferta);
        console.log("Codigo del producto a enviar: " + codigo);
        console.log("Calificación del producto a enviar: " + calif);
        console.log("Colores del producto a enviar: " + colores);
        console.log("Tamaños del producto a enviar: " + tamanos);
        console.log("Descripción del producto a enviar: " + descrip);
        console.log("Condiciones del producto a enviar: " + condi);
        console.log("Prioridad del producto a enviar: " + producto_prioridad);
        console.log("Foto1 del producto a enviar: " + foto1);
        console.log("Foto2 del producto a enviar: " + foto2);
        console.log("Foto3 del producto a enviar: " + foto3);
        /* generarCat(id_nueva_cat, slide, prioridad); */
        e.preventDefault();
        $.ajax({
            url: 'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                id_producto: id_producto,
                nombre_producto: nombre_producto,
                unidad_producto: unidad_producto,
                precioA: precioA,
                precioB: precioB,
                producto_categoria: producto_categoria,
                oferta: oferta,
                moneda: moneda,
                producto_prioridad: producto_prioridad,
                marca: marca,
                codigo: codigo,
                calif: calif,
                colores: colores,
                tamanos: tamanos,
                descrip: descrip,
                condi: condi,
                foto1: foto1,
                foto2: foto2,
                foto3: foto3,
                instruccion: instruccion
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