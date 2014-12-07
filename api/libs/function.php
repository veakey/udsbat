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
	
	function uds_trim($b_name){
		$first = strtolower($b_name);
		$second = str_replace(
			[' ','-','à','â','é','è','ê'],
			['','','a','a','e','e','e'],
			$first
		);
		//à en rajouter si on en croise d'autre...
		return $second;
	}
	
	function find_word($url, $to_seek){
		$start = strpos($url, $to_seek);
		$camp_start = strpos($url, '/', $start + strlen($to_seek)) + 1;
		$camp_stop = strpos($url, '/', $camp_start + 1);
		$length = $camp_stop - $camp_start;
		return substr($url, $camp_start, $length);
	}
	
	function find_campus($url){
		return find_word($url, '/campus');
	}
	
	function find_building_short($url, $campus){
		return find_word($url, $campus);
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
		$succeed4 = copy(get_api_path('/libs/new_script.php'), $root_path . '/index.php');
		
		return $succeed0 && $succeed1 && $succeed3 && $succeed4;
	}
	
	
	
	function update_node($campus, $building){
		$building = uds_trim($building);
		$aux = '/campus/' . $campus . '/' . $building;
		$root_path = get_api_path($aux);
		$pic_path = $root_path . '/' . 'img';
		
		$max = -1;
		
		$files = glob($pic_path . '/*.{png}', GLOB_BRACE);
		foreach($files as $file) {
			$raw_value = explode('.', basename($file))[0];
			$current_value = intval($raw_value);
			
			if ($max < $current_value){
				$max = $current_value;
			}
		}
		
		//pour avoir un incrément de plus que le max trouvé précédemment
		$max++;
		$next_img = $pic_path . '/' . $max . '.png';
		
		$succeed0 = copy(get_tmp_pic_path(), $next_img);
		
		return $succeed0;
	}
?>
