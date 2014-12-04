<?php
	header('Content-type: application/json');
	$toPrint = '{
		"success": "true",
		"totalCount": "4",
		"data": [
			{
				"name": "4 Cantons",
				"lat": "45.6405320",
				"lon": "5.8709770",
				"pic": "http://udsbat.valentinkim.org/img/x/1.png"
			},
			{
				"name": "Maurienne",
				"lat": "45.6408976",
				"lon": "5.8694857",
				"pic": "http://udsbat.valentinkim.org/img/x/1.png"
			},
			{
				"name": "Vanoise",
				"lat": "45.6402732",
				"lon": "5.8701079",
				"pic": "http://udsbat.valentinkim.org/img/x/1.png"
			},
			{
				"name": "Combe de Savoie",
				"lat": "45.6411808",
				"lon": "5.8692764",
				"pic": "http://udsbat.valentinkim.org/img/x/1.png"
			}
		]
	}';
	
	print $toPrint;
?>	