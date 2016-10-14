<?php
include '../config/config.inc';
include '../model/System/Util.php';
$util = new Util();

$ruta_archivo_csv = $config['path_aplicacion'].'files/csv/Octubre.csv';
$MyArray = $util->csv_to_array($ruta_archivo_csv);
//var_dump($MyArray);
echo "TOTAL:".count($MyArray)."<br/>";

$i=1;
foreach($MyArray as $row){	
	echo "FILA $i -> APE1:".utf8_encode($row['APE1'] )."<br/>";
	if($i>=3) break;
	$i++;
}

?>