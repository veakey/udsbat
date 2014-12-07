<?php
	include($_SERVER['DOCUMENT_ROOT'].'/api/libs/base_config.php');
	/*
	 * 0) récupération campus, batiment
	 * 1) création arborescence
	 * 2) copier img/tmp.png vers new arbo 1.png -> n.png dans le cas où le bat existe déjà
	 * 3) insert into bdd
	 * 	a) geoloc
	 * 	b) bati
	 */
	
	$building = $_POST['buildingName'];
	
	
	
	$short_buidling_name = uds_trim($building);
	
	$campus = $database->select(
		'campus',
		'*',[
			'ca_nom[=]' => $_POST['campus']
		]
	);
	
	$short_name = $campus[0]['ca_nom_court'];
	
	$existing_building = $database->select(
		'batiment',[
			'[>]campus' => ['cle_campus' => 'ca_id'],
			'[>]geoloc' => ['cle_geoloc' => 'ge_id']
		],[
			'batiment.ba_id',
			'batiment.ba_nom(name)'
		],[
			'AND' => [
				'ba_nom_court' => $short_buidling_name,
				'ca_nom_court' => $short_name,
				'ge_actif' => 1
			]
		]
	);
	
	//var_dump($database->last_query());
	//var_dump($campus);
	//var_dump($existing_building);
	
	/* check if building present regarding the api
	 * if yes 
	 * 	1) add new Location (by default it's set to non active) => only admin will update this field
	 * 	2) add new picture
	 */
	
	//if (count($existing_building) == 0 || $existing_building == true){
	$aux = '/campus/' . $campus[0]['ca_nom_court'] . '/' . $short_buidling_name;
	$root_path = get_api_path($aux);
	
	if (!file_exists($root_path)){
		//par défaut on active le premier insert pour la géoloc, c'est un système de confiance
		//on verra bien comment les gens vont se comporter...
		$last_geoloc_id = $database->insert(
			'geoloc',[
				'ge_lati' => $_POST['lati'],
				'ge_longi' => $_POST['longi'],
				'ge_actif' => 1
			]
		);
		
		$last_building_id = $database->insert(
			'batiment', [
				'ba_nom' => $building,
				'ba_nom_court' => $short_buidling_name,
				'ba_img_url' => '1.png',
				'ba_description' => '',
				'cle_campus' => $campus[0]['ca_id'],
				'cle_geoloc' => $last_geoloc_id
			]
		);
		
		create_new_node($short_name, $building);
	}else{
		$last_geoloc_id = $database->insert(
			'geoloc',[
				'cle_batiment' => $existing_building[0]['ba_id'],
				'ge_lati' => $_POST['lati'],
				'ge_longi' => $_POST['longi']
			]
		);
		update_node($short_name, $building);
	}
	
	$toReturn = [];
	$toReturn['build'] = $existing_building;
	$toReturn['campus'] = $campus;
	
	print json_encode($toReturn);
?>
