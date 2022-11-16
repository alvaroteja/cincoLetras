<?php
function conectarBD()
{
    $hostname = "localhost";
    $usuario = "root";
    $password = "";
    $basededatos = "cincoLetras";
    try {
        $conexion = new mysqli($hostname, $usuario, $password, $basededatos);
        if ($conexion->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
            return false;
        }

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

    if ($resultado->num_rows == 0) {
        return false;
    } else if ($resultado->num_rows == 1) {
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

function contarPartidasAlmacenadas($alias, $conexion)
{
    $ins = "SELECT count(*) FROM `partidas` WHERE jugador ='$alias'";
    $query = $conexion->query($ins);
    $resultado = $query->fetch_assoc();
    return $resultado['count(*)'];
}
function contarPuntosAlmacenados($alias, $conexion)
{
    $ins = "SELECT puntos FROM `partidas` WHERE jugador ='$alias'";
    $query = $conexion->query($ins);
    $puntos = [];
    while ($registro = $query->fetch_assoc()) {
        array_push($puntos, $registro['puntos']);
    }
    return array_sum($puntos);
}

function crearRegistroPartidaAleatoria($conexion)
{
    $jugador = "";
    $puntos = (random_int(0, 6) * 100);
    $intentos = 10 - ($puntos / 100) - 3;
    if ($intentos > 6) $intentos = 6;
    $puntos == 0 ? $partidaGanada = false : $partidaGanada = true;
    $fecha = "";

    //saca todos los alias y escoge uno al azar
    $consulta = "SELECT alias from usuarios";
    $resultado = $conexion->query($consulta);
    //$registro = $resultado->fetch_assoc();
    $alias = [];
    while ($registro = $resultado->fetch_assoc()) {
        array_push($alias, $registro['alias']);
    }
    $random = random_int(0, (count($alias) - 1));
    $jugador = $alias[$random];

    //crea fecha al azar
    $mes = random_int(1, 12);
    $dia = random_int(1, 29);
    $fecha = "2022-" . $mes . "-" . $dia;


    $ins = "INSERT INTO partidas (id, jugador, partidaGanada, puntos, intentos, fecha) VALUES (NULL, '$jugador', '$partidaGanada', '$puntos', '$intentos', '$fecha')";
    $query = $conexion->query($ins);
}
