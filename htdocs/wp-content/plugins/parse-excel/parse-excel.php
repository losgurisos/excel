﻿<?php
ob_start();

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://localhost.com
 * @since             1.0.0
 * @package           Parse_Excel
 *
 * @wordpress-plugin
 * Plugin Name:       Parse Excel
 * Plugin URI:        http://www.notenemospaginadelplugin.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Software
 * Author URI:        http://localhost.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       parse-excel
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-parse-excel-activator.php
 */
function activate_parse_excel() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-parse-excel-activator.php';
    Parse_Excel_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-parse-excel-deactivator.php
 */
function deactivate_parse_excel() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-parse-excel-deactivator.php';
    Parse_Excel_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_parse_excel');
register_deactivation_hook(__FILE__, 'deactivate_parse_excel');
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-parse-excel.php';

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
            'Subir Promos', //page title
            'Subir Promos', //menu title
            'edit_pages', //capabilities
            'parse_excel', //menu slug
            'load_from_excel' //function
    );


    // add
    /* add_submenu_page(
      'parse_excel', //parent slug
      'Cargar Excel', //page title
      'Cargar desde excel', //menu title
      'edit_pages', //capability
      'centros_item_create', //menu slug
      'centros_item_create' //function
      ); */
}

require_once('load-from-excel.php');
//require_once('centros-update-item.php');
//require_once('centros-list-items.php');
//require_once('includes/helpers.php');

add_action('admin_menu', 'parse_excel_menu');

add_shortcode('parse_excel_render', 'parse_excel_shortcode');

function parse_excel_shortcode($atts) {
    return parseExcelLogic($atts);
}

// THE LOGIC
function parseExcelLogic($atts) {
    add_action('wp_footer', 'add_shortcode_css_and_js');
    $trans = array("á" => "a", "é" => "e", "í" => "i", "ó" => "o", "ú" => "u", "ñ" => "n");

    // database object
    global $wpdb;
    $table = $wpdb->prefix . "parse_excel_data";
    require( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $sql = "SELECT * FROM " . $table;

    $result = $wpdb->get_results($sql);




    $html = '<div class="container parse-excel">
            	<div class="row">';

    $html .= getSidebar();

    $html .= '<div class="col-md-9 excel-center">
                    <ul class="item-list">';



    for ($i = 0; $i < count($result); $i++) {

        $_clasificacion = $result[$i]->clasificacion;
        foreach ($trans as $clave => $valor) {
            $_clasificacion = str_replace($clave, $valor, $_clasificacion);
        }

        $html .= '<li class="col-md-12 col-lg-6 cat-' . strtolower($_clasificacion) . ' dep-' . strtolower(str_replace(" ", "_", $result[$i]->departamento)) . '">
                            <div class="item">
                                <div class="item-img">
                                <img src="' . ($result[$i]->imagen !== '' && $result[$i]->imagen !== NULL ? plugins_url('public/marcas/' . $result[$i]->imagen . '', __FILE__) : plugins_url('public/img/pronto1.jpg', __FILE__)) . '"/>
                                </div>
                                <div class="item-data">
                                    <div class="item-category-img ' . strtolower($_clasificacion) . '">

                                    </div>
                                    <div class="item-disscount">
                                        <p class="val">' . ($result[$i]->descuento === '' ? $result[$i]->cuotas : ($result[$i]->descuento . '%')) . '</p>
                                        <p class="mini">' . ($result[$i]->descuento === ''? 'cuotas' : 'dto' ) .'</p>
                                    </div>

                                    <div class="item-apply-on">' . $result[$i]->beneficios . '</div>
                                    <div class="item-address">' . $result[$i]->direccion . '</div></div>
                            </div>
                        </li>';
    }

    // items container center
    $html .= '</ul></div>';

    // container and row
    $html .= '</div></div>';

    return $html;
}

function add_shortcode_css_and_js() {
    wp_enqueue_script('parse-excel-shortcode-js', plugins_url('public/js/parse-excel-public.js', __FILE__), false);
    wp_enqueue_style('parse-excel-shortcode-css', plugins_url('public/css/parse-excel-public.css', __FILE__), false);
}

function getSidebar() {

    return '<div class="col-md-3 col-sm-3 col-xs-12 excel-sidebar">
                    <div class="top">
                        <p class="title">Descuentos en comercios amigos</p>
                        <div class="row">

                            <div class="category-filter-container">


                                <div class="category-filter-item col-xs-2 col-sm-4 col-lg-4 col-md-6">

                                    <div class="category-filter tecnologia">
                                        <div class="cat-filter-icon "></div>
                                        <div class="cat-filter-title">Tecnología</div>
                                        <div class="cat-filter-checkbox-container">
                                            <input category="tecnologia" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="category-filter-item  col-xs-2 col-sm-4 col-lg-4 col-md-6">
                                    <div class="category-filter moda">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-title">Moda</div>
                                        <div class="cat-filter-checkbox-container">
                                            <input category="moda" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="category-filter-item col-xs-2 col-sm-4 col-lg-4 col-md-6" >
                                    <div class="category-filter ninos">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-title">Niños</div>
                                        <div class="cat-filter-checkbox-container">
                                            <input category="ninos" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="category-filter-item  col-xs-2 col-sm-4 col-lg-4 col-md-6" >
                                    <div class="category-filter hogar">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-title">Hogar</div>
                                        <div class="cat-filter-checkbox-container">
                                             <input category="hogar" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="category-filter-item col-xs-2  col-sm-4 col-lg-4 col-md-6">
                                    <div class="category-filter vehiculos">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-title">Vehículos</div>
                                        <div class="cat-filter-checkbox-container">
                                             <input category="vehiculos" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="category-filter-item col-xs-2 col-sm-4  col-lg-4 col-md-6">
                                    <div class="category-filter otros">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-title">Otros</div>
                                        <div class="cat-filter-checkbox-container">
                                            <input category="otros" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cities-filter-container">
                            <div class="cities-filter-select-container">
                                <select id="cities-filter-select" class="cities-filter-select">
                                    <option value=""> -- Departamento -- </option>
                                    <option value="montevideo">Montevideo</option>
                                    <option value="artigas">Artigas</option>
                                    <option value="canelones">Canelones</option>
                                    <option value="colonia">Colonia</option>
                                    <option value="durazno">Durazno</option>
                                    <option value="treinta_y_tres">Treinta y Tres</option>
                                    <option value="cerro_largo">Cerro Largo</option>
                                    <option value="flores">Flores</option>
                                    <option value="florida">Florida</option>
                                    <option value="maldonado">Maldonado</option>
                                    <option value="lavalleja">Lavalleja</option>
                                    <option value="paysandu">Paysandu</option>
                                    <option value="rio_negro">Rio Negro</option>
                                    <option value="rivera">Rivera</option>
                                    <option value="rocha">Rocha</option>
                                    <option value="san_jose">San Jose</option>
                                    <option value="salto">Salto</option>
                                    <option value="soriano">Soriano</option>
                                    <option value="tacuarembo">Tacuarembo</option>  
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--<a href="/tarjeta-beneficia" class="beneficios">Beneficios Pronto!</a>
                    <div class="bottom">
                        <div class="container-beneficios">
                            <a href="/retiros-en-efectivo" class="beneficio col-lg-3 col-sm-3 col-xs-3 col-md-3 efectivo">
                                <div class="beneficio_image "></div>
                                <div class="beneficio_name">Retirar efectivo</div>
                                <div  class="checkbox-container"><input type="checkbox"/></div>
                            </a>
                            <a href="/pago-movil" class="beneficio col-lg-3 col-sm-3 col-md-3 col-xs-3  movil">
                                <div class="beneficio_image"></div>
                                <div class="beneficio_name">Pago móvil</div>
                                <div class="checkbox-container"><input type="checkbox"/></div>
                            </a>
                            <a href="/restaurantes/" class="beneficio col-lg-3 col-sm-3 col-md-3 col-xs-3  restaurantes">
                                <div class="beneficio_image"></div>
                                <div class="beneficio_name">Restaurantes</div>
                                <div  class="checkbox-container"><input type="checkbox"/></div>
                            </a>
                            <a href="/beneficios-estaciones/" class="beneficio col-lg-3 col-sm-3 col-md-3 col-xs-3  estaciones">
                                <div class="beneficio_image"></div>
                                <div class="beneficio_name">Estaciones</div>
                                <div  class="checkbox-container"><input type="checkbox"/></div>
                            </a>
                        </div>
                        <div class="beneficia">

                        </div>
                    </div>-->
                </div>';
}

// WIDGET
//require_once( dirname(__FILE__) . "/widget.php");
run_parse_excel();
ob_end_flush();
?>