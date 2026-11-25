var tabla;
let arrayImages = [];
let arrayImagesqr = [];

let myDropzone = new Dropzone('.dropzone', {
    url: '../../assets/img',
    maxFilesize: 20,
    maxFile: 1,
    acceptedFiles: 'image/jpg, image/png',
    addRemoveLinks: true,
    dictRemoveFile: 'quitar'
});

myDropzone.on('addedfile', file => {
    arrayImages.push(file);
    console.log(arrayImages);
});

myDropzone.on('removedfile', file => {
    let i = arrayImages.indexOf(file);
    arrayImages.splice(i, 1);
    console.log(arrayImages);
});

let myDropzoneQR = new Dropzone('#dropzoneQR', {
    url: '../../controller/productocontrolador.php?op=guardaryeditar',
    maxFilesize: 20,
    maxFiles: 2,
    acceptedFiles: 'image/jpg, image/png',
    addRemoveLinks: true,
    dictRemoveFile: 'quitar'
});

myDropzoneQR.on('addedfile', file => {
    arrayImagesqr.push(file);
    console.log(arrayImagesqr);
});

myDropzoneQR.on('removedfile', file => {
    let i = arrayImagesqr.indexOf(file);
    arrayImagesqr.splice(i, 1);
    console.log(arrayImagesqr);
});

function init() {
    // Limpiar arrays y reiniciar Dropzones al abrir el modal
    arrayImages = [];
    arrayImagesqr = [];
    myDropzone.removeAllFiles();
    myDropzoneQR.removeAllFiles();

    $("#producto_form").on("submit", function (e) {
        guardaryeditar(e);
    });
}




$(document).ready(function () {


    $.post("../../controller/categoriacontrolador.php?op=combo", function (data) {
        $("#cat_id").html(data);
    });

    tabla = $('#producto_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'copyHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../../controller/productocontrolador.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]],
        "language": {
            "sProcessing": "Procesando....",
            "sLengthMenu": "Monstrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty": "Monstrando un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousand": ",",
            "sLoadingRecords": "Cargando....",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior",
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendete",
                "sSortDescending": ": Activar para ordenar la columna de manera descendete",
            }
        }
    }).dataTable();

});

function guardaryeditar(e) {
    e.preventDefault();

    var formData = new FormData($("#producto_form")[0]);
    var totalFiles = arrayImages.length;

    for (var i = 0; i < totalFiles; i++) {
        formData.append("file[]", arrayImages[i]);
    }

    var totalFilesQR = arrayImagesqr.length;
    for (var i = 0; i < totalFilesQR; i++) {
        formData.append("fileqr[]", arrayImagesqr[i]);
    }

    $.ajax({
        url: "../../controller/productocontrolador.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            // Limpiar form y reiniciar Dropzones después de agregar un nuevo registro
            $('#producto_form')[0].reset();
            myDropzone.removeAllFiles();
            myDropzoneQR.removeAllFiles();

            $('#modalmantenimiento').modal('hide');
            $('#producto_data').DataTable().ajax.reload();

            swal.fire(
                'Registro',
                'Se registró correctamente.',
                'success'
            );
        },
    });
}


function editar(id) {
    $('#mdltitulo').html('Editar Registro');

    myDropzone.removeAllFiles();
    myDropzoneQR.removeAllFiles();

    $.post("../../controller/productocontrolador.php?op=mostrar", { id: id }, function (data) {
        data = JSON.parse(data);
        $('#id').val(data.id);
        $('#codigo').val(data.codigo);
        $('#cat_id').val(data.cat_id).trigger('change');
        $('#producto').val(data.producto);
        $('#precio').val(data.precio);
        $('#prod_cant').val(data.prod_cant);

        myDropzone.removeAllFiles();
        myDropzoneQR.removeAllFiles();

        if (data.imagen !== null) {
            $('#producto_imagen').attr('src', '../../assets/img/' + data.imagen);
        }
        $('#producto_imagen').attr('alt', data.imagen || '');

        if (data.imagen !== null) {
            var existingImage = { name: data.imagen, size: 12345 };

            myDropzone.files.push(existingImage);

            myDropzone.createThumbnailFromUrl(existingImage, myDropzone.options.thumbnailWidth, myDropzone.options.thumbnailHeight,
                myDropzone.options.thumbnailMethod, true, function (thumbnail) {
                    myDropzone.emit('thumbnail', existingImage, thumbnail);
                    myDropzone.emit('complete', existingImage);
                });

            if (existingImage.previewElement) {
                existingImage.previewElement.classList.add('dz-success');
                existingImage.previewElement.classList.add('dz-complete');
            }
        }

        if (data.QR !== null) {
            $('#producto_qr').attr('src', '../../assets/QRS/' + data.QR);
        }
        $('#producto_qr').attr('alt', data.QR || '');

        if (data.QR !== null) {
            var existingQRImage = { name: data.QR, size: 12345 };

            myDropzoneQR.files.push(existingQRImage);

            myDropzoneQR.createThumbnailFromUrl(existingQRImage, myDropzoneQR.options.thumbnailWidth, myDropzoneQR.options.thumbnailHeight,
                myDropzoneQR.options.thumbnailMethod, true, function (thumbnail) {
                    myDropzoneQR.emit('thumbnail', existingQRImage, thumbnail);
                    myDropzoneQR.emit('complete', existingQRImage);
                });

            if (existingQRImage.previewElement) {
                existingQRImage.previewElement.classList.add('dz-success');
                existingQRImage.previewElement.classList.add('dz-complete');
            }
        }
    });

    $('#modalmantenimiento').modal('show');
}


function eliminar(id) {
    swal.fire({
        title: "CRUD",
        text: "Desea eliminar el registro?",
        icon: "error",
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true

    }).then((result) => {
        if (result.isConfirmed) {

            $.post("../../controller/productocontrolador.php?op=eliminar", { id: id }, function (data) {
                $('#producto_data').DataTable().ajax.reload();
            });

            $('#producto_data').DataTable().ajax.reload();

            swal.fire(
                'Eliminado  !',
                'El registro se elimino correctamente.',
                'success'
            )
        }
    }
    )
}


function limpiarVistaPreviaImagen() {
    $('#producto_imagen').attr('src', ''); 
    $('#producto_imagen').attr('alt', ''); 
    myDropzone.removeAllFiles(); 
}

function limpiarVistaPreviaQR() {
    $('#producto_qr').attr('src', ''); 
    $('#producto_qr').attr('alt', ''); 
    myDropzoneQR.removeAllFiles(); 
}

$(document).on("click", "#btnnuevo", function () {
    $('#id').val('');
    $('#cat_id').val('').trigger('change');
    $('#codigo').val('');
    $('#producto').val('');
    $('#precio').val('');
    $('#prod_cant').val('');
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalmantenimiento').modal('show');
    limpiarVistaPreviaImagen(); 
    limpiarVistaPreviaQR(); 
});



init();

