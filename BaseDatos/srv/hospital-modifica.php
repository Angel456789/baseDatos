<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_HOSPITAL.php";

ejecutaServicio(function () {

    // Recuperar los parámetros
    $id = recuperaIdEntero("id");
    $nombre = recuperaTexto("nombreH");
    $direccion = recuperaTexto("direccion");
    $telefono = recuperaTexto("telefono");

    // Valida los campos recibidos
    $nombre = validaNombre($nombre);
    $direccion = validaDireccion($direccion);
    $telefono = validaTelefono($telefono);

    // Actualizar los datos en la base de datos
    update(
        pdo: Bd::pdo(),
        table: "HOSPITAL", // Nombre de la tabla
        set: [
            "Nombre_Hospital" => $nombre,
            "Direccion" => $direccion,
            "Telefono" => $telefono
        ],
        where: ["ID_Hospital" => $id]
    );

    // Devolver los datos actualizados en formato JSON
    devuelveJson([
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "direccion" => ["value" => $direccion],
        "telefono" => ["value" => $telefono]
    ]);
});
