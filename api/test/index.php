<?php
	include($_SERVER['DOCUMENT_ROOT'].'/api/libs/base_config.php');
	
	$json =
	'{
		"success": true,
		"totalCount": 1,
		"data": [
			{
				"pic": "http://udsbat.valentinkim.org/api/test/img/1.png",
				"name": "Thermes de Thonon les Bains",
				"desc": "",
				"lat": "46.3699219",
				"lon": "6.4729251"
			},{
				"pic": "http://udsbat.valentinkim.org/api/test/img/2.png",
				"name": "Hotel Savoie Leman",
				"desc": "",
				"lat": "46.3726017",
				"lon": "6.4751996"
			},{
				"pic": "http://udsbat.valentinkim.org/api/test/img/3.png",
				"name": "Bodega",
				"desc": "",
				"lat": "46.3709287",
				"lon": "6.4789547"
			}
		]
	}';
	
	print $json;
?>
