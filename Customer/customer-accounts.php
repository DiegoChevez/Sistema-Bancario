<?php

require_once('../Tools/connexion.php');

if (isset($_GET['idPerson'])) {
    $idCliente = $_GET['idPerson'];
    $sql = "SELECT c.`Names`, c.`Surnames`, c.`DUI`, c.`Salary`, c.`Residence`, c.`PhoneNumber`, u.`Mail`, u.`Password`
        FROM customers c
        INNER JOIN users u ON u.`ID_User` = c.`UserAccount`
        WHERE c.`ID_Cliente` = '" . $idCliente . "'";
    $result = $conex->query($sql);
    $datos = $result->fetch_assoc();
} else {
    header("location:index.php");
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->

<?php
//head
include_once("head.php");
?>

<body>

    <?php
    //navbar
    include_once("nav.php");
    ?>

    <div id="right-panel" class="right-panel">


        <?php
        //header
        include_once("header.php");
        ?>

        <div class="content">
            <div class="header-content" style="display: flex; align-items: center; gap: 10px;">
                <a href="index.php" style="font-size: 1.5rem;"><i class="fa-regular fa-circle-left"></i></a>
                <h3>Cuentas de <?php echo $idCliente; ?></h3>
            </div>
            <hr>
            <div class="animated fadeIn">
                <div class="row">
                    <?php
                    // Consulta SQL para seleccionar los usuarios con el rol "cliente" o "dependiente"
                    $sql = "SELECT a.*,CONCAT(c.`Names`, ' ', c.`Surnames`) AS FullName
                            FROM accounts a
                            INNER JOIN customers c ON c.`UserAccount` = a.`Customer`
                            WHERE `Customer` = '" . $idCliente . "'";

                    // Ejecutar la consulta SQL
                    $resultado = mysqli_query($conex, $sql);

                    // Verificar si se encontraron resultados
                    if (mysqli_num_rows($resultado) > 0 && mysqli_num_rows($resultado) <= 3) {
                        // Imprimir los resultados en una tabla HTML
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            if($fila['Status'] == 'Activo'){
                                echo '<div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">Cuenta: ' . $fila['AccountNumber'] . ' </strong>
                                        <small><span class="badge badge-primary float-right mt-1">Activo</span></small>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <img class="mx-auto d-block" src="images/card.png" alt="Card image cap" style="width: 30%;">
                                            <h5 class="text-sm-center mt-2 mb-1">' . $fila['AccountType'] . '</h5>
                                            <div class="location text-sm-center"><i class="fa-solid fa-id-card-clip"></i> ' . $fila['FullName'] . ' </div>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                            <h5 class="text-sm-center mt-2 mb-1" style="color:#146551; font-weight: bold;">Saldo: $'.$fila['Balance'].'</h5>
                                        </div>
                                    </div>
                                    <div class="card-footer text-sm-center">
                                        <a class="btn btn-outline-secondary btn-sm" href="customer-transactions.php?idCuenta='.$fila['ID_Account'].'" role="button">Movimientos</a>
                                        <a class="btn btn-outline-info btn-sm" href="customer-new-transactions.php?idCuenta='.$fila['ID_Account'].'" role="button"><i class="fa-solid fa-plus"></i> Transferencia</a>
                                    </div>
                                </div>
                            </div>';
                            }else{
                                echo '<div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">Cuenta: ' . $fila['AccountNumber'] . ' </strong>
                                        <small><span class="badge badge-secondary float-right mt-1">Innactiva</span></small>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <img class="mx-auto d-block" src="images/card.png" alt="Card image cap" style="width: 30%;">
                                            <h5 class="text-sm-center mt-2 mb-1">' . $fila['AccountType'] . '</h5>
                                            <div class="location text-sm-center"><i class="fa-solid fa-id-card-clip"></i> ' . $fila['FullName'] . ' </div>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                            <h5 class="text-sm-center mt-2 mb-1" style="color:#146551; font-weight: bold;">Saldo: $'.$fila['Balance'].'</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            }
                            
                        }
                    }
                    if(mysqli_num_rows($resultado) >= 0 && mysqli_num_rows($resultado) <=2){
                        echo '<div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">Solicitar Cuenta</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <h5 class="text-sm-center mt-2 mb-1"><a href="accounts-creator.php?idCustomer='.$idCliente.'"><i class="fa-solid fa-circle-plus text-sm-center" style="font-size: 18rem;"></i></a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
                    

                    mysqli_free_result($resultado);
                    mysqli_close($conex);

                    ?>
                    
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php
        //scripts
        include_once("footer.php");
        ?>
    </div>

    

    





    <?php
    //scripts
    include_once("scripts.php")
    ?>

</body>