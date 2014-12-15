<?php
	include($_SERVER['DOCUMENT_ROOT'].'/api/libs/base_config.php');
	
	//var_dump($_SERVER);
	
	//$url = "https://ajax.googleapis.com/ajax/services/search/images?" .
    //   "v=1.0&q=barack%20obama&start=0&userip=" . $_SERVER['REMOTE_ADDR'];
    
    $url = "https://www.zalora.com.my/mobile-api/women/clothing?maxitems=5&page=1&sort=price&dir=desc";

	// sendRequest
	// note how referer is set manually
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_REFERER, 'udsbat.valentinkim.org');
	$body = curl_exec($ch);
	curl_close($ch);

	// now, process the JSON string
	$json_array = json_decode($body, true);
	// now have some fun with the results...
	
	var_dump($json_array['metadata']['results']);
	//print $body;
	
	//$result = $json_array['responseData']['results'];
	
	/*
	print '<html><body>';
	
	for ($i = 0; $i < count($result); $i++){
		$aux = $result[$i];
		print $aux['title'] . '<br/>';
		print '<img src = "' . $aux['url'] . '" width = "200"/><br/>';
	}
	
	print '</body></html>';
	*/
?>
