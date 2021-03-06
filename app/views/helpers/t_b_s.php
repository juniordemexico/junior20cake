<?php
/**
 * Helper that captures the Session flash and renders it in proper html
 * for the twitter bootstrap alert-message styles.
 *
 * @author Joey Trapp
 *
 */
class TBSHelper extends AppHelper {

	/**
	 * Helpers available in this helper
	 *
	 * @var array
	 * @access public
	 */
	public $helpers = array("Form", "Html", "Js", "Ajax", "Session", 'Number', 'Time', 'Text', 'WebAlert');
	
	
	// Confirm Replacement
	/**
	 * Creates an HTML link.
	 *
	 * If $url starts with "http://" this is treated as an external link. Else,
	 * it is treated as a path to controller/action and parsed with the
	 * HtmlHelper::url() method.
	 *
	 * If the $url is empty, $title is used instead.
	 *
	 * ### Options
	 *
	 * - `escape` Set to false to disable escaping of title and attributes.
	 *
	 * @param string $title The content to be wrapped by <a> tags.
	 * @param mixed $url Cake-relative URL or array of URL parameters, or external URL (starts with http://)
	 * @param array $options Array of HTML attributes.
	 * @param string $confirmMessage JavaScript confirmation message.
	 * @return string An `<a />` element.
	 * @access public
	 * @link http://book.cakephp.org/view/1442/link
	 */
		function link($title, $url = null, $options = array(), $confirmMessage = false) {
			$escapeTitle = true;
			if ($url !== null) {
				$url = $this->url($url);
			} else {
				$url = $this->url($title);
				$title = $url;
				$escapeTitle = false;
			}

			if (isset($options['escape'])) {
				$escapeTitle = $options['escape'];
			}

			if ($escapeTitle === true) {
				$title = h($title);
			} elseif (is_string($escapeTitle)) {
				$title = htmlentities($title, ENT_QUOTES, $escapeTitle);
			}

			if (!empty($options['confirm'])) {
				$confirmMessage = $options['confirm'];
				unset($options['confirm']);
			}
			
			if ($confirmMessage) {
				$confirmMessage = str_replace("'", "\'", $confirmMessage);
				$confirmMessage = str_replace('"', '\"', $confirmMessage);
				$options['onclick'] = "return bootbox.confirm('{$confirmMessage}');";
			} elseif (isset($options['default']) && $options['default'] == false) {
				if (isset($options['onclick'])) {
					$options['onclick'] .= ' event.returnValue = false; return false;';
				} else {
					$options['onclick'] = 'event.returnValue = false; return false;';
				}
				unset($options['default']);
			}
			return sprintf($this->Html->tags['link'], $url, $this->_parseAttributes($options), $title);
		}
	
	
	/**
	 * Takes an array of options to output markup that works with
	 * twitter bootstrap forms.
	 *
	 * @param array $options
	 * @access public
	 * @return string
	 */
	public function input($field, $options = array()) {

		// Checkout how the input parameters are given
		if (is_array($field)) {
			$options = $field;
			$field = $options['field'];
		} else {
			$options["field"] = $field;
		}

		if (!isset($field)) { return ''; }

		$out = $theGroup = $theHelp = $theLabel = $theControl = $theHiddenControls = 
		$theError = 
		$help_inline = $help_block = 
		$theStyleClass = 
		$theScripts = 
		$thePrepend = $theAppend = $thePrependAppendClass = 
		$theSelectOptions = 
		'';
		
		// Default options, etc...
		if(isset($options['type'])) 
			$theType=$options['type'];

		$defaults = array(
			'help_inline' => '',
			'help_block' => '',
		);

//		$options = array_merge($defaults, $options);

		// Determine both model and field parameters
		$theModel = ucfirst($this->Form->defaultModel);
		$split = explode(".", $options["field"]);
		if($split && sizeof($split)>1) {
			$theModel = ucfirst($split[0]);
			$theField = ucfirst($split[1]);
		}
		else {
			$theField = ucfirst($split[0]);
		}

		$options['field'] = $theModel.(!empty($theModel)?'.':'').$theField;

		// Introspects the Model to get field's info
		if (!isset($this->Form->fieldset[$theModel])) {
			$this->Form->_introspectModel($theModel);
		}
		
		// Get the field's metadata into the theFieldMeta variable
		if(	isset($this->Form->fieldset) &&
			array_key_exists($theModel, $this->Form->fieldset) &&
			array_key_exists('fields', $this->Form->fieldset[$theModel])
			) {
			$theFieldMeta=$this->Form->fieldset[$theModel]['fields'][strtolower($theField)];
		}
		
		// If the field's type is text or String,
		// then set the MaxLength option when it is not passed by parameter.
		if(!array_key_exists('maxlength', $options) &&
			isset($theFieldMeta) &&
			isset($theFieldMeta['length']) &&
			isset($theFieldMeta['type']) && 
			($theFieldMeta['type']=='text' || $theFieldMeta['type']=='string')
		) {
			$options['maxlength']=$theFieldMeta['length'];
		}

		// Generate a Label for the Control
		if (!isset($options['label']) || $options['label'] === false) {
			$options['label'] = '';
		} else if (!empty($options['label'])) {
			$theLabel = '<label for="'.$theModel.$theField.'" class="control-label">'.$options['label'].'</label>';
		} else {
			if(!isset($options['label']))
				$theLabel = '<label for="'.$theModel.$theField.'" class="control-label">'.$theField.'</label>';
		}
		$options['label']=false;

		// Generate de Add-On content
/*
		if(isset($options['add-on'])) {
			$theAddOn.='<span class="add-on">'.$options['add-on'].'</span>';
			$options['add-on']=null;
		}
*/
		// Generate the extra Prepend/Appended content
		if (!empty($options['prepend'])) {
			$thePrepend.=$this->Html->tag('span',$options['prepend'], array('class'=>'add-on'));
			$options['prepend']=null;
			$thePrependAppendClass="input-prepend";
		}
		if (!empty($options["append"])) {
			$theAppend.=$this->Html->tag("span",$options['append'], array('class'=>'add-on'));
			$options['append']=null;
			$thePrependAppendClass.="input-append";
		}

		// generate the error...
		list($help_inline, $help_block) = $this->_help_markup($options);

		// generate the error message for the input field, if any...
		if ($this->Form->error($field)) {
//			echo WCR.WCR."Error-${field}::".$this->Form->error($field);
			$theError = $this->Form->error($field);
			$help_block = $this->Html->tag(
				"span",
				str_replace(array('<div class="error-message">', '</div>'), '', $this->Form->error($field)),
				array("class" => "help-inline")
			);
		}

		// Get the control's layout width and define the control's style class
		if(isset($options['class'])) $theStyleClass=trim($options['class']);
		if(isset($options['ly_w'])) {
			$theStyleClass.=' span'.$options['ly_w'];
			$options['ly_w']=null;
		}
		$options['class']=trim($theStyleClass);

		if(isset($options['type']) && $options['type']=='textdate') {
			$options['type']='text';
			$theScripts.=' $(\'#'.$theModel.'.'.$options['field'].'\').datepicker({ dateFormat: \'yyyy-mm-dd\'});';
//			$options['dateFormat'] = 'DMY';
		}

		// generate the form's input control (main thing)
		$options['div']=false;

		if(isset($options['type']) && $options['type']=='radiogroup') {
			$theSelectOptions=$options['selectOptions'];
			$options['selectOptions']=null;
			$theControl = $this->Form->radio($field, $theSelectOptions,	array('label'=>'','legend'=>'','div'=>false));
		}
		elseif(isset($options['autocomplete']) && is_array($options['autocomplete'])) {
			$options['type']='text';
			$options['data-provide']='typeahead';
			$options['data-type']='json';
			$options['data-items']='16';
			$options['data-min-length']=(isset($options['autocomplete']['min-length'])?
										$options['autocomplete']['min-length']:
										'2');
			$options['data-autocomplete-url']=(isset($options['autocomplete']['url'])?
												$options['autocomplete']['url']:
												'/'.$theModel.'/'.$theField.'/'.
												'autocomplete'
												);

			// Generate the html control element
			$theControl=$this->Form->input($field, $options);

			// Gets the generated control's id
			$theControlId = $this->getHtmlElementId($theControl);

			// If was impossible to get the control's id. Determine it...
			if( !$theControlId  ) {
				$theControlId = $theModel.'.'.$theField;
			}

			// Get or Determine the hidden control's id...
			if ( isset($options['autocomplete']['addHiddenField']) ) {
				if (is_string($options['autocomplete']['addHiddenField']) && !is_array($options['autocomplete']['addHiddenField']) ) {
					$options['autocomplete']['addHiddenField']=array($options['autocomplete']['addHiddenField']);
				}

				foreach($options['autocomplete']['addHiddenField'] as $hiddenItem) {
					if(is_string($hiddenItem) && !is_array($hiddenItem) && !isset($hiddenItem['options'])) {
						$theControl.=$this->Form->hidden($hiddenItem).CR;
					}
					elseif(isset($hiddenItem['options'])) {
						$theControl.=$this->Form->hidden($hiddenItem, $hiddenItem['options'] ).CR;					
					}
				}
			}

			
			$theScripts = $this->Html->scriptBlock($this->Js->domReady('
var typeahead'.$theControlId.' = $(\'#'.$theControlId.'\');
    typeahead'.$theControlId.'.typeahead({
        source: function(typeahead, query) {
            if(this.ajax_call)
                this.ajax_call.abort();
            this.ajax_call = $.ajax({
                dataType: \'json\',
				data: {
                    keyword: query,
                     proveedor_id: $(\'#Proveedor.id\').val()
                },
                url: typeahead'.$theControlId.'.data(\'autocompleteUrl\'),
                success: function(data) {
                    typeahead.process(data);
                }
            });
        },
        property: \'value\',
        onselect: function (obj) {
			$(\'#'.$theControlId.'\').attr(\'title\', obj.title);
'.
(isset($options['autocomplete']['addHiddenField'])?'
			$(\'#'.$theControlId.'\').val(obj.id);'
:'')
.'
        }
    });
'),
array('inline'=>false)
);

/*
			$theControl= CR.'<input type="text" id="'.($theModel.'.'.$theField).'" 
		name="data['.$theModel.']['.$theField.']" class="span2"
		data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
		data-autocomplete-url="'.$options['autocomplete-url'].'"
		/>'.CR;
		// /Articulos/autocomplete/tipo:1
*/
		}
		else {
			if(isset($this->data[$theModel][strtolower($theField)]) &&
			!empty($this->data[$theModel][strtolower($theField)]) &&
				is_numeric(trim($this->data[$theModel][strtolower($theField)])) &&
				trim($this->data[$theModel][strtolower($theField)])<>'' &&
				!is_integer(trim($this->data[$theModel][strtolower($theField)]))
				)
			if(isset($options['format']) ) {
				if($options['format']==='currency' || $options['format']==='numeric') {
					if ( !isset($this->data[$theModel][strtolower($theField)]) )
						$theValue=0;
					else
						$theValue=trim($this->data[$theModel][strtolower($theField)]);
					$options['value']=$this->Number->format($theValue, array('before'=>null, 'after'=>null, 'places'=>2));
				}
				if($options['format']==='integer') {
					if ( !isset($this->data[$theModel][strtolower($theField)]) )
						$theValue=0;
					else
						$theValue=trim($this->data[$theModel][strtolower($theField)]);
					$options['value']=$this->Number->format($theValue, array('before'=>null, 'after'=>null, 'places'=>0));
				}

			}
			$options['escape']=false;
			
	//		pr($options);

			$theControl = $this->Form->input($field, $options);			
		}

		// clean the error message, if any.
		$theControl = str_replace($this->Form->error($field),'',$theControl);

/*
		if(stristr('type="text"',$theControl) ) {
			str_ireplace('type="text"', 'type="text" maxlength="'..'"');
		}
*/		
		// create the prepend-append div
		if( !empty($thePrepend) || !empty($theAppend)) {
			$controlGroup = $this->Html->tag(
							"div",
							(!empty($thePrepend)?$thePrepend:'').
							$theControl.
							(!empty($theAppend)?$theAppend:''),
							array("class" => $thePrependAppendClass));
		}
		else {
			$controlGroup = $theControl;
		}

		// control's div
		$controlGroup = $this->Html->tag(
			"div",
			$controlGroup.
			$help_inline.$help_block,
			array("class" => "controls input".(isset($options['multiple'])?' multiple-input':''))
		);

		if(!empty($theScripts)) {
			$theScripts='<script>'.$theScripts.'</script>';
		}

		// final control-group div. Set the field's style here.
		$controlGroup = $this->Html->tag(
			"div",
			$theLabel.$controlGroup.$theScripts,
			array("class" => "control-group".(!empty($theError)?' error':''))
		);

		return $controlGroup."\n";
	}

	/**
	 * Takes the options from the input method and returns an array of the
	 * inline help and inline block content wrapped in the appropriate markup. 
	 * 
	 * @param mixed $options 
	 * @access public
	 * @return string
	 */
	public function _help_markup($options) {
		$help_markup = array("help_inline" => "", "help_block" => "");
		foreach (array_keys($help_markup) as $help) {
			if (isset($options[$help]) && !empty($options[$help])) {
				$help_class = str_replace("_", "-", $help);
				$help_markup[$help] = $this->Html->tag(
					"span",
					$options[$help],
					array("class" => $help_class)
				); 
			}
		}
		return array_values($help_markup);
	}

	/**
	 * Outputs a list of radio form elements with the proper
	 * markup for twitter bootstrap styles 
	 * 
	 * @param array $options 
	 * @access public
	 * @return string
	 */
	public function radio($field, $options = array()) {
		if (is_array($field)) {
			$options["field"] = $field;
		} else {
			$options = $field;
		}
		if (!isset($options["options"]) || !isset($options["field"])) { return ""; }
		$opt = $options["options"];
		$options["options"]=null;
		$inputs = "";
		foreach ($opt as $key => $val) {
			$input = $this->Form->radio(
				$options["field"],
				array($key => $val),
				array("label" => false)
			);
			$id = array();
			preg_match_all("/id=\"[a-zA-Z0-9_-]*\"/", $input, $id);
			if (isset($id[0][1]) && !empty($id[0][1])) {
				$id = $id[0][1];
				$id = substr($id, 4);
				$id = substr($id, 0, -1);
				$input = $this->Html->tag("label", $input, array("for" => $id));
			}
			$inputs .= $this->Html->tag("li", $input);
		}
		$options["input"] = $this->Html->tag("ul", $inputs, array("class" => "inputs-list"));
		return $this->input($options);
	}

/**
 * Uses the selected JS engine to create a submit input
 * element that is enhanced with Javascript.  Options can include
 * both those for FormHelper::submit() and JsBaseEngine::request(), JsBaseEngine::event();
 *
 * Forms submitting with this method, cannot send files. Files do not transfer over XmlHttpRequest
 * and require an iframe or flash.
 *
 * ### Options
 * 
 * - `url` The url you wish the XHR request to submit to.
 * - `confirm` A string to use for a confirm() message prior to submitting the request.
 * - `method` The method you wish the form to send by, defaults to POST
 * - `buffer` Whether or not you wish the script code to be buffered, defaults to true.
 * - Also see options for JsHelper::request() and JsHelper::event()
 *
 * @param string $title The display text of the submit button.
 * @param array $options Array of options to use. See the options for the above mentioned methods.
 * @return string Completed submit button.
 * @access public
 */
	function submit($caption = null, $options = array()) {
		if (!isset($options['id'])) {
			$options['id'] = 'submit-' . intval(mt_rand());
		}
		$formOptions = array('div');
		list($options, $htmlOptions) = $this->Js->_getHtmlOptions($options, $formOptions);
		if( isset($options['escape']) ) $htmlOptions['escape']=$options['escape'];
		$htmlOptions['type']='submit';
		$out = $this->Form->button($caption, $htmlOptions);

		$this->Js->get('#' . $htmlOptions['id']);

		$options['data'] = $this->Js->serializeForm(array('isForm' => false, 'inline' => true));
		$requestString = $url = '';
		if (isset($options['confirm'])) {
			$requestString = $this->confirmReturn($options['confirm']);
			unset($options['confirm']);
		}
		if (isset($options['url'])) {
			$url = $options['url'];
			unset($options['url']);
		}
		if (!isset($options['method'])) {
			$options['method'] = 'post';
		}
		$options['dataExpression'] = true;

		$buffer = isset($options['buffer']) ? $options['buffer'] : null;
		$safe = isset($options['safe']) ? $options['safe'] : true;
		unset($options['buffer'], $options['safe']);

		$requestString .= $this->request($url, $options);
		if (!empty($requestString)) {
			$event = $this->Js->event('click', $requestString, $options + array('buffer' => $buffer));
		}
		if (isset($buffer) && !$buffer) {
			$opts = array('safe' => $safe);
			$out .= $this->Html->scriptBlock($event, $opts);
		}
		return $out;
	}

	/**
	 * Wraps the form button method and just applies the Bootstrap classes to the button
	 * before passing the options on to the FormHelper button method. 
	 * 
	 * @param string $value 
	 * @param array $options 
	 * @access public
	 * @return string
	 */
	public function button($value = "Submit", $options = array()) {
		$options = $this->button_options($options);
		return $this->Form->button($value, $options);
	}

	/**
	 * Wraps the html link method and applies the Bootstrap classes to the options array
	 * before passing it on to the html link method. 
	 * 
	 * @param mixed $title 
	 * @param mixed $url 
	 * @param array $options 
	 * @param mixed $confirm 
	 * @access public
	 * @return string
	 */
	public function button_link($title, $url, $options = array(), $confirm = false) {
		$options = $this->button_options($options);
		return $this->Html->link($title, $url, $options, $confirm);
	}

	/**
	 * Wraps the postLink method to create post links that use the bootstrap button
	 * styles. 
	 * 
	 * @param mixed $title 
	 * @param mixed $url 
	 * @param array $options 
	 * @param mixed $confirm 
	 * @access public
	 * @return string
	 */
	public function button_form($title, $url, $options = array(), $confirm = false) {
		$options = $this->button_options($options);
		return $this->Form->postLink($title, $url, $options, $confirm);
	}

	/**
	 * Takes the array of options from $this->button or $this->button_link and returns
	 * the modified array with the bootstrap classes 
	 * 
	 * @param mixed $options 
	 * @access public
	 * @return string
	 */
	public function button_options($options) {
		$valid_styles = array("danger", "info", "primary", "success");
		$valid_sizes = array("small", "large");
		$style = isset($options["style"]) ? $options["style"] : "";
		$size = isset($options["size"]) ? $options["size"] : "";
		$disabled = isset($options["disabled"]) ? (bool)$options["disabled"] : false;
		$class = "btn";
		if (!empty($style) && in_array($style, $valid_styles)) { $class .= " {$style}"; }
		if (!empty($size) && in_array($size, $valid_sizes)) { $class .= " {$size}"; }
		if ($disabled) { $class .= " disabled"; }
		unset($options["style"]);
		unset($options["size"]);
		unset($options["disabled"]);
		$options["class"] = isset($options["class"]) ? $options["class"] . " " . $class : $class;
		return $options;
	}

	/**
	 * Delegates to the HtmlHelper::getCrumbList() method and sets the proper class for the
	 * breadcrumbs class. 
	 * 
	 * @param array $options 
	 * @access public
	 * @return string
	 */
	public function breadcrumbs($options = array()) {
		return $this->getCrumbList(array_merge(array("class" => "breadcrumb"), $options));
	}

	/**
	 * Delegates to the HtmlHelper::addCrumb() method. 
	 * 
	 * @param mixed $title 
	 * @param mixed $link 
	 * @param array $options 
	 * @access public
	 * @return string
	 */
	public function add_crumb($title, $url, $options = array()) {
		return $this->Html->addCrumb($title, $url, $options);
	}

	/**
	 * Creates a Bootstrap label with $messsage and optionally the $type. Any
	 * options that could get passed to HtmlHelper::tag can be passed in the
	 * third param.
	 * 
	 * @param string $message 
	 * @param string $type 
	 * @param array $options
	 * @access public
	 * @return string
	 */
	public function label($message = "", $style = "", $options = array()) {
		$class = "label";
		$valid = array("success", "important", "warning", "notice");
		if (!empty($style) && in_array($style, $valid)) {
			$class .= " {$style}";
		}
		if (isset($options["class"]) && !empty($options["class"])) {
			$options["class"] = $class . " " . $options["class"];
		} else {
			$options["class"] = $class;
		}
		return $this->Html->tag("span", $message, $options);
	}

	/**
	 * Renders alert markup and takes a style and closable option 
	 * 
	 * @param mixed $content 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function alert($content, $options = array()) {
		$close = "";
		if ((isset($options['closable']) && $options['closable']) || !isset($options['closable']) ||true) {
			$close = '<a href="#" class="close" data-dismiss="alert">x</a>';
		}
		$style = isset($options["style"]) ? $options["style"] : "flash";
		$types = array("info", "success", "error", "warning");
		if ($style === "flash") {
			$style = "info";
		}
		if (strtolower($style) === "auth") {
			$style = "error";
		}
		if (!in_array($style, array_merge($types, array("auth", "flash")))) {
			$style = "error";
		}
		$class = "alert alert-{$style}";
		return $this->Html->tag(
			'div',
			'<h4 class="alert-heading">'.$style.'!</h4>'.
			"{$close}<p>{$content}</p>",
			array("class" => $class)
		);
	}
	
	/**
	 * Captures the Session flash if it is set and renders it in the proper
	 * markup for the twitter bootstrap styles. The default key of "flash",
	 * gets translated to the warning styles. Other valid $keys are "info",
	 * "success", "error". The $key "auth" with use the error styles because
	 * that is when the auth form fails.
	 *
	 * @param string $key
	 * @param $options
	 * @access public
	 * @return string
	 */
	public function flash($key = "flash", $options = array()) {
		$content = $this->_flash_content($key);
		if (empty($content)) { return ''; }
		$close = false;
		if ((isset($options['closable']) && $options['closable'])) {
			$close = true;
		}
		return $this->alert($content, array("style" => $key, "closable" => $close));
	}
	
	/**
	 * By default it checks $this->flash() for 5 different keys of valid
	 * flash types and returns the string.
	 *
	 * @param array $options
	 * @access public
	 * @return string
	 */
	public function myflashes($options = array()) {
		if (!isset($options["keys"]) || !$options["keys"]) {
			$options["keys"] = array("info", "success", "error", "warning", "flash");
		}
		if (isset($options["auth"]) && $options["auth"]) {
			$options["keys"][] = "auth";
			unset($options["auth"]);
		}
		$keys = $options["keys"];
		unset($options["keys"]);
		$out = '';
		foreach($keys as $key) {
			$thisFlash=$this->_flash_content($key);
			if(!empty($thisFlash)) {
				if($key=='default') {
					$out.='<div id="flashMessage" class="alert alert-info">
	<a class="close" data-dismiss="alert">×</a>
	<h4 class="alert-heading">Atencion !</h4>
	<p>'.
	$thisFlash.'
	</p>
</div>';
				}
				else {
					$out.=$thisFlash;
				}
			}
		}
		return $out;
	}

	/**
	 * By default it checks $this->flash() for 5 different keys of valid
	 * flash types and returns the string.
	 *
	 * @param array $options
	 * @access public
	 * @return string
	 */
	public function flashes($options = array()) {
		if (!isset($options["keys"]) || !$options["keys"]) {
			$options["keys"] = array("info", "success", "error", "warning", "flash");
		}
		if (isset($options["auth"]) && $options["auth"]) {
			$options["keys"][] = "auth";
			unset($options["auth"]);
		}
		$keys = $options["keys"];
		unset($options["keys"]);
		$out = '';
		foreach($keys as $key) {
			$out .= $this->flash($key, $options);
		}
		return $out;
	}


/**
 * Create a text field with Autocomplete.
 *
 * Creates an autocomplete field with the given ID and options.
 *
 * options['with'] defaults to "Form.Element.serialize('$field')",
 * but can be any valid javascript expression defining the additional fields.
 *
 * @param string $field DOM ID of field to observe
 * @param string $url URL for the autocomplete action
 * @param array $options Ajax options
 * @return string Ajax script
 * @link http://book.cakephp.org/view/1370/autoComplete
 */
	function autoComplete($field, $url = "", $options = array()) {
		$out=$this->Ajax->autocomplete($field, $url, $options);
		return $out;
	}

	/**
	 * Returns the content from SessionHelper::flash() for the passed in
	 * $key. 
	 * 
	 * @param string $key 
	 * @access public
	 * @return void
	 */
	public function _flash_content($key = "flash") {
		return $this->Session->flash($key, array("element" => null));
	}
	
	/**
	 * Displays the alert-message.block-messgae div's from the twitter
	 * bootstrap.
	 *
	 * @param string $message
	 * @param array $links
	 * @param array $options
	 * @access public
	 * @return string
	 */
	public function block($message = null, $options = array()) {
		$style = "warning";
		$valid = array("warning", "success", "info", "error");
		if (isset($options["style"]) && in_array($options["style"], $valid)) {
			$style = $options["style"];
		}
		$class = "alert-message block-message {$style}";
		$close = $links = "";
		if (isset($options["closable"]) && $options["closable"]) {
			$close = '<a href="#" class="close">x</a>';
		}
		if (isset($options["links"]) && !empty($options["links"])) {
			$links = $this->Html->tag(
				"div",
				implode("", $options["links"]),
				array("class" => "alert-actions")
			);
		}
		return $this->Html->tag("div", $close.$message.$links, array("class" => $class));
	}

	/* return the (string)ID  */
	public function getHtmlElementId( &$element ) {
		$id='';
		$idArray = array();
		preg_match_all("/id=\"[a-zA-Z0-9_-]*\"/", $element, $idArray);
		if (isset($idArray[0][0]) && !empty($idArray[0][0])) {
			$id = $idArray[0][0];
			$id = substr($id, 4, 32);
			$id = substr($id, 0, -1);
		}
		if( !empty($id) ) {
			return $id;
		}
		return false;
	}
}
