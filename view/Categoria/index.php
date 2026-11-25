<?php require_once("../Main/sesion.php"); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("../Main/mainhead.php"); ?>
    <title>Eventu - Categorias</title>
</head>

<body>
    <div id="main-wrapper">
        <?php
        require_once("../Main/mainheadpanel.php");
        require_once("../Main/mainleftpanel.php");
        ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Mantenimiento</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Categorias</a></li>
                    </ol>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-12">
                        <div class="br-section-wrapper">
                            <div class="card-header">
                                <h3 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Categorias</h3>

                                <?php
                                // Verificar si el tipo de usuario es diferente de 2 (cliente)
                                if ($_SESSION["tipo"] != 2) {
                                    echo '<button type="button" id="btnnuevo_cat" class="btn btn-outline-primary" data-toggle="modal" data-target="#c">Nueva Categoría</button>';
                                }
                                ?>

                            </div>
                            <div class="card-body">
                                <div class="table-wrapper">
                                    <table id="producto_data_cat" class="display min-w850" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p">Id</th>
                                                <th class="wd-15p">Nombre</th>
                                                <th class="wd-15p">Descripcion</th>
                                                <?php
                                                // Verificar si el tipo de usuario no es igual a 2 (cliente)
                                                if ($_SESSION["tipo"] != 2) {
                                                    echo '<th class="wd-15p">Modificar</th>';
                                                    echo '<th class="wd-15p">Eliminar</th>';
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!--**********************************
            Footer start
        ***********************************-->
    <div class="footer">
        <div class="copyright">
            <p></p>
        </div>
    </div>
    <!--**********************************
            Footer end
        ***********************************-->
    </div>

    <?php
    require_once("modalcategoria.php")
        ?>

    <?php
    require_once("../Main/mainjs.php");
    ?>
    <script src="categoriasdeproducto.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>