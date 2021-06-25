<?php

include_once '../../../../../../wp-config.php';
include_once '../../../../../../wp-load.php';
include_once '../../../../../../wp-includes/wp-db.php';
include_once '../../../../../../wp-includes/pluggable.php';

include('../../../conexion/conexion.php');
global $wpdb;

//define index of column
$columns = array(
    0 => 'numeroEmpleado',
    1 => 'nombre',
    2 => 'apellido',
    3 => 'horaDesde',
    4 => 'horaHastas',
    5 => 'duracionTurno',
    6 => 'codigo',
    7 => 'campania',
    8 => 'servicio',
    9 => 'centro',
    10 => 'semanal',
    11 => 'descanso20',
    12 => 'descanso30',
    13 => 'descanso10',
    14 => 'pausa1',
    15 => 'pausa2',
    16 => 'pausa3',
    17 => 'pausa4',
    18 => 'pausa5',
    19 => 'pausa6',
    20 => 'pausa7',
    21 => 'pausa8',
    22 => 'obra'
);
$error = true;
$colVal = '';
$colIndex = $rowId = 0;


if (isset($_POST)) {

    $colIndex = $_POST['index'];
    $colVal = $_POST['val'];
    $rowId = $_POST['id'];





    $sql = "UPDATE `{$wpdb->prefix}co_turnos`  SET  $columns[$colIndex]  = '" . $colVal . "' WHERE id_turnos='" . $rowId . "'";

    if ($conexion->query($sql) === TRUE) {
        echo 1;
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
} 