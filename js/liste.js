function writeBuddy(campusFullName){
	var campus = campusFullName.toLowerCase().split(' ')[0];
	$('#buildingName').val('');
	
	$.getJSON('http://udsbat.valentinkim.org/api/campus/' + campus,function(result){
		console.debug(result);
		var mData = result.data;
		var imgUrl = '';
		$('#corps').append('<div class = "uds-item"><h3 id="thumbnails-custom-content">' + campusFullName + '</h3><div class="bs-example" id = "' + campus + '"></div></div>');
		for(i = 0, len = mData.length; i < len; ++i){
			imgUrl = 'api/campus/' + campus + '/' + mData[i].short+ '/img/' + mData[i].pic;
			var aux = mData[i].name;
			$('#' + campus).append(
'<div class="row"><div class="col-sm-6 col-md-4"><div class="thumbnail"><img src="' + imgUrl + '"><div class="caption"><h3>' + mData[i].name + '</h3><p>' + mData[i].desc + '</p></div></div></div></div>'
			);
		}
	});
}


function writeBuildingList(){
	$.getJSON('http://udsbat.valentinkim.org/api/campus',function(result){
		console.debug(result);
		for(i = 0, len = result.data.length; i < len; ++i){
			var aux = result.data[i];
			writeBuddy(aux);
		}
	});
}


$(document).ready(function(){
	writeBuildingList();
});
