
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

            <h3>Bienvenido <?php echo $_Username ?></h3>
            <hr> <br>

            <div class="animated fadeIn">

                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-3 col-lg-6">
                        <div class="card text-white bg-flat-color-1">
                            <div class="card-body">
                                <div class="card-left pt-1 float-left">
                                    <h3 class="mb-0 fw-r">
                                        <a href="customer-accounts.php?idPerson=<?php echo $_IdUser ?>" class="text-light">Cuentas</a>
                                    </h3>
                                    <p class="text-light mt-1 m-0">Targetas</p>
                                </div><!-- /.card-left -->

                                <div class="card-right float-right text-right">
                                    <i class="icon fade-5 icon-lg pe-7s-credit"></i>
                                </div><!-- /.card-right -->

                            </div>

                        </div>
                    </div>
                    <!--/.col-->

                    <div class="col-lg-3 col-lg-6">
                        <div class="card text-white bg-flat-color-1">
                            <div class="card-body">
                                <div class="card-left pt-1 float-left">
                                    <h3 class="mb-0 fw-r">
                                        <a href="customer-lending.php?idPerson=<?php echo $_IdUser ?>" class="text-light">Prestamos</a>
                                    </h3>
                                    <p class="text-light mt-1 m-0">Creditos</p>
                                </div><!-- /.card-left -->

                                <div class="card-right float-right text-right">
                                    <i class="icon fade-5 icon-lg pe-7s-cash"></i>
                                </div><!-- /.card-right -->

                            </div>

                        </div>
                    </div>
                    <!--/.col-->
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