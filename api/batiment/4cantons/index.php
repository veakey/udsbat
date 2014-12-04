<?php
	header('Content-type: application/json');
	$toPrint = '{
		"success": "true",
		"totalCount": "1",
		"data": {
			"name": "4 Cantons",
			"lat": "45.6405320",
			"lon": "5.8709770",
			"pic": "dumb url"
		}
	}';
	
	print $toPrint;
?>