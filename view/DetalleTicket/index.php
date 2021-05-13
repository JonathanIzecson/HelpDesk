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
                                <h3 id="lblidticket"></h3>
                                <span id="lblestado"></span>
                                <span class='label label-pill label-primary' id="lblnombre"></span>
                                <span class='label label-pill label-warning' id="lblfecha"></span>
                                <ol class="breadcrumb breadcrumb-simple">
                                    <li><a href="#">Home</a></li>
                                    <li class="active">Detalle ticket</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </header>

                <div class="box-typical box-typical-padding">
                        <div class="row">
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="cat_id">Categoria</label>
                                    <input type="text" id="cat_id" class="form-control" name="cat_id" readonly>
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="tick_titulo">Titulo</label>
                                    <input type="text" class="form-control" id="tick_titulo" name="tick_titulo" readonly>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="tick_descrip">Descripcion</label>
                                    <p id="tick_descrip"></p>
                                </fieldset>
                            </div>

                        </div>
                    <!--.row-->
                </div>

                <section class="activity-line" id="lbldetalle">

                </section>
                <!--.activity-line-->

                <div class="box-typical box-typical-padding" id="paneldetalle">
                    <p>
                        Agrega tu respuesta.
                    </p>
                        <div class="row">
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="tickd_desc">Descripcion</label>
                                    <div class="summernote-theme-4">
                                        <textarea class="summernote" id="tickd_desc" name="tickd_desc"></textarea>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-6">
                                <button type="button" id="btnenviar" class="btn btn-rounded btn-inline btn-primary-outline">Enviar</button>
                                <button type="button" id="btncerrarticket" class="btn btn-rounded btn-inline btn-warning-outline">Cerrar Ticket</button>
                            </div>
                        </div>
                    <!--.row-->
                </div>

            </div>
            <!--.container-fluid-->
        </div>
        <!--.page-content-->
        <?php require_once "../includes/js.php"; ?>
        <script src="detalle.js" type="text/javascript"></script>
    </body>

    </html>
<?php
} else {
    header("Location: " . Conectar::ruta() . "index.php");
}
?>