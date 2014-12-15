<?php
	include($_SERVER['DOCUMENT_ROOT'].'/api/libs/base_config.php');
	/*
	 * 0) récupération campus, batiment
	 * 1) insert into bdd
	 *  .) ip
	 * 	a) geoloc
	 * 	b) bati
	 *  c) pic
	 * 	  0) copier img/tmp.png vers new arbo 1.png -> n.png dans le cas où le bat existe déjà
	 * 2) création/update arborescence
	 */
	
	//************************************ 0)
	
	$building = $_GET['buildingName'];
	
	$short_buidling_name = uds_trim($building);
	
	$campus = $database->select(
		'campus',
		'*',[
			'ca_nom[=]' => $_GET['campus']
		]
	);
	
	$short_name = $campus[0]['ca_nom_court'];
	
	$existing_building = $database->select(
		'batiment',[
			'[>]campus' => ['cle_campus' => 'ca_id']
		],[
			'batiment.ba_id',
			'batiment.ba_nom(name)'
		],[
			'AND' => [
				'ba_nom_court' => $short_buidling_name,
				'ca_nom_court' => $short_name
			]
		]
	);
	
	//************************************ 1)
	
	//*** .)
	$existing_ip = $database->select(
		'adress', [
			'ad_id(id)',
			'ad_client(client)',
			'ad_forwarded(forwarded)',
			'ad_remote(remote)'
		],[
			'AND' => [
				'ad_client' => isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : null,
				'ad_forwarded' => isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR']: null,
				'ad_remote' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null
			]
		]
	);
	
	$cle_ip = -1;
	//Dans le cas où une address ip correspond
	if (count($existing_ip) != 0){
		$cle_ip = $existing_ip[0]['id'];
	}else{
		$cle_ip = $database->insert(
			'adress', [
				'ad_client' => isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : null,
				'ad_forwarded' => isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR']: null,
				'ad_remote' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null
			]
		);
	}
	
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
		$pic_name = $short_buidling_name.'1.png';
		
		$last_building_id = $database->insert(
			'batiment', [
				'ba_nom' => $building,
				'ba_nom_court' => $short_buidling_name,
				'ba_description' => '',
				'cle_campus' => $campus[0]['ca_id'],
				'cle_addr' => $cle_ip
			]
		);
		
		$last_pic_id = $database->insert(
			'pic', [
				'pi_name' => $pic_name,
				'cle_addr' => $cle_ip,
				'cle_batiment' => $last_building_id
				'pi_actif' => 1
			]
		);
		
		$last_geoloc_id = $database->insert(
			'geoloc',[
				'ge_lati' => $_GET['lati'],
				'ge_longi' => $_GET['longi'],
				'ge_actif' => 1,
				'cle_batiment' => $last_building_id,
				'cle_addr' => $cle_ip,
			]
		);
		
		create_new_node($short_name, $building, $pic_name);
	}else{
		$building_id = $existing_building[0]['ba_id'];
		
		$new_index = get_new_pi_id($database, $building_id);
		$new_pic_name = $short_buidling_name . $new_index . '.png';
		
		print $new_index . 'polo#';
		
		$last_pic_id = $database->insert(
			'pic', [
				'pi_name' => $new_pic_name,
				'cle_addr' => $cle_ip,
				'cle_batiment' => $building_id,
				'pi_actif' => 0
			]
		);
		
		$last_geoloc_id = $database->insert(
			'geoloc',[
				'ge_lati' => $_GET['lati'],
				'ge_longi' => $_GET['longi'],
				'cle_batiment' => $building_id,
				'cle_addr' => $cle_ip
			]
		);
		update_node($short_name, $building, $new_pic_name);
	}
	
	$toReturn = [];
	$toReturn['build'] = $existing_building;
	$toReturn['campus'] = $campus;
	
	print json_encode($toReturn);
?>
