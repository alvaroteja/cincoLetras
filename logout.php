<?php
session_start();
$_SESSION = array();
session_destroy();
// setcookie(session_name(), 123, time() - 1000);
$past = time() - 3600;
foreach ($_COOKIE as $key => $value) {
    setcookie($key, $value, $past, '/');
}
header("Location: index.php");
