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
                                        VALUES('" . $idAccount . "','" . $idPerson . "','" . $accountNumber . "'," . $cvv . ",'" . $dueDate . "',0,'" . $accountType . "','" . $openingDate . "','Activo')");

        header("location:../accounts-creator.php?success=0&idPerson=" . $idPerson . "");
    }
}


if (isset($_POST["btn-AddLending"])) {
    if (isset($_GET['idPerson'])) {
        $idPerson = $_GET['idPerson'];
        $amount = $_POST['txt-amount'];
        $monthlyPayment = $_POST['txt-MonthlyPayment'];
        $prefix = substr($idPerson, 0, 2);
        $random = rand(10, 99);
        $idLending = "L" . $prefix . $random;
        $interest = 0;
        $interestP = 0;

        if ($amount <= 600) {
            $interest = 0.03;
            $interestP = 3;
        } elseif ($amount <= 900) {
            $interest = 0.04;
            $interestP = 4;
        } else {
            $interest = 0.05;
            $interestP = 5;
        }

        $months = ceil($amount / $monthlyPayment);
        $years = ceil($months / 12); // Redondeamos hacia arriba para obtener el número de años como un número entero
        $totalPayment = $monthlyPayment * ($years * 12); // Cantidad total de pagos mensuales
        $totalInterest = $amount * $interest; // Monto total de intereses pagados
        $totalAmount = $amount + $totalInterest; // Cantidad total que el cliente deberá pagar

        echo $years;

        $insertSQL = $conex->query("INSERT INTO lendings (`ID_Lending`, `Moneylender`, `TotalAmount`, `Interest`, `Amount`, `Status`, `MonthlyPayment`, `PaymentDeadline`) 
                                                VALUES ('" . $idLending . "', '" . $idPerson . "', '" . $totalAmount . "', '" . $interestP . "%', '" . $amount . "', 'En espera', '" . $monthlyPayment . "', '" . $years . "')");

        header("location:../lendings-creator.php?success=0&idPerson=" . $idPerson . "");
    } else {
        header("location:../lendings-creator.php?error=0idPerson=" . $idPerson . "");
    }
}

if (isset($_POST["btn-AddPayment"])) {
    if (isset($_GET['idLending'])) {
        $idLending = $_GET['idLending'];
        $idCuenta = $_POST["txt-cuenta"];
        $balance = $_POST["txt-cantidad"];

        $randomSeries = mt_rand(10000, 99999);
        $idTransacction = $idCuenta . $randomSeries;
        $dateRealization = date('Y-m-d H:i:s');

        $selectSql2 = $conex->query("SELECT * FROM lendings WHERE `ID_Lending` = '" . $idLending . "'");
        $selectSql = $conex->query("SELECT * FROM accounts WHERE `ID_Account` = '" . $idCuenta . "'");
        if ($data = $selectSql->fetch_assoc()) {
            $author = $data["Customer"];
            $currentAccountBalance = $data["Balance"];
            if ($data2 = $selectSql2->fetch_assoc()) {
                $currentTotalAmount = $data2["TotalAmount"];
                $newBalance = $currentAccountBalance - $balance;
                $newTotalAmount = $currentTotalAmount - $balance;
                if ($currentAccountBalance > $balance && $currentTotalAmount > $balance) {
                    $insertSql = $conex->query("INSERT INTO transactions (`ID_Transaction`,`RootAccount`,`TransactionType`,`DateRealization`,`DestinationAccount`,`Balance`,`PaymentConcept`,`Author`,`Status`)
                    VALUES('" . $idTransacction . "','" . $idCuenta . "','Transaccion','" . $dateRealization . "','" . $idCuenta . "'," . $balance . ",'" . 'Deposito al Prestamo' . "','" . $author . "','Realizado')");

                    if ($insertSql) {
                        $updateSql = $conex->query("UPDATE accounts SET Balance = $newBalance WHERE ID_Account = '" . $idCuenta . "'");
                        if ($updateSql) {
                            $updateSql2 = $conex->query("UPDATE lendings SET TotalAmount = $newTotalAmount WHERE ID_Lending = '" . $idLending . "'");
                            if ($updateSql2) {
                                header("location:../lending-new-payment.php?success=0&idLending=" . $idLending . "");
                            } else {
                                header("location:../lending-new-payment.php?bug=0&idLending=" . $idLending . "");
                            }
                        } else {
                            header("location:../lending-new-payment.php?fault=0&idLending=" . $idLending . "");
                        }
                    } else {
                        header("location:../lending-new-payment.php?bug=0&idLending=" . $idLending . "");
                    }
                }else{
                    header("location:../lending-new-payment.php?fault=0&idLending=" . $idLending . "");
                }
            }else{
                header("location:../lending-new-payment.php?bug=0&idLending=" . $idLending . "");
            }
        }else{
            header("location:../index.php");
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

if (isset($_GET["idLending"]) && isset($_GET["action"])) {
    $idLending = $_GET['idLending'];
    $action = $_GET['action'];
    switch ($action) {
        case 'eliminar':
            deletedLending($idLending);
            break;
        default:
            header("location:../users-clients.php?bug=0");
            break;
    }
}

function deletedLending($idLending)
{
    include "../../Tools/connexion.php";
    $sql = $conex->query("DELETE FROM lendings WHERE `ID_Lending` = '" . $idLending . "'");
    if ($sql) {
        header("location:../customer-lending.php?success=0");
    } else {
        header("location:../customer-lending.php?bug=0");
    }
}
