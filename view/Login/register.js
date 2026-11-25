function isPasswordSecure(password) {
    const minLength = 8;
    const hasUpperCase = /[A-Z]/.test(password);
    const hasLowerCase = /[a-z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

    return password.length >= minLength && hasUpperCase && hasLowerCase && hasNumber && hasSpecialChar;
}

function init() {
}

$(document).ready(function() {
    $('#registerform').on("submit", function (e) {
        Registrar(e);
    });

    $('#togglePassword').on('click', function() {
        const passwordField = $('#clave');
        const passwordFieldType = passwordField.attr('type');
        const newType = passwordFieldType === 'password' ? 'text' : 'password';
        passwordField.attr('type', newType);
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });
});

function Registrar(e) {
    e.preventDefault();

    var usu_nom = $('#usu_nom').val();
    var apellidos = $('#apellidos').val(); 
    var dni = $('#dni').val(); 
    var usu_correo = $('#usu_correo').val();
    var clave = $('#clave').val();

    if (usu_nom === '' || apellidos === '' || dni === '' || usu_correo === '' || clave === '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Todos los campos son obligatorios',
        });
    } else if (!isPasswordSecure(clave)) {
        Swal.fire({
            icon: 'error',
            title: 'Contraseña insegura',
            text: 'La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula, un número y un carácter especial.',
        });
    } else {
        $.post("../../controller/usuariocontrolador.php?op=registro", {
            usu_nom: usu_nom,
            apellidos: apellidos, 
            dni: dni, 
            usu_correo: usu_correo,
            clave: clave
        }, function (data) {
            if (data == 1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El correo ya está registrado',
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: '¡Registro exitoso!',
                    text: 'Ahora puedes iniciar sesión',
                }).then(() => {
                    window.location.href = "../../view/Login/index.php";
                });
            }
        }).fail(function (xhr, status, error) {
            console.error("Error en la solicitud AJAX:", xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Error en la solicitud AJAX. ¡Inténtalo de nuevo!',
            });
        });
    }
}
