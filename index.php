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
		
		<img 
			class = "uds-item" 
			src = "img/building.png" 
			width = "200" 
			onClick = "uploadPicture(this);" 
			name = "picName"
			id = "udsBatPic"
		/>
		
		<form action="pages/updatePic.php" method="post" enctype="multipart/form-data" id="picUpdateForm">
			<input type="file" name="file" accept = "image/*" id="file" style="visibility:hidden;position:absolute;top:0;left:0"/>
		</form>
		
		
		<form method = "post" class = "uds-form" action = "pages/updateBuilding.php" id = "udsUpdate">
			<div class = "uds-item">
				<div class="input-group">
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Campus <span class="caret"></span></button>
						<ul class="dropdown-menu" role="menu" id = "campus-choice-parent">
						</ul>
					</div>
					<input name = "campus" id = "campus" type="text" class="form-control final-form" disabled>
				</div>
			</div>
			<input class = "form-control uds-item final-form" type = "text" value = "" placeholder = "Nom du bâtiment" name = "buildingName" id="bName" />
			<input class = "form-control uds-item final-form" type = "number" step = "any" value = "" placeholder = "Latitude" name = "lati" id = "lati"/>
			<input class = "form-control uds-item final-form" type = "number" step = "any" value = "" placeholder = "Longitude" name = "longi" id = "longi"/>
			</div>
			<!--<input class = "uds-textfield" type = "text" value = "" placeholder = "Altitude" name = "alti" id = "alti"/>
Ne fonctionne pas pour le moment -->
			<div class = "btn-group-lg" id = "uds-submit">
				<img class = "btn btn-primary uds-locate" src = "img/locate.png" width = "56" onClick = "updateLocation();"/>
				<input class = "btn btn-primary" type = "submit" value = "Je me rends utile !" id = "udsUpdate-submit" disabled/>
			</div>
			
		</form>
	</body>
	<script src = "js/jquery-2.1.1.min.js"></script>
	<script src = "js/bootstrap.min.js"></script>
	<script src = "js/app.js"></script>
	<script src = "js/load.anim.js"></script>
</html>
