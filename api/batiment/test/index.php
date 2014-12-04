<?php
	header('Content-type: application/json');
	$toPrint = '{
		"success": "true",
		"totalCount": "1",
		"data": {
				"name": "Bâtiment de test",
				"lat": "",
				"lon": "",
				"pic": ""
			}
	}';
	
	print $toPrint;
?>
