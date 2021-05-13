<?php
require_once "../../config/conexion.php";
if (isset($_SESSION['usu_id'])) {
?>

    <!DOCTYPE html>
    <html>

    <?php require_once("../includes/head.php"); ?>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <title>Home HelpDesk </title>
    </head>

    <body class="with-side-menu">

        <?php require_once("../includes/header.php"); ?>
        <!--.site-header-->

        <div class="mobile-menu-left-overlay"></div>
        <?php require_once("../includes/nav.php"); ?>
        <!--.side-menu-->

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col col-sm-4">
                        <article class="statistic-box green">
                            <div>
                                <div class="number" id="lbltotal"></div>
                                <div class="caption">
                                    <div>Total tickets</div>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="col col-sm-4">
                        <article class="statistic-box yellow">
                            <div>
                                <div class="number" id="lblabiertos"></div>
                                <div class="caption">
                                    <div>Tickets Abiertos</div>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="col col-sm-4">
                        <article class="statistic-box red">
                            <div>
                                <div class="number" id="lblcerrados"></div>
                                <div class="caption">
                                    <div>Tickets Cerrados</div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                <div id="grafica" style="height: 250px;"></div>
            </div>
            <!--.container-fluid-->
        </div>
        <!--.page-content-->

        <?php require_once("../includes/js.php"); ?>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        <script src="home.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: " . Conectar::ruta() . "index.php");
}
?>