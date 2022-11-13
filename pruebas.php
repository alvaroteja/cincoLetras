<?php
include 'funcionesBD.php';
$conexion = conectarBD();
echo "<br/><br/><br/>";
echo validarAliasContrasena('AlvaroTeja', 'Abcd123!', $conexion);
echo "<br/><br/><br/>";
