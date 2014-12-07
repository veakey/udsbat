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
			'batiment.ba_id',
			'batiment.ba_img_url(pic)',
			'batiment.ba_nom(name)',
			'batiment.ba_description(desc)',
			'geoloc.ge_lati(lat)',
			'geoloc.ge_longi(lon)'
		],[
			'AND' => [
				'ba_nom_court' => $building_short,
				'ca_nom_court' => $campus,
				'ge_actif' => 1
			]
		]
	);
	
	
	//$result should be unique !
	
	
	if (count($result) > 0){
		$pic = $result[0]['pic'];
		$result[0]['pic'] = 'http://'.$_SERVER['SERVER_NAME'].'/api/campus/'.$campus.'/'.$building_short.'/img/'. $pic;
	}
	
	
	
	//print $database->last_query();
	
	$success = $result !== false;
	
	if ($success){
		$count = count($result);
	}
	
	
	print get_json($success, $count, $result);
?>
