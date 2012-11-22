/* IDD Core Javascript functionality */


/* JQuery Ajax Global Options and Callbacks */


$(document).ready(function() {
	if ( typeof $('#busy-indicator')=='object') {
		$('#busy-indicator').ajaxStart( function() {
			$(this).show();
		});
		$('#busy-indicator').ajaxStop( function() {
			$(this).hide();
		});
	}

	if ( typeof $('.dropdown-toggle') != 'undefined' ) {
		$('.dropdown-toggle').dropdown();
	}

$.extend($.gritter.options, { 
    position: 'top-right', // defaults to 'top-right' but can be 'bottom-left', 'bottom-right', 'top-left', 'top-right' (added in 1.7.1)
	fade_in_speed: 'fast', // how fast notifications fade in (string or int)
	fade_out_speed: 2000, // how fast the notices fade out
	time: 5000, // hang on the screen for...
	sticky: true,
});

});

function capitaliseFirstLetter(string)
{
    return string[0].toUpperCase() + string.slice(1);
}

var AxFillFormFields = function(data,form) {
	
        $.each(data,function(k,d) {
			var model=k;
			$.each(d,function(field,value) {
				elID=model+capitaliseFirstLetter(field);
				el=$('#'+form+' '+'#'+elID);
				if(typeof $(el) != undefined) {
					$(el).val(value);
				}
			});
		});
    }


/*
	In-Browser sticky alerts
	
	axAlert('buena notificacion Eliminado.', 'success');
	axAlert('Esto es por un error que ocurrio ya sabes pues', 'error');
*/
var axAlert = function(txt, type, sticky, title, icon) {
	var labelClass='';
	var iconClass='';
	
	if(typeof type == 'undefined') {
		type='info';
	}

	if(typeof sticky == 'undefined') {
		if (type!='info') sticky=true; else sticky=false;
	}
	
	if(typeof title == 'undefined') {
		title='';
	}

	switch(type) {
		case 'success':
			labelClass = 'label-success'; 
			iconClass = 'Fevorite.png';
			title = title!='' ? title : 'OK!';
			break;
		case 'alert': 
			labelClass='label-info';
			iconClass = 'Info 2.png';
			title = title!='' ? title : 'NOTIFICACION!';
			break;
		case 'error':
			labelClass = 'label-important';
			iconClass = 'Winamp.png';
			title = title!='' ? title : 'ERROR!';
			break;
		case 'warning': 
			labelClass='label-warning';
			iconClass = 'Info 2.png';
			title = title!='' ? title : 'ADVERTENCIA!';
			break;
		default:
			labelClass='label-default';
			iconClass = 'Info.png';
			title = title!='' ? title : 'ATENCION!';
	}
	
	if(typeof icon != 'undefined') {
		iconClass=icon;
	}
	
	// Generate an unique id

	return $.gritter.add({
		title: '<label class="label '+labelClass+'" style="width:95%;">'+title+' <span class="pull-right"><small><em>('+'18:30:53'+')</em></small></span></label>',
		text: txt,
		image: '/img/icons/devine/white/'+iconClass,
		fade_out_speed: 2000, // how fast the notices fade out
		time: 5000, // hang on the screen for...
		class_name: 'my-sticky-class',
		sticky: sticky,
	});
}

function getUniqueId(prefix) {
	if(typeof prefix != 'object') {
		prefix='';
	}
	return (prefix + '_' + Math.floor(Math.random()*99999));
}
