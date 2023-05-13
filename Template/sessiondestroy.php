<?php
session_start(); // Iniciar la sesión

// Destruir todas las variables de sesión
$_SESSION = array();

// Si se desea destruir la cookie de sesión, también se puede descomentar la siguiente línea
// if (ini_get("session.use_cookies")) {
//     $params = session_get_cookie_params();
//     setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
// }

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página "index.php" o a cualquier otra página deseada
header("Location: ../Login/index.php");
exit;
?>