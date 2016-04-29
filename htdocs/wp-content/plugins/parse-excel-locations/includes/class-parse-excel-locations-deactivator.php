<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://lospibesnotienenpagina.com
 * @since      1.0.0
 *
 * @package    Parse_Excel
 * @subpackage Parse_Excel/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Parse_Excel
 * @subpackage Parse_Excel/includes
 * @author     Software <gmail@gmail.com>
 */
class Parse_Excel_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;
        $table = $wpdb->prefix . "parse_excel_data";

        $sql = "DROP TABLE IF EXISTS ".$table.";";

        $e = $wpdb->query($sql);
	}

}
