<?php
$alias = "";
$contrasena = "";

$aliasValido = true;
$contrasenaValido = true;

$listaErrores = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alias = $_POST['alias'];
    $contrasena = $_POST['contrasena'];

    //comprobar que los campos no estén vacíos
    if (!$alias) {
        $listaErrores = $listaErrores . "Introduce un alias.<br/>";
        $aliasValido = false;
    }
    if (!$contrasena) {
        $listaErrores = $listaErrores . "Introduce una contraseña.<br/>";
        $contrasenaValido = false;
    }

    //conexión con la base de datos
    if ($listaErrores == "") {

        include 'funcionesBD.php';
        include 'funcionesSesionCookies.php';
        $conexion = conectarBD();
        if ($conexion) {
            $usuarioValido = validarAliasContrasena($alias, $contrasena, $conexion);
            !$usuarioValido ? $listaErrores = $listaErrores . "El usuario o/y contraseña no son válidos" : "";
        } else {
            $listaErrores = $listaErrores . "Error al conectarse a la base de datos.<br/>";
        }

        if ($conexion && $usuarioValido) {
            session_start();
            $_SESSION['alias'] = $_POST['alias'];
            // $_SESSION['intento'] = 1;
            crearCookie('puntosDeSesion', 0);
            crearCookie('partidasDeSesion', 0);
            mysqli_close($conexion);
            header("Location: index.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style/styleLogin.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,600&family=Signika:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body>
    <h1>Login</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="contenedor">
        <div id="datosLogin">
            <div class='inputCompleto <?php if (!$aliasValido) echo 'campoInvalido'; ?>'><label for='alias'>Alias</label>
                <input type='text' name='alias' value="<?php echo $alias ?>"></input>
            </div>
            <div class='inputCompleto <?php if (!$contrasenaValido) echo 'campoInvalido'; ?>'><label for='contrasena'>Contraseña</label>
                <input type='password' name='contrasena'></input>
            </div>
        </div>
        <div id="CajaBotonLinkLogin">
            <input type="submit" class="boton" value="Login">
            <a href="registro.php" class="link">Registrarse</a>
        </div>
    </form>
    <p id="errores"><?php echo $listaErrores ?></p>

</body>

</html>