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
                <h3>Clientes</h3>
            </div>

            <hr>

            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="display: flex; justify-content: space-between;">
                                <strong class="card-title">Clientes Registrados</strong>
                                <div class="form-actions form-group">
                                    <a class="btn btn-outline-primary" href="customer-creator.php" role="button"><i class="fa fa-plus-circle"></i>&nbsp; Agregar</a>
                                    <a class="btn btn-danger" href="#" role="button"><i class="fa-regular fa-file-lines"></i> PDF</a>
                                    <a class="btn btn-success" href="#" role="button"><i class="fa-regular fa-file-excel"></i> EXCEL</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">

                                <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Cliente</th>
                                            <th>Numero de Cuenta</th>
                                            <th>CVV</th>
                                            <th>Fecha de Vencimiento</th>
                                            <th>Balance</th>
                                            <th>Tipo de Cuenta</th>
                                            <th>Fecha de creacion</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        // Consulta SQL para seleccionar los usuarios con el rol "cliente" o "dependiente"
                                        $sql = "SELECT a.*,u.`Username` FROM accounts a INNER JOIN users u ON u.`ID_User` = a.`Customer`";

                                        // Ejecutar la consulta SQL
                                        $resultado = mysqli_query($conex, $sql);

                                        // Verificar si se encontraron resultados
                                        if (mysqli_num_rows($resultado) > 0) {
                                            $dataN = 1;
                                            // Imprimir los resultados en una tabla HTML
                                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                                echo "<tr>";
                                                echo "<td>" . $dataN . "</td>";
                                                echo "<td>" . $fila['Username'] . "</td>";
                                                echo "<td>" . $fila['AccountNumber'] . "</td>";
                                                echo "<td>" . $fila['CVV'] . "</td>";
                                                echo "<td>" . $fila['DueDate'] . "</td>";
                                                echo "<td>$" . $fila['Balance'] . "</td>";
                                                echo "<td>" . $fila['AccountType'] . "</td>";
                                                echo "<td>" . $fila['OpeningDate'] . "</td>";
                                                if($fila['Status']=='Activo'){
                                                    echo '<td><center><span class="badge badge-primary">' . $fila['Status'] . '</span></center></td>';
                                                }else{
                                                    echo '<td><center><span class="badge badge-secondary">' . $fila['Status'] . '</span></center></td>';
                                                }
                                                
                                                $dataN++;
                                            }
                                            echo "</tr>";
                                        }

                                        mysqli_free_result($resultado);
                                        mysqli_close($conex);

                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div>

        <div class="clearfix"></div>






        <?php
        //scripts
        include_once("footer.php");
        ?>


    </div>

    <!-- Scripts -->
    <?php
    //scripts
    include_once("scripts.php")
    ?>

</body>