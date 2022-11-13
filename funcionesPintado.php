<?php

function pintarCajasInput($fila)
{
    for ($i = 0; $i < 5; $i++) {
        echo '<input id="letra' . $fila . $i . '" class="letra" name= "letra' . ($i) . '"type="text" maxlength="1" style="text-transform: uppercase" onkeydown="return /[a-z]/i.test(event.key)"/>';
    }
}
function pintarCajasDiv($fila, $letras)
{
    for ($i = 0; $i < 5; $i++) {
        echo '<div id="letra' . $fila . $i . '" class="letra">' . $letras[$fila][$i] . '</div>';
    }
}
