<?php
/*
$this->Js->get('.renglon')->event(
'click',
"	$.ajax({
		async:true, 
		dataType:'html', 
		success:function (data, textStatus) {
					$('#content').html(data);
				},
		url:'\/".$MyController."\/".$MyRowClickAction."\/'+this.id,
	});
"
, array('stop' => true));
*/

$this->Js->get('.renglon')->event(
'click',
"
	localtion.replace('\/".$MyController."\/".'details'."\/'+this.id);
"
, array('stop' => true));

?>

