<?php
echo ABSPATH;
$table = $wpdb->prefix . "parse_excel_locations_data";
require( ABSPATH . 'wp-admin/includes/upgrade.php' );

$sql = 'SELECT * FROM '.$table;

$result = $wpdb->get_results($sql);

$response = array();

echo json_encode($result);

for($i = 0; $i < count($result); $i++){
	
}

function fs_get_wp_config_path()
{
    $base = dirname(__FILE__);
    $path = false;

    if (@file_exists(dirname(dirname($base))."/wp-config.php"))
    {
        $path = dirname(dirname($base))."/wp-config.php";
    }
    else
    if (@file_exists(dirname(dirname(dirname($base)))."/wp-config.php"))
    {
        $path = dirname(dirname(dirname($base)))."/wp-config.php";
    }
    else
    $path = false;

    if ($path != false)
    {
        $path = str_replace("\\", "/", $path);
    }
    return $path;
}




