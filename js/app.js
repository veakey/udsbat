var uploadPicture = function(obj){
	toggleAction();
	$('#file').click();
};

function maPosition(position) {
console.log('salut ma poule !');
	var lati = position.coords.latitude;
	var longi = position.coords.longitude;
//  var alti = position.coords.altitude;
//console.log(alti);
  //document.getElementById("lat").value = lati;
	$('#lati').attr('value', lati);
	$('#longi').attr('value', longi);
//	$('#alti').attr('value', alti);
	toggleAction();
}


function updateLocation() {
	toggleAction();
    if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(maPosition);
        console.log('if');
    } else { 
        alert("Geolocation is not supported by this browser.");
        console.log('else')
        toggleAction();
    }
}

function transformPicIntoCanvas(){
	
}


$(document).ready(function(){
	//TODO biatch !
	console.debug('should be ready by now !');
	
	$('#file').on('change', function(){
		$('#picUpdate').submit();
	});
	
	
	/*$('#file').on('change', function(){
		console.debug($(this));
		
		var input = document.getElementById('file');
		
		var filesToUpload = input.files;
		var file = filesToUpload[0];

		var img = document.createElement("img");
		var reader = new FileReader();  
		reader.onload = function(e) {img.src = e.target.result
			console.log(e.target.result);}
		
		reader.readAsDataURL(file);

		setTimeout(function(){
			var canvas = document.getElementById('uds-canvas');

			var MAX_WIDTH = 600;
			var MAX_HEIGHT = 450;
			var width = img.width;
			var height = img.height;

			if (width > height) {
			  if (width > MAX_WIDTH) {
				height *= MAX_WIDTH / width;
				width = MAX_WIDTH;
			  }
			} else {
			  if (height > MAX_HEIGHT) {
				width *= MAX_HEIGHT / height;
				height = MAX_HEIGHT;
			  }
			}
			canvas.width = width;
			canvas.height = height;
			var ctx = canvas.getContext("2d");
			ctx.drawImage(img, 0, 0, width, height);

			var dataUrl = canvas.toDataURL("image/png");
			
			console.log(dataUrl);
			//ici faire le submit...
			//toggleAction();
			
			$.ajax({
				url: 'pages/updatePic.php',//$(this).attr('action'),
				type: 'POST',//$(this).attr('method'),
				data: {image: dataUrl},//$(this).serialize(),
				//cache: false,
				//contentType: false,
				//processData: false,
				success: function(response) {
					console.log('on success');
					console.debug(response);
					//mettre à jour la photo
					setTimeout(function(){
						$('#udsBatPic').attr('src', 'img/tmp.png');
						toggleAction();
					}, 2000);
					
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
					console.error('Status: ' + textStatus);
					console.error('Error: ' + errorThrown);
				}
			});
		}, 200);

		
		
		//setTimeout(function(){
		//	tranformPicIntoCanvas();
		//});
		
		//$('#udsBatPic').attr('src','');
		//$('#picUpdate').submit();
		//toggleAction();
	});*/
	
	/*$('#picUpdate').ajaxForm(function(data) {
		//$('#result').html(data);
		setTimeout(function(data){
			$('#udsBatPic').attr('src', 'img/tmp.png');
			//console.debug(data);
			toggleAction();
		}, 2000);
		
	});*/
	
	
	$(document).on('submit', '#udsUpdate', function(e) {
		e.preventDefault();
		
		console.debug($(this).serialize());
		
		//transformer l'image en canvas
		//var dataUrl = tranformPicIntoCanvas();
		
		$.ajax({
			url: $(this).attr('action'),
			type: $(this).attr('method'),
			data: $(this).serialize(),
			success: function(response) {
				console.debug(response);
				toggleAction();
				//mettre à jour les couleurs des champs
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				console.error('Status: ' + textStatus);
				console.error('Error: ' + errorThrown);
			}
		});
		
	});
});
