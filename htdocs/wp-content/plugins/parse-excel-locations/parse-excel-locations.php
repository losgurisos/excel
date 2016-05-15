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

// THE LOGIC
function parseExcelLocationLogic($atts) {
    add_action('wp_footer', 'add_shortcode_locations_css_and_js');

    $trans = array("á" => "a", "Á" => "A", "é" => "e", "É" => "E", "í" => "i", "Í" => "I", "ó" => "o", "Ó" => "O", "ú" => "u", "Ú" => "U", "ñ" => "n");

    $transServices = array(
        "tarjeta_de_credito" => "tarjeta",
        "prestamo_en_efectivo" => "solicitud",
        "cobranzas" => "pagos",
        "orden_de_compra" => "compras"
    );

    $transTipolocal = array(
        "sucursal_pronto!" => "sucursal_pronto"
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

        $serviceResult = $result[$i]->servicios;
        $tipoLocalResult = $result[$i]->tipo_local;

        foreach ($trans as $clave => $valor) {
            $serviceResult = str_replace($clave, $valor, $serviceResult);
            $tipoLocalResult = str_replace($clave, $valor, $tipoLocalResult);
        }


        $_servicios = explode(" - ", $serviceResult);
        $_tipoLocal = explode(" - ", $tipoLocalResult);


        $coordenadas = explode(",", $result[$i]->coordenadas);


        $servicios = array();
        $tipoLocal = array();
        for ($j = 0; $j < count($_servicios); $j++) {

            $_serv = strtolower(str_replace(" ", "_", $_servicios[$j]));


            foreach ($transServices as $clave => $valor) {
                $_serv = str_replace($clave, $valor, $_serv);
            }

            $servicios[] = $_serv;
        }

        for ($j = 0; $j < count($_tipoLocal); $j++) {

            $_tipo = strtolower(str_replace(" ", "_", $_tipoLocal[$j]));


            foreach ($transTipolocal as $clave => $valor) {
                $_tipo = str_replace($clave, $valor, $_tipo);
            }

            $tipoLocal[] = $_tipo;
        }


        $toJsonResult[] = array(
            "departamento_titulo" => rtrim($depto),
            "departamento" => strtolower(str_replace(" ", "_", rtrim($depto))),
            "nombre" => $result[$i]->nombre,
            "localidad_titulo" => rtrim($localidad),
            "localidad" => strtolower(str_replace(" ", "_", rtrim($localidad))),
            "direccion" => $result[$i]->direccion,
            "coordenadas" => array(
                "x" => $coordenadas[0],
                "y" => $coordenadas[1],
            ),
            "telefono" => $result[$i]->telefono,
            "servicios" => $servicios,
            "tipo_local_titulo" => $_tipoLocal,
            "tipo_local" => $tipoLocal
        );
    }
    ?>
    <script>
        var servicesFilters = [];
        var deptoFilter = '';
        var localidadFilter = '';
        var tipoLocalFilter = '';

        var marker_data = function (depto, localidad, lat, lng, title, servicios, tipo_local, direccion) {
            this.lat = lat;
            this.lng = lng;
            this.title = title;
            this.depto = depto;
            this.localidad = localidad;
            this.servicios = servicios;
            this.tipo_local = tipo_local;
            this.direccion = direccion;
        };
        var localidades_data = <?php echo json_encode($toJsonResult); ?>;
        var marker_data_arr = [];
        for (var i in localidades_data) {
            if(localidades_data[i].coordenadas.x && localidades_data[i].coordenadas.y)
                marker_data_arr.push(
                        new marker_data(
                                localidades_data[i].departamento,
                                localidades_data[i].localidad,
                                parseFloat(localidades_data[i].coordenadas.x),
                                parseFloat(localidades_data[i].coordenadas.y),
                                localidades_data[i].nombre,
                                localidades_data[i].servicios,
                                localidades_data[i].tipo_local,
                                localidades_data[i].direccion
                            )
                        );
        }

        jQuery(document).ready(function () {

            var cbFilters = jQuery(".cat-filter-checkbox");
            var deptoSelect = jQuery("#cities-filter-select");
            var localidadSelect = jQuery("#localidades-filter-select");
            var tipoLocalSelect = jQuery("#tipo-local-filter-select");

            cbFilters.change(function () {

                var service = jQuery(this).attr('service');

                var index = servicesFilters.indexOf(service);

                if (index === -1)
                    servicesFilters.push(service);
                else
                    servicesFilters.splice(index, 1);

                reloadFilters();
            });

            tipoLocalSelect.change(function () {

                tipoLocalFilter = jQuery(this).val();
                reloadFilters();

            });

            function TipoLocalSelectManager(tipo_local_select_id) {
                var tipo_locales = [];

                function newOption(value, title) {
                    return '<option value="' + value + '">' + title + '</option>';
                }
                this.getTiposLocalQty = function () {
                    return tipo_locales.length;
                }
                this.addTipoLocal = function (tipo_local_cod, tipo_local_title) {
                    if (!this.exists(tipo_local_cod)) {
                        tipo_locales.push(new TipoLocal(tipo_local_cod, tipo_local_title));
                        //tipo_locales.sort(compare);
                    }

                }

                this.exists = function (tipo_local_cod) {
                    for (var i in tipo_locales) {
                        if (tipo_local_cod === tipo_locales[i].getCode())
                            return true;
                    }
                    return false;
                }

                this.loadTipolocalesOptions = function () {
                    var _select = jQuery("#" + tipo_local_select_id);
                    _select.html('');
                    _select.append(newOption('', 'Todos'));
                    for (var i in tipo_locales)
                        _select.append(
                                newOption(
                                        tipo_locales[i].getCode(),
                                        tipo_locales[i].getTitle()
                                        )
                                )

                }

                function TipoLocal(tipo_local_cod, tipo_local_title) {
                    var _tipo_local_cod = tipo_local_cod;
                    var _tipo_local_title = tipo_local_title;

                    this.getCode = function () {
                        return _tipo_local_cod;
                    }
                    this.getTitle = function () {
                        return _tipo_local_title;
                    }
                }

            }


            function DepartamentosSelectManager(dep_select_id, loc_select_id) {

                var _dep_select_id = dep_select_id;
                var _loc_select_id = loc_select_id;
                var departamentos = [];

                // custom compare for sorting
                function compare(a, b) {
                    if (a.getTitle() < b.getTitle())
                        return -1;
                    else if (a.getTitle() > b.getTitle())
                        return 1;
                    else
                        return 0;
                }

                // new option tag
                function newOption(value, title) {
                    return '<option value="' + value + '">' + title + '</option>';
                }

                this.addDepartamento = function (dep_code, dep_title) {
                    if (!this.exists(dep_code)) {
                        departamentos.push(new Departamento(dep_code, dep_title));
                        departamentos.sort(compare);
                    }

                }
                this.addLocalidad = function (dep_code, loc_code, loc_title) {
                    if (!this.exists(dep_code))
                        return false;

                    this.getDepartamento(dep_code).addLocalidad(loc_code, loc_title);
                }
                this.exists = function (dep_code) {
                    for (var i in departamentos) {
                        if (dep_code === departamentos[i].getCode())
                            return true;
                    }
                    return false;
                }
                this.getDepartamento = function (dep_code) {
                    for (var i in departamentos) {
                        if (dep_code === departamentos[i].getCode())
                            return departamentos[i];
                    }
                    return false;
                }
                this.loadDeptosOptions = function () {
                    var _select = jQuery("#" + _dep_select_id);
                    _select.html('');
                    _select.append(newOption('', ' -- Departamento -- '))
                    for (var i in departamentos)
                        _select.append(
                                newOption(
                                        departamentos[i].getCode(),
                                        departamentos[i].getTitle()
                                        )
                                )

                }
                this.loadLocalidadesOption = function (dep_code) {
                    var _select = jQuery("#" + _loc_select_id);
                    if (!this.exists(dep_code))
                        return;
                    _select.html('');
                    _select.append(newOption('', ' -- Barrio/Localidad -- '))
                    var _localidades = this.getDepartamento(dep_code).getLocalidades();
                    for (var i in _localidades)
                        _select.append(
                                newOption(
                                        _localidades[i].getCode(),
                                        _localidades[i].getTitle()
                                        )
                                )
                }

                function Departamento(code, title) {

                    var localidades = [];
                    var title = title;
                    var code = code;


                    this.getCode = function () {
                        return code;
                    }
                    this.getTitle = function () {
                        return title;
                    }
                    this.addLocalidad = function (loc_code, loc_title) {
                        if (!this.exists(loc_code)) {
                            localidades.push(new Localidad(loc_code, loc_title));
                            localidades.sort(compare);
                        }
                    }
                    this.exists = function (loc_code) {
                        for (var i in localidades) {
                            if (loc_code === localidades[i].getCode())
                                return true;
                        }
                        return false;
                    }
                    this.getLocalidades = function () {
                        return localidades;
                    }

                    function Localidad(code, title) {
                        var title = title;
                        var code = code;
                        this.getCode = function () {
                            return code;
                        }
                        this.getTitle = function () {
                            return title;
                        }
                    }

                }
            }




            var departamentosManager = new DepartamentosSelectManager('cities-filter-select', 'localidades-filter-select');
            var tipoLocalSelectManager = new TipoLocalSelectManager('tipo-local-filter-select');

            for (var i in localidades_data) {
                departamentosManager.addDepartamento(localidades_data[i].departamento, localidades_data[i].departamento_titulo);
                departamentosManager.addLocalidad(localidades_data[i].departamento, localidades_data[i].localidad, localidades_data[i].localidad_titulo);

                for (var j in localidades_data[i].tipo_local)
                    tipoLocalSelectManager.addTipoLocal(localidades_data[i].tipo_local[j], localidades_data[i].tipo_local_titulo[j]);

            }

            departamentosManager.loadDeptosOptions();
            tipoLocalSelectManager.loadTipolocalesOptions();

            tipoLocalesQty = tipoLocalSelectManager.getTiposLocalQty();


            var _localidadesPos = [];
            var _localidades = [];
            for (var i in localidades_data) {
                if (_localidades.indexOf(localidades_data[i].localidad) === -1) {
                    _localidades.push(localidades_data[i].localidad);
                    _localidadesPos.push(i);
                }


            }

            for (var i in _localidadesPos) {
                //localidadSelect.append('<option value="' + localidades_data[_localidadesPos[i]].localidad + '">' + localidades_data[_localidadesPos[i]].localidad_titulo + '</option>');
            }


            deptoSelect.change(function () {

                deptoFilter = jQuery(this).val();
                departamentosManager.loadLocalidadesOption(deptoFilter);
                localidadFilter = '';
                reloadFilters();

            });
            localidadSelect.change(function () {

                localidadFilter = jQuery(this).val();
                reloadFilters();

            });
            jQuery("#my_location").click(function () {
                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var geolocationLatLng = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        infoWindow.setPosition(geolocationLatLng);
                        infoWindow.open(map);
                        infoWindow.setContent('Te encuentras aqui.');
                        map.setZoom(12);
                        map.setCenter(geolocationLatLng);
                    }, function () {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
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
        var tipoLocalesQty = 0;
        var google_map_markers = new Array();
        var map;
        var geolocationLatLng = {lat: -32.7027405, lng: -54.7530596};
        var infoWindow;

        function reloadFilters() {

            var bounds = new google.maps.LatLngBounds();
            var foundAny = false;
            for (var i = 0; i < marker_data_arr.length; i++) {
                //console.log(deptoFilter !=='',marker_data_arr[i].depto !== deptoFilter )
                //console.log(intersect_safe(servicesFilters, marker_data_arr[i].servicios), servicesFilters.length);
                if ((deptoFilter !== '' && marker_data_arr[i].depto !== deptoFilter)
                        || (localidadFilter !== '' && marker_data_arr[i].localidad !== localidadFilter)
                        || (tipoLocalFilter !== '' && ((tipoLocalFilter === 'todos' && marker_data_arr[i].tipo_local.length < tipoLocalesQty) || (tipoLocalFilter !== 'todos' && marker_data_arr[i].tipo_local.indexOf(tipoLocalFilter) === -1)))
                        || !(intersect_safe(servicesFilters, marker_data_arr[i].servicios) === servicesFilters.length)) {

                    //console.log(google_map_markers);
                    google_map_markers[i].setVisible(false);

                } else {
                    foundAny = true;
                    google_map_markers[i].setVisible(true);
                    bounds.extend(google_map_markers[i].getPosition());
                }
            }
            if (foundAny) {
                map.fitBounds(bounds);
            } else {
                var center = new google.maps.LatLng(-32.63597, -55.6288045);
                map.setZoom(7);
                map.setCenter(center, 7);
            }

        }

        function intersect_safe(a, b) {
            var intersections = 0;
            for (var i in a)
                if (b.indexOf(a[i]) !== -1)
                    intersections++;
            return intersections;
        }


        function initMap() {
            //32.63597,-55.6288045
            var myLatLng = {lat: -32.63597, lng: -55.6288045};
            map = new google.maps.Map(document.getElementById('locations-map'), {
                zoom: 7,
                center: myLatLng
            });
            infoWindow = new google.maps.InfoWindow({map: map});
            infoWindow.close();
            //console.log(document.getElementById('map'));
            for (var i = 0; i < marker_data_arr.length; i++) {

                myLatLng = {lat: marker_data_arr[i].lat, lng: marker_data_arr[i].lng};

                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: marker_data_arr[i].title,
                    direccion: marker_data_arr[i].direccion,
                    getHtmlInfoContent: function() {
                        return "<div style='text-align:left;line-height:20px'>"+
                                    "<b>"+this.title+"</b><br>"+
                                    this.direccion+
                                "</div>"
                    }
                });
                google.maps.event.addListener(marker, 'click', function () {
                    infoWindow.setContent(this.getHtmlInfoContent());
                    infoWindow.open(map, this);
                });

                //console.log(marker);
                google_map_markers.push(marker);

            }
        }
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            if (browserHasGeolocation) {
                alert("Error: El servicio de geolocalización ha fallado.");
            } else {
                alert('Error: Su navegador no soporta geolocalización.');
            }
            /*infoWindow.setPosition(pos);
             infoWindow.setContent(browserHasGeolocation ?
             'Error: El servicio de geolocalización ha fallado.' :
             'Error: Su navegador no soporta geolocalización.');*/
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
                        <div class="my-location" id="my_location">
                        <div class="my-location-content">
                        <div class="my-location-title">Mi ubicación</div>
                        <div class="my-location-subtitle">Haz click en el botón y automáticamente busca la sucursal más cercana a vos.</div>
                        </div>
                        </div>
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
                                    <div class="filter-barrio col-lg-12">
                                        <div class="label col-lg-6 col-md-6 col-sm-12">
                                          Tipo de Local
                                        </div>
                                        <div class="cbox col-lg-6 col-md-6 col-sm-12">
                                            <select id="tipo-local-filter-select" class="tipo-local-filter-select">
                                                <option value=""> -- Tipo de Local -- </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 separator">
                                    <hr>
                                    <div class="absbox"><p>Locales con</p></div>
                                </div>
                                <div class="category-filter-item  col-xs-4 col-sm-4 col-lg-4 col-md-4">
                                    <div class="category-filter solicitud">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-checkbox-container">
                                            <input service="solicitud" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                        <div class="cat-filter-title">Solicitúd de préstamo</div>

                                    </div>
                                </div>
                                <div class="category-filter-item  col-xs-4 col-sm-4 col-lg-4 col-md-4" >
                                    <div class="category-filter tarjeta">
                                        <div class="cat-filter-icon"></div>
                                        <div class="cat-filter-checkbox-container">
                                            <input service="tarjeta" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                        <div class="cat-filter-title">Solicitar tarjeta</div>

                                    </div>
                                </div>
                                <div class="category-filter-item  col-xs-4 col-sm-4 col-lg-4 col-md-4" style="display:none !important;">

                                    <div class="category-filter sucursal">
                                        <div class="cat-filter-icon "></div>
                                        <div class="cat-filter-checkbox-container">
                                            <input service="compras" type="checkbox" class="cat-filter-checkbox"/>
                                        </div>
                                        <div class="cat-filter-title">Ordenes de compra</div>

                                    </div>
                                </div>


                                <div class="category-filter-item  col-xs-4 col-sm-4 col-lg-4 col-md-4" >
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
