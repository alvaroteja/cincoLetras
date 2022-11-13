<?php

if (!filter_var($alias, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\d\.]{5,}/")))) {
    //comprobar que no existe este alias en la base de datos
    $listaErrores = $listaErrores . "Error: El alias no es válido, introduce un alias mínimo de 5 caracteres.<br/>";
    $aliasValido = false;
}
if (!filter_var($nombre, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}/")))) {
    $listaErrores = $listaErrores . "Error: El nombre no es válido.<br/>";
    $nombreValido = false;
}
if (!filter_var($apellido, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}/")))) {
    $listaErrores = $listaErrores . "Error: El apellido no es válido.<br/>";
    $apellidoValido = false;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $listaErrores = $listaErrores . "Error: El email no es válido.<br/>";
    $emailValido = false;
}
if (!filter_var($edad, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[0-9]{1,2}/")))) {
    $listaErrores = $listaErrores . "Error: La edad no es válida, introduzca un número positivo mayor que 0.<br/>";
    $edadValido = false;
}
if (!filter_var($contrasena, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*/")))) {
    $listaErrores = $listaErrores . "Error: La contraseña no es válida, introduce una contraseña de 8 caracteres mínimo, que contenga mayusculas, numeros y/o caracteres especiales.<br/>";
    $contrasenaValido = false;
}
