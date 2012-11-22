<script>

var msg1=$.gritter.add({
	title: '<label class="label label-warning" style="width:95%;">OK! <em>(<?php e(date('H:i:s'))?>)</em></label>',
	text: 'El Item se Guardo correctamente',
	image: '/img/icons/devine/white/<?php e(ICON_SUCCESS)?>',
	class_name: 'my-sticky-class',
	sticky: 'true',
	before_close: function(e, manual_close) {
	if (!manual_close) {
		var textBox=$(e).find('INPUT#appendedInput');
		bootbox.alert('The alert was closed, your message is:<br/> ' +textBox.val());
		return false;
		}
	},
});
var msg2=$.gritter.add({
	title: '<label class="label label-important" style="width:95%;">ERROR! <em>(<?php e(date('H:i:s'))?>)</em></label>',
	text: 'El Item NO se pudo Guardar',
	image: '/img/icons/devine/white/<?php e(ICON_ERROR)?>',
	class_name: 'my-sticky-class',
	sticky: 'true',
});

var msg3=$.gritter.add({
	title: '<label class="label" style="width:95%;">Manuel Perez <em>((<?php e(date('H:i:s'))?>))</em></label>',
	text: 'Bien, este es un mensaje de aviso solamente por el <div class="input-append info"><input class="span2 stickyInput" id="appendedInput" type="text" placeholder="Respuesta..."  data-type="chat-message" data-to-userid="2131" data-in-reply-to="23123123" /><button id="btnStickyClose" class="btn btn-info" type="button"	onclick="javascript: $.gritter.remove(msg1);">Ok</button></div>',
	image: '/img/icons/devine/white/<?php e(ICON_CHAT)?>',
	class_name: 'my-sticky-class',
	sticky: 'true',
	before_close: function(e, manual_close){
	if (!manual_close) {
		var textBox=$(e).find('INPUT#appendedInput');
		bootbox.alert('The alert was closed, your message is:<br/> ' +textBox.val());
		return false;
		}
	},
});

</script>
