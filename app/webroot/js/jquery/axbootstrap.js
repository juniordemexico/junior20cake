/*
* Twitter Bootstrappifier for CakePHP 
*
* Author: Mutlu Tevfik Kocak
*
* CakePHP Twitter Bootstrappifier
*
* Selects all con twitter Bootstrap incompatible form and buttons,
* and converts them into pretty Twitter Bootstrap style.
*
*/

function axbootstrap()
{
//All submit forms wrapped to div.action
//$('input][type="submit"][class!="btn primary"]').wrap('<div class="actions" />');
//All submit forms converted to primary button
//$('input[type="submit"]').addClass('btn primary');
//All index actions converted into pretty buttons
//$('td][class="actions"] > a[class!="btn"]').addClass('btn');
//$('div[class="input text required"]').addClass('control-group');
//$('div[class="input text"]').addClass('control-group');
//$('div .input').addClass('controls');
//$('div .controls label').addClass('span2');

//$('div[class="input"]').addClass('control-group');
//All (div.inputs) with default FormHelper style (div.input > label ~ input)
//converted into Twitter Bootstrap Style (div.clearfix > label ~ div.input)

//$('div[class!="input added"].input').removeClass().addClass('clearfix');
//$('div.clearfix > label ~ input').wrap('<div class="input added" />');
//$('div.clearfix > label ~ select').wrap('<div class="input added" />');
//$('div.clearfix > label ~ textarea').wrap('<div class="input added" />');

}

//Default CakePHP Error inputs are converted to twitter bootstrap style
function axerrorstrap()
{
//	$('.message').addClass('alert-message error');
//	$('.flash_success').addClass('alert-message success');
//	$('.flash_warning').addClass('alert-message warning');
//	$('.error-message').addClass('help-inline');
//	$('div.error-message').append($('div.error-message').replaceWith('<span class="help-inline">'+$('div.error-message').text()+'</span'));
//	$('.form-error').addClass('error');
//	$('.form-error').closest('.clearfix').addClass('error');
}

//Styling start when document loads
$(document).ready(function() {
	axbootstrap();
	axerrorstrap();
});



























