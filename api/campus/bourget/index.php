<?php
	include($_SERVER['DOCUMENT_ROOT'].'/api/libs/base_config.php');
	
	$count = -1;
	
	//récupération des bâtiments depuis bdd à l'aide du framework medoo
	$result = $database->select(
		'batiment',[
			'[>]campus' => ['cle_campus' => 'ca_id']
		],[
			'batiment.ba_id',
			'batiment.ba_nom(name)',
			'batiment.ba_nom_court(short)',
			'batiment.ba_description(desc)',
		],[
			'AND' => [
				'ca_nom_court' => 'bourget'
			]
		]
	);
	
	$success = $result !== false;
	
	if ($success){
		$count = count($result);
	}
	
	
	print get_json($success, $count, $result);
?>
