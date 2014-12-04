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
				"pic": "dumb url"
			},
			{
				"name": "Maurienne",
				"lat": "45.6408976",
				"lon": "5.8694857",
				"pic": "dumb url"
			},
			{
				"name": "Vanoise",
				"lat": "45.6402732",
				"lon": "5.8701079",
				"pic": "dumb url"
			},
			{
				"name": "Combe de Savoie",
				"lat": "45.6411808",
				"lon": "5.8692764",
				"pic": "dumb url"
			}
		]
	}';
	
	print $toPrint;
?>	