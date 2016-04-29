<?php
/**
 * Fired during plugin activation
 *
 * @link       http://lospibesnotienenpagina.com
 * @since      1.0.0
 *
 * @package    Parse_Excel
 * @subpackage Parse_Excel/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Parse_Excel
 * @subpackage Parse_Excel/includes
 * @author     Andrés <penalunandres@gmail.com>
 */
class Parse_Excel_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
        $table = $wpdb->prefix . "parse_excel_data";
        $sql = "CREATE TABLE ".$table." (
		id INT NOT NULL AUTO_INCREMENT,
		departamento VARCHAR (255) NOT NULL,
		clasificacion VARCHAR (255) NOT NULL,
		localidad VARCHAR (255) NOT NULL,
		direccion VARCHAR (512) NOT NULL,
		nombre_comercial VARCHAR (512) NOT NULL,
		imagen VARCHAR (512) NOT NULL,
		beneficios VARCHAR (512) NOT NULL,
		descuento VARCHAR (255) NOT NULL DEFAULT '0',
  		PRIMARY KEY (id)
		);";

        require( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
	}
}