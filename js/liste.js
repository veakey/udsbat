function showObj(obj, pos){
	
	var parent = obj.parentNode;
	$(parent).children().each(function(){
		$(this).removeClass('active');
	});
	$(obj).addClass('active');
	
	var grtParent = parent.parentNode;
	var grtPaChildren = grtParent.childNodes;
	var captionDiv = null;
	
	for (i = 0, len = grtPaChildren.length; i < len ; ++i){
		var aux = grtPaChildren[i];
		if ($(aux).hasClass('caption')){
			captionDiv = aux;
			break;
		}
	}
	
	switch(pos){
		case 0:
			$(captionDiv).find('.uds-desc').show(500);
			$(captionDiv).find('.uds-time').hide(500);
			$(captionDiv).find('.uds-pos').hide(500);
		break;
		case 1:
			$(captionDiv).find('.uds-desc').hide(500);
			$(captionDiv).find('.uds-time').show(500);
			$(captionDiv).find('.uds-pos').hide(500);
		break;
		default:
			$(captionDiv).find('.uds-desc').hide(500);
			$(captionDiv).find('.uds-time').hide(500);
			$(captionDiv).find('.uds-pos').show(500);
		break;
	}
}

function showCampus(obj, index){
	
	var parent = obj.parentNode;
	
	console.debug(parent);
	
	var $all = $(parent).find('.list-group-item');
	
	$all.each(function(){
		$(this).removeClass('active');
	});
	
	$(obj).addClass('active');
	
	switch(index){
		case 0:
			$(parent).find('#annecy').show(500);
			$(parent).find('#bourget').hide(500);
			$(parent).find('#jacob').hide(500);
		break;
		case 1:
			$(parent).find('#annecy').hide(500);
			$(parent).find('#bourget').show(500);
			$(parent).find('#jacob').hide(500);
		break;
		default:
			$(parent).find('#annecy').hide(500);
			$(parent).find('#bourget').hide(500);
			$(parent).find('#jacob').show(500);
		break;
	}
}

function checkDesc(obj){
	
	console.debug($(obj));
	if ($(obj).text().size() !== 0){
		$(obj).parent().find('.udsDesc-submit').each(function(){
			$(this).removeAttr('disabled');
		});
	}else{
		$(this).prop('disabled');
	}
}

function writeBuildingDetail(aux, campus){
	
	var node = aux.short;
	
	$.getJSON('http://udsbat.valentinkim.org/api/campus/' + campus + '/' + node,function(result){
		
		var mNodeData = result.data[0];
		
		var 
			imgUrl = mNodeData.pic,
			name = mNodeData.name,
			desc = mNodeData.desc === '' ? 'Pas de description pour le moment' : mNodeData.desc,
			lat = mNodeData.lat,
			lon = mNodeData.lon,
			horaire = mNodeData.horaire === null ? 'Pas d\'horaire pour le moment' : mNodeData.horaire;
		
		/*var realDesc = desc === '' ?
			'<div>' +
				'<input type="text" class="form-control" placeholder="Informations utiles à propos du bâtiment">' +
				'<input class = "btn btn-primary udsDesc-submit" type = "submit" value = "Je me rends utile !" disabled/>' +
			'</div>'
				: 
			desc;*/
		
		var toAppend = 
		'<div class="row">' +
			'<div class="col-sm-6 col-md-4">' +
				'<div class="thumbnail">' +
					'<ul class="nav nav-tabs">' +
						'<li role="presentation" class = "active uds-desc-header" onClick="showObj(this, 0);"><a href="javascript:" class="private-block">Description</a></li> ' +
						'<li role="presentation" class = "uds-time-header" onClick="showObj(this, 1);"><a href="javascript:" class="private-block">Horaire</a></li> ' +
						'<li role="presentation" class = "uds-time-header" onClick="showObj(this, 2);"><a href="javascript:" class="private-block">Position</a></li> ' +
					'</ul>' +
					'<img src="' + imgUrl + '"/>' +
					'<div class = "caption">' +
						'<div class="uds-desc">' +
							'<h3>' + name + '</h3><p>' + desc + '</p>' + 
						'</div>' +
						'<div class="uds-time">' +
							'<h3></h3>' + horaire +
						'</div>' +
						'<div class="uds-pos">' +
							'<h3></h3>' +
							'<p>Lat : ' + lat + '</p>' +
							'<p>Lon : ' + lon + '</p>' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>' +
		'</div>';
		$('#' + campus).append(toAppend);
	});
}


function writeCampus(campusFullName, index){
	var campus = campusFullName.toLowerCase().split(' ')[0];
	
	$.getJSON('http://udsbat.valentinkim.org/api/campus/' + campus,function(result){
		console.debug(result);
		var 
			mData = result.data,
			count = result.totalCount;
		var toAppend = 
		'<a href= "javascript:" class="list-group-item uds-item" onClick = "showCampus(this, ' + index + ')">' +
			'<span class="badge">' + count + '</span>' + 
			campusFullName +
		'</a>' +
		'<h3></h3>' +
		'<div class="bs-example campus" id = "' + campus + '"></div>';
		$('#corps').append(toAppend);
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
			writeCampus(aux, i);
		}
	});
}


$(document).ready(function(){
	writeBuildingList();
	
	$('input[type=text]').change(function(){
		console.debug($(this));
	});
});
