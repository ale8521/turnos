<?php
include_once '../../../../../../wp-config.php';
include_once '../../../../../../wp-load.php';
include_once '../../../../../../wp-includes/wp-db.php';
include_once '../../../../../../wp-includes/pluggable.php';

include('../../../conexion/conexion.php');
global $wpdb;
if (is_user_logged_in()) {
    $cu = wp_get_current_user();
}
$user_general = $cu->user_login;
$user_general;
$permisos = implode(', ', $cu->roles);
$permisos;

session_start();
$semanaAnio = $_POST['semanaAnio'];



$consulta = "SELECT      *,
     DATE_FORMAT(fechaDia, '%d/%m/%Y') as fechaDia2,
    DATE_FORMAT(fechaCreacion, '%d/%m/%Y') as fechaCreacion2
    FROM 
        {$wpdb->prefix}co_turnos 
        where semanaAnio = '$semanaAnio' AND lugar = 'VALENCIA' order by fechaDia";

$resultado = $conexion->query($consulta);
?>
<div class="table-responsive">
       <table id="listarTurnosMando" class="table table-striped" style="font-size: 10px">
        <thead>
            <tr>
                <th style="width:100px !important">
                    <div class="input-group"> <span class="input-group-addon"> 
                            <input type="checkbox" aria-label="Checkbox" class="checkall" id="checkall" style="margin-top: 13px"> </span> 
                        <button type="button" id="delete_record" class="btn btn-danger" style="border-radius: 5px">Borrar</button> 
                    </div>
                </th>
                <th>Dia</th>
                <th>Dia Semana</th>
                <th>N_Empleado</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Hora inicio</th>
                <th>Hora fin</th>
                <th>Duracion</th>
                <th>Codigo</th>
                <th>Campa&ntilde;a</th>
                <th>Servicio</th>
                <th>Centro</th>
                <th>Semanal</th>
                <th>Descanso 20</th>
                <th>Descanso 30</th>
                <th>Descanso 10</th>
                <th>Pausa 1</th>
                <th>Pausa 2</th>
                <th>Pausa 3</th>
                <th>Pausa 4</th>
                <th>Pausa 5</th>
                <th>Pausa 6</th>
                <th>Pausa 7</th>
                <th>Pausa 8</th>
                <th>Obra</th>
                <th>Fecha creacion</th>
            </tr>                 
        </thead>
        <tbody id="editable_table">
            <?php
            while ($activos = mysqli_fetch_array($resultado)) {
                ?>
                <tr data-row-id="<?php echo $activos['id_turnos']; ?>">
                    <td style='text-align: center'>
                        <input type='checkbox' class='delete_check' id='delcheck_<?php echo $activos['id_turnos'] ?>' onclick='checkcheckbox();' value='<?php echo $activos['id_turnos'] ?>'>
                    </td>
                    <td style='text-align: center'><?php echo $activos['fechaDia2'] ?></td>
                    <td  style='text-align: center'><?php echo $activos['dia'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='0' antiguo="<?php echo $activos['numeroEmpleado']; ?>" style='text-align: center'><?php echo $activos['numeroEmpleado'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='1' antiguo="<?php echo $activos['nombre']; ?>" style='text-align: center'><?php echo $activos['nombre'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='2' antiguo="<?php echo $activos['apellido']; ?>" style='text-align: center'><?php echo $activos['apellido'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='3' antiguo="<?php echo $activos['horaDesde']; ?>" style='text-align: center'><?php echo $activos['horaDesde'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='4' antiguo="<?php echo $activos['horaHastas']; ?>" style='text-align: center'><?php echo $activos['horaHastas'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='5' antiguo="<?php echo $activos['duracionTurno']; ?>" style='text-align: center'><?php echo $activos['duracionTurno'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='6' antiguo="<?php echo $activos['codigo']; ?>" style='text-align: center'><?php echo $activos['codigo'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='7' antiguo="<?php echo $activos['campania']; ?>" style='text-align: center'><?php echo $activos['campania'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='8' antiguo="<?php echo $activos['servicio']; ?>" style='text-align: center'><?php echo $activos['servicio'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='9' antiguo="<?php echo $activos['centro']; ?>" style='text-align: center'><?php echo $activos['centro'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='10' antiguo="<?php echo $activos['semanal']; ?>" style='text-align: center'><?php echo $activos['semanal'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='11' antiguo="<?php echo $activos['descanso20']; ?>" style='text-align: center'><?php echo $activos['descanso20'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='12' antiguo="<?php echo $activos['descanso30']; ?>" style='text-align: center'><?php echo $activos['descanso30'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='13' antiguo="<?php echo $activos['descanso10']; ?>" style='text-align: center'><?php echo $activos['descanso10'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='14' antiguo="<?php echo $activos['pausa1']; ?>" style='text-align: center'><?php echo $activos['pausa1'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='15' antiguo="<?php echo $activos['pausa2']; ?>" style='text-align: center'><?php echo $activos['pausa2'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='16' antiguo="<?php echo $activos['pausa3']; ?>" style='text-align: center'><?php echo $activos['pausa3'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='17' antiguo="<?php echo $activos['pausa4']; ?>" style='text-align: center'><?php echo $activos['pausa4'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='18' antiguo="<?php echo $activos['pausa5']; ?>" style='text-align: center'><?php echo $activos['pausa5'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='19' antiguo="<?php echo $activos['pausa6']; ?>" style='text-align: center'><?php echo $activos['pausa6'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='20' antiguo="<?php echo $activos['pausa7']; ?>" style='text-align: center'><?php echo $activos['pausa7'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='21' antiguo="<?php echo $activos['pausa8']; ?>" style='text-align: center'><?php echo $activos['pausa8'] ?></td>
                    <td   class="editable-col" contenteditable="true" ubi='22' antiguo="<?php echo $activos['obra']; ?>" style='text-align: center'><?php echo $activos['obra'] ?></td>
                    <td   class="editable-col" contenteditable="true" style='text-align: center'><?php echo $activos['fechaCreacion2'] ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr>

            </tr>
        </tfoot>
    </table>
</div>    
<script type="text/javascript">
    $(document).ready(function () {
        $('td.editable-col').on('focusout', function () {
            var val = $(this).text();
            var id = $(this).parent('tr').attr('data-row-id');
            var index = $(this).attr('ubi');
            if ($(this).attr('antiguo') === val) {
                return false;
            }
            $.ajax({
                type: "POST",
                url: "../wp-content/plugins/turnos/modulos/bandejaTurnosMandoValencia/query/editarCelda.php",
                cache: false,
                data: {"val": val, "id": id, "index": index},
                success: function (response)
                {
                    if (response === "1") {
                        Swal.fire({
                            title: "Actualizacion exitosa",
                            icon: "success",
                            timer: 6000000
                        });
                        return false;
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: response,
                            icon: "error",
                            timer: 6000000
                        });
                    }
                }
            });
        });
    });



    dataTable = $(document).ready(function () {
        $('#listarTurnosMando').dataTable({
     
            "ordering": false,
            "autoWidth": true,
            bInfo: true,
            lengthMenu: [[10, 50, 100, 200, -1], [10, 50, 100, 200, "TODOS"]],
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


                Swal.fire({
                    title: "Esta seguro de eliminar?",
                    text: "No podras recuperar esta informacion !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Eliminar",
                    cancelButtonText: "Cancelar",
                }).then(function (isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            url: '../wp-content/plugins/turnos/modulos/bandejaTurnosMandoValencia/query/eliminar.php',
                            type: 'POST',
                            data: {"request": "2", "deleteids_arr": deleteids_arr},
                            success: function (respuesta) {

                                if (respuesta === "1") {
                                    var semanaAnio = document.getElementById('semanaAnio').value;
                                    $.ajax({
                                        type: "POST",
                                        url: "../wp-content/plugins/turnos/modulos/bandejaTurnosMandoValencia/query/mandoVigo.php",
                                        data: ("semanaAnio=" + semanaAnio),
                                        success: function (respuesta)
                                        {
                                            $("#tablaVigo").html(respuesta);
                                        }
                                    });
                                    Swal.fire("Eliminado!", "La informacion ha sido eliminado.", "success");
                                } else {
                                    Swal.fire({
                                        title: "¡Error!",
                                        text: respuesta,
                                        icon: "error",
                                        timer: 3000000
                                    });
                                }
                            }
                        });
                    } else {
                        Swal.fire("Cancelled", "Accion cancelada", "error");
                    }
                });
            }
        });
    });
    // Checkbox checked
    function checkcheckbox() {

        // Total checkboxes
        var length = $('.delete_check').length;
        // Total checked checkboxes
        var totalchecked = 0;
        $('.delete_check').each(function () {
            if ($(this).is(':checked')) {
                totalchecked += 1;
            }
        });
        // Checked unchecked checkbox
        if (totalchecked === length) {
            $("#checkall").prop('checked', true);
        } else {
            $('#checkall').prop('checked', false);
        }
    }

</script>