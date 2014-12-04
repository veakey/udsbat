<?php
	header('Content-type: application/json');
	$toPrint = '{
		"success": "true",
		"totalCount": "1",
		"data": {
			"name": "Vanoise",
			"lat": "45.6402732",
			"lon": "5.8701079",
			"pic": "dumb url"
		}
	}';
	
	print $toPrint;
?>