<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Acara - Ticketing Bootstrap Admin Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../../public/images/favicon.png">
    <link href="../../public/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                    </div>
                                    <h4 class="text-center mb-4 text-white">Registra tu cuenta</h4>
                                    <form id="registerform" method="post">
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Nombre</strong></label>
                                            <input type="text" id="usu_nom" name="usu_nom" class="form-control" placeholder="Ingrese Nombre">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Apellidos</strong></label>
                                            <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Ingrese Apellidos">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>DNI</strong></label>
                                            <input type="text" id="dni" name="dni" class="form-control" placeholder="Ingrese DNI">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Correo Electrónico</strong></label>
                                            <input type="email" id="usu_correo" name="usu_correo" class="form-control" placeholder="hello@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Contraseña</strong></label>
                                            <div class="input-group">
                                                <input type="password" id="clave" name="clave" class="form-control" value="">
                                                <div class="input-group-append">
                                                    <button id="togglePassword" class="btn btn-outline-secondary" type="button">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <small class="form-text text-white">La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula, un número y un carácter especial.</small>
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" id="btnregistrar" class="btn bg-white text-primary btn-block">Registrar</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p class="text-white">¿Ya tienes una cuenta? <a class="text-white" href="../../view/Login/index.php">Iniciar sesión</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../public/lib/global/global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script src="register.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
</body>
</html>
