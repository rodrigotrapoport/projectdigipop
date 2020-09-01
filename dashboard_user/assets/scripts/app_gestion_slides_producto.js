function cargarDatos() {
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_productos.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            categorias = lineas.config.catSlide;
            console.log("Categoria Slides objetos: " + categorias);
            slides = lineas.config.slides;
            console.log("Slides objetos: " + slides);

            temp_option_cat = ``;
            template_cat = ``;
            template_slides = ``;
            console.log("JSON esta cargado!")
            for (i in categorias) {
                template_cat += `
                                <tr idcatSlides="${categorias[i]['id']}">
                                    <td>categoria${categorias[i]['id']}</td>
                                    <td>${categorias[i]['titulo']}</td> 
                                    <td>
                                        <a href="#collapseOne" class="btn_edit_slicat"><i class="fas fa-edit" style="color:blue;"></i></a> 
                                        <a href="#collapseOne" class="btn_del_slicat"><i class="fas fa-trash-alt" style="color:red;"></i></a> 
                                        <a href="#collapseOne" class="btn_cop_slicat"><i class="fas fa-copy" style="color:orange;"></i></a>
                                    </td>
                                </tr>`;
                /* Para tomar el último ID de Categoria SLIDE */
                id_slicat_ultimo = `${categorias[i]['id']}`;
                console.log("soy id ultimo cat:" + id_slicat_ultimo);
                /* Armar el option Categorias */
                temp_option_cat += `<option value="categoria${categorias[i]['id']}">categoria${categorias[i]['id']}: ${categorias[i]['titulo']}</option>`;
            };
            /* Para imprimir listo el nuevo ID Categoria Slide*/
            indice_new_slicat = parseInt(id_slicat_ultimo) + 1;
            console.log("Soy la ultima categoria a generar:" + indice_new_slicat);
            nueva_categoria = "categoria" + indice_new_slicat;;
            /* Para generar tabla slide */
            for (z in slides) {
                template_slides += `
                                        <tr idSlide="${slides[z]['id']}">
                                            <td>${slides[z]['id']}</td>
                                            <td>${slides[z]['slideCategoria']}</td>
                                            <td><img src="${slides[z]['foto']}" class="img-thumbnail" width="30%" alt=""></td> 
                                            <td>${slides[z]['filtroFoto']}</td>
                                            <td>${slides[z]['opacidad']}</td>
                                            <td>${slides[z]['titulo']}</td> 
                                            <td>${slides[z]['subtitulo']}</td>
                                            <td>${slides[z]['texto']}</td>
                                            <td><a href="${slides[z]['link']}" target="_blank">${slides[z]['link']}</a></td>
                                            <td>${slides[z]['textoBtn']}</td> 
                                            <td>${slides[z]['colorBtn']}</td>
                                            <td>${slides[z]['tipoBtn']}</td>
                                            <td>${slides[z]['sombraBtn']}</td> 
                                            <td>${slides[z]['colorTxTitulo']}</td>
                                            <td>${slides[z]['colorTxSubtitulo']}</td>
                                            <td>${slides[z]['colorTxBtn']}</td>
                                            <td>${slides[z]['form']}</td>
                                            <td>
                                                <a href="#collapseTwo" class="btn_edit_sli"><i class="fas fa-edit" style="color:blue;"></i></a> 
                                                <a href="#collapseTwo" class="btn_del_sli"><i class="fas fa-trash-alt" style="color:red;"></i></a> 
                                                <a href="#collapseTwo" class="btn_cop_sli"><i class="fas fa-copy" style="color:orange;"></i></a>
                                            </td>
                                        </tr>
                        `;
                id_slide_ultimo = `${slides[z]['id']}`;
            };
            /* Indice de SLIDE */
            indice_new_sli = parseInt(id_slide_ultimo) + 1;
            nuevo_slide = "slide" + indice_new_sli;


            /* Ingresar los valores pre-cargados en la sección Agregar o Editar Categoria */
            $('#tabla_cat_slides').html(template_cat);
            $('#instruccion_cat_slide').text("crear");
            $('#id_cat_slide').text(nueva_categoria);
            $('#tabla_slides').html(template_slides);
            $('#instruccion_slide').text("crear");
            $('#slide_categoria').html(temp_option_cat);
            $('#id_slide').text(nuevo_slide);
        }
    })
};

// BOTONES
/* Función Editar Categoria de Slides */
$(document).on('click', '.btn_edit_slicat', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_editar_catslides = $(element).attr('idcatSlides');
    console.log("ID editar Equipo " + id_editar_catslides);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_productos.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            categoria_sli = lineas.config.catSlide;
            console.log("Categoria Slides objetos: " + categoria_sli);
            console.log("JSON esta cargado para Editar!");
            editar_categoria_slide = "catSlide" + parseInt(id_editar_catslides);
            /* Para generar lista de Servicios */
            titulo = `${categoria_sli[editar_categoria_slide]['titulo']}`;
            /* Ingresar los valores pre-cargados en la sección Agregar o Editar Categoria */
            $('#id_cat_slide').text(editar_categoria_slide);
            $('#instruccion_cat_slide').text("editar");
            $('#slides_nombre_categoria').val(titulo);

        }
    })
});
/* Función Borrar Categoria de Slides */
$(document).on('click', '.btn_del_slicat', function () {
    let element = $(this)[0].parentElement.parentElement;
    var id_borrar_catslides = $(element).attr('idcatSlides');
    console.log("ID borrar Equipo " + id_borrar_catslides);
    var mensaje = confirm("¿Estas seguro que quieres borrarlo?");
    if (mensaje) {
	    
	    ///// RUTA  A LA CARPETA DE LA TIENDA ///////
        var tienda = 'Rodrigo';
	    var ruta = '../ecommerce/' + tienda +'/config/assets/php/guardar_JSON.php' ;
	    
        $.ajax({
            url: ruta, //'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                id_catSlide: id_borrar_catslides,
                instruccion_catSlide: "borrar",
                titulo_catSlide: ""
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
/* Función Copiar Categoria de Slides */
$(document).on('click', '.btn_cop_slicat', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_copiar_catslides = $(element).attr('idcatSlides');
    console.log("ID copiar Equipo " + id_copiar_catslides);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_productos.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            categoria_sli = lineas.config.catSlide;
            console.log("Categoria Slides objetos: " + categoria_sli);
            console.log("JSON esta cargado para Copiar!");
            id_copiar_cat_slide = "catSlide" + parseInt(id_copiar_catslides);
            id_catslide_ultimo = ``;
            for (wii in categoria_sli) {
                id_catslide_ultimo = `${categoria_sli[wii]['id']}`;
            };
            newid = parseInt(id_catslide_ultimo) + 1;
            id_crear_catslide = "catSlide" + newid;
            /* Para generar captura de datos */
            titulo = `${categoria_sli[id_copiar_cat_slide]['titulo']}`;

            /* Ingresar los valores pre-cargados en la sección Agregar o Editar Categoria Slide */
            $('#id_cat_slide').text(id_crear_catslide);
            $('#instruccion_cat_slide').text("crear");
            $('#slides_nombre_categoria').val(titulo);
        }
    })

});
/* Función Editar Slides */
$(document).on('click', '.btn_edit_sli', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_editar_slide = $(element).attr('idSlide');
    console.log("ID editar Slide " + id_editar_slide);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_productos.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            slides = lineas.config.slides;
            categorias = lineas.config.catSlide;
            console.log("Slides objetos: " + slides);
            console.log("CatSlides objetos: " + categorias);
            console.log("JSON esta cargado para Editar Slides!");
            editar_slide = "slide" + parseInt(id_editar_slide);
            console.log("Editar Slide " + editar_slide);
            /* Capturar datos */
            id_sli = `${slides[editar_slide]['id']}`;
            sli_cat = `${slides[editar_slide]['slideCategoria']}`;
            foto = `${slides[editar_slide]['foto']}`;
            filtroFoto = `${slides[editar_slide]['filtroFoto']}`;
            opacidad = `${slides[editar_slide]['opacidad']}`;
            titulo = `${slides[editar_slide]['titulo']}`;
            subtitulo = `${slides[editar_slide]['subtitulo']}`;
            texto = `${slides[editar_slide]['texto']}`;
            link = `${slides[editar_slide]['link']}`;
            textoBtn = `${slides[editar_slide]['textoBtn']}`;
            colorBtn = `${slides[editar_slide]['colorBtn']}`;
            tipoBtn = `${slides[editar_slide]['tipoBtn']}`;
            sombraBtn = `${slides[editar_slide]['sombraBtn']}`;
            colorTxTitulo = `${slides[editar_slide]['colorTxTitulo']}`;
            colorTxSubtitulo = `${slides[editar_slide]['colorTxSubtitulo']}`;
            colorTxBtn = `${slides[editar_slide]['colorTxBtn']}`;
            form = `${slides[editar_slide]['form']}`;
            console.log(id_sli);
            console.log(sli_cat);
            console.log(foto);
            console.log(filtroFoto);
            console.log(opacidad);
            console.log(titulo);
            console.log(subtitulo);
            console.log(texto);
            console.log(link);
            console.log(textoBtn);
            console.log(colorBtn);
            console.log(tipoBtn);
            console.log(sombraBtn);
            console.log(colorTxTitulo);
            console.log(colorTxSubtitulo);
            console.log(colorTxBtn);
            console.log(form);

            /* ENLISTAR CATEGORIAS */
            temp_option_cat = ``;
            for (it in categorias) {
                /* Armar el option Categorias */
                temp_option_cat += `<option value="categoria${categorias[it]['id']}">categoria${categorias[it]['id']}: ${categorias[it]['titulo']}</option>`;
            };
            temp_option_cat += `<option value="categoria${categorias['catSlide' + id_editar_slide]['id']}" selected>categoria${categorias['catSlide' + id_editar_slide]['id']}: ${categorias['catSlide' + id_editar_slide]['titulo']}</option>`;
            console.log("CatSli " + temp_option_cat);
            /* TIPO DE BOTON*/
            temp__tipoBtn = ``;
            if (tipoBtn == "Cuadrado") {
                temp_tipoBtn = `
                    <option value="Cuadrado" selected>Cuadrado</option>
                    <option value="Redondeado">Redondeado</option>
                `;
            } else {
                temp_tipoBtn = `
                    <option value="Cuadrado">Cuadrado</option>
                    <option value="Redondeado" selected>Redondeado</option>
                `;
            };
            console.log("Tipo Boton " + temp_tipoBtn);
            /* SOMBRA */
            temp_sombraBtn = ``;
            if (sombraBtn == "si") {
                temp_sombraBtn = `
                    <option value="si" selected>si</option>
                    <option value="no">no</option>
                `;
            } else {
                temp_sombraBtn = `
                    <option value="si">si</option>
                    <option value="no" selected>no</option>
                `;
            };
            console.log("Sombra Boton " + temp_sombraBtn);
            /* FORM */
            temp_form = ``;
            if (sombraBtn == "si") {
                temp_form = `
                    <option value="si" selected>si</option>
                    <option value="no">no</option>
                `;
            } else {
                temp_form = `
                    <option value="si">si</option>
                    <option value="no" selected>no</option>
                `;
            };
            console.log("Form " + temp_form);
            /* FILTRO FOTO */
            temp_filtroFoto = ``;
            if (filtroFoto === "Ninguno") {
                temp_filtroFoto = `  
                    <option value="Ninguno" selected>Ninguno</option>
                    <option value="Desenfoque">Desenfoque</option> 
                    <option value="Escala de grises">Escala de grises</option> 
                    <option value="Sepia">Sepia</option> 
                    <option value="Saturación">Saturación</option> 
                    <option value="Transparencia">Transparencia</option>
                `;
            } else if (filtroFoto == "Desenfoque") {
                temp_filtroFoto = `
                    <option value="Ninguno">Ninguno</option>
                    <option value="Desenfoque" selected>Desenfoque</option> 
                    <option value="Escala de grises">Escala de grises</option> 
                    <option value="Sepia">Sepia</option> 
                    <option value="Saturación">Saturación</option> 
                    <option value="Transparencia">Transparencia</option>
                `;
            } else if (filtroFoto == "Escala de grises") {
                temp_filtroFoto = `
                    <option value="Ninguno">Ninguno</option>
                    <option value="Desenfoque">Desenfoque</option> 
                    <option value="Escala de grises" selected>Escala de grises</option> 
                    <option value="Sepia">Sepia</option> 
                    <option value="Saturación">Saturación</option> 
                    <option value="Transparencia">Transparencia</option>
                `;
            } else if (filtroFoto == "Sepia") {
                temp_filtroFoto = `
                    <option value="Ninguno">Ninguno</option>
                    <option value="Desenfoque">Desenfoque</option> 
                    <option value="Escala de grises">Escala de grises</option> 
                    <option value="Sepia" selected>Sepia</option> 
                    <option value="Saturación">Saturación</option> 
                    <option value="Transparencia">Transparencia</option>
                `;
            } else if (filtroFoto == "Saturación") {
                temp_filtroFoto = `
                    <option value="Ninguno">Ninguno</option>
                    <option value="Desenfoque">Desenfoque</option> 
                    <option value="Escala de grises">Escala de grises</option> 
                    <option value="Sepia">Sepia</option> 
                    <option value="Saturación" selected>Saturación</option> 
                    <option value="Transparencia">Transparencia</option>
                `;
            } else {
                temp_filtroFoto = `
                    <option value="Ninguno">Ninguno</option>
                    <option value="Desenfoque">Desenfoque</option> 
                    <option value="Escala de grises">Escala de grises</option> 
                    <option value="Sepia">Sepia</option> 
                    <option value="Saturación">Saturación</option> 
                    <option value="Transparencia" selected>Transparencia</option>
                `;
            };
            console.log("Filtro " + temp_filtroFoto);
            temp_opacidad = ``;
            if (opacidad == "0") {
                temp_opacidad = `  
                    <option value="0" selected>0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.1") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1" selected>0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.2") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2" selected>0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.3") {
                temp_filtroFoto = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3" selected>0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.4") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4" selected>0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.5") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5" selected>0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.6") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6" selected>0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.7") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7" selected>0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.8") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8" selected>0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.9") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9" selected>0.9</option>
                    <option value="1">1</option>
                `;
            } else {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1" selected>1</option>
                `;
            };
            console.log("Opacidad " + temp_opacidad);
            /* Ingresar los valores pre-cargados en la sección Agregar o Editar SLIDE */
            $('#id_slide').text(editar_slide);
            $('#instruccion_slide').text("editar");
            $('#slide_categoria').html(temp_option_cat);
            $('#slide_titulo').val(titulo);
            $('#slide_subtitulo').val(subtitulo);
            $('#slide_texto').val(texto);
            $('#slide_link').val(link);
            $('#slide_boton').val(textoBtn);
            $('#slide_tipo_boton').html(temp_tipoBtn);
            $('#slide_color_boton').val(colorBtn);
            $('#slide_sombra_boton').html(temp_sombraBtn);
            $('#slide_titulo_color').val(colorTxTitulo);
            $('#slide_subtitulo_color').val(colorTxSubtitulo);
            $('#slide_texto_color').val(colorTxBtn);
            $('#slide_form').html(temp_form);
            $('#slide_filtro').html(temp_filtroFoto);
            $('#slide_opacidad').html(temp_opacidad);
            $('#slide_image').val(foto);
        }
    })

});
/* Función Borrar Slides */
$(document).on('click', '.btn_del_sli', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_borrar_slide = $(element).attr('idSlide');
    console.log("ID borrar SLIDE " + id_borrar_slide);
    var mensaje = confirm("¿Estas seguro que quieres borrarlo?");
    if (mensaje) {
	    
	    ///// RUTA  A LA CARPETA DE LA TIENDA ///////
        var tienda = 'Rodrigo';
	    var ruta = '../ecommerce/' + tienda +'/config/assets/php/guardar_JSON.php' ;
	    
        $.ajax({
            url: ruta, //'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                id_slide: id_borrar_slide,
                instruccion_slide: "borrar",
                slide_categoria: "",
                slide_titulo: "",
                slide_subtitulo: "",
                slide_texto: "",
                slide_link: "",
                slide_textoBtn: "",
                slide_tipoBtn: "",
                slide_colorBtn: "",
                slide_sombraBtn: "",
                slide_colorTxTitulo: "",
                slide_colorTxSubtitulo: "",
                slide_colorTxBtn: "",
                slide_form: "",
                slide_filtro: "",
                slide_opacidad: "",
                slide_image: ""
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
/* Función Copiar Slides */
$(document).on('click', '.btn_cop_sli', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_copiar_slide = $(element).attr('idSlide');
    console.log("ID copiar Slide " + id_copiar_slide);
    $.ajax({
        url: '/dashboard_user/assets/php/traductor_config_productos.php',
        type: 'POST',
        success: function (response) {
            const lineas = JSON.parse(response);
            slides = lineas.config.slides;
            categorias = lineas.config.catSlide;
            console.log("Slides objetos: " + slides);
            console.log("CatSlides objetos: " + categorias);
            console.log("JSON esta cargado para Editar Slides!");
            copiar_slide = "slide" + parseInt(id_copiar_slide);
            for (zw in slides) {
                id_slide_ultimo = `${slides[zw]['id']}`;
            };
            newid_temp = 1 + parseInt(id_slide_ultimo);
            newid_slide = "slide" + newid_temp;
            /* Capturar datos */
            id_sli = newid_slide;
            sli_cat = `${slides[copiar_slide]['slideCategoria']}`;
            foto = `${slides[copiar_slide]['foto']}`;
            filtroFoto = `${slides[copiar_slide]['filtroFoto']}`;
            opacidad = `${slides[copiar_slide]['opacidad']}`;
            titulo = `${slides[copiar_slide]['titulo']}`;
            subtitulo = `${slides[copiar_slide]['subtitulo']}`;
            texto = `${slides[copiar_slide]['texto']}`;
            link = `${slides[copiar_slide]['link']}`;
            textoBtn = `${slides[copiar_slide]['textoBtn']}`;
            colorBtn = `${slides[copiar_slide]['colorBtn']}`;
            tipoBtn = `${slides[copiar_slide]['tipoBtn']}`;
            sombraBtn = `${slides[copiar_slide]['sombraBtn']}`;
            colorTxTitulo = `${slides[copiar_slide]['colorTxTitulo']}`;
            colorTxSubtitulo = `${slides[copiar_slide]['colorTxSubtitulo']}`;
            colorTxBtn = `${slides[copiar_slide]['colorTxBtn']}`;
            form = `${slides[copiar_slide]['form']}`
            /* ENLISTAR CATEGORIAS */
            temp_option_cat = ``;
            for (it in categorias) {
                /* Armar el option Categorias */
                temp_option_cat += `<option value="categoria${categorias[it]['id']}">categoria${categorias[it]['id']}: ${categorias[it]['titulo']}</option>`;
            };
            temp_option_cat = `<option value="categoria${categorias['catSlide' + id_copiar_slide]['id']}" selected>categoria${categorias['catSlide' + id_copiar_slide]['id']}: ${categorias['catSlide' + id_copiar_slide]['titulo']}</option>`;
            /* TIPO DE BOTON*/
            temp__tipoBtn = ``;
            if (tipoBtn == "Cuadrado") {
                temp_tipoBtn = `
                    <option value="cuadrado" selected>Cuadrado</option>
                    <option value="redondeado">Redondeado</option>
                `;
            } else {
                temp_tipoBtn = `
                    <option value="Cuadrado">Cuadrado</option>
                    <option value="Redondeado" selected>Redondeado</option>
                `;
            };
            /* SOMBRA */
            temp_sombraBtn = ``;
            if (sombraBtn == "si") {
                temp_sombraBtn = `
                    <option value="si" selected>si</option>
                    <option value="no">no</option>
                `;
            } else {
                temp_sombraBtn = `
                    <option value="si">si</option>
                    <option value="no" selected>no</option>
                `;
            };
            /* FORM */
            temp_form = ``;
            if (sombraBtn == "si") {
                temp_form = `
                    <option value="si" selected>si</option>
                    <option value="no">no</option>
                `;
            } else {
                temp_form = `
                    <option value="si">si</option>
                    <option value="no" selected>no</option>
                `;
            };
            /* FILTRO FOTO */
            temp_filtroFoto = ``;
            if (filtroFoto == "Ninguno") {
                temp_filtroFoto = `  
                    <option value="Ninguno" selected>Ninguno</option>
                    <option value="Desenfoque">Desenfoque</option> 
                    <option value="Escala de grises">Escala de grises</option> 
                    <option value="Sepia">Sepia</option> 
                    <option value="Saturación">Saturación</option> 
                    <option value="Transparencia">Transparencia</option>
                `;
            } else if (filtroFoto == "Desenfoque") {
                temp_filtroFoto = `
                    <option value="Ninguno">Ninguno</option>
                    <option value="Desenfoque" selected>Desenfoque</option> 
                    <option value="Escala de grises">Escala de grises</option> 
                    <option value="Sepia">Sepia</option> 
                    <option value="Saturación">Saturación</option> 
                    <option value="Transparencia">Transparencia</option>
                `;
            } else if (filtroFoto == "Escala de grises") {
                temp_filtroFoto = `
                    <option value="Ninguno">Ninguno</option>
                    <option value="Desenfoque">Desenfoque</option> 
                    <option value="Escala de grises" selected>Escala de grises</option> 
                    <option value="Sepia">Sepia</option> 
                    <option value="Saturación">Saturación</option> 
                    <option value="Transparencia">Transparencia</option>
                `;
            } else if (filtroFoto == "Sepia") {
                temp_filtroFoto = `
                    <option value="Ninguno">Ninguno</option>
                    <option value="Desenfoque">Desenfoque</option> 
                    <option value="Escala de grises">Escala de grises</option> 
                    <option value="Sepia" selected>Sepia</option> 
                    <option value="Saturación">Saturación</option> 
                    <option value="Transparencia">Transparencia</option>
                `;
            } else if (filtroFoto == "Saturación") {
                temp_filtroFoto = `
                    <option value="Ninguno">Ninguno</option>
                    <option value="Desenfoque">Desenfoque</option> 
                    <option value="Escala de grises">Escala de grises</option> 
                    <option value="Sepia">Sepia</option> 
                    <option value="Saturación" selected>Saturación</option> 
                    <option value="Transparencia">Transparencia</option>
                `;
            } else {
                temp_filtroFoto = `
                    <option value="Ninguno">Ninguno</option>
                    <option value="Desenfoque">Desenfoque</option> 
                    <option value="Escala de grises">Escala de grises</option> 
                    <option value="Sepia">Sepia</option> 
                    <option value="Saturación">Saturación</option> 
                    <option value="Transparencia" selected>Transparencia</option>
                `;
            };
            temp_opacidad = ``;
            if (opacidad == "0") {
                temp_opacidad = `  
                    <option value="0" selected>0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.1") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1" selected>0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.2") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2" selected>0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.3") {
                temp_filtroFoto = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3" selected>0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.4") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4" selected>0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.5") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5" selected>0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.6") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6" selected>0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.7") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7" selected>0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.8") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8" selected>0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1">1</option>
                `;
            } else if (opacidad == "0.9") {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9" selected>0.9</option>
                    <option value="1">1</option>
                `;
            } else {
                temp_opacidad = `
                    <option value="0">0</option>
                    <option value="0.1">0.1</option>
                    <option value="0.2">0.2</option>
                    <option value="0.3">0.3</option>
                    <option value="0.4">0.4</option>
                    <option value="0.5">0.5</option>
                    <option value="0.6">0.6</option>
                    <option value="0.7">0.7</option>
                    <option value="0.8">0.8</option>
                    <option value="0.9">0.9</option>
                    <option value="1" selected>1</option>
                `;
            };
            /* Ingresar los valores pre-cargados en la sección Agregar o Editar Categoria */
            $('#id_slide').text(id_sli);
            $('#instruccion_slide').text("crear");
            $('#slide_categoria').html(temp_option_cat);
            $('#slide_titulo').val(titulo);
            $('#slide_subtitulo').val(subtitulo);
            $('#slide_texto').val(texto);
            $('#slide_link').val(link);
            $('#slide_boton').val(textoBtn);
            $('#slide_tipo_boton').html(temp_tipoBtn);
            $('#slide_color_boton').val(colorBtn);
            $('#slide_sombra_boton').html(temp_sombraBtn);
            $('#slide_titulo_color').val(colorTxTitulo);
            $('#slide_subtitulo_color').val(colorTxSubtitulo);
            $('#slide_texto_color').val(colorTxBtn);
            $('#slide_form').html(temp_form);
            $('#slide_filtro').html(temp_filtroFoto);
            $('#slide_opacidad').html(temp_opacidad);
            $('#slide_image').val(foto);

        }
    })
});



// GUARDAR LOS FORMULARIOS DE SLIDES //////
$(document).ready(function () {
	//// CATSLIDES /////
    cargarDatos();
    $('.btn-catsli').click(function (e) {
        console.log("Hiciste click en el boton Guardar Categoria Slide");
        id_catslides = $('#id_cat_slide').text();
        intruccion = $('#instruccion_cat_slide').text();
        titulo = $('#slides_nombre_categoria').val();
        console.log("ID CATSLIDES " + id_catslides);
        console.log("INSTRUCCION CATSLIDES" + intruccion);
        console.log("Titulo catslides " + titulo);
        e.preventDefault();
        
        ///// RUTA  A LA CARPETA DE LA TIENDA ///////
        var tienda = 'Rodrigo';
	    var ruta = '../ecommerce/' + tienda +'/config/assets/php/guardar_JSON.php' ;
	    
        $.ajax({
            url: ruta, //'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                id_catSlide: id_catslides,
                instruccion_catSlide: intruccion,
                titulo_catSlide: titulo
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
    ///// SLIDES /////
    $('.btn-sli').click(function (e) {
        console.log("Hiciste click en el boton Guardar Slide");
        id_slide = $('#id_slide').text();
        instruccion = $('#instruccion_slide').text();
        categoria = $('#slide_categoria').val();
        titulo = $('#slide_titulo').val();
        subtitulo = $('#slide_subtitulo').val();
        texto = $('#slide_texto').val();
        link = $('#slide_link').val();
        textboton = $('#slide_boton').val();
        tipoboton = $('#slide_tipo_boton').val();
        colorboton = $('#slide_color_boton').val();
        sombra = $('#slide_sombra_boton').val();
        colortitulo = $('#slide_titulo_color').val();
        colorsubtitulo = $('#slide_subtitulo_color').val();
        colortexto = $('#slide_texto_color').val();
        form = $('#slide_form').html();
        filtro = $('#slide_filtro').html();
        opacidad = $('#slide_opacidad').html();
        imagen = $('#slide_image').val();
        console.log(id_slide);
        console.log(instruccion);
        console.log(categoria);
        console.log(titulo);
        console.log(subtitulo);
        console.log(texto);
        console.log(link);
        console.log(textboton);
        console.log(tipoboton);
        console.log(colorboton);
        console.log(sombra);
        console.log(colortitulo);
        console.log(colorsubtitulo);
        console.log(colortexto);
        console.log(form);
        console.log(filtro);
        console.log(opacidad);
        console.log(imagen);
        e.preventDefault();
        
        ///// RUTA  A LA CARPETA DE LA TIENDA ///////
        var tienda = 'Rodrigo';
	    var ruta = '../ecommerce/' + tienda +'/config/assets/php/guardar_JSON.php' ;
	    
        $.ajax({
            url: ruta, //'assets/php/guardar_JSON.php',
            type: 'GET',
            data: {
                id_slide: id_slide,
                instruccion_slide: instruccion,
                slide_categoria: categoria,
                slide_titulo: titulo,
                slide_subtitulo: subtitulo,
                slide_texto: texto,
                slide_link: link,
                slide_textoBtn: textboton,
                slide_tipoBtn: tipoboton,
                slide_colorBtn: colorboton,
                slide_sombraBtn: sombra,
                slide_colorTxTitulo: colortitulo,
                slide_colorTxSubtitulo: colorsubtitulo,
                slide_colorTxBtn: colortexto,
                slide_form: form,
                slide_filtro: filtro,
                slide_opacidad: opacidad,
                slide_image: imagen
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
    
    
    /*
    $('.btn-nos').click(function (e) {
        nosotros_ofrecemos = $('#nosotros_ofrecemos').val(qofrecemos);
        nosotros_deferencial = $('#nosotros_diferencial').val(diferencial);
        nosotros_valores = $('#nosotros_valores').val(valores);
        nosotros_futuro = $('#nosotros_futuro').val(vision);
        nosotros_f1 = $('#foto1').val(foto1);
        nosotros_f2 = $('#foto2').val(foto2);
        nosotros_f3 = $('#foto3').val(foto3);
        nosotros_f4 = $('#foto4').val(foto4);
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
    }); */
}); 

