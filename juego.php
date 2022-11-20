<?php
include 'funcionesPintado.php';
include 'funcionesBD.php';
include 'funcionesSesionCookies.php';
include 'funcionesValidarArrays.php';

session_start();

if (isset($_SESSION['alias'])) {
    $alias = "";
    $mensajeErrores = "";
    $puntosDeSesion = 0;
    $partidasDeSesion = 0;
    $intento = 1;
    $letrasIntroducidas = $_SESSION['letrasIntroducidas'];
    $alias = $_SESSION['alias'];
    $conexion = conectarBD();
    $puntosAcumulados = contarPuntosAlmacenados($alias, $conexion);
    $partidasAcumuladas = contarPartidasAlmacenadas($alias, $conexion);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $intento = $_SESSION['intento'];
        if (letrasIntroducidasValidas()) {
            $_SESSION['intento']++;
            //capturo las letras del post en $letras introducidas
            if ($intento <= 6) {
                for ($i = 0; $i < 5; $i++) {
                    $letrasIntroducidas[$intento - 1][$i] = strtolower($_POST['letra' . ($i)]);
                }
            }
            //actualizo letrasIntroducidas de la sesion
            $_SESSION['letrasIntroducidas'] = $letrasIntroducidas;

            if (palabraAcertada()) {
                //actualizar los puntos de sesion con $puntosPartida
                crearCookie('puntosDeSesion', $_COOKIE['puntosDeSesion'] + (700 - (($_SESSION['intento'] - 1) * 100)));
                //guardar la partida en la base de datos con sus puntos, intentos...
                $conexion = conectarBD();
                crearRegistroPartida($conexion, 1);

                header("Location: partidaGanada.php");
            }
            if ($_SESSION['intento'] >= 7 && !palabraAcertada()) {
                //guardar la partida en la base de datos como perdida
                $conexion = conectarBD();
                crearRegistroPartida($conexion, 0);
                header("Location: partidaPerdida.php");
            }
        } else {
            $mensajeErrores = "Rellena todas las casillas verdes con una única letra";
        }
    }
    try {
        $puntosDeSesion = $_COOKIE['puntosDeSesion'];
        $partidasDeSesion = $_COOKIE['partidasDeSesion'];
        $puntosPartida = 700 - ($_SESSION['intento'] * 100);
    } catch (\Throwable $th) {
        echo "Ha ocurrido un error con las cookies";
        echo $th;
    }
} else {
    header("Location: login.php");
}
//echo "palabra = " . $_COOKIE['palabra'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=
    , initial-scale=1.0" />
    <title>Document</title>
    <link href="style/styleJuego.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,600&family=Signika:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body>
    <div id="datos">
        <div id="puntos">
            <div id="puntosSesion">
                <h3 class="info">PUNTOS DE SESIÓN: </h3>
                <h3 class="numero"><?php echo $puntosDeSesion ?></h3>
            </div>
            <div id="puntosAcumulados">
                <h3 class="info">PUNTOS ACUMULADOS: </h3>
                <h3 class="numero"><?php echo $puntosAcumulados ?></h3>
            </div>
        </div>
        <div id="partidas">
            <div id="partidasSesion">
                <h3 class="info">PARTIDAS DE SESIÓN: </h3>
                <h3 class="numero"><?php echo $partidasDeSesion ?></h3>
            </div>
            <div id="partidasAcumuladas">
                <h3 class="info">PARTIDAS ACUMULADAS: </h3>
                <h3 class="numero"><?php echo $partidasAcumuladas ?></h3>
            </div>
        </div>
    </div>
    <div id="botonesVolverAJugarYLogout">
        <a href="nuevaPartida.php">Partida Nueva</a>
        <a href="logout.php">Logout</a>
    </div>
    <p id="mensajeErrores"><?php echo $mensajeErrores ?></p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div id="contenedorJuego" class="contenedor">

            <?php pintarFila($letrasIntroducidas); ?>

        </div>
        <div id="cajaPuntosBoton">
            <div id="puntosDePartida">
                <p id="puntosPartidaTexto">PUNTOS PARTIDA:</p>
                <p id="puntosPartidaNumeros"><?php echo $puntosPartida ?></p>
            </div>
            <input type="submit" id="botonEnviar">
        </div>
    </form>
    <?php
    ?>
</body>

</html>