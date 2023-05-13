<?php

require_once('../Tools/connexion.php');

if(isset($_GET["idPerson"])){
    $idPerson = $_GET["idPerson"];

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
                <a href="customer-accounts.php" style="font-size: 1.5rem;"><i class="fa-regular fa-circle-left"></i></a>
                <h3>Nuevo Cuenta</h3>
            </div>
            <hr>
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Cuentas: </strong> <?php echo $idPerson ?>
                        </div>
                        <div class="card-body card-block">
                            <form action="controllers/customer-transactions-contoller.php?idPerson=<?php echo $idPerson ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Residencia</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="txt-AccountType" id="txt-AccountType" class="form-control" required>
                                            <option value="" disabled selected>Seleccione su Tipo de Cuenta</option>
                                            <option value="Corriente">Corriente</option>
                                            <option value="Ahorros">Ahorros</option>
                                        </select>

                                        <small class="form-text text-muted">Seleccione su recidencia</small>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" name="btn-AddAccount"><i class="fa fa-check"></i>&nbsp; Solicitar</button>
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
                            title: 'Ha ocurrido un error',
                            text: 'No se ha solicitado su cuenta, intente nuevamente'})
                </script>";
    }

    if (isset($_GET['error2'])) {
        echo "<script>Swal.fire({
                            icon: 'error',
                            title: 'Ha ocurrido un error',
                            text: 'Parece que se han perdido datos, reintente nuevamente'})
                </script>";
    }
    ?>

</body>

</html>