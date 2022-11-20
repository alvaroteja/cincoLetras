<?php
function letrasIntroducidasValidas()
{
    $longitudUno = true;
    $esUnaLetra = true;
    $letrasIntroducidas = [];
    for ($i = 0; $i < 5; $i++) {
        $letrasIntroducidas[$i] = $_POST['letra' . ($i)];
    }
    for ($i = 0; $i < 5 && $longitudUno; $i++) {
        $longitudUno = longitudUno($letrasIntroducidas[$i]);
    }
    for ($i = 0; $i < 5 && $esUnaLetra; $i++) {
        $esUnaLetra = esUnaLetra($letrasIntroducidas[$i]);
    }
    if ($longitudUno && $esUnaLetra) {
        return true;
    } else {
        return false;
    }
}

function longitudUno($letra)
{
    if (mb_strlen($letra) === 1) {
        return true;
    } else {
        return false;
    }
}

function esUnaLetra($letra)
{
    if (!filter_var($letra, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-ZñÑ]/")))) {
        return false;
    } else {
        return true;
    }
}

function palabraAcertada()
{
    $palabraAcertada = true;

    for ($i = 0; $i < 5; $i++) {
        $letrasIntroducidas[$i] = strtolower($_POST['letra' . ($i)]);
    }
    $palabra = $_COOKIE['palabra'];
    for ($i = 0; $i < mb_strlen($palabra) && $palabraAcertada; $i++) {
        if ($palabra[$i] != $letrasIntroducidas[$i]) $palabraAcertada = false;
    }
    return $palabraAcertada;
}

function contieneEsaLetra($letra)
{
    $palabra = $_COOKIE['palabra'];
    if (strpos($palabra, $letra) === false) {
        return false;
    } else {
        return true;
    }
}

function coincideLetraEnPosicion($letra)
{
    $posicionesCoincidentes = [];
    $palabra = $_COOKIE['palabra'];
    for ($i = 0; $i < mb_strlen($palabra); $i++) {
        if ($palabra[$i] == $letra) array_push($posicionesCoincidentes, $letra);
    }
    return $posicionesCoincidentes;
}
