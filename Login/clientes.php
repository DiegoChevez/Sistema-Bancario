<?php
session_start();
if (isset($_SESSION['ID_User'])) {
    $ID_User = $_SESSION["ID_User"];
    $Username = $_SESSION["Username"];
    $Role = $_SESSION["Role"];
    $Mail = $_SESSION["Mail"];
    $Password = $_SESSION["Password"];
    $RegistrationDate = $_SESSION["RegistrationDate"];
    $Status = $_SESSION["Status"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
</head>

<body>
    <h1>Bienvenido <?php echo $Username ?></h1><br>
    <h2>Tu rol es: <?php echo $Role ?></h2>
</body>

</html>