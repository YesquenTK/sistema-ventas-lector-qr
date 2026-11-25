<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <?php require_once("../Main/mainhead.php") ?>
    <title>Eventu - Login</title>
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
                                        <a href=""><img src="../../public/images/logo.png" alt="" height="150"></a>
                                    </div>
                                    <h3 class="text-center mb-4 text-white">Iniciar Sesión</h3>
                                    <h6 class="text-center mb-4 text-white">Ingrese su credencial para obtener acceso</h6>
                                    <form id="loginform" method="post">
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Usuario:</strong></label>
                                            <i class="prefix-icon anticon anticon-user"></i>
                                            <input type="text" class="form-control" id="usuario" placeholder="Usuario" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Contraseña:</strong></label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="clave" placeholder="Contraseña" autocomplete="off">
                                                <div class="input-group-append">
                                                    <button id="togglePassword" class="btn btn-outline-secondary" type="button">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <button type="submit" class="btn bg-white text-primary btn-block" id="btningresar">Iniciar Sesión</button>
                                            </div>
                                        </div>
                                    </form>
                                    <p class="text-center text-white">¿No tienes una cuenta? <a href="RegisterPage.php" style="color: #2760AE;">Regístrate aquí</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once("../Main/mainjs.php") ?>
    <script src="./login.js"></script>
</body>
</html>
