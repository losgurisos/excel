<?php
function load_locations_from_excel (){


	$excelFile = $_FILES['excel_file'];

	if(isset($excelFile)) {
		// Get extension
		$fileExtension = pathinfo($excelFile['name'], PATHINFO_EXTENSION);

		// Check extension
		if($fileExtension == 'xls' || $fileExtension == 'xlsx'){

			
			// include PHPExcel lib
			include 'libs/PhpExcel/Classes/PHPExcel/IOFactory.php';

			// Get path
			$inputFileName = $excelFile['tmp_name'];

			//  Read your Excel workbook
			try {
			    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
			    $objPHPExcel = $objReader->load($inputFileName);
			} catch(Exception $e) {
				$error = "No se pudo obtener información del archivo";
			    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			    
			}

			//  Get worksheet dimensions
			$sheet = $objPHPExcel->getSheet(0); 
			$highestRow = $sheet->getHighestRow(); 
			$highestColumn = $sheet->getHighestColumn();

			// database object
			global $wpdb;
		    $table = $wpdb->prefix . "parse_excel_locations_data";
		    require( ABSPATH . 'wp-admin/includes/upgrade.php' );

		    // Truncate table
		    $sql = "DELETE FROM ".$table;
		    $wpdb->query($sql);

		    $recordsCount = 0;

		    $indexes = array(
		    	"departamento" => 0,
		    	"nombre" => 1,
				"localidad" => 2,
				"direccion" => 3,
				"coordenadas" => 4,
				"telefono" => 5,
				"servicios" => 6,
				"tipo_local" => 7
	    	);

			for ($row = 2; $row <= $highestRow; $row++){ 
			    //  Read a row of data into an array
			    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
			                                    NULL,
			                                    TRUE,
			                                    FALSE);
			    //  Insert row data array into your database

			    if($rowData[0][0] == NULL) {
			    	// Break if we reach a null value in excel
			    	break;
			    }


			    // Inserte data
		        $sql = "INSERT INTO ".$table." (
					departamento,
					nombre,
					localidad,
					direccion,
					coordenadas,
					telefono,
					servicios,
					tipo_local
				) VALUES (
					'".$rowData[0][$indexes["departamento"]]."',
					'".$rowData[0][$indexes["nombre"]]."',
					'".$rowData[0][$indexes["localidad"]]."',
					'".$rowData[0][$indexes["direccion"]]."',
					'".$rowData[0][$indexes["coordenadas"]]."',
					'".$rowData[0][$indexes["telefono"]]."',
					'".$rowData[0][$indexes["servicios"]]."',
					'".$rowData[0][$indexes["tipo_local"]]."'
				);";

				// Exec query
		        $recordsCount += $wpdb->query($sql);

			}

			if($recordsCount === 0){
				$error = "No se pudo obtener información del archivo";
			} else {
				$message = "Exito! ". $recordsCount . " registros cargados";
			}

		} else {
			$error = 'Error, asegurate que el archivo sea de extensión .xls o .xlsx';
		}
	}

	
	?>
	<div class="wrap">

	<h2>Cargar localidades desde excel</h2>
		<?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>
		<?php if (isset($error)): ?><div class="error"><p><?php echo $error;?></p></div><?php endif;?>
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
			<table class='wp-list-table widefat fixed'>

				<tr><th><strong>Seleccionar archivo: </strong></th>
                    <td><input type="file" name="excel_file" style="width:500px;"/></td></tr>
				
			</table>
			<input type='submit' name="load" value='Cargar datos' class='button'>
		</form>
		</div>

	<?php

}
?>