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
	$('.final-form').change();
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

function transformImgToCanvas(){
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
	
	
	var blobBin = atob(dataUrl.split(',')[1]);
	var array = [];
	for(var i = 0; i < blobBin.length; i++) {
		array.push(blobBin.charCodeAt(i));
	}
	var file=new Blob([new Uint8Array(array)], {type: 'image/png'});
	
	var formData = new FormData();
	
	formData.append("file", file);
	
	return formData;
}


$(document).ready(function(){
	
	$('.campus-choice').click(function(){
		$('#campus').val($(this).text());
		$('.final-form').change();
	});
	
	$('.final-form').on('change', function(){
		var maxItems = $('.final-form').length;
		var changedItems = 0;
		$('.final-form').each(function(index){
			if ($(this).val() !== ''){
				changedItems ++;
			}
		});
		if (changedItems === maxItems){
			$('#udsUpdate-submit').removeAttr('disabled');
		}else{
			$('#udsUpdate-submit').prop('disabled', true);
		}
	});
	
	$('.final-form').keyup(function(){
		$(this).change();
	});
	
	$('.final-form').keydown(function(){
		$(this).change();
	});
	
	$('#file').on('change', function(event){
		console.debug($(this));
		
		var input = document.getElementById('file');
		
		var filesToUpload = input.files;
		var file = filesToUpload[0];

		var img = document.createElement("img");
		var reader = new FileReader();  
		reader.onload = function(e) {
			img.src = e.target.result
		};
		
		reader.readAsDataURL(file);

		setTimeout(function(){
			var formData = transformImgToCanvas();
			
			$.ajax({
			   url: "pages/bob.php",
			   type: "POST",
			   data: formData,
			   processData: false,
			   contentType: false,
			}).done(function(respond){
			  console.debug(respond);
			  setTimeout(function(){
				  d = new Date();
				  $('#udsBatPic').attr('src', 'img/tmp.png?' + d.getTime());
				  toggleAction();
				}, 500);
			  
			});
			
			return true;
		},500);
	});
	
	
	$(document).on('submit', '#udsUpdate', function(e) {
		e.preventDefault();
		toggleAction();
		
		$('.final-form').each(function(){
			$(this).removeAttr('disabled');
		});
		
		console.debug($(this).serialize());
		
		$.ajax({
			url: $(this).attr('action'),
			type: $(this).attr('method'),
			data: $(this).serialize(),
			success: function(response) {
				console.debug(response);
				toggleAction();
				$('#udsUpdate-submit').prop('disabled', true);
				//mettre à jour les couleurs des champs
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				toggleAction();
				console.error('Status: ' + textStatus);
				console.error('Error: ' + errorThrown);
			}
		});
		
	});
});
