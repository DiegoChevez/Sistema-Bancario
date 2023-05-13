<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="menu-title">Banco Perla</li><!-- /.menu-title -->
                <li>
                    <a href="index.php"><i class="menu-icon fa fa-home"></i> &nbsp; Inicio </a>
                </li>
                <li>
                    <a href="../Website/index.html"><i class="menu-icon fa fa-globe"></i>&nbsp; SiteWeb</a>
                </li>
                <li class="menu-title">Acciones</li><!-- /.menu-title -->
                <li class="">
                    <a href="customer-accounts.php?idPerson=<?php echo $_IdUser ?>"><i class="menu-icon fa fa-credit-card"></i>&nbsp; Cuentas</a>
                </li>

                <li class="">
                    <a href="customer-lending.php?idPerson=<?php echo $_IdUser ?>"><i class="menu-icon fa fa-money"></i>&nbsp; Prestamos</a>
                </li>

                <li class="menu-title">Opciones</li><!-- /.menu-title -->
                <li class="">
                    <a href="sessiondestroy.php"><i class="menu-icon fa fa-retweet"></i>&nbsp; Cambiar de Cuenta</a>
                </li>
                <li class="">
                    <a href="sessiondestroy.php"><i class="menu-icon fa fa-sign-out"></i>&nbsp; Salir</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>