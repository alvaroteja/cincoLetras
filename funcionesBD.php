<?php
function conectarBD()
{
    $hostname = "localhost";
    $usuario = "root";
    $password = "";
    $basededatos = "cincoLetras";
    try {
        $conexion = new PDO("mysql:host=$hostname;dbname=$basededatos", $usuario, $password);
        return $conexion;
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        return false;
        // die();
    }
}

function insertarDatosregistro($alias, $nombre, $apellido, $email, $edad, $contrasena, $conexion)
{
    $ins = "INSERT into usuarios (alias, contrasena, nombre, apellido, email, edad) values('$alias', '$contrasena', '$nombre', '$apellido', '$email', '$edad')";
    $query = $conexion->query($ins);
}

function existeUsuario($alias, $conexion)
{
    $consulta = "SELECT alias from usuarios WHERE alias='$alias'";
    $resultado = $conexion->query($consulta);

    if ($resultado->rowCount() == 0) {
        return false;
    } else if ($resultado->rowCount() == 1) {
        return true;
    } else {
        $error = "Error al validar usuario";
        echo $error;
        return $error;
    }
}

function validarAliasContrasena($aliasIntroducido, $contrasenaIntroducida, $conexion)
{
    if (existeUsuario($aliasIntroducido, $conexion)) {
        $consulta = "SELECT alias, contrasena from usuarios WHERE alias='$aliasIntroducido'";
        $resultado = $conexion->query($consulta);

        foreach ($resultado as $usuario) {
            if ($contrasenaIntroducida == $usuario['contrasena']) {
                return true;
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
}
