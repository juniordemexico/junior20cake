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

$.extend($.gritter.options, { 
    position: 'top-right', // defaults to 'top-right' but can be 'bottom-left', 'bottom-right', 'top-left', 'top-right' (added in 1.7.1)
	fade_in_speed: 'fast', // how fast notifications fade in (string or int)
	fade_out_speed: 1500, // how fast the notices fade out
	time: 6000, // hang on the screen for...
	sticky: 'true',
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
