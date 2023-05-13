<?php
include "../../Tools/connexion.php";
session_start();
$id_User = $_SESSION["ID_User"];
if (isset($_POST["btn-AddTransaction"])) {
    if (isset($_GET['idCuenta'])) {
        $idRootAccount = $_GET['idCuenta'];
        $transactionType = $_POST["txt-TipoTransaccion"];
        $destinationAccount = $_POST["txt-Destino"];
        $balance = $_POST["txt-cantidad"];
        $paymentConcept = $_POST["txt-Descripcion"];

        $randomSeries = mt_rand(10000, 99999);
        $idTransacction = $idRootAccount . $randomSeries;
        $dateRealization = date('Y-m-d H:i:s');
        $author = $id_User;
        switch ($transactionType) {
            case 'Retiro':
                BankWithdrawal($author, $idRootAccount, $idTransacction, $transactionType, $dateRealization, $balance, $paymentConcept);
                break;
            case 'Deposito':
                BankDeposit($author, $idRootAccount, $idTransacction, $transactionType, $dateRealization, $balance, $paymentConcept);
                break;
            case 'Transaccion':
                BankTransactions($author, $idRootAccount, $idTransacction, $transactionType, $dateRealization, $balance, $paymentConcept, $destinationAccount);
                break;
            default:
                header("location:../customer-new-transactions.php");
                break;
        }
        mysqli_close($conex);
    } else {
        header("location:../index.php");
    }
}


function BankWithdrawal($author, $idRootAccount, $idTransacction, $transactionType, $dateRealization, $balance, $paymentConcept)
{
    include "../../Tools/connexion.php";
    //Seleccionamos toda la informacion de la cuenta perjudicada
    $selectSql = $conex->query("SELECT * FROM accounts WHERE `ID_Account` = '" . $idRootAccount . "'");
    if ($data = $selectSql->fetch_assoc()) {
        $currentAccountBalance = $data["Balance"];
        if ($currentAccountBalance > $balance) {
            $insertSql = $conex->query("INSERT INTO transactions (`ID_Transaction`,`RootAccount`,`TransactionType`,`DateRealization`,`DestinationAccount`,`Balance`,`PaymentConcept`,`Author`,`Status`)
                                                        VALUES('" . $idTransacction . "','" . $idRootAccount . "','" . $transactionType . "','" . $dateRealization . "','" . $idRootAccount . "'," . $balance . ",'" . $paymentConcept . "','" . $author . "','Realizado')");
            if ($insertSql) {
                $newBalance = $data["Balance"] - $balance;
                $updateSql = $conex->query("UPDATE accounts SET Balance = $newBalance WHERE ID_Account = '" . $idRootAccount . "'");
                if ($updateSql) {
                    header("location:../customer-transactions.php?success=0&idCuenta=" . $idRootAccount . "");
                }
            } else {
                header("location:../customer-transactions.php?bug=0&idCuenta=" . $idRootAccount . "");
            }
        } else {
            header("location:../customer-transactions.php?fault=0&idCuenta=" . $idRootAccount . "");
        }
    } else {
        header("location:../customer-transactions.php?bug=0&idCuenta=" . $idRootAccount . "");
    }
    mysqli_close($conex);
}

function BankDeposit($author, $idRootAccount, $idTransacction, $transactionType, $dateRealization, $balance, $paymentConcept)
{
    include "../../Tools/connexion.php";
    $selectSql = $conex->query("SELECT * FROM accounts WHERE `ID_Account` = '" . $idRootAccount . "'");
    if ($data = $selectSql->fetch_assoc()) {
        $currentAccountBalance = $data["Balance"];
        $insertSql = $conex->query("INSERT INTO transactions (`ID_Transaction`,`RootAccount`,`TransactionType`,`DateRealization`,`DestinationAccount`,`Balance`,`PaymentConcept`,`Author`,`Status`)
                                                            VALUES('" . $idTransacction . "','" . $idRootAccount . "','" . $transactionType . "','" . $dateRealization . "','" . $idRootAccount . "'," . $balance . ",'" . $paymentConcept . "','" . $author . "','Realizado')");
        if ($insertSql) {
            $newBalance = $currentAccountBalance + $balance;
            $updateSql = $conex->query("UPDATE accounts
                                            SET Balance = $newBalance
                                            WHERE ID_Account = '" . $idRootAccount . "'");
            if ($updateSql) {
                header("location:../customer-transactions.php?success=0&idCuenta=" . $idRootAccount . "");
            } else {
                header("location:../customer-transactions.php?bug=0&idCuenta=" . $idRootAccount . "");
            }
        }
    } else {
        header("location:../customer-transactions.php?bug=0&idCuenta=" . $idRootAccount . "");
    }
    mysqli_close($conex);
}

function BankTransactions($author, $idRootAccount, $idTransacction, $transactionType, $dateRealization, $balance, $paymentConcept, $destinationAccount)
{
    include "../../Tools/connexion.php";
    $selectSql = $conex->query("SELECT * FROM accounts WHERE `AccountNumber` = '" . $destinationAccount . "'");
    $selectSql2 = $conex->query("SELECT * FROM accounts WHERE `ID_Account` = '" . $idRootAccount . "'");
    if ($data = $selectSql->fetch_assoc()) {
        $currentAccountBalance = $data["Balance"];
        $idDestinationAccount = $data["ID_Account"];
        if ($data2 = $selectSql2->fetch_assoc()) {
            $currentAccountBalance2 = $data2["Balance"];
            $newBalance = $currentAccountBalance + $balance; //DestinationAccount
            $newBalance2 = $currentAccountBalance2 - $balance; //AuthorAccount
            if ($currentAccountBalance2 > $balance) {
                $insertSql = $conex->query("INSERT INTO transactions (`ID_Transaction`,`RootAccount`,`TransactionType`,`DateRealization`,`DestinationAccount`,`Balance`,`PaymentConcept`,`Author`,`Status`)
                VALUES('" . $idTransacction . "','" . $idRootAccount . "','" . $transactionType . "','" . $dateRealization . "','" . $idDestinationAccount . "'," . $balance . ",'" . $paymentConcept . "','" . $author . "','Realizado')");
                if ($insertSql) {
                    $updateSql = $conex->query("UPDATE accounts SET Balance = $newBalance WHERE ID_Account = '" . $idDestinationAccount . "'");
                    if ($updateSql) {
                        $updateSql2 = $conex->query("UPDATE accounts SET Balance = $newBalance2 WHERE ID_Account = '" . $idRootAccount . "'");
                        if ($updateSql2) {
                            header("location:../customer-transactions.php?success=0&idCuenta=" . $idRootAccount . "");
                        }
                    } else {
                        header("location:../customer-transactions.php?bug=0&idCuenta=" . $idRootAccount . "&error=1");
                    }
                } else {
                    header("location:../customer-transactions.php?bug=0&idCuenta=" . $idRootAccount . "&error=2");
                }
            } else {
                header("location:../customer-transactions.php?fault=0&idCuenta=" . $idRootAccount . "&error=3");
            }
        } else {
            header("location:../customer-transactions.php?bug=0&idCuenta=" . $idRootAccount . "&error=4");
        }
    } else {
        header("location:../customer-transactions.php?bug=0&idCuenta=" . $idRootAccount . "&error=5");
    }
    mysqli_close($conex);
}

if (isset($_POST["btn-AddAccount"])) {
    if (isset($_GET['idPerson'])) {
        $idPerson = $_GET['idPerson'];
        $accountType = $_POST["txt-AccountType"];
        $prefix = substr($idPerson, 0, 2);
        $random = rand(10, 99);
        $idAccount = "C" . $prefix . $random;
        $accountNumber = sprintf("%04d %04d %04d %04d", rand(0, 9999), rand(0, 9999), rand(0, 9999), rand(0, 9999));
        $cvv = rand(100, 999);
        $openingDate = date("Y-m-d");
        $dueDate = date("Y-m-d", strtotime("+3 years", strtotime($openingDate)));
        $Insert3 = $conex->query("INSERT INTO `accounts`(`ID_Account`,`Customer`,`AccountNumber`,`CVV`,`DueDate`,`Balance`,`AccountType`,`OpeningDate`,`Status`)
                                        VALUES('" . $idAccount . "','" . $idPerson . "','" . $accountNumber . "'," . $cvv . ",'" . $dueDate . "',0,'".$accountType."','" . $openingDate . "','Es espera')");

        header("location:../accounts-creator.php?success=0&idPerson=".$idPerson."");
    }
}
