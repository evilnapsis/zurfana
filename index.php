<?php
/**
 * index.php
 * 
 * Punto de entrada principal de la aplicación.
 * Carga el autoload, inicializa el framework y carga el módulo de inicio.
 * author: @evilnapsis
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// el archivo autoload inicializa todos lo archivos necesarios para que el framework funcione
include "core/autoload.php";


// cargamos el modulo iniciar.
$lb = new Lb();
$lb->loadModule("index");

?>