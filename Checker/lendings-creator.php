<?php

require_once('../Tools/connexion.php');
if (isset($_GET["idPerson"])) {
    $idPerson = $_GET["idPerson"];
    $sqlPartners = "SELECT * FROM accounts WHERE `Customer` = '" . $idPerson . "' AND `AccountType` = 'Empresarial'";
    $sqlCustomers = "SELECT * FROM customers WHERE `UserAccount` = '" . $idPerson . "'";
    $resultPartners = $conex->query($sqlPartners);
    $resultCustomers = $conex->query($sqlCustomers);
    $datosPartners = $resultPartners->fetch_assoc();
    $datosCustomers = $resultCustomers->fetch_assoc();
    $case = '0';
    $interest = 0;
    if(mysqli_num_rows($resultCustomers) > 0){
        $salaryCustomer = $datosCustomers["Salary"];
        $maxMonthlyPayment = $salaryCustomer * 0.3;
        $case = 'Customer';
    }elseif(mysqli_num_rows($resultPartners)){
        $balancePartner = $datosPartners["Balance"];
        $case = 'Partner';
        $maxMonthlyPayment = $balancePartner * 0.3;
    }else{

    }
    
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
    <!-- Left Panel -->
    <?php
    //navbar
    include_once("nav.php");
    ?>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php
        //header
        include_once("header.php");
        ?>
        <!-- Content -->
        <div class="content">
            <div class="header-content" style="display: flex; align-items: center; gap: 10px;">
                <a href="users-clients.php" style="font-size: 1.5rem;"><i class="fa-regular fa-circle-left"></i></a>
                <h3>Nuevo Prestamo</h3>
            </div>
            <hr>
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Solicitud de</strong> Prestamos
                        </div>
                        <div class="card-body card-block">
                            <form action="controllers/customer-transactions-contoller.php?idPerson=<?php echo $idPerson ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <?php
                                switch($case){
                                    case 'Customer':
                                        if ($salaryCustomer < 365) {
                                            
                                            echo '<div class="row form-group">
                                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Monto del Prestamo</label></div>
                                                    <div class="col-12 col-md-9">
                                                        <select name="txt-amount" id="txt-amount" class="form-control" required>
                                                            <option value="" disabled selected>Seleccione una cantidad</option>
                                                            <option value="1000">$1,000</option>
                                                            <option value="5000">$5,000</option>
                                                            <option value="8000">$8,000</option>
                                                            <option value="10000">$10,000</option>
                                                        </select>
                                                        <small class="form-text text-muted">Seleccione su prestamo</small>
                                                    </div>
                                                </div>';
                                        }elseif($salaryCustomer < 600){
                                            
                                            echo '<div class="row form-group">
                                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Monto del Prestamo</label></div>
                                                    <div class="col-12 col-md-9">
                                                        <select name="txt-amount" id="txt-amount" class="form-control" required>
                                                            <option value="" disabled selected>Seleccione una cantidad</option>
                                                            <option value="10000">$10,000</option>
                                                            <option value="12000">$12,000</option>
                                                            <option value="15000">$15,000</option>
                                                            <option value="25000">$25,000</option>
                                                        </select>
                                                        <small class="form-text text-muted">Seleccione su prestamo</small>
                                                    </div>
                                                </div>';
                                        }elseif($salaryCustomer < 900){
                                            
                                            echo '<div class="row form-group">
                                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Monto del Prestamo</label></div>
                                                    <div class="col-12 col-md-9">
                                                        <select name="txt-amount" id="txt-amount" class="form-control" required>
                                                            <option value="" disabled selected>Seleccione una cantidad</option>
                                                            <option value="10000">$10,000</option>
                                                            <option value="15000">$15,000</option>
                                                            <option value="25000">$25,000</option>
                                                            <option value="35000">$35,000</option>
                                                        </select>
                                                        <small class="form-text text-muted">Seleccione su prestamo</small>
                                                    </div>
                                                </div>';
                                        }else{
                                            
                                            echo '<div class="row form-group">
                                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Monto del Prestamo</label></div>
                                                    <div class="col-12 col-md-9">
                                                        <select name="txt-amount" id="txt-amount" class="form-control" required>
                                                            <option value="" disabled selected>Seleccione una cantidad</option>
                                                            <option value="10000">$10,000</option>
                                                            <option value="25000">$25,000</option>
                                                            <option value="35000">$35,000</option>
                                                            <option value="50000">$50,000</option>
                                                        </select>
                                                        <small class="form-text text-muted">Seleccione su prestamo</small>
                                                    </div>
                                                </div>';
                                        }
                                        break;
                                    case 'Partner':
                                        if ($balancePartner < 365) {
                                            
                                            echo '<div class="row form-group">
                                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Monto del Prestamo</label></div>
                                                    <div class="col-12 col-md-9">
                                                        <select name="txt-amount" id="txt-amount" class="form-control" required>
                                                            <option value="" disabled selected>Seleccione una cantidad</option>
                                                            <option value="1000">$1,000</option>
                                                            <option value="5000">$5,000</option>
                                                            <option value="8000">$8,000</option>
                                                            <option value="10000">$10,000</option>
                                                        </select>
                                                        <small class="form-text text-muted">Seleccione su prestamo</small>
                                                    </div>
                                                </div>';
                                        }elseif($balancePartner < 600){
                                            
                                            echo '<div class="row form-group">
                                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Monto del Prestamo</label></div>
                                                    <div class="col-12 col-md-9">
                                                        <select name="txt-amount" id="txt-amount" class="form-control" required>
                                                            <option value="" disabled selected>Seleccione una cantidad</option>
                                                            <option value="10000">$10,000</option>
                                                            <option value="12000">$12,000</option>
                                                            <option value="15000">$15,000</option>
                                                            <option value="25000">$25,000</option>
                                                        </select>
                                                        <small class="form-text text-muted">Seleccione su prestamo</small>
                                                    </div>
                                                </div>';
                                        }elseif($balancePartner < 900){
                                            
                                            echo '<div class="row form-group">
                                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Monto del Prestamo</label></div>
                                                    <div class="col-12 col-md-9">
                                                        <select name="txt-amount" id="txt-amount" class="form-control" required>
                                                            <option value="" disabled selected>Seleccione una cantidad</option>
                                                            <option value="10000">$10,000</option>
                                                            <option value="15000">$15,000</option>
                                                            <option value="25000">$25,000</option>
                                                            <option value="35000">$35,000</option>
                                                        </select>
                                                        <small class="form-text text-muted">Seleccione su prestamo</small>
                                                    </div>
                                                </div>';
                                        }else{
                                            echo '<div class="row form-group">
                                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Monto del Prestamo</label></div>
                                                    <div class="col-12 col-md-9">
                                                        <select name="txt-amount" id="txt-amount" class="form-control" required>
                                                            <option value="" disabled selected>Seleccione una cantidad</option>
                                                            <option value="10000">$10,000</option>
                                                            <option value="25000">$25,000</option>
                                                            <option value="35000">$35,000</option>
                                                            <option value="50000">$50,000</option>
                                                        </select>
                                                        <small class="form-text text-muted">Seleccione su prestamo</small>
                                                    </div>
                                                </div>';
                                        }
                                        break;
                                    default:
                                    header("location:index.php");
                                    break;
                                }
                                ?>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Cuota Mensual</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="number" id="txt-MonthlyPayment" name="txt-MonthlyPayment" placeholder="$**" class="form-control" required min="1" max="<?php echo trim($maxMonthlyPayment); ?>">
                                        <small class="form-text text-muted">Ingrese su cuota mensual no mayor a $<?php echo$maxMonthlyPayment ?></small>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" name="btn-AddLending"><i class="fa fa-check"></i>&nbsp; Solicitar</button>
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

        <!-- Footer -->
        <?php
        //scripts
        include_once("footer.php");
        ?>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->

    <?php
    //scripts
    include_once("scripts.php");

    ?>



    <?php
    if (isset($_GET['error1'])) {
        echo "<script>Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ha ocurrido un error'})
                </script>";
    }

    if (isset($_GET['error2'])) {
        echo "<script>Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ha ocurrido un error'})
                </script>";
    }

    if (isset($_GET['success'])) {
        echo "<script>Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Prestamo solicitado con exito'})
                </script>";
    }
    ?>

</body>

</html>