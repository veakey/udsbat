<?php
	include($_SERVER['DOCUMENT_ROOT'].'/api/libs/base_config.php');
	
	$count = -1;
	
	//récupération des bâtiments depuis bdd à l'aide du framework medoo
	$result = $database->select(
		'campus',
		'ca_nom',
		['ORDER' => 'ca_nom ASC']
	);
	
	$success = $result !== false;
	
	if ($success){
		$count = count($result);
	}
	
	
	print get_json($success, $count, $result);
?>
