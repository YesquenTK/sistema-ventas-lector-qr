function init() {
    $('#loginform').on("submit", function (e) {
        Ingresar(e);
    });

    $('#togglePassword').on('click', function() {
        const passwordField = $('#clave');
        const passwordFieldType = passwordField.attr('type');
        const newType = passwordFieldType === 'password' ? 'text' : 'password';
        passwordField.attr('type', newType);
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });
}

function Ingresar(e) {
    e.preventDefault();
    
    var usu_alias = $('#usuario').val();
    var usu_pass = $('#clave').val();
    console.log(usu_alias);
    
    $.post("../../controller/usuariocontrolador.php?op=ingresar", { alias: usu_alias, clave: usu_pass }, function (data) {
        var response = JSON.parse(data);
        console.log(response);

        if (response.id == 0) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Las credenciales no coinciden',
                showConfirmButton: true,
            });
        } else {
            console.log('User ID:', response.id);
            window.location.href = "../Inicio/index.php";
        }
    });
}

init();
