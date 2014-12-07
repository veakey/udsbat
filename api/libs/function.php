<?php
	$database = new medoo([
		'database_type' => 'mysql',
		'database_name' => 'udsbat',
		'server' => 'localhost',
		'username' => 'batman',
		'password' => 'estobat',
	]);
	
	function get_json($succeed, $count, $data){
		$toReturn = [];
		$toReturn['success'] = $succeed;
		$toReturn['totalCount'] = $count;
		$toReturn['data'] = $data;
		
		return json_encode($toReturn);
	}
?>
