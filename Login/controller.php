<?php
include_once "../Tools/connexion.php";

session_start();
if (!empty($_POST["btn-access"])) {
    if (!empty($_POST["mailUser"]) and !empty($_POST["passwdUser"])) {
        $mailUser = $_POST["mailUser"];
        $passwdUser = $_POST["passwdUser"];

        $sql = $conex->query("SELECT * FROM users WHERE Mail= '$mailUser'");
        if ($datos = $sql->fetch_object()) {
            $mailUserBD= $datos->Mail;
            $passwdUserBD = $datos->Password;

            if(password_verify($passwdUser, $passwdUserBD)){
                $_SESSION["ID_User"] = $datos->ID_User;
                $_SESSION["Username"] = $datos->Username;
                $_SESSION["Role"] = $datos->Role;
                $_SESSION["Mail"] = $datos->Mail;
                $_SESSION["Password"] = $datos->Password;
                $_SESSION["RegistrationDate"] = $datos->RegistrationDate;
                $_SESSION["Status"] = $datos->Status;

                switch ($_SESSION["Role"]) {
                    case "CJ922":
                        header("locatio:../Checker/index.php");
                        break;
                    case "CL670":
                        header("location:../Client/index.php");
                        break;
                    case "DP121":
                        header("location:../Dependent/index.php");
                        break;
                    case "GG129":
                        header("location:../GeneralManager/index.php");
                        break;
                    case "GS181":
                        header("location:../BranchOfficeManager/index.php");
                        break;
                    default:
                        header("location:../WebSite/index.php");
                        break;
                }

            }else {
                # code...
            }
            
        } else {
            # code...
        }
    } else {

    }
}
