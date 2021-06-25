<?php

include_once '../../../../../../wp-config.php';
include_once '../../../../../../wp-load.php';
include_once '../../../../../../wp-includes/wp-db.php';
include_once '../../../../../../wp-includes/pluggable.php';

include('../../../conexion/conexion.php');
global $wpdb;
$request = $_POST['request'];

if ($request == 2) {

    $deleteids_arr = $_POST['deleteids_arr'];

    foreach ($deleteids_arr as $deleteid) {
        mysqli_query($conexion, "DELETE FROM {$wpdb->prefix}co_turnos WHERE id_turnos=" . $deleteid);
    }

    echo 1;
    exit;
}