<?php
	$database = new medoo([
		'database_type' => 'mysql',
		'database_name' => 'udsbat',
		'server' => 'localhost',
		'username' => 'batman',
		'password' => 'estobat',
	]);
	
	function get_api_path($subpath = ''){
		return $_SERVER['DOCUMENT_ROOT'] . '/api' . $subpath;
	}
	
	function get_img_path(){
		return $_SERVER['DOCUMENT_ROOT'] . '/img';
	}
	
	function get_tmp_pic_path(){
		return get_img_path() . '/tmp.png';
	}
	
	function get_json($succeed, $count, $data){
		$toReturn = [];
		$toReturn['success'] = $succeed;
		$toReturn['totalCount'] = $count;
		$toReturn['data'] = $data;
		
		return json_encode($toReturn);
	}
	
	function get_new_script(){
		//check in api/libs/new_script.php;
	}
	
	function uds_trim($b_name){
		$first = strtolower($b_name);
		$second = str_replace(
			[' ', '-'],
			['',''],
			$first
		);
		return $second;
	}
	
	function find_campus($url){
		$to_seek = '/campus';
		$start = strpos($url, $to_seek);
		$camp_start = strpos($url, '/', $start + strlen($to_seek));
		$camp_stop = strpos($url, '/', $camp_start);
		return substr($url, $camp_start, $camp_stop);
	}
	
	function find_building_short($url, $campus){
		$to_seek = $campus;
		$start = strpos($url, $to_seek);
		$end = strpos($url, '/', $start + strlen($to_seek));
		return substr($url, $start, $end);
	}
	
	function create_new_node($campus, $building){
		//création du répertoire
		$building = uds_trim($building);
		$aux = '/campus/' . $campus . '/' . $building;
		$root_path = get_api_path($aux);
		$succeed0 = mkdir($root_path, 0777);
		
		$pic_path = $root_path . '/' . 'img';
		$succeed1 = mkdir($pic_path, 0777);
		
		$succeed3 = copy(get_tmp_pic_path(), $pic_path . '/1.png');
		
		//création du fichier index.php
		
		return $succeed0 && $succeed1 && $succeed3;
	}
	
	function update_node($campus, $building){
		
	}
?>
