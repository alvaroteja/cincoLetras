<?php

function crearCookie($nombreCookie, $valorCookie)
{
    $fecha_expiracion = time() + 365 * 24 * 60 * 60;
    // $path = $_SERVER['REQUEST_URI'];
    $path = '/';
    setcookie($nombreCookie, $valorCookie, $fecha_expiracion, $path, '', 0);
}
