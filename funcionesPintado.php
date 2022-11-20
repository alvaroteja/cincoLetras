<?php

function pintarCajasInput($fila)
{
    for ($i = 0; $i < 5; $i++) {
        echo '<input id="letra' . $fila . $i . '" class="letra" name= "letra' . ($i) . '"type="text" maxlength="1" style="text-transform: uppercase" onkeydown="return /[a-zñ]/i.test(event.key)"/>';
    }
}
function pintarCajasDiv($fila, $letras)
{
    $color = "";
    for ($i = 0; $i < 5; $i++) {
        if ($fila < $_SESSION['intento'] - 1) {
            if ($_COOKIE['palabra'][$i] == $letras[$fila][$i]) {
                $color = "coincide";
            } else if (contieneEsaLetra($letras[$fila][$i])) {
                $color = "contiene";
            } else {
                $color = "noContiene";
            }
        }
        echo '<div id="letra' . $fila . $i . '" class="letra ' . $color . '" style="text-transform: uppercase">' . $letras[$fila][$i] . '</div>';
    }
}

function pintarFila($letrasIntroducidas)
{
    $intento = $_SESSION['intento'];
    // if ($intento > 6) $intento = 6;
    for ($i = 0; $i < 6; $i++) {

        echo "<div id='" . 'fila' . ($i + 1) . "' class='fila filaTurnoActual'>";
        if ($intento == $i + 1 && $intento <= 6) {
            pintarCajasInput($i);
        } else {
            pintarCajasDiv($i, $letrasIntroducidas);
        }
        echo "</div>";
    }
}
