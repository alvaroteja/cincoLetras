<?php
include 'funcionesSesionCookies.php';
include 'funcionesBD.php';

$alias = "";
session_start();

if (isset($_SESSION['alias'])) {
    $alias = $_SESSION['alias'];
    $_SESSION['intento'] = 1;
    $conexion = conectarBD();
    $palabra = seleccionarParlabra($conexion);
    crearCookie('palabra', $palabra);
    crearCookie('partidasDeSesion', $_COOKIE['partidasDeSesion'] + 1);

    $letrasIntroducidas =  array(
        array("", "", "", "", ""),
        array("", "", "", "", ""),
        array("", "", "", "", ""),
        array("", "", "", "", ""),
        array("", "", "", "", ""),
        array("", "", "", "", ""),
    );

    $_SESSION['letrasIntroducidas'] = $letrasIntroducidas;
    header("Location: juego.php");
} else {
    header("Location: login.php");
}
