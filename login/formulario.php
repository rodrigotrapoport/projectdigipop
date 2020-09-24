<?php
require('log/log.php');

/// CONEXION DB ///
$dbc = mysqli_connect(DBHOST,DBUSER,DBPW);
if (!$dbc) {
    exit();
};

$dbs = mysqli_select_db($dbc, DBNAME);
if (!$dbs) {
    exit();
};

//****** AES ***********	
$claveEncriptacion = 'exito seguro!';
$secret = 'texto secreto 1';
function my_simple_crypt( $string, $action = 'e', $clave, $secr ) {
    $secret_key = $clave; 
    $secret_iv  = $secr ;
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    };
    return $output;
}	
//**************************
$nombreUsuario = '';
$emailUsuario = '';	
	
if(isset($_GET['link'])){
	$link      = $_GET['link'];
	$idUsuario =  my_simple_crypt( $_GET['link'], 'd', $claveEncriptacion, $secret );
	
	//****** CHECA QUE NO SE REPITA LA CARGA DE DATOS *****
		
		$values = "SELECT  id  FROM serContrato WHERE idUsuario='$idUsuario' ";
		$result = $dbc->query($values);	
		$check1  = mysqli_num_rows($result);
		
		$values = "SELECT  id  FROM usuarios WHERE idUsuario='$idUsuario' ";
		$result = $dbc->query($values);	
		$check2  = mysqli_num_rows($result);
		
		$values = "SELECT  id  FROM tiendas WHERE idUsuario='$idUsuario' ";
		$result = $dbc->query($values);	
		$check3  = mysqli_num_rows($result);
    
    //************************************
	
	$values = "SELECT email, nombre  FROM inscripcion WHERE idUsuario='$idUsuario' 
	           AND estatus='approved'  
	           AND medioPago IS NOT NULL 
	           AND collection_id IS NOT NULL 
	           AND collection_status IS NOT NULL";  // corregir si cambia metodo pago y pago  pending  o rechazado
	          
	$result = $dbc->query($values);	
	$filas  = mysqli_num_rows($result);	
	if($filas == 1 AND $check1==0 AND $check2==0 AND $check3==0){   // solo si existe un registro para acreditar pago continua
		//echo '<br> encontro 1 resultado <br>';
		while($row = $result -> fetch_assoc()){
		    $emailUsuario = $row['email'];
		    $nombreUsuario= $row['nombre'];
		};		
	} else { header('Location:login.html'); };
};	
	
	
//echo  'hola';	
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digipop Tech</title>
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
        
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
	    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous">
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
	    crossorigin="anonymous">
	</script>
    
    <link rel="stylesheet" href="css/estilosiniciar.css">
    
    <style>
		.fondo {
		  height: 100%;
		  background-image: linear-gradient(#D8D8DF, #EFEFF0); 
		  /* Standard syntax (must be last) */
		}
		
		img {
	        width: 250px;
	        -webkit-filter: drop-shadow(5px 5px 10px #666666);
	        filter: drop-shadow(5px 5px 5px #666666);
	      }
    </style>

</head>

<body class="fondo" onload="inicio()">

	<!--
    <div class="wrapper fadeInDown">
        <div id="formContent">
            

            
            <div class="fadeIn first">
                <br>
                <i class="fas fa-user"></i> Registro de Usuario<br><br>
            </div>

            
            <form class="col col-md-6">
                <input type="text" id="" class="fadeIn second col-md-12 is-invalid" name="nombre" placeholder="Nombres" ><br><br>
                
                <input type="text" id="" class="fadeIn second col-md-12 is-invalid" name="apellido" placeholder="Apellidos" ><br><br>
                
                <input type="text" id="" class="fadeIn second col-md-12 is-invalid" name="email" placeholder="Email" ><br><br>
                
                <input type="text" id="" class="fadeIn second col-md-12 is-invalid" name="conf_email" placeholder="Confirmar Email" ><br><br>
                
                <input type="text" id="" class="fadeIn second col-md-12 is-invalid" name="usuario" placeholder="Crear Usuario" ><br><br>
                
                <input type="text" id="" class="fadeIn third col-md-12 is-invalid" name="password" placeholder="PIN 4 digitos" ><br><br>
                
                <input type="text" id="" class="fadeIn third col-md-12 is-invalid" name="conf_password" placeholder="Confirmar PIN 4 digitos" ><br><br>
                
                
			    <select name="fTipo" id="fTipo" class="col-md-12">
			    	<option value="servicio" >Servicio</option>
				    <option value="ecommerce">Ecommerce</option>   
				</select><br><br>
			    
                <input type="text" id="" class="fadeIn third col-md-12 is-invalid" name="nombre_tienda" placeholder="Nombre de la Tienda" ><br><br>
                
                <input type="text" id="" class="fadeIn third col-md-12 is-invalid" name="rubro" placeholder="Rubro" ><br><br>
                
                <input type="text" id="" class="fadeIn third col-md-12 is-invalid" name="direccion" placeholder="Dirección completa" ><br><br>
                
                <input type="text" id="" class="fadeIn third col-md-12 is-invalid" name="localidad" placeholder="Localidad" ><br><br>
                
                <input type="text" id="" class="fadeIn third col-md-12 is-invalid" name="estado" placeholder="Estado o provincia" ><br><br>
                
                <input type="text" id="" class="fadeIn third col-md-12 is-invalid" name="pais" placeholder="País" ><br><br>
                
                <input type="button" class="fadeIn fourth" value="Registrarme" id="enviarConsulta">
            </form>

            <
            <div id="formFooter">
                <a class="underlineHover" href="login.html">Iniciar Sesión</a>  
            </div>

        </div>
    </div>
    -->
    <br><br>
    <div class="container col-md-6">
	    <div class="row justify-content-md-center">
	        <img src="digiPop.svg" height="70px"  class="col-md-3 col8"><br>
	    </div>
	    <br>
	    <p class="h3 text-dark text-center">FAVOR DE COMPLETAR EL FORMULARIO DE INSCRIPCIÓN</p>
	    <hr>
	    
	    <form class="">
			<div class="form-group">
			    <label for="formGroupExampleInput">Nombre Completo</label>
			    <input type="text" class="form-control is-valid" id="nombre" value="<?php  echo $nombreUsuario;?>" oninput="nombreP()">
		    </div>
			
			<div class="form-group">
			    <label for="formGroupExampleInput2">Email</label>
			    <input type="text" class="form-control is-valid" id="email" value="<?php echo $emailUsuario;?>" oninput="emailP()">
			</div>
			
			<div class="form-group">
			    <label for="formGroupExampleInput2">Usuario</label>
			    <input type="text" class="form-control is-invalid" id="usuario" placeholder="De 8 caracteres o mas" oninput="usuarioP()">
			    <div class="invalid-feedback" id="error" style="display: none">
			        ESCRIBA OTRO NOMBRE EL USUARIO YA EXISTE!!!
			    </div>
			</div>

            <div class="form-group">
			    <label for="formGroupExampleInput2">Pin</label>
			    <input type="password" class="form-control is-invalid" id="password" placeholder="Pin de 4 digitos" oninput="pinP()">
			</div>
			
			<div class="form-group">
			    <label for="formGroupExampleInput2">Confirmar Pin</label>
			    <input type="password" class="form-control is-invalid" id="conf_password" placeholder="Pin de 4 digitos" oninput="c_pinP()">
			</div>
		    
		    <div class="form-group">
			    <label for="formGroupExampleInput2">Nombre de Tu Tienda</label>
			    <input type="text" class="form-control is-invalid" id="nombre_tienda" placeholder="Digipop" oninput="nombreT()">
			</div>
		    
		    <div class="form-group">
			    <label for="formGroupExampleInput2">Rubro</label>
			    <input type="text" class="form-control is-invalid" id="rubro" placeholder="Ecommerce" oninput="rubroT()">
			</div>
		    
		    <div class="form-group">
			    <label for="formGroupExampleInput2">Direccion Completa</label>
			    <input type="text" class="form-control is-invalid" id="direccion" placeholder="Los Almendros 3000 Barrio Los Alamos C.P.1000" oninput="direccionP()">
			</div>
		    
		    <div class="form-group">
			    <label for="formGroupExampleInput2">Ciudad/Localidad</label>
			    <input type="text" class="form-control is-invalid" id="localidad" placeholder="Puerto Vallarta" oninput="localidadP()">
			</div>
			
			<div class="form-group">
			    <label for="formGroupExampleInput2">Estado/Provincia</label>
			    <input type="text" class="form-control is-invalid" id="estado" placeholder="Nayarit" oninput="estadoP()">
			</div>
			
			<div class="form-group">
			    <label for="formGroupExampleInput2">Pais</label>
			    <input type="text" class="form-control is-invalid" id="pais" placeholder="Mexico" oninput="paisP()">
			</div>
		    
		    <button type="button" class="btn btn-primary btn-block" id="enviarConsulta">Registrarme</button>

		</form>
		
		<hr>
		<div class="row justify-content-md-center">
			<a class="btn btn-link" href="#" role="button">Login</a>
			&nbsp;
			<a class="btn btn-link" href="#" role="button">Recuperar Pin</a>
			
		</div>
	    
    </div>
    
    <br><br>

    <!-- Image and text -->
	<nav class="navbar navbar-light bg-dark text-white">
	  <a class="navbar-brand text-white" href="www.digipop.tech">
	    <img src="digiPop.svg"  height="40" class="d-inline-block align-top" alt="">www.digipop.tech
	  </a>
	  <a class="text-center">hola@digipop.tech</a>
	</nav>
      
</body>

<script type="text/javascript">
	
	function inicio(){
		document.getElementById("enviarConsulta").disabled = true;
	}
	
	function botonP(){
		if(
	        document.getElementById("email").className == "form-control is-valid"         &&
	        document.getElementById("usuario").className == "form-control is-valid"       &&
	        document.getElementById("password").className == "form-control is-valid"      &&
	        document.getElementById("conf_password").className == "form-control is-valid" &&
	        document.getElementById("nombre_tienda").className == "form-control is-valid" &&
	        document.getElementById("rubro").className == "form-control is-valid"         &&
	        document.getElementById("direccion").className == "form-control is-valid"     &&
	        document.getElementById("localidad").className == "form-control is-valid"     &&
	        document.getElementById("estado").className == "form-control is-valid"        &&
	        document.getElementById("pais").className == "form-control is-valid"                  
        ){
	        document.getElementById("enviarConsulta").disabled = false;
        } else {
	        document.getElementById("enviarConsulta").disabled = true;
        };
        
	}
	
	$(document).ready(function(){  
	    $('#usuario').keyup(function(){  
	           var query = $('#usuario').val();  
	           if(query != '')  
	           {  
	                $.ajax({  
	                    url:"usuario.php",  
	                    method:"POST",
	                    dataType: 'json',  
	                    data:{ nombre: query },  
	                    success:function(data)  
	                    {  
	                        //var datosX = JSON.parse(data);
	                        var consulta = data.res;
	                        console.log( consulta );
	                        if( consulta == 'error'){
	                            document.getElementById("usuario").className = "form-control is-invalid";
	                            //document.getElementById("error").className   = "invalid-feedback";
	                            document.getElementById("error").style.display = 'block';
	                        } else {
		                        document.getElementById("error").style.display = 'none'; 
		                    }; 
	                    }, 
					    error:function(res){
						    console.log('no llega nada ');
						}  
	                });  
	           }  
	    });
	});
	
	
	
    function usuarioP() {
	    var n = document.getElementById("usuario").value;
	    if( n.length > 7 ){
		    document.getElementById("usuario").className = "form-control is-valid";
	    } else{
		    document.getElementById("usuario").className = "form-control is-invalid";
        };
        botonP();
    }
    function pinP() {
	    var n = document.getElementById("password").value;
	    if( n.length == 4 ){
		    document.getElementById("password").className = "form-control is-valid";
	    } else{
		    document.getElementById("password").className = "form-control is-invalid";
        };
        botonP();
    }
    function c_pinP() {
	    var n = document.getElementById("conf_password").value;
	    if( n ==   document.getElementById("password").value ){
		    document.getElementById("conf_password").className = "form-control is-valid";
	    } else{
		    document.getElementById("conf_password").className = "form-control is-invalid";
        };
        botonP();
    }
    function nombreT() {
	    var n = document.getElementById("nombre_tienda").value;
	    if( n.length > 6 ){
		    document.getElementById("nombre_tienda").className = "form-control is-valid";
	    } else{
		    document.getElementById("nombre_tienda").className = "form-control is-invalid";
        };
        botonP();
    }
    function rubroT() {
	    var n = document.getElementById("rubro").value;
	    if( n.length > 6 ){
		    document.getElementById("rubro").className = "form-control is-valid";
	    } else{
		    document.getElementById("rubro").className = "form-control is-invalid";
        };
        botonP();
    }
    function direccionP() {
	    var n = document.getElementById("direccion").value;
	    if( n.length > 15 ){
		    document.getElementById("direccion").className = "form-control is-valid";
	    } else{
		    document.getElementById("direccion").className = "form-control is-invalid";
        };
        botonP();
    }
    function localidadP() {
	    var n = document.getElementById("localidad").value;
	    if( n.length > 7 ){
		    document.getElementById("localidad").className = "form-control is-valid";
	    } else{
		    document.getElementById("localidad").className = "form-control is-invalid";
        };
        botonP();
    }
    function estadoP() {
	    var n = document.getElementById("estado").value;
	    if( n.length > 6 ){
		    document.getElementById("estado").className = "form-control is-valid";
	    } else{
		    document.getElementById("estado").className = "form-control is-invalid";
        };
        botonP();
    }
    function paisP() {
	    var n = document.getElementById("pais").value;
	    if( n.length > 5 ){
		    document.getElementById("pais").className = "form-control is-valid";
	    } else{
		    document.getElementById("pais").className = "form-control is-invalid";
        };
        botonP();
    }
    
    
$(document).ready(function(){  
    $('#enviarConsulta').click(function(){ 
	    
	    // ENVIA LOS DATOS PERSONALES 
	    $.ajax({  
	        url:"registro.php",   // envia a la url DE DATOS PERSONALES
	        method:"POST", 
	        dataType: 'json', 
	        data:{
		          ref        : '<?php echo $link;?>', 
		          fUsuario   : $("#usuario").val(),
		          fPin       : $("#conf_password").val(),    
		          fNtienda   : $("#nombre_tienda").val(),
		          fRubro     : $("#rubro").val(),
		          fUbicacion : $("#direccion").val()+' '+$("#localidad").val()+' '+
		                       $("#estado").val()+' '+$("#pais").val() 
		         },  
		         success:function(resp){
			        var datos = resp.res;
			        			        						                     
			    }, 
			    error:function(res){
				    alert('TUS DATOS SE CARGARON CORRECTAMENTE');
				    window.location.href = 'login.html';
				}
	    });
	          
    });
});      
</script>
<?php 
	gc_collect_cycles();
	?>

</html>