<?php
$alias = "";
$nombre = "";
$apellido = "";
$email = "";
$edad = "";
$contrasena = "";

$aliasValido = true;
$nombreValido = true;
$apellidoValido = true;
$emailValido = true;
$edadValido = true;
$contrasenaValido = true;
$listaErrores = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    $alias = $_POST['alias'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $edad = $_POST['edad'];
    $contrasena = $_POST['contrasena'];

    include 'validacionesRegistro.php';

    if ($listaErrores == "") {

        include 'funcionesBD.php';

        $conexion = conectarBD();
        if ($conexion) {
            $existeUsuario = existeUsuario($alias, $conexion);
            $existeUsuario ? $listaErrores = $listaErrores . "El usuario introducido ya existe.<br/>" : "";
        } else {
            $listaErrores = $listaErrores . "Error al conectarse a la base de datos.<br/>";
        }

        if ($conexion && !$existeUsuario) {
            insertarDatosregistro($alias, $nombre, $apellido, $email, $edad, $contrasena, $conexion);
            header('Location: login.php');
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
    <h1>Registro</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="contenedor">
        <div id="datosLogin">
            <div class='inputCompleto <?php if (!$aliasValido) echo 'campoInvalido'; ?>'><label for='alias'>Alias</label>
                <input type='text' name='alias' value="<?php echo $alias ?>" />
            </div>
            <div class='inputCompleto <?php if (!$nombreValido) echo 'campoInvalido'; ?>'><label for='nombre'>Nombre</label>
                <input type='text' name='nombre' value="<?php echo $nombre ?>" />
            </div>
            <div class='inputCompleto <?php if (!$apellidoValido) echo 'campoInvalido'; ?>'><label for='apellido'>Apellido</label>
                <input type='text' name='apellido' value="<?php echo $apellido ?>" />
            </div>
            <div class='inputCompleto <?php if (!$emailValido) echo 'campoInvalido'; ?>'><label for='email'>Email</label>
                <input type="email" name='email' value="<?php echo $email ?>" />
            </div>
            <div class='inputCompleto <?php if (!$edadValido) echo 'campoInvalido'; ?>'><label for='edad'>Edad</label>
                <input type="text" name='edad' value="<?php echo $edad ?>" onkeydown="return /[0-9]/i.test(event.key)" />
            </div>
            <div class='inputCompleto <?php if (!$contrasenaValido) echo 'campoInvalido'; ?>'><label for='contrasena'>Contraseña</label>
                <input type=" password" name='contrasena' value="<?php echo $contrasena ?>" />
            </div>
        </div>
        <div id="CajaBotonLinkLogin">
            <input type="submit" class="boton" value="Registrarse">
            <a href="login.php" class="link">Login</a>
        </div>
    </form>
    <p id="errores"><?php echo $listaErrores ?></p>

</body>

</html>