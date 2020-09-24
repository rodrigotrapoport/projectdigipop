<?php
	

// https://blockchain.com/btc/payment_request?address=1Tm5EXcx6zmFcDebSz894KMX8LpK67z9i&amount=0.01795670&message=jjhjhj
// bitcoin:1Tm5EXcx6zmFcDebSz894KMX8LpK67z9i?message=jjhjhj&amount=0.01795670
// semillas electrum  excess whale thought bright pony witness decline bean rigid oil smile adult
// pasword silicio2021!

$pasarelaPagos = 
'{  "pagos" : {
		"efectivo" :{
			"numeroCell"  : "x1" ,
			"email"       : "x2" ,
			"direccion"   : "x3" ,
			"condiciones" : "x4" ,
			"visible"     : "si" 
		},
		"paypal" : {
			"clienteId"   : "ATwVXaggQaUJq_cQdeH-H5AJjMRnbmSgnRD09TF51_A9tXuqkh4bv7qRxUr6jLxMMtxaa2r2SpLvGnjH" ,
			"moneda"      : "currency=MXN" ,
			"email"       : "x3" ,
			"numeroCell"  : "x4" ,
			"condiciones" : "x5" ,
			"visible"     : "si" 
		},
	    "mercadoPago" : {
			"dato1"   : "x1" ,
			"dato2"   : "x2" ,
			"dato3"   : "x3" ,
			"dato4"   : "x4" ,
			"dato5"   : "x5" ,
			"visible" : "si" 
		},
		"bitcoin" : {
			"to" : "1B9jA3X2ZmbrcxNfjHNtRS68mho2p844Rv" ,
			"email" : "x2" ,
			"numeroCell"  : "x3" ,
			"condiciones" : "x4" ,
			"visible"     : "si" 
		},
		"ethereum" : {
			"to"    : "0x24B2Fab8898a0ED5bF94C6150883C99397A832fF" ,
			"email" : "x2" ,
			"numeroCell"  : "x3" ,
			"condiciones" : "x4" ,
			"visible"     : "si" 
		},
        "dai" : {
			"to"    : "0x24B2Fab8898a0ED5bF94C6150883C99397A832fF" ,
			"email" : "x2" ,
			"numeroCell"  : "x3" ,
			"condiciones" : "x4" ,
			"visible"     : "si" 
		}
	}
}';
	
?>