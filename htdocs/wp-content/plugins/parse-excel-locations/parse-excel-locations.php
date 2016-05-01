<?php
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
 * @package           Parse_Excel_Locations
 *
 * @wordpress-plugin
 * Plugin Name:       Parse Excel Locations
 * Plugin URI:        http://www.localhost.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Software
 * Author URI:        http://localhost.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       parse-excel-locations
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
function activate_parse_excel_locations() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-parse-excel-locations-activator.php';
    Parse_Excel_Locations_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-parse-excel-deactivator.php
 */
function deactivate_parse_excel_locations() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-parse-excel-locations-deactivator.php';
    Parse_Excel_Locations_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_parse_excel_locations');
register_deactivation_hook(__FILE__, 'deactivate_parse_excel_locations');
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-parse-excel-locations.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_parse_excel_locations() {

    $plugin = new Parse_Excel_Locations();
    $plugin->run();
}

//menu items
function parse_excel_locations_menu() {

    // Main Menu
    add_menu_page(
            'Subir Localidades', //page title
            'Subir Localidades', //menu title
            'edit_pages', //capabilities
            'parse_excel_locations', //menu slug
            'load_locations_from_excel' //function
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

require_once('load-locations-from-excel.php');
//require_once('centros-update-item.php');
//require_once('centros-list-items.php');
//require_once('includes/helpers.php');

add_action('admin_menu', 'parse_excel_locations_menu');

add_shortcode('parse_excel_locations_render', 'parse_excel_locations_shortcode');

function parse_excel_locations_shortcode($atts) {
    return parseExcelLocationLogic($atts);
}

function transform($str) {
    $trans = array("á" => "a", "é" => "e", "í" => "i", "ó" => "o", "ú" => "u", "ñ" => "n");
}

// THE LOGIC
function parseExcelLocationLogic($atts) {
    add_action('wp_footer', 'add_shortcode_locations_css_and_js');

    $trans = array("á" => "a", "é" => "e", "í" => "i", "ó" => "o", "ú" => "u", "ñ" => "n");

    $transServices = array(
        "tarjeta_de_credito" => "tarjeta",
        "prestamo_en_efectivo" => "solicitud",
        "cobranzas" => "pagos",
        "orden_de_compra" => "compras"
    );

    // database object
    global $wpdb;
    $table = $wpdb->prefix . "parse_excel_locations_data";
    require( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $sql = "SELECT * FROM " . $table;

    $result = $wpdb->get_results($sql);

    $toJsonResult = array();


    for ($i = 0; $i < count($result); $i++) {


        $localidad = $result[$i]->localidad;
        $depto = $result[$i]->departamento;

        foreach ($trans as $clave => $valor) {
            $localidad = str_replace($clave, $valor, $localidad);
            $depto = str_replace($clave, $valor, $depto);
        }

        foreach ($trans as $clave => $valor) {

            $result[$i]->servicios = str_replace($clave, $valor, $result[$i]->servicios);
        }

        $_servicios = explode(" - ", $result[$i]->servicios);

        $coordenadas = explode(",", $result[$i]->coordenadas);


        $servicios = array();

        for ($j = 0; $j < count($_servicios); $j++) {

            $_serv = strtolower(str_replace(" ", "_", $_servicios[$j]));


            foreach ($transServices as $clave => $valor) {
                $_serv = str_replace($clave, $valor, $_serv);
            }


            $servicios[] = $_serv;
        }


        $toJsonResult[] =
            array(
                "departamento_titulo" => $depto,
                "departamento" => strtolower(str_replace(" ", "_",$depto)),
                "nombre" => $result[$i]->nombre,
                "localidad_titulo" =>  $localidad,
                "localidad" =>strtolower(str_replace(" ", "_",$localidad)) ,
                "direccion" => $result[$i]->direccion,
                "coordenadas" => array(
                        "x" => $coordenadas[0],
                        "y" => $coordenadas[1],
                    ),
                "telefono" => $result[$i]->telefono,
                "servicios" => $servicios
            );
    }
    ?>
    <script>
        var servicesFilters = [];
        var deptoFilter = '';
        var localidadFilter = '';

        var marker_data = function (depto, localidad, lat, lng, title, servicios) {
            this.lat = lat;
            this.lng = lng;
            this.title = title;
            this.depto = depto;
            this.localidad = localidad;
            this.servicios = servicios;
        };
        var localidades_data = <?php echo json_encode($toJsonResult); ?>;
        var marker_data_arr = [];
        for (var i in localidades_data) {
            marker_data_arr.push(
                    new marker_data(
                            localidades_data[i].departamento,
                            localidades_data[i].localidad,
                            parseFloat(localidades_data[i].coordenadas.x),
                            parseFloat(localidades_data[i].coordenadas.y),
                            localidades_data[i].nombre,
                            localidades_data[i].servicios
                            )
                    );


        }



        jQuery(document).ready(function () {

            cbFilters = jQuery(".cat-filter-checkbox");
            deptoSelect = jQuery("#cities-filter-select");
            localidadSelect = jQuery("#localidades-filter-select");

            var _localidadesPos = [];
            var _localidades = [];
            for(var i in localidades_data) {
                if(_localidades.indexOf(localidades_data[i].localidad) === -1){
                    _localidades.push(localidades_data[i].localidad);
                    _localidadesPos.push(i);
                }
                
                
            }

            for(var i in _localidadesPos){
                localidadSelect.append('<option value="'+localidades_data[_localidadesPos[i]].localidad+'">'+localidades_data[_localidadesPos[i]].localidad_titulo+'</option>');
            }

            cbFilters.change(function () {

                var service = jQuery(this).attr('service');

                var index = servicesFilters.indexOf(service);

                if (index === -1)
                    servicesFilters.push(service);
                else
                    servicesFilters.splice(index, 1);

                reloadFilters();
            });

            deptoSelect.change(function () {

                deptoFilter = jQuery(this).val();
                reloadFilters();

            });
            localidadSelect.change(function () {

                localidadFilter = jQuery(this).val();
                reloadFilters();

            });

        })


        /* marker_data_arr.push(new marker_data("MALDONADO", -31.2783835, -56.5093691, "PANDO"));
         marker_data_arr.push(new marker_data("MELO", -31.2783837, -57.5193691, "VENEZUELA"));
         marker_data_arr.push(new marker_data("CANELONES", -31.2783832, -56.5593691, "TU HERMANA"));
         marker_data_arr.push(new marker_data("MONTEVIDEO", -32.9840109, -57.0524278, "PEPE"));
         marker_data_arr.push(new marker_data("MONTEVIDEO", -31.2783835, -57.5493691, "ETC"));
         marker_data_arr.push(new marker_data("MALDONADO", -33.5461217, -56.76919, "ETC"));
         marker_data_arr.push(new marker_data("MALDONADO", -34.5278466, -55.5014186, "ETC"));
         */
        var google_map_markers = new Array();
        var map;

        function reloadFilters() {
 
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < marker_data_arr.length; i++) {
                //console.log(deptoFilter !=='',marker_data_arr[i].depto !== deptoFilter )
  
                if ((deptoFilter !=='' && marker_data_arr[i].depto !== deptoFilter)
                    || (localidadFilter!=='' && marker_data_arr[i].localidad !== localidadFilter)
                    || intersect_safe(servicesFilters, marker_data_arr[i].servicios)) {

                    //console.log(google_map_markers);
                    google_map_markers[i].setVisible(false);

                } else {
                    google_map_markers[i].setVisible(true);
                    bounds.extend(google_map_markers[i].getPosition());
                }
            }

            map.fitBounds(bounds);
        }

        function intersect_safe(a, b) {
            for (var i in a)
                if (b.indexOf(a[i]) === -1)
                    return true
            return false;
        }


        function initMap() {
            var myLatLng = {lat: -32.5623464, lng: -55.4331402};
            map = new google.maps.Map(document.getElementById('locations-map'), {
                zoom: 8,
                center: myLatLng
            });
            //console.log(document.getElementById('map'));
            for (var i = 0; i < marker_data_arr.length; i++) {

                myLatLng = {lat: marker_data_arr[i].lat, lng: marker_data_arr[i].lng};

                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: marker_data_arr[i].title
                });
                //console.log(marker);
                google_map_markers.push(marker);



            }

            //example
            //hide_markers_where_not("depto", "MONTEVIDEO");

        }


    </script>
    <?php
    $html = '<div class="container parse-excel">
            	<div class="row">';
    $html .= getSidebarLocations();
    $html .= '<style>
                html, body {
                    height: 100%;
                    margin: 0;
                    padding: 0;
                }

            </style><div class="locations-map" id="locations-map"></div>';


// container and row
    $html .= '</div></div>';
    return $html;
}

function getSidebarLocations() {

    return '
            <div class="col-md-3 col-sm-3 col-xs-12 location-excel-sidebar">
                    <div class="top">
                        <p class="title">Encontrá la sucursal más cercana a vos</p>
                        <div class="row">

                            <div class="category-filter-container">

                                <div class="col-lg-12 filter-container">
                                    <div class="filter-depto col-lg-12">
                                        <div class="label col-lg-6 col-md-6 col-sm-12">
                                            Elegí tu departamento
                                        </div>
                                        <div class="cbox col-lg-6 col-md-6 col-sm-12">
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
                                    <div class="filter-barrio col-lg-12">
                                        <div class="label col-lg-6 col-md-6 col-sm-12">
                                            Barrio/Localidad
                                        </div>
                                        <div class="cbox col-lg-6 col-md-6 col-sm-12">
                                            <select id="localidades-filter-select" class="localidades-filter-select">
                                                <option value=""> -- Barrio/Localidad -- </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 separator">
                                    <hr>
                                    <div class="absbox"><p>Locales con</p></div>
                                </div>
                                <div class="category-filter-item  col-xs-3 col-sm-6 col-lg-6 col-md-6">
                                    <div class="category-filter solicitud">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-checkbox-container">
                                            <input category="solicitud" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                        <div class="cat-filter-title">Solicitud de prestamo</div>

                                    </div>
                                </div>
                                <div class="category-filter-item col-xs-3 col-sm-6 col-lg-6 col-md-6" >
                                    <div class="category-filter tarjeta">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-checkbox-container">
                                            <input service="tarjeta" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                        <div class="cat-filter-title">Solicitar tarjeta</div>

                                    </div>
                                </div>
                                <div class="category-filter-item col-xs-3 col-sm-6 col-lg-6 col-md-6">

                                    <div class="category-filter sucursal">
                                        <div class="cat-filter-icon "></div>
                                        <div class="cat-filter-checkbox-container">
                                            <input service="compras" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                        <div class="cat-filter-title">Ordenes de compra</div>

                                    </div>
                                </div>


                                <div class="category-filter-item  col-xs-3 col-sm-6 col-lg-6 col-md-6" >
                                    <div class="category-filter estadoc">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-checkbox-container">
                                            <input service="pagos" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                        <div class="cat-filter-title">Pagos</div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="beneficios">Mi ubicación</div>
                    </div>

                </div>';
}

function add_shortcode_locations_css_and_js() {

    wp_enqueue_script('parse-excel-locations-shortcode-js', plugins_url('public/js/parse-excel-locations-public.js', __FILE__), false);
    wp_enqueue_style('parse-excel-locations-shortcode-css', plugins_url('public/css/parse-excel-locations-public.css', __FILE__), false);
}

// WIDGET
//require_once( dirname(__FILE__) . "/widget.php");
run_parse_excel_locations();
