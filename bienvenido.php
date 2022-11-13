<?php
$alias = "";
session_start();

if (isset($_SESSION['alias'])) {
    $alias = $_SESSION['alias'];
} else {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style/styleBienvenido.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,600&family=Signika:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body>
    <h1>Hola <?php echo $alias ?></h1>
    <div class="contenedor">
        <h2>¿Qué deseas hacer?</h2>
        <a href="juego.php">Jugar</a>
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>