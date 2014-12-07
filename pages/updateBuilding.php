<?php
	
	$toReturn = array();
	
	foreach($_POST as $key => $value){
		$toReturn[$key] = $value;
	}
	
	echo json_encode($toReturn);
?>
