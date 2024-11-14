<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_HOSPITAL.php";

ejecutaServicio(function () {

    // Recupera los valores de los campos
    $nombre = recuperaTexto("nombreH");
    $direccion = recuperaTexto("direccion");
    $telefono = recuperaTexto("telefono");

    // Valida los campos recibidos
    $nombre = validaNombre($nombre);
    $direccion = validaDireccion($direccion);
    $telefono = validaTelefono($telefono);
    // Conexión a la base de datos
    $pdo = Bd::pdo();

    // Inserción de los datos en la tabla HOSPITAL
    insert(pdo: $pdo, into: "HOSPITAL", values: [
        "Nombre_Hospital" => $nombre,
        "Direccion" => $direccion,
        "Telefono" => $telefono
    ]);
    
    // Obtiene el último ID insertado (ID_Hospital)
    $id = $pdo->lastInsertId();

    // Codifica el ID para la URL
    $encodeId = urlencode($id);

    // Devuelve la respuesta de éxito (201 Created)
    devuelveCreated("/srv/hospital.php?id=$encodeId", [
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "direccion" => ["value" => $direccion],
        "telefono" => ["value" => $telefono]
    ]);
});
