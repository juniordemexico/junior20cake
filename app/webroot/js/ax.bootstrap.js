/* AxBOS Bootstrap file */

/* Defines global symbols. Sets default settings for libraries and frameworks */
/* Instantiates, initializate and configures Classes, Libs and Frameworks. */
/* Binds the events of some UI html elements to their respective actions */
/* Execute some required hacks and workarounds to ensure full integration and
maximal portability and availability */


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

// jQuery Gritter Defaults (Visual Notifications, Growl's style)
$.extend($.gritter.options, { 
    position: 'top-right', // defaults to 'top-right' but can be 'bottom-left', 'bottom-right', 'top-left', 'top-right' (added in 1.7.1)
	fade_in_speed: 'fast', // how fast notifications fade in (string or int)
	fade_out_speed: 2000, // how fast the notices fade out
	time: 5000, // hang on the screen for...
	sticky: true,
});


}); // end: $(document).ready(func...)
