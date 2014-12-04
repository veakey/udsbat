<?php
	header('Content-type: application/json');
	$toPrint = '{
		"success": "true",
		"totalCount": "1",
		"data": {
			"name": "Combe de Savoie",
			"lat": "45.6411808",
			"lon": "5.8692764",
			"pic": "http://udsbat.valentinkim.org/img/x/1.png"
		}
	}';
	
	print $toPrint;
?>