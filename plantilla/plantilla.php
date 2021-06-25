<?php
define('RAI_RUTA_TURNOS', plugin_dir_path(__FILE__));
include(RAI_RUTA_TURNOS . 'conexion/conexion.php');
global $wpdb;
$user_info = get_userdata(1);

if (is_user_logged_in()) {
    $cu = wp_get_current_user();
}
$user_general = $cu->user_login;
$user_general;
$permisos = implode(', ', $cu->roles);
$permisos;
global $wpdb;
?>

<html>
    <head>
        <meta charset="UTF-8">   
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <title>Turnos</title>
        <link rel="stylesheet" href="../wp-content/plugins/turnos/librerias/assets/vendors/choices.js/choices.min.css" />

        <link rel="stylesheet" href="../wp-content/plugins/turnos/librerias/assets/fonts.css"  type="text/css"/>
        <link rel="stylesheet" href="../wp-content/plugins/turnos/librerias/assets/css/bootstrap.css">
        <link rel="stylesheet" href="../wp-content/plugins/turnos/librerias/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
        <link rel="stylesheet" href="../wp-content/plugins/turnos/librerias/assets/vendors/bootstrap-icons/bootstrap-icons.css">
        <link rel="stylesheet" href="../wp-content/plugins/turnos/librerias/assets/css/app.css">
        <link rel="stylesheet" href="../wp-content/plugins/turnos/librerias/assets/vendors/datable/datatables.css"  type="text/css"/>
        <link rel="stylesheet" href="../wp-content/plugins/turnos/librerias/assets/css/style.css"  type="text/css"/>
        <link rel="stylesheet" href="../wp-content/plugins/turnos/librerias/assets/sweetalert/dist/sweetalert2.min.css"  type="text/css"/>

    </head>
    <body>

    </body>  
    <script src="../wp-content/plugins/turnos/librerias/assets/jq/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../wp-content/plugins/turnos/librerias/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../wp-content/plugins/turnos/librerias/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../wp-content/plugins/turnos/librerias/assets/js/main.js"></script>
    <script src="../wp-content/plugins/turnos/librerias/assets/vendors/choices.js/choices.min.js"></script>
    <script src="../wp-content/plugins/turnos/librerias/funcionesJs/funcionesTurnos.js" type="text/javascript"></script>
    <script src="../wp-content/plugins/turnos/librerias/funcionesJs/validar.js" type="text/javascript"></script>
    <script src="../wp-content/plugins/turnos/librerias/assets/sweetalert/dist/sweetalert2.all.js" type="text/javascript"></script>
    <script src="../wp-content/plugins/turnos/librerias/assets/sweetalert/dist/sweetalert2.all.min.js" type="text/javascript"></script>
   
    <script src="../wp-content/plugins/turnos/librerias/assets/vendors/datable/datatables.min.js" type="text/javascript"></script>
    <script src="../wp-content/plugins/turnos/librerias/assets/vendors/datable/Buttons-1.7.1/js/buttons.print.js" type="text/javascript"></script>
    <script src="../wp-content/plugins/turnos/librerias/assets/vendors/datable/JSZip-2.5.0/jszip.min.js" type="text/javascript"></script>
    <script src="../wp-content/plugins/turnos/librerias/assets/vendors/datable/Buttons-1.7.1/js/buttons.html5.min.js" type="text/javascript"></script>
</html>
