<?php
include 'funcionesBD.php';
session_start();

$conexion = conectarBD();
$consulta = "SELECT alias from usuarios";
$todosLosAlias = $conexion->query($consulta);

$usuario = $_SESSION['alias'];
$puntusUsuario = contarPuntosAlmacenados($usuario, $conexion);

$ranking = [];
foreach ($todosLosAlias as $alias) {
    $clave = $alias['alias'];
    $puntos = contarPuntosAlmacenados($clave, $conexion);
    $ranking[$puntos] = $clave;
}

krsort($ranking);

$posicionEnRanking = 0;
$contador = 0;
foreach ($ranking as $key => $value) {
    $contador++;
    if ($value == $_SESSION['alias']) {
        $posicionEnRanking = $contador;
    }
}

// echo "<pre>";
// print_r($ranking);
// echo "<br>" . $posicionEnRanking;

$_SESSION = array();
session_destroy();
// setcookie(session_name(), 123, time() - 1000);
$past = time() - 3600;
foreach ($_COOKIE as $key => $value) {
    setcookie($key, $value, $past, '/');
}
mysqli_close($conexion);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style/styleLogout.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,600&family=Signika:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body>
    <h1>¡Adiós <?php echo $usuario ?>!</h1>
    <div class="contenedor">
        <h2>Tu posición en el ranking es <b><?php echo $posicionEnRanking . "º</b>, con <b>" . $puntusUsuario . "</b> puntos." ?></h2>
        <a href="index.php">Continuar</a>
    </div>
</body>

</html>