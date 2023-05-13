<?php
include "../../Tools/connexion.php";

// *Insert de un nuevo cliente
if (isset($_POST["btn-AddPartners"])) {
    $names = $_POST["txt-names"];
    $surnames = $_POST["txt-surnames"];
    $mail = $_POST["txt-mail"];
    $password = $_POST["txt-password"];
    $dui = $_POST["txt-dui"];
    $trade = $_POST["txt-trade"];
    $recidence = $_POST["txt-residence"];
    $phoneNumber = $_POST["txt-phoneNumber"];

    $sql = $conex->query("SELECT * FROM `partners` WHERE DUI = '" . $dui . "'");
    if ($datos = $sql->fetch_object()) {
        header("location:../partners-creator.php?error1=0");
    } else {
        $sql2 = $conex->query("SELECT * FROM `users` WHERE Mail = '" . $mail . "'");
        if ($datos = $sql2->fetch_object()) {
            header("location:../partners-creator.php?error2=0");
        } else {
            $idPerson = substr($names, 0, 1) . substr($surnames, 0, 1) . rand(100, 999);
            $oneName = explode(" ", $names);
            $oneLastName = explode(" ", $surnames);
            $username = $oneName[0] . "." . $oneLastName[0];
            $CurrentlyDate = date("Y/m/d");
            $passwdEncripted = password_hash($password, PASSWORD_DEFAULT);

            $Insert = $conex->query("INSERT INTO `users`(`ID_User`, `Username`, `Role`, `Mail`, `Password`, `RegistrationDate`, `Status`) 
                                    VALUES ('" . $idPerson . "','" . strtolower($username) . "','DP121','" . $mail . "','" . $passwdEncripted . "','" . $CurrentlyDate . "','Activo')");

            $Insert2 = $conex->query("INSERT INTO `partners`(`ID_Partners`, `Names`, `Surnames`, `DUI`, `Trade`, `Location`, `PhoneNumber`, `Status`,`UserAccount`) 
                                    VALUES ('" . $idPerson . "','" . $names . "','" . $surnames . "','" . $dui . "','" . $trade . "','" . $recidence . "','" . $phoneNumber . "','Activo','" . $idPerson . "')");

            $prefix = substr($idPerson, 0, 2);
            $random = rand(10, 99);
            $idAccount = "C" . $prefix . $random;
            $accountNumber = sprintf("%04d %04d %04d %04d", rand(0, 9999), rand(0, 9999), rand(0, 9999), rand(0, 9999));
            $cvv = rand(100, 999);
            $openingDate = date("Y-m-d");
            $dueDate = date("Y-m-d", strtotime("+3 years", strtotime($openingDate)));
            $Insert3 = $conex->query("INSERT INTO `accounts`(`ID_Account`,`Customer`,`AccountNumber`,`CVV`,`DueDate`,`Balance`,`AccountType`,`OpeningDate`,`Status`)
                                        VALUES('" . $idAccount . "','" . $idPerson . "','" . $accountNumber . "'," . $cvv . ",'" . $dueDate . "',0,'Corriente','" . $openingDate . "','Activo')");

            header("location:../partners-creator.php?success=0");
        }
    }
    mysqli_close($conex);
}

// *Update de un cliente
if (isset($_POST["btn-UpdatePartner"])) {
    if (isset($_GET["idPartner"])) {
        $idPartner = $_GET["idPartner"];
        $newMail = $_POST["txt-mail"];
        $newRecidence = $_POST["txt-location"];
        $newPhoneNumber = $_POST["txt-phoneNumber"];

        $sql = $conex->query("UPDATE partners p
                                INNER JOIN users u ON u.`ID_User` = p.`UserAccount`
                                SET p.`PhoneNumber`= '" . $newPhoneNumber . "',
                                u.`Mail` = '" . $newMail . "',
                                p.`Location`='" . $newRecidence . "'
                                WHERE p.`ID_Partners` = '" . $idPartner . "'");
        if ($sql) {
            header("location:../users-partners.php?success=0");
        } else {
            header("location:../partners-editor.php?bug=0 & idPartner=" . $idPartner . "");
        }
    }
    mysqli_close($conex);
}


// *Update [Activar o Desactivar] de un cliente y cuentas
if (isset($_GET['idPartner']) && isset($_GET['action'])) {
    $idPartner = $_GET['idPartner'];
    $action = $_GET['action'];
    switch ($action) {
        case 'activar':
            UserON($idPartner);
            break;
        case 'deshabilitar':
            UserOFF($idPartner);
            break;
        default:
            header("location:../users-partners.php?bug=0");
            break;
    }
}

// *Funcion para activar usuario y cuentas
function UserON($idPartner)
{
    include "../../Tools/connexion.php";
    $sql = $conex->query("UPDATE partners p
                        INNER JOIN users u ON u.`ID_User` = p.`UserAccount`
                        LEFT JOIN accounts a ON a.`Customer` = u.`ID_User`
                        SET p.`Status` = 'Activo', u.`Status` = 'Activo', a.`Status` = 'Activo'
                        WHERE p.`ID_Partners` = '" . $idPartner . "'");
    if ($sql) {
        header("location:../users-partners.php?success=0");
    } else {
        header("location:../users-partners.php?bug=0");
    }
}

// *Funcion para desactivar usuario y cuentas
function UserOFF($idPartner)
{
    include "../../Tools/connexion.php";
    $sql = $conex->query("UPDATE partners p
                        INNER JOIN users u ON u.`ID_User` = p.`UserAccount`
                        LEFT JOIN accounts a ON a.`Customer` = u.`ID_User`
                        SET p.`Status` = 'Inactivo', u.`Status` = 'Inactivo', a.`Status` = 'Inactivo'
                        WHERE p.`ID_Partners` = '" . $idPartner . "'");
    if ($sql) {
        header("location:../users-partners.php?success=0");
    } else {
        header("location:../users-partners.php?bug=0");
    }
}
