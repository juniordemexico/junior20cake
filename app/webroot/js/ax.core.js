/* AxBOS Core Javascript functionality (symbols, functions and classes) */


/*
	In-Browser sticky alerts (Based on jQuery's Gritter)
	Usage:
	axAlert('This is the text contents of an INFO alert (default)');
	axAlert('Transaction succesfully!', 'success');
	axAlert('Error while trying to connect with the host...', 'error');
	axAlert('Today is due-date for THAT TASK!', 'warning');
	axAlert('You have a new mail from he@there.no', 'notification');
*/
var axAlert = function(txt, type, sticky, title, icon) {
	var labelClass='';
	var iconClass='';
	
	if(typeof type == 'undefined' || type=='info') {
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
		case 'notification': 
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
	
	// Get Time and Date
	var currentDate = new Date();
	  var day = currentDate.getDate();
	  var month = currentDate.getMonth()+1;
	  var year = currentDate.getYear();
	  var time = currentDate.getTime();
	
	var theTimestamp = day + '/' + month + '/' + year + ' ' + time; 

	// Generate an unique id
	// (well, it's supposed )

	return $.gritter.add({
		title: '<label class="label '+labelClass+'" style="width:95%;">'+title+' <span class="pull-right"><small><em>('+theTimestamp+')</em></small></span></label>',
		text: 'nada'+txt,
		image: '/img/icons/devine/white/'+iconClass,
		fade_out_speed: 2000, // how fast the notices fade out
		time: 5000, // hang on the screen for...
		class_name: 'my-sticky-class',
		sticky: sticky,
	});
}

/* Form's functions */
var AxFillFormFields = function(data,form) {
	$.each(data,function(k,d) {
		var model=k;
		$.each(d,function(field,value) {
			elID=model+ucFirst(field);
			el=$('#'+form+' '+'#'+elID);
			if(typeof $(el) != undefined) {
				$(el).val(value);
			}
		});
	});
}

/* Generic Utilities */
var getUniqueId = function(prefix) {
	if(typeof prefix != 'object') {
		prefix='';
	}
	return (prefix + '_' + Math.floor(Math.random()*99999));
}


/* String functions */
var ucFirst = function (string)
{
    return string[0].toUpperCase() + string.slice(1);
}
