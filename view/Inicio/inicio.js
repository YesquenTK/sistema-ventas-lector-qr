var carrito = [];

$(document).ready(function(){ 

  console.log("ID del usuario:", idUsuario);

    $('#camera').hide();

});

function eliminar(id){
    let filas ="";
    let orden_f = 0;
    let monto_total = 0;
    let orden ;
    orden = Number(id) - 1;
    carrito.splice(orden, 1);

    monto_total = listarCarrito();

    $('#total_monto').html("S/. "+Number.parseFloat(monto_total).toFixed(2));
    $('#monto_pagar').val(Number.parseFloat(monto_total).toFixed(2));
}

function guardar_codigo_escaneado(result_qr) {
  let cambio = 0;
  let monto_total = 0;
  let filas = "";
  let orden = 0;
  $.ajax({
      type: 'POST',
      url: "../../controller/productocontrolador.php?op=mostrar_codigo",
      data: { producto_cod: result_qr },
      async: false,
      dataType: 'JSON',
      success: function (datos) {
          console.log(datos);

          let cat_id = datos.cat_id;
          console.log("cat_id:", cat_id);

          carrito.push({
              'id': datos.id,
              'codigo': datos.codigo,
              'producto': datos.producto,
              'precio': datos.precio,
              'imagen': datos.imagen,
              'cantidad': 1,
              'cat_id': datos.cat_id
          });

          monto_total = listarCarrito();
      },
      error: function (error) {
          console.log(error)
      }
  });

  $('#total_monto').html("S/. " + Number.parseFloat(monto_total).toFixed(2));
  $('#monto_pagar').val(Number.parseFloat(monto_total).toFixed(2));
}

// Resto del código de la función agregar_prod()
function agregar_prod(){
  let num_doc = $('#num_cod').val();

  if(num_doc != ""){
      guardar_codigo_escaneado(num_doc);
  }
}




function listarCarrito(){
    let orden = 0;
    let monto_total = 0;
    let filas ="";

    carrito.forEach(function(item){
        orden++;
        filas +='<tr>';
        filas +='<td class="centr" style="padding: 1.5rem 0rem;">'+orden+'</td>';
        filas +='<td class="centr" style="padding: 1.5rem 0rem;">'+item.codigo+'</td>';
        filas +='<td class="centr" style="padding: 1.5rem 0rem;">'+item.producto+'</td>';
        filas +='<td class="centr" style="padding: 1.5rem 0rem;">'+Number.parseFloat(item.precio).toFixed(2)+'</td>';
        //filas +='<td class="centr">'+item.cantidad+'</td>';
        filas +='<td class="centr" style="width: 150px">';
        filas +=  '<div class="container" style="margin-top:0px" >';
        filas +=    '<div class="row justify-content-center">';
        filas +=      '<div class="col-sm-4 p-1">';
        filas +=        '<button class="btn btn-outline-secondary boton-sr" id="inc_'+item.codigo+'" onclick="Reducir(this)" style="width:100%; text-align:center; padding: 0.375rem 0; height: 100% "><span>-</span></button>';
        filas +=      '</div>';
        filas +=      '<div class="col-12 col-sm-4 p-1">';
        filas +=        '<input id="cant_'+item.codigo+'" type="number" min="1" max="9" class="form-control" style="width:100%; text-align:center; padding: 0.375rem 0;" value ="'+item.cantidad+'" step="1" oninput="AgregarNumero(this)" />';
        filas +=      '</div>';
        filas +=      '<div class="col-sm-4 p-1">';
        filas +=        '<button class="btn btn-outline-secondary boton-sr" id="dec_'+item.codigo+'" onclick="Incrementar(this)" style= "width:100%; text-align:center; padding: 0.375rem 0;  height: 100% "><span>+</span></button>';
        filas +=      '</div>';
        filas +=    '</div>';
        filas +=  '</div>';
        filas +='</td>';
        filas +='<td class="centr"><img src="../../assets/img/'+item.imagen+'" width="35px" height="55px" ></img></td>';
        //filas +='<td class="centr"><img src="../../assets/img/usuario.jpg" width="35px" height="55px" ></img></td>';
        filas +='<td class="centr" style="padding: 1rem 0rem;"><button type="button" onClick="eliminar('+orden+');"  id="'+item.id+'" class="btn btn-danger btn-icon">X</button></td>';
        filas +='</tr>';
        
        monto_total += Number(item.precio) * Number(item.cantidad);
    });
    $('#t_body').html(filas);

    //$('#producto_data').dataTable();

    return monto_total;
}

function Incrementar(val){
    let ids       = val.id;
    let id_ipt    =  ids.slice(4);
    let cantidad  = $('#cant_'+id_ipt).val();
    let resultado = Number(cantidad) + 1;
    let monto_total = 0;

    carrito.forEach(function(item){
        if(item.codigo == id_ipt){
            item.cantidad = Number(item.cantidad) + 1;
            //item.precio = item.precio * item.cantidad;
        }
    });

    monto_total = listarCarrito();

    $('#cant_'+id_ipt).val(resultado);
    $('#total_monto').html("S/. "+Number.parseFloat(monto_total).toFixed(2));
    $('#monto_pagar').val(Number.parseFloat(monto_total).toFixed(2));
}

function Reducir(val){
  let ids       = val.id;
  let id_ipt    =  ids.slice(4);
  let cantidad  = $('#cant_'+id_ipt).val();
  let resultado;
  let monto_total = 0;

  if(cantidad == '1'){

  }else {
    carrito.forEach(function(item){
        if(item.codigo == id_ipt){
            item.cantidad = Number(item.cantidad) - 1;
        }
    });

    monto_total = listarCarrito();
    resultado = Number(cantidad) - 1;
    $('#cant_'+id_ipt).val(resultado);
    $('#total_monto').html("S/. "+Number.parseFloat(monto_total).toFixed(2));
    $('#monto_pagar').val(Number.parseFloat(monto_total).toFixed(2));
  }
  
  
}

function AgregarNumero(val){
    let ids         = val.id;
    let id_ipt      = ids.slice(5);
    let cantidad    = $('#cant_'+id_ipt).val();
    let monto_total = 0;

    carrito.forEach(function(item){
        if(item.codigo == id_ipt){
            item.cantidad = cantidad ;
            //item.precio = item.precio * item.cantidad;
        }
    });

    monto_total = listarCarrito();

    $('#total_monto').html("S/. "+Number.parseFloat(monto_total).toFixed(2));
    $('#monto_pagar').val(Number.parseFloat(monto_total).toFixed(2));
}

function Opciones(){
  let valor = $('#tipo_busqueda').val();
  
  if(valor == "1"){ // 1   = BUSQUEDA CODIGO
    console.log("1");
    $('#camera').hide();
    $('#btn_agregar').show();
    $('#codigo').show();
  }else {
    if(valor == "2"){ // 2 = LEctor QR
      console.log("2");
      $('#camera').show();
      $('#btn_agregar').hide();
      $('#codigo').hide();
    }else{
       //valor = 3
    }
  }

}

function agregar_prod(){
    let num_doc = $('#num_cod').val();

    if(num_doc != ""){
        guardar_codigo_escaneado(num_doc);
    }

  

}

var initial_code_result = true;
var video = document.createElement("video");
var canvasElement = document.getElementById("canvas");
var canvas = canvasElement.getContext("2d");
var loadingMessage = document.getElementById("loadingMessage");
var outputContainer = document.getElementById("output");
var outputMessage = document.getElementById("outputMessage");
var outputData = document.getElementById("outputData");
var sonido = document.querySelector('#sonido_qr');

function drawLine(begin, end, color) {
  canvas.beginPath();
  canvas.moveTo(begin.x, begin.y);
  canvas.lineTo(end.x, end.y);
  canvas.lineWidth = 4;
  canvas.strokeStyle = color;
  canvas.stroke();
}//fin drawLine

// Use facingMode: environment to attemt to get the front camera on phones
navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
  video.srcObject = stream;
  video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
  video.play();
  requestAnimationFrame(tick);
});

function tick() {
  loadingMessage.innerText = "âŒ› Cargando Video...";
  if (video.readyState === video.HAVE_ENOUGH_DATA) {
    loadingMessage.hidden = true;
    canvasElement.hidden = false;
    outputContainer.hidden = false;

    canvasElement.height = video.videoHeight;
    canvasElement.width = video.videoWidth;
    canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
    var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
    var code = jsQR(imageData.data, imageData.width, imageData.height, {
      inversionAttempts: "dontInvert",
    });
    if (code && initial_code_result) {
      drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
      drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
      drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
      drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
      if(code.data!=''){
        outputMessage.hidden = true;
        outputData.parentElement.hidden = false;
        outputData.innerText = code.data;
        sonido.setAttribute("autoplay", true);
        sonido.setAttribute("playsinline", true); 
        sonido.play();
        sonido.play();
        guardar_codigo_escaneado(code.data);
        initial_code_result = false;
        setTimeout(function(){
          initial_code_result = true;
        },4000);
      }else{
        
      }
    } else {
      if(initial_code_result){
        outputMessage.hidden = false;
        outputData.parentElement.hidden = true;
      }
    }
  }
  requestAnimationFrame(tick);
}//tick






/*PAGO CULQI*/

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
  let desc = "";
  if(carrito.length != 0){
      
      carrito.forEach(function(item){
          desc += ''+item.producto+' ';
      });

      console.log(desc);
      Culqi.settings({
        title: 'Store',
        currency: 'PEN',  // Este parámetro es requerido para realizar pagos yape
        description: desc,
        amount: precio,  // Este parámetro es requerido para realizar pagos yape
        order: 'ord_live_0CjjdWhFpEAZlxlz', // Este parámetro es requerido para realizar pagos con pagoEfectivo, billeteras y Cuotéalo
        //xculqirsaid: 'Inserta aquí el id de tu llave pública RSA',
        //rsapublickey: 'Inserta aquí tu llave pública RSA',
    });

    Culqi.open();
  }else {
    
    swal.fire(
      'No se ha elegido ningun producto',
      '',
      'warning'
    );
  }

  
});

function culqi_redirect(url) {
window.location.href = url;
}

function culqi() {
if (Culqi.token) {
  // ¡Objeto Token creado exitosamente!
  var token = Culqi.token.id;
  var email = Culqi.token.email;
  var data = { precio: precio, token: token, email: email };
  
  // Envía el token y el email al servidor con Ajax
  $.post('../../procesar-pago.php', data, function (res) {
    
    // Redirige a la URL de retorno después de un pago exitoso
    var url_retorno = '/Producto_QR/productoqr/view/Inicio/detalles_compra.php?monto=' + precio + '&Email=' + email + '&idUsuario=' + idUsuario;

    // Agrega la información del carrito a la URL
    url_retorno += '&carrito=' + encodeURIComponent(JSON.stringify(carrito));

    culqi_redirect(url_retorno);
  });
} else {
  console.log(Culqi.error);
  alert(Culqi.error.user_message);
}
}
