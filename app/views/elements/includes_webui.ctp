<script>
var myAxApp=angular.module('AxApp', ['ui','ui.bootstrap']);

myAxApp.value('ui.config', {
	date: {
		dateFormat: "yy-mm-dd"
	},
   	jq: {
      	datepicker: {
         	dateFormat: 'yyyy/mm/dd'
			}
		}
});

</script>
