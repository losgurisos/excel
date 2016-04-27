<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://lospibesnotienenpagina.com
 * @since             1.0.0
 * @package           Parse_Excel
 *
 * @wordpress-plugin
 * Plugin Name:       Parse Excel
 * Plugin URI:        http://www.notenemospaginadelplugin.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Andrés
 * Author URI:        http://lospibesnotienenpagina.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       parse-excel
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-parse-excel-activator.php
 */
function activate_parse_excel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-parse-excel-activator.php';
	Parse_Excel_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-parse-excel-deactivator.php
 */
function deactivate_parse_excel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-parse-excel-deactivator.php';
	Parse_Excel_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_parse_excel' );
register_deactivation_hook( __FILE__, 'deactivate_parse_excel' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-parse-excel.php';

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
        'Parse Excel', //page title
        'Parse Excel', //menu title
        'edit_pages', //capabilities
        'parse_excel', //menu slug
        'load_from_excel' //function
    );


    // add
    /*add_submenu_page(
        'parse_excel', //parent slug
        'Cargar Excel', //page title
        'Cargar desde excel', //menu title
        'edit_pages', //capability
        'centros_item_create', //menu slug
        'centros_item_create' //function
    );*/


}
require_once('load-from-excel.php');
//require_once('centros-update-item.php');
//require_once('centros-list-items.php');
//require_once('includes/helpers.php');

add_action('admin_menu','parse_excel_menu');

add_shortcode( 'ParseExcel', 'parse_excel_shortcode' );
function parse_excel_shortcode( $atts )
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
