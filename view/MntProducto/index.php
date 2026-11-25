<?php require_once("../Main/sesion.php"); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("../Main/mainhead.php"); ?>
    <title>Eventu - Productos</title>
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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Producto</a></li>

                    </ol>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-12">
                        <div class="br-section-wrapper">
                            <div class="card-header">
                                <h3 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Productos</h3>


                                <?php
                                // Verificar si el tipo de usuario es diferente de 2 (cliente)
                                if ($_SESSION["tipo"] != 2) {
                                    echo '<button type="button" id="btnnuevo" class="btn btn-outline-primary">Nuevo Registro</button>';
                                }
                                ?>

                            </div>
                            <div class="card-body">
                                <div class="table-wrapper">
                                    <table id="producto_data" class="display min-w850" style="width: 100%">


                                        <thead>
                                            <tr>
                                                <th class="wd-15p">Id</th>
                                                <th class="wd-15p">Codigo</th>
                                                <th class="wd-15p">Categoria</th>
                                                <th class="wd-15p">Nombre</th>
                                                <th class="wd-15p">Precio</th>
                                                <th class="wd-15p">Cantidad</th>
                                                <th class="wd-15p">Imagen</th>
                                                <th class="wd-15p">QR</th>
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
    require_once("modalmantenimiento.php")
        ?>

    <?php
    require_once("../Main/mainjs.php");
    ?>
    <script src="mntproducto.js"></script>

</body>

</html>