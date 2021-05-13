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
                                <h3>Nuevo ticket</h3>
                                <ol class="breadcrumb breadcrumb-simple">
                                    <li><a href="#">Home</a></li>
                                    <li class="active">Nuevo ticket</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </header>

                <div class="box-typical box-typical-padding">
                    <p>
                        Aqui puedes generar un nuevo ticket de HelpDesk.
                    </p>

                    <h5 class="m-t-lg with-border">Crea un nuevo ticket</h5>


                    <form method="post" id="ticket_form">
                        <div class="row">
                            <input type="hidden" name="usu_id" id="usu_id" value="<?php echo $_SESSION['usu_id']; ?>">
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="cat_id">Categoria</label>
                                    <select id="cat_id" class="form-control" name="cat_id">
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="tick_titulo">Titulo</label>
                                    <input type="text" class="form-control" id="tick_titulo" name="tick_titulo" placeholder="Ingresa titulo">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="tick_desc">Descripcion</label>
                                    <div class="summernote-theme-4">
                                        <textarea class="summernote" id="ticket_desc" name="tick_desc"></textarea>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <button type="submit" name="action" value="add" class="btn btn-rounded btn-inline btn-primary-outline">Guardar</button>
                            </div>
                        </div>
                    </form>
                    <!--.row-->
                </div>

            </div>
            <!--.container-fluid-->
        </div>
        <!--.page-content-->
        <?php require_once "../includes/js.php"; ?>
        <script src="nuevo.js" type="text/javascript"></script>
    </body>

    </html>
<?php
} else {
    header("Location: " . Conectar::ruta() . "index.php");
}
?>