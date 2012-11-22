<?php
/**
 * Helper that captures the Session flash and renders it in proper html
 * for the twitter bootstrap alert-message styles.
 *
 * @author Joey Trapp
 *
 */
class  GritterHelper extends AppHelper {

	/**
	 * Helpers available in this helper
	 *
	 * @var array
	 * @access public
	 */
	public $helpers = array("Form", "Html", "Js", "Ajax", "Session", 'Number', 'Time');
	var $types=array(
		'info'=>array(	
				'title'=>'ATENCION:',
				'labelClass'=>'label-default',
				'iconClass'=>ICON_INFO,
				),
		'success'=>array(
				'title'=>'OK!',
				'labelClass'=>'label-warning',
				'iconClass'=>ICON_SUCCESS,
				),
		'error'=>array(
				'title'=>'ERROR!',
				'labelClass'=>'label-important',
				'iconClass'=>ICON_ERROR,
				),
		'alert'=>array(
				'title'=>'ALERTA:',
				'labelClass'=>'label-info',
				'iconClass'=>ICON_ALERT,
				),
		);

	public function alert($text='', $type='info', $title=null) {
		if(!$title) {
			$title=$this->types[$type]['title'];
		}
/*
		return $this->Html->scriptBlock($this->Js->domReady(
"
\$.gritter.add({
	title: '<label class=\"label ".$this->types[$type]['labelClass']."\" style=\"width:95%;\">".
	$title." <em>(".
	date('H:i:s').
	")</em></label>',
	text: '".$text."',
	image: '/img/icons/devine/white/".$this->types[$type]['iconClass']."',
	class_name: 'my-sticky-class',
	sticky: true,
});
"			
			), array('inline'=>false));
*/
		return $this->Html->scriptBlock($this->Js->domReady(
" axAlert( '$text', '$type', '$title'); \n"			
			), array('inline'=>false));

	}

	public function alertFlash($text='', $type='info', $title=null, $time=6000) {
		if(!$title) {
			$title=$this->types[$type]['title'];
		}
		return $this->Html->scriptBlock($this->Js->domReady(
"
\$.gritter.add({
	title: '<label class=\"label ".$this->types[$type]['labelClass']."\" style=\"width:95%;\">".
	$title." <em>(".
	date('H:i:s').
	")</em></label>',
	text: '".$text."',
	time: ".$time.",
	fade_out_speed: 3000,
	image: '/img/icons/devine/white/".$this->types[$type]['iconClass']."',
	sticky: false,
});
"			
			), array('inline'=>false));
	}

}