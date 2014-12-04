﻿<?php
	clearstatcache();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>UDS CAT</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/app.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	</head>
	<body class = "jumbotron">
		<div id="loaderImage"></div>
		<!--<input type = "button" id="testButton" onClick = "toggleAction();" value = "toggle"></input>-->
		
		<img 
			class = "uds-item" 
			src = "img/building.png" 
			width = "200" 
			onClick = "uploadPicture(this);" 
			name = "picName"
			id = "udsBatPic"
		/>
		
		<canvas id = "uds-canvas" class = "uds-item"></canvas>
		<form action="pages/bob.php" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" accept = "image/*" id="fileToUpload">
			<input type="submit" value="Upload Image" name="submit">
		</form>
		<!--<form method = "post" action = "pages/updatePic.php" enctype = "multipart/form-data" id = "picUpdate">-->
			
			<!--<input type = "hidden" name = "MAX_FILE_SIZE" value = "2097152"/>-->
			<!--<label for="file" style = "display: none;">Filename:</label>-->
			<!--<input type = "file" name = "file" id = "file" accept = "image/*"style = "display: none;"/>-->
			<!--<input type = "submit" value = "Envoyer" name = "submit" id = "send"/> -->
		<!--</form>-->
		<form method = "post" class = "uds-form" action = "pages/updateBuilding.php" id = "udsUpdate">
			<div class = "input-group-lg">
			<input class = "form-control uds-item" type = "text" value = "" placeholder = "Nom du bâtiment" name = "buildingName"/>
			<input class = "form-control uds-item" type = "text" value = "" placeholder = "Latitude" name = "lati" id = "lati"/>
			<input class = "form-control uds-item" type = "text" value = "" placeholder = "Longitude" name = "longi" id = "longi"/>
			</div>
			<!--<input class = "uds-textfield" type = "text" value = "" placeholder = "Altitude" name = "alti" id = "alti"/>
Ne fonctionne pas pour le moment -->
			<div class = "btn-group-lg" id = "uds-submit">
				<img class = "btn btn-primary uds-locate" src = "img/locate.png" width = "56" onClick = "updateLocation();"/>
				<input class = "btn btn-primary" type = "submit" value = "Je me rends utile !"/>
			</div>
		</form>
		<!-- Liste des bâtiments -->
	</body>
	<script src = "js/jquery-2.1.1.min.js"></script>
	<script src = "js/bootstrap.min.js"></script>
	<!--<script src = "js/jquery.form.min.js"></script>-->
	<script src = "js/app.js"></script>
	<script src = "js/load.anim.js"></script>
</html>
