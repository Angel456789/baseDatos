<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

/**
 * Valida el campo nombre.
 * 
 * @param false|string $nombre
 * @return string
 * @throws ProblemDetails
 */
function validaNombre(false|string $nombre)
{
    if ($nombre === false)
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Falta el nombre.",
            type: "/error/faltanombre.html",
            detail: "La solicitud no tiene el valor de nombre."
        );

    $trimNombre = trim($nombre);

    if ($trimNombre === "")
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Nombre en blanco.",
            type: "/error/nombreenblanco.html",
            detail: "Pon texto en el campo nombre."
        );

    return $trimNombre;
}

/**
 * Valida el campo direccion.
 * 
 * @param false|string $direccion
 * @return string
 * @throws ProblemDetails
 */
function validaDireccion(false|string $direccion)
{
    if ($direccion === false)
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Falta la dirección.",
            type: "/error/faltadireccion.html",
            detail: "La solicitud no tiene el valor de dirección."
        );

    $trimDireccion = trim($direccion);

    if (strlen($trimDireccion) < 10 || strlen($trimDireccion) > 200)
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Dirección inválida.",
            type: "/error/direccioninvalida.html",
            detail: "La dirección debe tener entre 10 y 200 caracteres."
        );

    return $trimDireccion;
}

/**
 * Valida el campo telefono.
 * 
 * @param false|string $telefono
 * @return string
 * @throws ProblemDetails
 */
function validaTelefono(false|string $telefono)
{
    if ($telefono === false)
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Falta el teléfono.",
            type: "/error/faltatelefono.html",
            detail: "La solicitud no tiene el valor de teléfono."
        );

    $trimTelefono = trim($telefono);

    if (!preg_match('/^\d{7,15}$/', $trimTelefono))
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Teléfono inválido.",
            type: "/error/telefonoinvalido.html",
            detail: "El teléfono debe tener entre 7 y 15 dígitos numéricos."
        );

    return $trimTelefono;
}
