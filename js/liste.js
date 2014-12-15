function writeBuildingDetail(aux, campus){
	
	var node = aux.short;
	
	$.getJSON('http://udsbat.valentinkim.org/api/campus/' + campus + '/' + node,function(result){
		
		//console.error('here##');
		console.debug(result);
		
		var mNodeData = result.data[0];
		
		var 
			imgUrl = mNodeData.pic,
			name = mNodeData.name,
			desc = mNodeData.desc,
			lat = mNodeData.lat,
			lon = mNodeData.lon;
		var toAppend = 
		'<div class="row"><div class="col-sm-6 col-md-4"><div class="thumbnail"><img src="' + 
		imgUrl + '"><div class="caption"><h3>' + name + '</h3><p>' + desc + '</p></div></div></div></div>';
		$('#' + campus).append(toAppend);		
	});
}


function writeBuddy(campusFullName){
	var campus = campusFullName.toLowerCase().split(' ')[0];
	$('#buildingName').val('');
	
	$.getJSON('http://udsbat.valentinkim.org/api/campus/' + campus,function(result){
		console.debug(result);
		var mData = result.data;
		var imgUrl = '';
		$('#corps').append('<div class = "uds-item"><h3 id="thumbnails-custom-content">' + campusFullName + '</h3><div class="bs-example" id = "' + campus + '"></div></div>');
		for(i = 0, len = mData.length; i < len; ++i){
			
			var aux = mData[i];
			
			writeBuildingDetail(aux, campus);
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
