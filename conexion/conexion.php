<?php

require_once(ABSPATH . 'wp-config.php');
$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysqli_select_db($conexion, DB_NAME);
?>