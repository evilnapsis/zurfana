<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// el archivo autoload inicializa todos lo archivos necesarios para que el framework funcione
include "core/autoload.php";


// cargamos el modulo iniciar.
$lb = new Lb();
$lb->loadModule("index");

?>