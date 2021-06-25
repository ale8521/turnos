<?php

//if(!define('WP_UNINSTALL_PLUGIN')){
//    die();
//}
//eliminar base de datos
global $wpdb;
//Borrar tabla de mysql
$co_sur_asis_region = $wpdb->prefix . 'co_sur_asis_region';
$wpdb->query("DROP TABLE $co_sur_asis_region");



delete_option('imacPrestashop_options');


if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) {


    exit();
}