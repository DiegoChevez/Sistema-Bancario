<?php

require_once('../Tools/connexion.php');
if (isset($_GET['idCuenta'])) {
    $idCuenta = $_GET['idCuenta'];
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
                <h3>Nuevo Transaccion: <?php echo $idCuenta; ?></h3>
            </div>
            <hr>
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Creando</strong> Transaccion
                        </div>
                        <div class="card-body card-block">
                            <form action="controllers/customer-transactions-contoller.php?idCuenta=<?php echo $idCuenta ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group" id="div-TipoTransaccion" style="display:none;">
                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Tipo de Transaccion</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="txt-TipoTransaccion" id="txt-TipoTransaccion" class="form-control" required>
                                            <option value="Transaccion" selected>Transaccion</option>
                                        </select>

                                        <small class="form-text text-muted">Seleccione el tipo de transaccion</small>
                                    </div>
                                </div>

                                <div class="row form-group" id="div-Destino">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Cuenta de Desino</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="txt-Destino" name="txt-Destino" placeholder="1234 1234 1234 1234" class="form-control" pattern="^\d{4}\s\d{4}\s\d{4}\s\d{4}$" title="Solo se aceptan numeros de cuentas">
                                        <small class="form-text text-muted">Digite el numero de cuenta del destino</small>
                                    </div>
                                </div>
                                <script>
                                    var input = document.getElementById("txt-Destino");

                                    input.addEventListener("input", function() {
                                        var value = input.value.replace(/\s/g, ""); // Eliminar espacios existentes
                                        var formattedValue = "";

                                        for (var i = 0; i < value.length; i++) {
                                            if (i > 0 && i % 4 === 0) {
                                                formattedValue += " ";
                                            }
                                            formattedValue += value[i];
                                        }

                                        input.value = formattedValue;
                                    });

                                    var select = document.getElementById("txt-TipoTransaccion");
                                    var destinoDiv = document.getElementById("div-Destino");

                                    select.addEventListener("change", function() {
                                        if (select.value === "Transaccion") {
                                            destinoDiv.style.display = "";
                                        } else {
                                            destinoDiv.style.display = "none";
                                        }
                                    });

                                    // Verificar el valor inicial al cargar la página
                                    if (select.value === "Transaccion") {
                                        destinoDiv.style.display = "";
                                    } else {
                                        destinoDiv.style.display = "none";
                                    }
                                </script>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Cantidad</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="number" id="txt-cantidad" name="txt-cantidad" placeholder="$200" class="form-control" step="any" min="0.01" required title="Introdusca una cantidad valida">
                                        <small class="form-text text-muted">Introduzca una cantidad</small>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Descripcion</label></div>
                                    <div class="col-12 col-md-9">
                                        <textarea id="txt-Descripcion" name="txt-Descripcion" class="form-control" placeholder="Deposito / Retiro" maxlength="255" required></textarea>
                                        <small class="form-text text-muted">Agrega una descripcion de la transferencia</small>
                                        <p id="wordCount" style="font-size: small;">0 palabras</p>
                                    </div>
                                </div>
                                <script>
                                    var textarea = document.getElementById("txt-Descripcion");
                                    var wordCountElement = document.getElementById("wordCount");

                                    textarea.addEventListener("input", function() {
                                        var text = textarea.value;
                                        var words = text.trim().split(/\s+/); // Dividir por espacios en blanco
                                        var wordCount = words.length;

                                        wordCountElement.textContent = wordCount + (wordCount === 1 ? " palabra" : " palabras");
                                    });
                                </script>

                                <button type="submit" class="btn btn-success" name="btn-AddTransaction"><i class="fa fa-check"></i>&nbsp; Procesar</button>
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
    
    if(isset($_GET["bug"])){
        echo "<script>Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ha ocurrido un error, intente nuevamente'})
            </script>";
    }

    if(isset($_GET["fault"])){
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