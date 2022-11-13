<?php
include 'funcionesPintado.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);
} else {
    $letrasIntroducidas =  array(
        array("", "", "", "", ""),
        array("", "", "", "Q", ""),
        array("", "D", "", "", ""),
        array("", "", "W", "", ""),
        array("", "Z", "", "", ""),
        array("", "", "", "", ""),
    );
    $ronda = 0;
    echo "La ronda es: " . $ronda . "<br/>";
    echo "<pre>";
    print_r($letrasIntroducidas);
    echo "<br/></pre>";
}
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
    <form action="" method="POST">
        <div id="contenedorJuego" class="contenedor">

            <div id="fila1" class="fila filaTurnoActual">
                <?php pintarCajasInput(0); ?>
            </div>
            <div id="fila2" class="fila">
                <?php pintarCajasDiv(1, $letrasIntroducidas); ?>
            </div>
            <div id="fila3" class="fila">
                <?php pintarCajasDiv(2, $letrasIntroducidas); ?>
            </div>
            <div id="fila4" class="fila">
                <?php pintarCajasDiv(3, $letrasIntroducidas); ?>
            </div>
            <div id="fila5" class="fila">
                <?php pintarCajasDiv(4, $letrasIntroducidas); ?>
            </div>
            <div id="fila6" class="fila">
                <?php pintarCajasDiv(5, $letrasIntroducidas); ?>
            </div>

        </div>
        <input type="submit" id="botonEnviar">
    </form>
</body>

</html>