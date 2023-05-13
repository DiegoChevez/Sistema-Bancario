<?php

require_once('../Tools/connexion.php');
if(isset($_GET['idPartner'])){
    $idPartners = $_GET['idPartner'];
    $sql = "SELECT p.`Names`, p.`Surnames`, p.`DUI`, p.`Trade`, p.`Location`, p.`PhoneNumber`, u.`Mail`, u.`Password`
            FROM partners p
            INNER JOIN users u ON u.`ID_User` = p.`UserAccount`
            WHERE p.`ID_Partners` = '".$idPartners."'";
    $result = $conex->query($sql);
    $datos = $result->fetch_assoc();

    $names = $datos['Names'];
    $surnames = $datos["Surnames"];
    $dui = $datos['DUI'];
    $trade = $datos['Trade'];
    $location = $datos['Location'];
    $phoneNumber = $datos['PhoneNumber'];
    $mail = $datos['Mail'];
    $password = $datos["Password"];

}else{
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
                <h3>Cliente: <?php echo $idPartners ?> </h3>
            </div>
            <hr>
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Editar</strong> Dependiente
                        </div>
                        <div class="card-body card-block">
                            <form action="controllers/partners-controller.php?idPartner=<?php echo $idPartners ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nombres</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="txt-names" name="txt-names" class="form-control" value= <?php echo $names;  ?> disabled>
                                        <small class="form-text text-muted">Nombres del Cliente</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Apellidos</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="txt-surnames" name="txt-surnames" class="form-control" value= <?php echo $surnames;  ?> disabled>
                                        <small class="form-text text-muted">Apellidos del Cliente</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="email" id="txt-mail" name="txt-mail" class="form-control" value= <?php echo $mail;  ?> >
                                        <small class="form-text text-muted">Correo Actual</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Contraseña</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="password" id="txt-password" name="txt-password" class="form-control" value= <?php echo $password;  ?> disabled >
                                        <small class="form-text text-muted">Contraseña Actual</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">DUI</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="txt-dui" name="txt-dui" class="form-control" value= <?php echo $dui;  ?> disabled>
                                        <small class="form-text text-muted">DUI del Cliente</small>
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
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Empresa</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="txt-trade" name="txt-trade" class="form-control" value= <?php echo $trade;  ?> disabled>
                                        <small class="form-text text-muted">Empresa actual</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Residencia</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="txt-location" id="txt-location" class="form-control">
                                            <option value="<?php echo $location;?>"selected><?php echo $location;  ?> </option>
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
                                            <option value="La Paz">La Paz</option>
                                            <option value="Cabañas">Cabañas</option>
                                        </select>

                                        <small class="form-text text-muted">Residencia actual</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Numero de Telefono</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="txt-phoneNumber" name="txt-phoneNumber" class="form-control" maxlength="9" pattern="^\d{0,9}-?\d{0,9}$" required title="Solo se aceptan numeros" value= <?php echo $phoneNumber;  ?> >
                                        <small class="form-text text-muted">Numero actual</small>
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
                                <a class="btn btn-secondary" href="users-partners.php" role="button"><i class="fa-solid fa-arrow-left"></i>&nbsp; Regresar</a>
                                <button type="submit" class="btn btn-success" name="btn-UpdatePartner"><i class="fa fa-check"></i>&nbsp; Actualizar</button>
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
    
    if (isset($_GET['bug'])) {
        echo "<script>Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ha ocurrido un error'})
                </script>";
    }
    
    
    ?>
    

</body>

</html>