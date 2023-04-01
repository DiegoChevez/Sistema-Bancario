<?php
include_once "../../Tools/connexion.php";

if(isset($_POST["btn-AddCustomer"])){
    $names = $_POST["txt-names"];
    $surnames = $_POST["txt-surnames"];
    $mail = $_POST["txt-mail"];
    $password = $_POST["txt-password"];
    $dui = $_POST["txt-dui"];
    $salary = $_POST["txt-salary"];
    $recidence = $_POST["txt-residence"];
    $phoneNumber = $_POST["txt-phoneNumber"];

    $sql = $conex->query("SELECT * FROM `customers` WHERE DUI = '".$dui."'");
    if ($datos = $sql->fetch_object()) {
        header("location:../customer-creator.php?error1=0");
    } else {
        $sql2 = $conex->query("SELECT * FROM `users` WHERE Mail = '".$mail."'");
        if($datos = $sql2->fetch_object()){
            header("location:../customer-creator.php?error2=0");
        }else{
            $idPerson = substr($names,0,1) . substr($surnames,0,1) . rand(100,999);
            $oneName = explode(" ",$names);
            $oneLastName = explode(" ",$surnames);
            $username = $oneName[0] .".". $oneLastName[0];
            $CurrentlyDate = date("Y/m/d");
            $passwdEncripted = password_hash($password,PASSWORD_DEFAULT);

            $Insert = $conex->query("INSERT INTO `users`(`ID_User`, `Username`, `Role`, `Mail`, `Password`, `RegistrationDate`, `Status`) 
                                    VALUES ('".$idPerson."','".strtolower($username)."','CL670','".$mail."','".$passwdEncripted."','".$CurrentlyDate."','Activo')");

            $Insert2 = $conex ->query("INSERT INTO `customers`(`ID_Cliente`, `Names`, `Surnames`, `DUI`, `Salary`, `Residence`, `PhoneNumber`, `UserAccount`) 
                                    VALUES ('".$idPerson."','".$names."','".$surnames."','".$dui."','".$salary."','".$recidence."','".$phoneNumber."','".$idPerson."')");
        }
    }

}



?>