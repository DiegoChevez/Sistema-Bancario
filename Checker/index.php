<?php


session_start();
$id_User = $_SESSION["ID_User"];
$username = $_SESSION["Username"];
$role = $_SESSION["Role"];
$mail = $_SESSION["Mail"];
$password = $_SESSION["Password"];
$registrationDate = $_SESSION["RegistrationDate"];
$status = $_SESSION["Status"];

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

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php
        //header
        include_once("header.php");
        ?>

        <!-- Content -->
        <div class="content">

            <h3>Bienvenido <?php echo $username ?></h3>
            <hr> <br>

            <div class="animated fadeIn">

                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-3 col-lg-6">
                        <div class="card text-white bg-flat-color-1">
                            <div class="card-body">
                                <div class="card-left pt-1 float-left">
                                    <h3 class="mb-0 fw-r">
                                        <a href="users-clients.php" class="text-light">Usuarios</a>
                                    </h3>
                                    <p class="text-light mt-1 m-0">Clientes</p>
                                </div><!-- /.card-left -->

                                <div class="card-right float-right text-right">
                                    <i class="icon fade-5 icon-lg pe-7s-users"></i>
                                </div><!-- /.card-right -->

                            </div>

                        </div>
                    </div>
                    <!--/.col-->

                    <div class="col-lg-3 col-lg-6">
                        <div class="card text-white bg-flat-color-3">
                            <div class="card-body">
                                <div class="card-left pt-1 float-left">
                                    <h3 class="mb-0 fw-r">
                                        <a href="users-partners.php" class="text-light">Dependientes</a>
                                    </h3>
                                    <p class="text-light mt-1 m-0">Afiliados</p>
                                </div><!-- /.card-left -->

                                <div class="card-right float-right text-right">
                                    <i class="icon fade-5 icon-lg pe-7s-map-2"></i>
                                </div><!-- /.card-right -->

                            </div>

                        </div>
                    </div>
                    <!--/.col-->

                </div>

                <div class="row">
                    <div class="col-lg-3 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-wallet text-primary border-primary"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Movimientos</div>
                                        <div class="stat-digit"><a href="WithdrawalsDeposits.php" class="stat-digit">Transacciones: Retiros y Depositos</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-support text-info border-info"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Procesos</div>
                                        <div class="stat-digit"><a href="customer-lending.php" class="stat-digit">Solicitudes de Prestamos</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-credit"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><a href="allAccounts.php" class="stat-text">Cuentas</a></div>
                                            <div class="stat-heading">Ahorro o Corriente</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-chat"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><a href="accountOFF.php" class="stat-text">Peticiones</a></div>
                                            <div class="stat-heading">Solicitudes de cuentas</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->

            </div>

        </div>


        <div class="clearfix"></div>


        <!-- Footer -->
        <?php
        //footer
        include_once("footer.php");
        ?>

    </div>
    <!-- /#right-panel -->


    <!-- Scripts -->
    <?php
    //scripts
    include_once("scripts.php")
    ?>

</body>

</html>