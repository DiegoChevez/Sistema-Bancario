<?php
include "../../Tools/connexion.php";

// *Insert de un nuevo cliente
if (isset($_POST["btn-AddCustomer"])) {
    $names = $_POST["txt-names"];
    $surnames = $_POST["txt-surnames"];
    $mail = $_POST["txt-mail"];
    $password = $_POST["txt-password"];
    $dui = $_POST["txt-dui"];
    $salary = $_POST["txt-salary"];
    $recidence = $_POST["txt-residence"];
    $phoneNumber = $_POST["txt-phoneNumber"];

    $sql = $conex->query("SELECT * FROM `customers` WHERE DUI = '" . $dui . "'");
    if ($datos = $sql->fetch_object()) {
        header("location:../customer-creator.php?error1=0");
    } else {
        $sql2 = $conex->query("SELECT * FROM `users` WHERE Mail = '" . $mail . "'");
        if ($datos = $sql2->fetch_object()) {
            header("location:../customer-creator.php?error2=0");
        } else {
            $idPerson = substr($names, 0, 1) . substr($surnames, 0, 1) . rand(100, 999);
            $oneName = explode(" ", $names);
            $oneLastName = explode(" ", $surnames);
            $username = $oneName[0] . "." . $oneLastName[0];
            $CurrentlyDate = date("Y/m/d");
            $passwdEncripted = password_hash($password, PASSWORD_DEFAULT);

            $Insert = $conex->query("INSERT INTO `users`(`ID_User`, `Username`, `Role`, `Mail`, `Password`, `RegistrationDate`, `Status`) 
                                    VALUES ('" . $idPerson . "','" . strtolower($username) . "','CL670','" . $mail . "','" . $passwdEncripted . "','" . $CurrentlyDate . "','Activo')");

            $Insert2 = $conex->query("INSERT INTO `customers`(`ID_Cliente`, `Names`, `Surnames`, `DUI`, `Salary`, `Residence`, `PhoneNumber`, `Status`,`UserAccount`) 
                                    VALUES ('" . $idPerson . "','" . $names . "','" . $surnames . "','" . $dui . "','" . $salary . "','" . $recidence . "','" . $phoneNumber . "','Activo','" . $idPerson . "')");

            $prefix = substr($idPerson, 0, 2);
            $random = rand(10, 99);
            $idAccount= "C".$prefix.$random;
            $accountNumber = sprintf("%04d %04d %04d %04d", rand(0, 9999), rand(0, 9999), rand(0, 9999), rand(0, 9999));
            $cvv = rand(100, 999);
            $openingDate = date("Y-m-d"); 
            $dueDate = date("Y-m-d", strtotime("+3 years", strtotime($fechaActual)));
            $Insert3 = $conex->query("INSERT INTO `accounts`(`ID_Account`,`Customer`,`AccountNumber`,`CVV`,`DueDate`,`Balance`,`AccountType`,`OpeningDate`,`Status`)
                                                    VALUES('".$idAccount."','".$idPerson."','".$accountNumber."',".$cvv.",'".$dueDate."',0,'Corriente','".$openingDate."','Activo')");

            header("location:../customer-creator.php?success=0");
        }
    }
    mysqli_close($conex);
}

// *Update de un cliente
if (isset($_POST["btn-UpdateCustomer"])) {
    if(isset($_GET["idCliente"])){
        $idCliente = $_GET["idCliente"];
        $newMail = $_POST["txt-mail"];
        $newSalary = $_POST["txt-salary"];
        $newRecidence = $_POST["txt-residence"];
        $newPhoneNumber = $_POST["txt-phoneNumber"];

        $sql = $conex->query("UPDATE customers c
                                INNER JOIN users u ON u.`ID_User` = c.`UserAccount`
                                SET c.`PhoneNumber`= '".$newPhoneNumber."', 
                                    c.`Residence` = '".$newRecidence."',
                                    c.`Salary` = '".$newSalary."',
                                    u.`Mail` = '".$newMail."'
                                WHERE c.`ID_Cliente` = '".$idCliente."'
                            ");
        if ($sql) {
            header("location:../users-clients.php?success=0");
        } else {
            header("location:../customer-editor.php?bug=0 & id_Cliente=".$idCliente."");
        }
    }
    mysqli_close($conex);
    

}


// *Update [Activar o Desactivar] de un cliente y cuentas
if (isset($_GET['id_Cliente']) && isset($_GET['action'])) {
    $idCliente = $_GET['id_Cliente'];
    $action = $_GET['action'];
    switch ($action) {
        case 'activar':
            UserON($idCliente);
            break;
        case 'deshabilitar':
            UserOFF($idCliente);
            break;
        default:
            header("location:../users-clients.php?bug=0");
            break;
    }
}

// *Funcion para activar usuario y cuentas
function UserON($id_Cliente)
{
    include "../../Tools/connexion.php";
    $sql = $conex->query("UPDATE customers c
                        INNER JOIN users u ON u.`ID_User` = c.`UserAccount`
                        LEFT JOIN accounts a ON a.`Customer` = u.`ID_User`
                        SET c.`Status`= 'Activo', 
                            u.`Status`= 'Activo',
                            a.`Status`= 'Activo'
                        WHERE c.`ID_Cliente` = '".$id_Cliente."'");
        if ($sql) {
            header("location:../users-clients.php?success=0");
        } else {
            header("location:../users-clients.php?bug=0");
        }
}

// *Funcion para desactivar usuario y cuentas
function UserOFF($id_Cliente)
{
    include "../../Tools/connexion.php";
    $sql = $conex->query("UPDATE customers c
                                INNER JOIN users u ON u.`ID_User` = c.`UserAccount`
                                LEFT JOIN accounts a ON a.`Customer` = u.`ID_User`
                                SET c.`Status`= 'Innactivo', 
                                    u.`Status`= 'Innactivo',
                                    a.`Status`= 'Innactivo'
                                WHERE c.`ID_Cliente` = '".$id_Cliente."'");
        if ($sql) {
            header("location:../users-clients.php?success=0");
        } else {
            header("location:../users-clients.php?bug=0");
        }
}