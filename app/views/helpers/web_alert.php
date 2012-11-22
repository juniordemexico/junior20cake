<?php
/**
 * Helper that captures the Session flash and renders it in proper html
 * for the twitter bootstrap alert-message styles.
 *
 * @author Joey Trapp
 *
 */
class  WebAlertHelper extends AppHelper {

	/**
	 * Helpers available in this helper
	 *
	 * @var array
	 * @access public
	 */
	public $helpers = array("Form", "Html", "Js", "Ajax", "Session", 'Number', 'Time', 'TBS');
	var $types=array(
		'info'=>array(	
				'title'=>'ATENCION:',
				'labelClass'=>'label-default',
				'iconFile'=>ICON_INFO,
				),
		'success'=>array(
				'title'=>'OK!',
				'labelClass'=>'label-primary',
				'iconFile'=>ICON_SUCCESS,
				),
		'error'=>array(
				'title'=>'ERROR!',
				'labelClass'=>'label-important',
				'iconFile'=>ICON_ERROR,
				),
		'warning'=>array(
				'title'=>'ADVERTENCIA!',
				'labelClass'=>'label-warning',
				'iconFile'=>ICON_WARNING,
				),
		'alert'=>array(
				'title'=>'NOTIFICACION:',
				'labelClass'=>'label-info',
				'iconFile'=>ICON_ALERT,
				),
		);

	// Generates a JS code snippet that will show-up 
	// a sticky alert when Document's Ready event gets fired 
	public function sticky($text='', $type='info', $sticky=null, $title=null) {
		if(!$title) {
			$title=$this->types[$type]['title'];
		}
		if(!$sticky) {
			if($type!='info') $sticky=true; else $sticky=false;
		}
		return $this->Html->scriptBlock($this->Js->domReady(
				" axAlert( '$text', '$type', ".($sticky?'true':'false').", '$title', '".$this->types[$type]['iconFile']."');"			
				), array('inline'=>false));
	}

	// Generates a JS code snippet that will show-up 
	// a sticky alert when Document's Ready event gets fired 
	public function stickyFlash($text='', $type='info', $title=null) {
		$sticky=false;
		if(!$title) {
			$title=$this->types[$type]['title'];
		}

		return $this->Html->scriptBlock($this->Js->domReady(
				" axAlertSticky( '$text', '$type', '$title'); \n"			
				), array('inline'=>false));
	}

	// Generats a JS code snippet to show a sticky alert, using user's cusomized parameters
	public function alert($text='', $options=array()) {
		if(!isset($options['type'])) {
			$options['type']='info';
		}
		if(!isset($options['title'])) {
			$options['title']=$this->types[$options['type']]['title'];
		}
		return $this->Html->scriptBlock(
"
\$.gritter.add({
	title: '<label class=\"label ".($this->types[$options['type']]['labelClass']."\" style=\"width:95%;\">".
	$title." <em>(".
	date('H:i:s').
	")</em></label>',
	text: '".$text."',
	time: ".(isset($options['time'])?$options['time']:9000).",
	fade_out_speed: ".(isset($options['fade_out_time'])?$options['fade_out_time']:1000).",
	image: '/img/icons/Devine/white/".(isset($options['iconFile'])?
											$options['iconFile']:
											$this->types[$options['type']]['iconFile']
										)."',
	sticky: ".(isset($options['sticky']) && $options['sticky']?'true':'false').",
});
"		
));
	}

/*
<?php echo $this->WebAlert->sticky('Nada pues solo SUCCESS avisando', 'success', false); ?>
<?php echo $this->WebAlert->sticky('Este fue un error', 'error'); ?>
<?php echo $this->WebAlert->sticky('Este fue un info info'); ?>
<?php echo $this->WebAlert->sticky('Esta es ALERTA pues general pues aca joe', 'alert'); ?>
*/
}