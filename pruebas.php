<?php
include 'funcionesBD.php';
echo "<pre>";
$conexion = conectarBD();
echo contarPuntosAlmacenados('ruben1', $conexion);
