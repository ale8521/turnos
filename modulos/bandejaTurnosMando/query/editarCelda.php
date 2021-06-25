<?php

include_once '../../../../../../wp-config.php';
include_once '../../../../../../wp-load.php';
include_once '../../../../../../wp-includes/wp-db.php';
include_once '../../../../../../wp-includes/pluggable.php';

include('../../../conexion/conexion.php');
global $wpdb;

//define index of column
$columns = array(
    0 => 'rut',
    1 => 'numeroEmpleado',
    2 => 'nombre',
    3 => 'apellido',
    4 => 'horaDesde',
    5 => 'horaHastas',
    6 => 'duracionTurno',
    7 => 'codigo',
    8 => 'campania',
    9 => 'centro',
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