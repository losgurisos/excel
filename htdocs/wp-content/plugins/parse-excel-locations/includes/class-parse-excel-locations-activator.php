<?php
/**
 * Fired during plugin activation
 *
 * @link       http://localhost.com
 * @since      1.0.0
 *
 * @package    Parse_Excel_Locations
 * @subpackage Parse_Excel_Locations/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Parse_Excel_Locations
 * @subpackage Parse_Excel_Locations/includes
 * @author     Software <gmail@gmail.com>
 */
class Parse_Excel_Locations_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
        $table = $wpdb->prefix . "parse_excel_locations_data";
        $sql = "CREATE TABLE ".$table." (
		id INT NOT NULL AUTO_INCREMENT,
		departamento VARCHAR (255) NOT NULL,
		nombre VARCHAR (255) NOT NULL,
		localidad VARCHAR (255) NOT NULL,
		direccion VARCHAR (512) NOT NULL,
		coordenadas VARCHAR (255) NOT NULL,
		telefono VARCHAR (255) NOT NULL,
		servicios VARCHAR (512) NOT NULL,
		tipo_local VARCHAR (512) NOT NULL,
  		PRIMARY KEY (id)
		);";

        require( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
	}
}