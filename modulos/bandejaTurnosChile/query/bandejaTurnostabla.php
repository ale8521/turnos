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
$semanaAnio = $_SESSION['semanaAnio'];
unset($_SESSION['semanaAnio']);
$consulta = "SELECT      *,
     DATE_FORMAT(fechaDia, '%d/%m/%Y') as fechaDia2,
    DATE_FORMAT(fechaCreacion, '%d/%m/%Y') as fechaCreacion2
    FROM 
        {$wpdb->prefix}co_turnos
        where  numeroEmpleado = '$user_general' and  semanaAnio = '$semanaAnio' AND lugar = 'CHILE' order by fechaDia";
$resultado = $conexion->query($consulta);
?>
<div class="table-responsive">
    <table id="listarTurnosTable" class="table table-striped" style="font-size: 10px">
        <thead>
            <tr>
                <th>Dni</th>
                <th>Dia</th>
                <th>Dia Semana</th>
                <th>Hora inicio</th>
                <th>Hora fin</th>
                <th>Duracion</th>
                <th>Codigo</th>
                <th>Campa&ntilde;a</th>
                <th>Centro</th>
                <th>Fecha creacion</th>
            </tr>                 
        </thead>
        <tbody>
            <?php
            while ($activos = mysqli_fetch_array($resultado)) {
                ?>
                <tr>
                    <td style='text-align: center'><?php echo $activos['rut'] ?></td>
                    <td style='text-align: center'><?php echo $activos['fechaDia2'] ?></td>
                    <td style='text-align: center'><?php echo $activos['dia'] ?></td>
                    <td style='text-align: center'><?php echo $activos['horaDesde'] ?></td>
                    <td style='text-align: center'><?php echo $activos['horaHastas'] ?></td>
                    <td style='text-align: center'><?php echo $activos['duracionTurno'] ?></td>
                    <td style='text-align: center'><?php echo $activos['codigo'] ?></td>
                    <td style='text-align: center'><?php echo $activos['campania'] ?></td>
                    <td style='text-align: center'><?php echo $activos['centro'] ?></td>
                    <td style='text-align: center'><?php echo $activos['fechaCreacion2'] ?></td>
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
    (function ($) {
        "use strict";
        $(document).ready(function () {
            $('#listarTurnosTable').dataTable({
                scrollY: false,
                scrollX: false,
                "ordering": false,
                "autoWidth": false,
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
        });

    })(jQuery);


</script>