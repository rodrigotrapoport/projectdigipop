<?php
	
// GEO IP //

$curl = curl_init(); // inicia el sistema q cargara la pagina web
curl_setopt($curl, CURLOPT_URL, 'https://get.geojs.io/v1/ip/geo.json');
curl_exec($curl);	
curl_close($curl);

?>