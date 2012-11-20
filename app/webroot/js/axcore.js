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

});

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

function capitaliseFirstLetter(string)
{
    return string[0].toUpperCase() + string.slice(1);
}
