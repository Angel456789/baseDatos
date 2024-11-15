<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_HOSPITAL.php"; 

ejecutaServicio(function () {

    // Consultar todos los hospitales de la base de datos, ordenados por nombre
    $lista = select(pdo: Bd::pdo(), from: "HOSPITAL", orderBy: "Nombre_Hospital");

    // Inicializar el HTML para la lista <dl>
    $render = "<dl>";

    // Iterar sobre cada hospital en la lista
    if (!empty($lista)) {
        foreach ($lista as $modelo) {
            $encodeId = urlencode($modelo["ID_Hospital"]);
            $id = htmlentities($encodeId);
            $nombre = htmlentities($modelo["Nombre_Hospital"]);
            $telefono = htmlentities($modelo["Telefono"]);
            $direccion = htmlentities($modelo["Direccion"]);
    
            $render .= "<dt><a href='modifica.html?id=$id'>$nombre</a></dt><dd>Direccion: $direccion, Telefono: $telefono </dd>";
        }
    } else {
        $render .= "<p>No se encontraron hospitales.</p>";
    }
    

    // Cerrar la lista <dl>
    $render .= "</dl>";

    // Devolver el HTML como respuesta en formato JSON
    devuelveJson(["lista" => ["innerHTML" => $render]]);
});
