
$(document).ready(function () {
    $("#semanaAnio").change(function () {
        var value = $(this).val();
        $("#semanaAnio1").val(value);
    });
});


(function ($) {
    "use strict";
    $(document).ready(function () {
        $('#turnos').DataTable({
            scrollY: false,
            scrollX: true,
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningun dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Ultimo",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortA v  scending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDesce nding": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    });
})(jQuery);


///*///////////////////////////////////////////////////////////////*/
///*-----------------Turnos Chile------------------*/
///*///////////////////////////////////////////////////////////////*/
$(document).ready(function () {
    // Check all 
    $('#checkall').click(function () {
        if ($(this).is(':checked')) {
            $('.delete_check').prop('checked', true);
        } else {
            $('.delete_check').prop('checked', false);
        }
    });
    // Delete record
    $('#delete_record').click(function () {

        var deleteids_arr = [];
        // Read all checked checkboxes
        $("input:checkbox[class=delete_check]:checked").each(function () {
            deleteids_arr.push($(this).val());
        });
        // Check checkbox checked or not
        if (deleteids_arr.length > 0) {
            // Confirm alert
            var confirmdelete = confirm("Realmente quieres eliminar registros?");
            if (confirmdelete === true) {
                $.ajax({
                    type: 'POST',
                    url: '../wp-content/plugins/turnos/modulos/bandejaTurnosMandoEspana/query/eliminar.php',

                    data: {"request": "2", "deleteids_arr": deleteids_arr},
                    success: function (respuesta) {

                        if (respuesta === "1") {
                            swal({
                                title: "¡Error!",
                                text: respuesta,
                                icon: "error",
                                timer: 3000000
                            });
                        } else {
                            swal({
                                title: "¡Error!",
                                text: respuesta,
                                icon: "error",
                                timer: 3000000
                            });
                        }
                    }

                });
            }
        }
    });
});

function buscarChile()
{
    var semanaAnio = $("#semanaAnio").val();
    $.ajax({
        type: "POST",
        url: "../wp-content/plugins/turnos/modulos/bandejaTurnosChile/query/consultaVariable.php",
        data: {"semanaAnio": semanaAnio}
    }).done(function (respuesta) {
        $("#tablaChile").load('../wp-content/plugins/turnos/modulos/bandejaTurnosChile/query/bandejaTurnostabla.php');
    });
}


function buscarEspa()
{
    var semanaAnio = document.getElementById('semanaAnio').value;

    if (semanaAnio === null || semanaAnio.length === 0 || /^\s+$/.test(semanaAnio))
    {
        $('#reSemanaAnio').html('El campo es obligatorio');
        $('#semanaAnio').css('border-bottom', '1px solid red');
        document.getElementById("semanaAnio").focus();
        return false;
    } else {
        $('#reSemanaAnio').html(' ');
        $('#semanaAnio').css('border-bottom', '1px solid #ccc');
    }
    $.ajax({
        type: "POST",
        url: "../wp-content/plugins/turnos/modulos/bandejaTurnos/query/consultaVariable.php",
        data: {"semanaAnio": semanaAnio}
    }).done(function (respuesta) {
        $("#tablaEspania").load('../wp-content/plugins/turnos/modulos/bandejaTurnos/query/bandejaTurnosTablaEp.php');
    });
}



function buscarMando()
{
    var semanaAnio = $("#semanaAnio").val();
    $.ajax({
        type: "POST",
        url: "../wp-content/plugins/turnos/modulos/bandejaTurnosMando/query/consultaVariable.php",
        data: {"semanaAnio": semanaAnio}
    }).done(function (respuesta) {
        $("#tablaMando").load('../wp-content/plugins/turnos/modulos/bandejaTurnosMando/query/bandejaTurnosTablaM.php');
    });
}




function buscarMandoEp()
{
    var semanaAnio = $("#semanaAnio").val();
    $.ajax({
        type: "POST",
        url: "../wp-content/plugins/turnos/modulos/bandejaTurnosMandoEspana/query/consultaVariable.php",
        data: {"semanaAnio": semanaAnio}
    }).done(function (respuesta) {
        $("#tablaMandoEp").load('../wp-content/plugins/turnos/modulos/bandejaTurnosMandoEspana/query/bandejaTurnosTablaM.php');
    });
}

function LimpiarEspaMan()
{
    document.getElementById('semanaAnio').value = "";
    var semanaAnio = $("#semanaAnio").val();
    $.ajax({
        type: "POST",
        url: "../wp-content/plugins/turnos/modulos/bandejaTurnosMandoEspana/query/consultaVariable.php",
        data: {"semanaAnio": semanaAnio}
    }).done(function (respuesta) {
        $("#tablaMandoEp").load('../wp-content/plugins/turnos/modulos/bandejaTurnosMandoEspana/query/bandejaTurnosTablaM.php');

    });
}

function LimpiarEspa()
{
    document.getElementById('semanaAnio').value = "";
    var semanaAnio = document.getElementById('semanaAnio').value;

    $.ajax({
        type: "POST",
        url: "../wp-content/plugins/turnos/modulos/bandejaTurnos/query/consultaVariable.php",
        data: {"semanaAnio": semanaAnio}
    }).done(function (respuesta) {
        $("#tablaEspania").load('../wp-content/plugins/turnos/modulos/bandejaTurnos/query/bandejaTurnosTablaEp.php');
    });

}
function LimpiarChile()
{
    document.getElementById('semanaAnio').value = "";
    var semanaAnio = $("#semanaAnio").val();
    $.ajax({
        type: "POST",
        url: "../wp-content/plugins/turnos/modulos/bandejaTurnosChile/query/consultaVariable.php",
        data: {"semanaAnio": semanaAnio}
    }).done(function (respuesta) {
        $("#tablaChile").load('../wp-content/plugins/turnos/modulos/bandejaTurnosChile/query/bandejaTurnostabla.php');
    });

}

function LimpiarMando()
{
    document.getElementById('semanaAnio').value = "";
    var semanaAnio = $("#semanaAnio").val();
    $.ajax({
        type: "POST",
        url: "../wp-content/plugins/turnos/modulos/bandejaTurnosMando/query/consultaVariable.php",
        data: {"semanaAnio": semanaAnio}
    }).done(function (respuesta) {
        $("#tablaMando").load('../wp-content/plugins/turnos/modulos/bandejaTurnosMando/query/bandejaTurnosTablaM.php');
    });
}



function cargueMes()
{
    var semanaAnio = $("#semanaAnio").val();
    if (semanaAnio !== "") {
        $('#fake-file-button-browse').removeAttr("disabled");//habilita boton
    } else {
        $("#fake-file-button-browse").prop("disabled", "disabled");

    }
}



function buscarVigo() {

//    $(".loader-page").css({display: "block", opacity: "9"})
    var semanaAnio = document.getElementById('semanaAnio').value;

    if (semanaAnio === null || semanaAnio.length === 0 || /^\s+$/.test(semanaAnio))
    {
        $('#reSemanaAnio').html('El campo es obligatorio');
        $('#semanaAnio').css('border-bottom', '1px solid red');
        return false;
    } else {
        $('#reSemanaAnio').html(' ');
        $('#semanaAnio').css('border-bottom', '1px solid #ccc');
    }


    $.ajax({
        type: "POST",
        url: "../wp-content/plugins/turnos/modulos/bandejaTurnosMandoVigo/query/mandoVigo.php",
        data: ("semanaAnio=" + semanaAnio),
        success: function (respuesta)
        {
            $("#tablaVigo").html(respuesta);
        }
    });
}


function LimpiarVigo()
{
    document.getElementById('semanaAnio').value = "";
    var semanaAnio = $("#semanaAnio").val();
    $.ajax({
        type: "POST",
        url: "../wp-content/plugins/turnos/modulos/bandejaTurnosMandoVigo/query/mandoVigo.php",
        data: {"semanaAnio": semanaAnio}
    }).done(function (respuesta) {
        $("#tablaVigo").html(respuesta);

    });
}



function buscarValencia() {

//    $(".loader-page").css({display: "block", opacity: "9"})
    var semanaAnio = document.getElementById('semanaAnio').value;

    if (semanaAnio === null || semanaAnio.length === 0 || /^\s+$/.test(semanaAnio))
    {
        $('#reSemanaAnio').html('El campo es obligatorio');
        $('#semanaAnio').css('border-bottom', '1px solid red');
        return false;
    } else {
        $('#reSemanaAnio').html(' ');
        $('#semanaAnio').css('border-bottom', '1px solid #ccc');
    }


    $.ajax({
        type: "POST",
        url: "../wp-content/plugins/turnos/modulos/bandejaTurnosMandoValencia/query/mandoValencia.php",
        data: ("semanaAnio=" + semanaAnio),
        success: function (respuesta)
        {
            $("#tablaValencia").html(respuesta);
        }
    });
}


function LimpiarValencia()
{
    document.getElementById('semanaAnio').value = "";
    var semanaAnio = $("#semanaAnio").val();
    $.ajax({
        type: "POST",
        url: "../wp-content/plugins/turnos/modulos/bandejaTurnosMandoValencia/query/mandoValencia.php",
        data: {"semanaAnio": semanaAnio}
    }).done(function (respuesta) {
        $("#tablaValencia").html(respuesta);

    });
}