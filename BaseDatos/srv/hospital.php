<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_HOSPITAL.php";

ejecutaServicio(function () {

    // Recuperar el ID del hospital desde la solicitud
    $id = recuperaIdEntero("id");

    // Consultar el hospital en la base de datos utilizando la función selectFirst
    $modelo = selectFirst(
        pdo: Bd::pdo(),
        from: "HOSPITAL", // Nombre de la tabla HOSPITAL
        where: ["ID_Hospital" => $id] // Condición de búsqueda por ID
    );

    // Si no se encuentra el hospital, devolver un error 404
    if ($modelo === false) {
        $idHtml = htmlentities($id); // Escapar el ID para prevenir XSS
        throw new ProblemDetails(
            status: NOT_FOUND,
            title: "Hospital no encontrado.",
            type: "/error/hospitalnoencontrado.html",
            detail: "No se encontró ningún hospital con el id $idHtml.",
        );
    }

    // Si se encuentra el hospital, devolver los datos en formato JSON
    devuelveJson([
        "id" => ["value" => $id],
        "nombreH" => ["value" => $modelo["Nombre_Hospital"]],
        "direccion" => ["value" => $modelo["Direccion"]],
        "telefono" => ["value" => $modelo["Telefono"]],
    ]);
});
