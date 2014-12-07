<?php
	include($_SERVER['DOCUMENT_ROOT'].'/api/libs/base_config.php');
	
	$count = -1;
	
	$script_name = $_SERVER['SCRIPT_FILENAME'];
	
	$campus = find_campus($script_name);
	$building_short = find_building_short($script_name, $campus);
	
	
	//récupération des bâtiments depuis bdd à l'aide du framework medoo
	$result = $database->select(
		'batiment',[
			'[>]campus' => ['cle_campus' => 'ca_id'],
			'[>]geoloc' => ['cle_geoloc' => 'ge_id']
		],[
			'ba_id',
			'ba_img_url(pic)',
			'ba_nom(name)',
			'ba_description(desc)',
			'ge_lati(lat)',
			'ge_longi(lon)'
		],[
			'ge_actif[=]' => 1,
			'ca_nom_court[=]' => $campus,
			'ba_nom_court[=]' => $building_short
		]
	);
	
	print $database->last_query();
	
	$success = $result !== false;
	
	if ($success){
		$count = count($result);
	}
	
	
	print get_json($success, $count, $result);
?>
