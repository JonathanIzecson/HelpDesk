<?php
require_once "../../config/conexion.php";
if (isset($_SESSION['usu_id'])) {
?>

    <!DOCTYPE html>
    <html>

    <?php require_once "../includes/head.php"; ?>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <title>Home - HelpDesk</title>
    </head>

    <body class="with-side-menu">

        <?php require_once "../includes/header.php"; ?>
        <!--.site-header-->

        <div class="mobile-menu-left-overlay"></div>
        <?php require_once "../includes/nav.php"; ?>
        <!--.side-menu-->

        <div class="page-content">
            <div class="container-fluid">
                <header class="section-header">
                    <div class="tbl">
                        <div class="tbl-row">
                            <div class="tbl-cell">
                                <h3>Mantenimiento Usuarios</h3>
                                <ol class="breadcrumb breadcrumb-simple">
                                    <li><a href="#">Home</a></li>
                                    <li class="active">Mantenimiento Usuarios</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </header>

                <div class="box-typical box-typical-padding">
                <button id="btnnuevo" type="button" class="btn btn-rounded btn-inline btn-primary-outline">Nuevo Usuario</button>
                    <table id="usuario_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th style="width: 5%;">Nombre</th>
                                <th style="width: 5%;">Apellido</th>
                                <th style="width: 30%;" class="d-none d-sm-table-cell">Correo</th>
                                <th style="width: 10%;" class="d-none d-sm-table-cell">Password</th>
                                <th style="width: 10%;" class="d-none d-sm-table-cell">Rol</th>
                                <th style="width: 5%;" class="text-center"></th>
                                <th style="width: 5%;" class="text-center"></th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--.container-fluid-->
        </div>
        <!--.page-content-->
        <?php require_once "modalmantenimiento.php"; ?>
        <?php require_once "../includes/js.php"; ?>
        <script src="mntusuarios.js" type="text/javascript"></script>
    </body>

    </html>
<?php
} else {
    header("Location: " . Conectar::ruta() . "index.php");
}
?>