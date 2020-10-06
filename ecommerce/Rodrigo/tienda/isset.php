<?php

if (file_exists("must_have.php")) {
    require "must_have.php";
} else {
    echo "el archivo no existe\n";
};
$a='';
//$b='';

if( isset($a) ){
    echo '<br>existe A';
}

if( isset($b) ){
    echo 'existe B';
}


?>