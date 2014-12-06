<!DOCTYPE html>
<html>
	<head>
		<title>UDS BAT</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/app.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	</head>
	<body class = "jumbotron">
		<div id="loaderImage"></div>
		<canvas id = "uds-canvas" class = "uds-item"></canvas>
		<?php
			if (isset($_GET['tmp_img'])){
				print '
				<img 
					class = "uds-item" 
					src = "img/tmp.png" 
					width = "200" 
					onClick = "uploadPicture(this);" 
					name = "picName"
					id = "udsBatPic"
				/>
				';
			}else{
				print '
					<form action="pages/bob.php" method="post" enctype="multipart/form-data" id="picUpdateForm">
						<input type="file" name="file" accept = "image/*" id="file"/>
						<input id="picUpdateSubmit" type="submit" value="Envoyer" name="submit"/>
					</form>
				';
				//
			}
		?>
		
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
