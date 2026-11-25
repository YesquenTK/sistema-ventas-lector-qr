<?php 
require_once("../Main/sesion.php"); 
$id_usuario = isset($_SESSION["id"]) ? $_SESSION["id"] : 0;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("../Main/mainhead.php"); ?>
    <title>Eventu - Inicio</title>
    <link rel="stylesheet" type="text/css" href="../../public/cam/estilo_camara.css"/>
    <link rel="stylesheet" type="text/css" href="../../public/cam/css/plugins/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/cam/css/plugins/simple-line-icons.css"/>
    <link rel="stylesheet" type="text/css" href="../../public/cam/css/plugins/animate.min.css"/>
    <script  src="../../public/cam/js/jsQR.js"></script>
    <script>
    var idUsuario = <?php echo json_encode($id_usuario); ?>;
    </script>
    
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
						<li class="breadcrumb-item"><a href="javascript:void(0)">Panel</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Inicio</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
 
                
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-12 panel">
                                    <div class="col-md-12 panel-heading">
                                        <h4 class="text-center" style="color:#333;font-weight: bold; "> Lector QR&nbsp;</h4>
                                    </div>
                                    <br>
                                    <div class="row ">
                                        <label class="col-sm-4 form-control-label">Tipo de Busqueda: </label>
                                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                            <select class="form-control" name="tipo_busqueda" id="tipo_busqueda" data-placeholder="Seleccione" style="width: 100%; height: 100%" onchange="Opciones()"  required>
                                                <option value="0">Seleccione</option>
                                                <option value="1">Codigo de Producto</option>
                                                <option value="2">Codigo QR</option>
                                                <!--<option value="3">Codigo de Barras</option>-->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px" id="codigo">
                                        <label class="col-sm-4 form-control-label">Codigo: </label>
                                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                            <input type="text" class="form-control" id="num_cod" name="num_cod" placeholder="Ingrese el N° de Codigo">
                                        </div>
                                    </div>
                                    <div class="row justify-content-center" style="margin-top: 20px" >
                                        <div class="col-6 col-sm-4">
                                            <button type="button" id="btn_agregar" class="btn btn-outline-primary btn-lg" style="width:100%" onclick="agregar_prod()">Agregar</button>
                                        </div>
                                    </div>
                                    <br>
                                    <div id="camera">
                                        <input type="text" id="cd" value="" style="display: none;">
                                        <input type="text" id="st" value="" style="display: none;">
                                        <div class="contenedor_camara">

                                            <div id="loadingMessage">🎥 No se puede acceder a la transmisión de video (asegúrese de tener una cámara web habilitada)</div>
                                            <canvas id="canvas" hidden></canvas>
                                            <div id="output" hidden>
                                                <div id="outputMessage">Aún no se ha detectado código QR</div>
                                                <div hidden><b>Código:</b> <span id="outputData"></span></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-md-6 px-20" style="padding-right: 20px">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-12 panel-heading ">
                                    <h4 class="text-center" style="color:#333;font-weight: bold; "> Lista de Productos&nbsp;</h4>
                                    <br>
                                    <div class="table-responsive">
                                        <table id="producto_data" class="table table-striped table-hover px-10" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="centr">#</th>
                                                    <th class="centr">Codigo</th>
                                                    <th class="centr">Producto</th>
                                                    <th class="centr">Precio</th>
                                                    <th class="centr">Cantidad</th>
                                                    <th class="centr">Imagen</th>
                                                    <th class="centr">Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody id="t_body">

                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <br>
                                    <h3>Total: <span id="total_monto"></span></h3>
                                    <input type="hidden" name="" id="monto_pagar">
                                </div>

                                <div class="col-md-12 ">
                                    <div class="row justify-content-center" style="margin-top: 20px">
                                        <div class="col-6 col-sm-4">
                                            <button type="button" id="btn_pagar" class="btn btn-outline-primary btn-lg" style="width:100%">Pagar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div style="position: fixed;top: -60px;">
            <audio controls id="sonido_qr" style="width: 0px !important;height: 0px !important;">
                <source src="../../public/cam/beep.mp3" type="audio/mpeg">
            </audio>
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
        require_once("../Main/mainjs.php"); 
    ?>
    <script src="https://checkout.culqi.com/js/v4"></script>
    <script src="./inicio.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //console.log("User ID:", idUsuario);

    </script>

</body>

</html>
