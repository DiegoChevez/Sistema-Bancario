<?php

require_once('../Tools/connexion.php');

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
                <a href="users-partners.php" style="font-size: 1.5rem;"><i class="fa-regular fa-circle-left"></i></a>
                <h3>Nuevo Dependiente</h3>
            </div>
            <hr>
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Agregar</strong> Dependiente
                        </div>
                        <div class="card-body card-block">
                            <form action="controllers/partners-controller.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nombres</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="txt-names" name="txt-names" placeholder="Nombre1 Nombre2" class="form-control" pattern="^[a-zA-Z\u00c0-\u024f]+([ ][a-zA-Z\u00c0-\u024f]+)?$" required title="Solo se aceptan letras, por favor introdusca sus nombre">
                                        <small class="form-text text-muted">Porfavor Introduzca sus Nombres</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Apellidos</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="txt-surnames" name="txt-surnames" placeholder="Apellido1 Apellido2" class="form-control" pattern="^[a-zA-Z\u00c0-\u024f]+([ ][a-zA-Z\u00c0-\u024f]+)?$" required title="Solo se aceptan letras, por favor introdusca sus apellidos">
                                        <small class="form-text text-muted">Porfavor Introduzca sus Apellidos</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="email" id="txt-mail" name="txt-mail" placeholder="abc@gmail.com" class="form-control" required>
                                        <small class="form-text text-muted">Porfavor introdusca su correo</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Contraseña</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="password" id="txt-password" name="txt-password" placeholder="****" class="form-control" pattern=".{8,}" required title="Su contraseña debe tener minimo 8 caracteres">
                                        <small class="form-text text-muted">Porfavor introdusca su contraseña</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">DUI</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="txt-dui" name="txt-dui" placeholder="12121212-1" class="form-control" maxlength="10" pattern="^\d{0,9}-?\d{0,9}$" required title="Solo se aceptan numeros">
                                        <small class="form-text text-muted">Porfavor Introduzca su DUI</small>
                                        <script>
                                            const input = document.getElementById('txt-dui');
                                            input.addEventListener('input', function() {
                                                // Eliminar cualquier guion existente
                                                let value = this.value.replace(/-/g, '');
                                                // Añadir guion después del séptimo carácter
                                                if (value.length > 8) {
                                                    value = value.slice(0, 8) + '-' + value.slice(8);
                                                }
                                                // Establecer el valor actualizado
                                                this.value = value;
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nombre del Negocio</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="txt-trade" name="txt-trade" placeholder="Banco Perla" class="form-control" required>
                                        <small class="form-text text-muted">Porfavor Introduzca su Salario Mensual</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Residencia</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="txt-residence" id="txt-residence" class="form-control" required>
                                            <option value="" disabled selected>Seleccione su departamento</option>
                                            <option value="San Salvador">San Salvador</option>
                                            <option value="La Libertad">La Libertad</option>
                                            <option value="Santa Ana">Santa Ana</option>
                                            <option value="San Miguel">San Miguel</option>
                                            <option value="Usulutan">Usulutan</option>
                                            <option value="Morazan">Morazan</option>
                                            <option value="San Vicente">San Vicente</option>
                                            <option value="Ahuachapan">Ahuachapan</option>
                                            <option value="Sonsonate">Sonsonate</option>
                                            <option value="Chalatenango">Chalatenango</option>
                                            <option value="Cuscatlan">Cuscatlan</option>
                                            <option value="La Union">La Union</option>
                                            <option value="La Pa">La Paz</option>
                                            <option value="Cabañas">Cabañas</option>
                                        </select>

                                        <small class="form-text text-muted">Seleccione su recidencia</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Numero de Telefono</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="txt-phoneNumber" name="txt-phoneNumber" placeholder="1212-1212" class="form-control" maxlength="9" pattern="^\d{0,9}-?\d{0,9}$" required title="Solo se aceptan numeros" required>
                                        <small class="form-text text-muted">Porfavor introdusca su numero</small>
                                        <script>
                                            const inputPhone = document.getElementById('txt-phoneNumber');

                                            inputPhone.addEventListener('input', function() {
                                                // Eliminar cualquier guion existente
                                                let value = this.value.replace(/-/g, '');
                                                // Añadir guion después del cuarto carácter
                                                if (value.length > 4) {
                                                    value = value.slice(0, 4) + '-' + value.slice(4);
                                                }

                                                // Establecer el valor actualizado
                                                this.value = value;
                                            });
                                        </script>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" name="btn-AddPartners"><i class="fa fa-check"></i>&nbsp; Agregar</button>
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
                            text: 'El DUI utilizado ya esta asiganado a una cuenta'})
                </script>";
    }

    if (isset($_GET['error2'])) {
        echo "<script>Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'El Correo ya esta asignado a otra cuenta'})
                </script>";
    }

    if (isset($_GET['success'])) {
        echo "<script>Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Se ha agregado correctamente'})
                </script>";
    }
    ?>

</body>

</html>