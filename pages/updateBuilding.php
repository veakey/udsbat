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
	
	$campus = $database->select(
		'campus',
		'*',[
			'ca_nom[=]' => $_POST['campus']
		]
	);
	
	$last_geoloc_id = $database->insert(
		'geoloc',[
			'ge_lati' => $_POST['lati'],
			'ge_longi' => $_POST['longi']
		]
	);
	
	$last_building_id = $database->insert(
		'batiment', [
			'ba_nom' => $building,
			'ba_nom_court' => uds_trim($building),
			'ba_img_url' => '1.png',
			'ba_description' => '',
			'cle_campus' => $campus[0]['ca_id'],
			'cle_geoloc' => $last_geoloc_id
		]
	);
	
	/*Arborescence
	 * 1) création d'un fichier qui permette de récupérer le bâtiment en fonction du dernier sous-dossier
	 * 
	 */
	
	$short_name = $campus[0]['ca_nom_court'];
	create_new_node($short_name, $building);
	
	$toReturn = [];
	$toReturn['campus'] = $campus;
	$toReturn['bob'] = $_SERVER;
	
	echo json_encode($toReturn);
?>
