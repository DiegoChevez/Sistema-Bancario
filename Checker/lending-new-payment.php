<?php

require_once('../Tools/connexion.php');
if (isset($_GET["idLending"])) {
    $idLending = $_GET["idLending"];
    $sql = "SELECT * FROM lendings WHERE `ID_Lending` = '" . $idLending . "'";
    $result = $conex->query($sql);
    $datos = $result->fetch_assoc();
    $idMoneyLender = $datos["Moneylender"];
    $totalAmount = $datos["Amount"];
    $monthlyPayment = $datos["MonthlyPayment"];
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
                <a href="users-clients.php" style="font-size: 1.5rem;"><i class="fa-regular fa-circle-left"></i></a>
                <h3>Nuevo Pago: <?php echo $idLending; ?></h3>
            </div>
            <hr>
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Depositando</strong> Pago
                        </div>
                        <div class="card-body card-block">
                            <form action="controllers/customer-transactions-contoller.php?idLending=<?php echo $idLending?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group" id="div-TipoTransaccion">
                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Tipo de Transaccion</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="txt-cuenta" id="txt-cuenta" class="form-control" required>
                                            <?php
                                            $sql = "SELECT * FROM accounts WHERE `Customer` = '" . $idMoneyLender . "'";
                                            $resultado = $conex->query($sql);
                                            if ($resultado->num_rows > 0) {
                                                echo '<option value="" disabled selected>Seleccione el tipo de transaccion</option>';
                                                while ($fila = $resultado->fetch_assoc()) {
                                                    $id = $fila['ID_Account'];
                                                    $cuenta = $fila['AccountNumber'];

                                                    // Imprimir cada opción
                                                    echo '<option value="' . $id . '">' . $cuenta . '</option>';
                                                }
                                            } else {
                                                echo '<option value="" disabled selected>No posee una cuenta</option>';
                                            }
                                            ?>
                                        </select>

                                        <small class="form-text text-muted">Seleccione el tipo de transaccion</small>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Cantidad</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="number" id="txt-cantidad" name="txt-cantidad" placeholder="$200" class="form-control" step="any" min="0.01" required title="Introdusca una cantidad valida" max="<?php echo trim($maxMonthlyPayment); ?>" >
                                        <small class="form-text text-muted">Introduzca una cantidad, recuerde no puede ser mayor a: $<?php echo $monthlyPayment ?></small>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success" name="btn-AddPayment"><i class="fa fa-check"></i>&nbsp; Procesar</button>
                                <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp; Limpiar</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <p>Recuerde que al crear este cliente tambien se le creara un usuario que tendra acceso a su panel de control</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
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

    <?php

    if (isset($_GET["bug"])) {
        echo "<script>Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ha ocurrido un error, intente nuevamente'})
            </script>";
    }

    if (isset($_GET["fault"])) {
        echo "<script>Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ha ocurrido un error, fondos insuficientes'})
            </script>";
    }

    if (isset($_GET['success'])) {
        echo "<script>Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Se ha procesado su transaccion'})
                </script>";
    }




    ?>

</body>