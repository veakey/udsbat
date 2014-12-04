<?php
	header('Content-type: application/json');
	$toPrint = '{
		"success": "true",
		"totalCount": "1",
		"data": {
			"name": "Maurienne",
			"lat": "45.6408976",
			"lon": "5.8694857",
			"pic": "dumb url"
		}
	}';
	
	print $toPrint;
?>