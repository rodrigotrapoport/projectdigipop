var result = document.getElementById("resul_tipografias");

function ShowSelectedTitulo(){
    let cod = document.getElementById("titulo");
    let op = cod.value;
    console.log(op);
    if (op == 1) {
        var url = "assets/images/alegreya.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="'+url+'";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 2) {
        var url = "assets/images/B612.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 3) {
        var url = "assets/images/Muli.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 4) {
        var url = "assets/images/Titillum.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 5) {
        var url = "assets/images/Varela.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 6) {
        var url = "assets/images/Vollkorn.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 7) {
        var url = "assets/images/IBM-Plex.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 8) {
        var url = "assets/images/Crimson.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 9) {
        var url = "assets/images/Cairo.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 10) {
        var url = "assets/images/BioRhyme.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else {
        result.innerHTML = '<p class="text-danger">Selecciona una tipografía</p>'
    };
    ///////// AJAX ///////
    $.ajax({ url : "./assets/php/guardar_JSON.php",   // envia a la url del carrito la informacion
	         method   : "POST", 
	         dataType : "json", 
	         data : { fTitulo  : op // texto agregado 
	         },  
	         success : function(resp){
		        var   consulta = resp.res;
		  	    alert(consulta);			                   
		     }, 
		     error   : function(res){
			    //alert('ERROR!!!');
	         }
	});
    
};

function ShowSelectedParrafo() {
    let cod1 = document.getElementById("parrafo");
    let op1 = cod1.value;
    console.log(op1);
    if (op1 == 11) {
        var url = "assets/images/Karla.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op1 == 12) {
        var url = "assets/images/Lora.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op1 == 13) {
        var url = "assets/images/Frank_Ruhl_Libre.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op1 == 14) {
        var url = "assets/images/Playfair_Display.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op1 == 15) {
        var url = "assets/images/Archivo.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op1 == 16) {
        var url = "assets/images/Spectral.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op1 == 17) {
        var url = "assets/images/Fjalla_One.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op1 == 18) {
        var url = "assets/images/Roboto.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op1 == 19) {
        var url = "assets/images/Montserrat.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op1 == 20) {
        var url = "assets/images/Rubik.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else {
        result.innerHTML = '<p class="text-danger">Selecciona una tipografía</p>'
    };
    ///////// AJAX ///////
    $.ajax({ url : "./assets/php/guardar_JSON.php",   // envia a la url del carrito la informacion
	         method   : "POST", 
	         dataType : "json", 
	         data : { fParrafo  : op1 // texto agregado 
	         },  
	         success : function(resp){
		        var   consulta = resp.res;
		  	    alert(consulta);			                   
		     }, 
		     error   : function(res){
			    //alert('ERROR!!!');
	         }
	});
};

function ShowSelectedTituloEsp() {
    var cod = document.getElementById("titulo_especiales");
    let op = cod.value;
    console.log(op);
    if (op == 21) {
        var url = "assets/images/Source_sans.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 22) {
        var url = "assets/images/Cardo.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 23) {
        var url = "assets/images/Cormorant.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 24) {
        var url = "assets/images/Work_sans.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 25) {
        var url = "assets/images/Rakkas.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 26) {
        var url = "assets/images/Concert_One.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 27) {
        var url = "assets/images/Yatra_One.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 28) {
        var url = "assets/images/Arvo.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 29) {
        var url = "assets/images/Montserrat.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else if (op == 30) {
        var url = "assets/images/Rubik.jpg";
        result.innerHTML = '<img id="imagen" class="img-fluid" src="' + url + '";alt="">';
        result.innerHTML += '<br><br><button class="btn btn-success" type="button">Elegir</button>';
    } else {
        result.innerHTML = '<p class="text-danger">Selecciona una tipografía</p>'
    };
    ///////// AJAX ///////
    $.ajax({ url : "./assets/php/guardar_JSON.php",   // envia a la url del carrito la informacion
	         method   : "POST", 
	         dataType : "json", 
	         data : { fSubtitulo  : op // texto agregado 
	         },  
	         success : function(resp){
		        var   consulta = resp.res;
		  	    alert(consulta);			                   
		     }, 
		     error   : function(res){
			    //alert('ERROR!!!');
	         }
	});
};
