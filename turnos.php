<?php

/**
 * Archivo del plugin 
 * Este archivo es leído por WordPress para generar la información del plugin
 * en el área de administración del complemento. Este archivo también incluye 
 * todas las dependencias utilizadas por el complemento, registra las funciones 
 * de activación y desactivación y define una función que inicia el complemento.
 *
 * @link                https://www.grupounisono.es/
 * @since               1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:         Turnos
 * Plugin URI:          https://www.grupounisono.es/
 * Description:         Plugin Libre
 * Version:             1.7
 * Author:              Alejandro Carvajal
 * Author URI:          https://www.grupounisono.es/
 * License:             GPL2
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         https://www.grupounisono.es/
 * Domain Path:         /languages
 */
define('RAI_RUTA_TURNOS', plugin_dir_path(__FILE__));
global $wpdb;

function ActivarTurnos() {
    global $wpdb;
    include(RAI_RUTA_TURNOS . 'bd_turnos.php');
}

function DesactivarTurnos() {
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'ActivarTurnos');
register_deactivation_hook(__FILE__, 'DesactivarTurnos');
add_action('admin_menu', 'CrearMenuTurnos');

function CrearMenuTurnos() {

    add_menu_page('Turnos Mandos Chile ', 'Turnos Mando Chile', 'manage_options', RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMando/bandejaTurnosMando.php'
    );
    add_submenu_page(RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMando/bandejaTurnosMando.php', 'Turnos Agente Chile', 'Turnos Agente Chile', 'manage_options', RAI_RUTA_TURNOS . '/modulos/bandejaTurnosChile/bandejaTurnosChile.php');
    add_submenu_page(RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMando/bandejaTurnosMando.php', 'Turnos Agente', 'Turnos Agente', 'manage_options', RAI_RUTA_TURNOS . '/modulos/bandejaTurnos/bandejaTurnos.php');
    add_submenu_page(RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMando/bandejaTurnosMando.php', 'Turnos Mando Madrid', 'Turnos Mando Madrid', 'manage_options', RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMandoEspana/bandejaTurnosMandoEspana.php');
    add_submenu_page(RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMando/bandejaTurnosMando.php', 'Turnos Mando Vigo', 'Turnos Mando Vigo', 'manage_options', RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMandoVigo/bandejaTurnosMandoVigo.php');
    add_submenu_page(RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMando/bandejaTurnosMando.php', 'Turnos Mando Valencia', 'Turnos Mando Valencia', 'manage_options', RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMandoValencia/bandejaTurnosMandoValencia.php');
    add_submenu_page(RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMando/bandejaTurnosMando.php', 'Cargue Masivo Turnos Chile', 'Cargue Masivo Turnos Chile', 'manage_options', RAI_RUTA_TURNOS . '/modulos/cargueMasivoTurnosChile/cargueMasivoTurnosChile.php');
    add_submenu_page(RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMando/bandejaTurnosMando.php', 'Cargue Masivo Turnos Madrid', 'Cargue Masivo Turnos Madrid', 'manage_options', RAI_RUTA_TURNOS . '/modulos/cargueMasivoTurnos/cargueMasivoTurnos.php');
    add_submenu_page(RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMando/bandejaTurnosMando.php', 'Cargue Masivo Turnos Vigo', 'Cargue Masivo Turnos Vigo', 'manage_options', RAI_RUTA_TURNOS . '/modulos/cargueMasivoTurnosVigo/cargueMasivoTurnosVigo.php');
    add_submenu_page(RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMando/bandejaTurnosMando.php', 'Cargue Masivo Turnos Valencia', 'Cargue Masivo Turnos Valencia', 'manage_options', RAI_RUTA_TURNOS . '/modulos/cargueMasivoTurnosValencia/cargueMasivoTurnosValencia.php');
}

function MostrarContenidoTurnos() {
    return "<h1>Contenido de la pagina</h1>";
}

function imprimirshortcodeTurnosAgenteTodos() {

    include(RAI_RUTA_TURNOS . '/modulos/bandejaTurnos/bandejaTurnos.php');
}

function imprimirshortcodeTurnosMandoChile() {

    include(RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMando/bandejaTurnosMando.php');
}

function imprimirshortcodeTurnosAgenteChile() {

    include(RAI_RUTA_TURNOS . '/modulos/bandejaTurnosChile/bandejaTurnosChile.php');
}

function imprimirshortcodeTurnosMandoValencia() {

    include(RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMandoValencia/bandejaTurnosMandoValencia.php');
}

function imprimirshortcodeTurnosMandoVigo() {

    include(RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMandoVigo/bandejaTurnosMandoVigo.php');
}

function imprimirshortcodeTurnosMandoMadrid() {

    include(RAI_RUTA_TURNOS . '/modulos/bandejaTurnosMandoEspana/bandejaTurnosMandoEspana.php');
}

add_shortcode("TurnosGeneral", "imprimirshortcodeTurnosAgenteTodos");
add_shortcode("TurnosMC", "imprimirshortcodeTurnosMandoChile");
add_shortcode("TurnosAC", "imprimirshortcodeTurnosAgenteChile");
add_shortcode("TurnosMVa", "imprimirshortcodeTurnosMandoValencia");
add_shortcode("TurnosMVi", "imprimirshortcodeTurnosMandoVigo");
add_shortcode("TurnosMma", "imprimirshortcodeTurnosMandoMadrid");



if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) {
    exit();
//eliminar base de datos
    global $wpdb;
//Borrar tabla de mysql

    delete_option('imacPrestashop_options');
}
?>