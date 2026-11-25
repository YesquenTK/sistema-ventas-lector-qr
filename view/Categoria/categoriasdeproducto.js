var tabla;

function init() {
    $("#producto_form_cat").on("submit", function (e) {
        guardaryeditar(e);
    });
}

function limpiarFormulario() {
    $('#cat_id').val('');
    $('#cat_nom').val('');
    $('#cat_des').val('');
}

$(document).ready(function () {

    $.post("../../controller/categoriacontrolador.php?op=listar", function (data) {

    });

    tabla = $('#producto_data_cat').dataTable({
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
            url: '../../controller/categoriacontrolador.php?op=listar',
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
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando un total de 0 registros",
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
    });

});

function guardaryeditar(e) {
    e.preventDefault();

    var formData = new FormData($("#producto_form_cat")[0]);

    $.ajax({
        url: "../../controller/categoriacontrolador.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            if (datos) {
                console.log("Respuesta del servidor:", datos);
            } else {
                console.log("La variable datos está vacía o nula.");
            }

            limpiarFormulario();
            $('#modalcategoria').modal('hide');
            $('#producto_data_cat').DataTable().ajax.reload();

            swal.fire(
                'Registro',
                'Se registró correctamente.',
                'success'
            );
        },
    });
}

function editar(cat_id) {
    console.log(cat_id);
    $('#mdltitulo_cat').html('Editar Registro');

    $.post("../../controller/categoriacontrolador.php?op=mostrar", { cat_id: cat_id }, function (data) {
        data = JSON.parse(data);
        $('#cat_id').val(data.cat_id);
        $('#cat_nom').val(data.cat_nom);
        $('#cat_des').val(data.cat_des);
        console.log(data);
    });

    $('#modalcategoria').modal('show');
}

function eliminar(cat_id) {
    swal.fire({
        title: "CRUD",
        text: "¿Desea eliminar el registro?",
        icon: "error",
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../../controller/categoriacontrolador.php?op=eliminar", { cat_id: cat_id }, function (data) {
                $('#producto_data_cat').DataTable().ajax.reload();
            });

            swal.fire(
                'Eliminado',
                'El registro se eliminó correctamente.',
                'success'
            );
        }
    });
}

$(document).on("click", "#btnnuevo_cat", function () {
    $('#mdltitulo_cat').html('Nueva categoría');
    limpiarFormulario();
    $('#modalcategoria').modal('show');
});

init();
