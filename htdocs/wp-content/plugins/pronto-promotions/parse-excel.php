<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              
 * @since             1.0.0
 * @package           parse-excel
 *
 * @wordpress-plugin
 * Plugin Name:       Parse Excel
 * Plugin URI:        
 * Description:       Parse data from .xls
 * Version:           1.0.0
 * Author:            Andrés Peña
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       Parse_Excel
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * The code that runs during plugin activation.
 */
function activate_parse_excel() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-parse-excel-activator.php';
    Parse_Excel_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_parse_excel() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-parse-excel-deactivator.php';
    Parse_Excel_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_parse_excel' );
register_deactivation_hook( __FILE__, 'deactivate_parse_excel' );


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_parse_excel() {

    $plugin = new Parse_Excel();
    $plugin->run();

}
//menu items
function parse_excel_menu() {

    // Main Menu
    add_menu_page(
        'Centros Acopio', //page title
        'Centros Acopio', //menu title
        'edit_pages', //capabilities
        'centros_main', //menu slug
        'centros_item_create' //function
    );


    // add
    add_submenu_page(
        'centros_main', //parent slug
        'Agregar centro', //page title
        'Agregar centro', //menu title
        'edit_pages', //capability
        'centros_item_create', //menu slug
        'centros_item_create' //function
    );

    // list
    add_submenu_page(
        'centros_main', //parent slug
        'Listar centros', //page title
        'Listar centros', //menu title
        'edit_pages', //capability
        'centros_list_items', //menu slug
        'centros_list_items' //function
    );

    // update
    add_submenu_page(
        '', //parent slug
        'Actualizar centro', //page title
        'Actualizar centro', //menu title
        'edit_pages', //capability
        'centros_update_item', //menu slug
        'centros_update_item' //function
    );

}
//require_once('centros-add-item.php');
//require_once('centros-update-item.php');
//require_once('centros-list-items.php');
//require_once('includes/helpers.php');

add_action('admin_menu','parse_excel_menu');

add_shortcode( 'ParseExcel', 'parseExcel_shortcode' );
function centrosAcopio_shortcode( $atts )
{
    return parseExcelLogic( $atts );
}

// THE LOGIC
function parseExcelLogic( $atts )
{

    return 'hola';
}
// WIDGET
//require_once( dirname(__FILE__) . "/widget.php");


run_parse_excel();

?>