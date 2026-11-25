

// Configura tu llave pública
Culqi.publicKey = 'pk_test_46504ddb7b1b7a3d'; // Llave Nueva

//Culqi.publicKey = 'pk_test_4f37e342c1ba192b';

/*Culqi.options({
    style: {
        logo: 'https://culqi.com/LogoCulqi.png',
        bannerColor: '', // hexadecimal
        buttonBackground: '', // hexadecimal
        menuColor: '', // hexadecimal
        linksColor: '', // hexadecimal
        buttonText: '', // texto que tomará el botón
        buttonTextColor: '', // hexadecimal
        priceColor: '' // hexadecimal
    }
});*/

var producto = '';
var precio = '';

const btn_pagar = document.getElementById('btn_pagar');

$('#btn_pagar').on('click', function (e) {
    e.preventDefault();
    let monto = $('#monto_pagar').val();
    precio = Number(monto) * 100;
    producto = "Boleta";
    console.log("PAGAR");

    Culqi.settings({
        title: 'Store',
        currency: 'PEN',  // Este parámetro es requerido para realizar pagos yape
        description: producto,
        amount: precio,  // Este parámetro es requerido para realizar pagos yape
        order: 'ord_live_0CjjdWhFpEAZlxlz', // Este parámetro es requerido para realizar pagos con pagoEfectivo, billeteras y Cuotéalo
        //xculqirsaid: 'Inserta aquí el id de tu llave pública RSA',
        //rsapublickey: 'Inserta aquí tu llave pública RSA',
    });

     // Abre el formulario con las opciones de Culqi.settings
     Culqi.open();
});

function culqi() {
    if (Culqi.token) { // ¡Objeto Token creado exitosamente!
        var token = Culqi.token.id;
        var email = Culqi.token.email;
        //En esta linea de codigo debemos enviar el "Culqi.token.id"
        var data = {precio: precio, token: token, email: email};
        //hacia tu servidor con Ajax


        $.post('../../procesar-pago.php', data, function(res){
            alert(res);
            console.log(res);
        });
        

    } else { // ¡Hubo algún problema!
        // Mostramos JSON de objeto error en consola
        console.log(Culqi.error);
        alert(Culqi.error.user_message);
    }
};

