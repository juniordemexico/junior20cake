<script>
var myAxApp=angular.module('AxApp', ['ui','ui.bootstrap']);

myAxApp.value('ui.config', {
	date: {
		dateFormat: "yy-mm-dd",
 			changeYear: true,
        	changeMonth: true,
        	yearRange: '-10:+2 ?>'
	},
   	jq: {
      	datepicker: {
         	dateFormat: 'yyyy-mm-dd',
 			changeYear: true,
        	changeMonth: true,
        	yearRange: '-10:+2'
			},
		tooltip: {
			placement: 'top'
		}
	}
});

</script>