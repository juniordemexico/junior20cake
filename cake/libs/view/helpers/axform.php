<?php
/**
 * Automatic generation of HTML FORMs from given data.
 *
 * Used for scaffolding.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.helpers
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Form helper library.
 *
 * Automatic generation of HTML FORMs from given data.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.view.helpers
 * @link http://book.cakephp.org/view/1383/Form
 */
class AxformHelper extends FormHelper {

/**
 * Other helpers used by FormHelper
 *
 * @var array
 * @access public
 */
	var $helpers = array('Html','Form');

/**
 * Holds the fields array('field_name' => array('type'=> 'string', 'length'=> 100),
 * primaryKey and validates array('field_name')
 *
 * @access public
 */
	var $fieldset = array();

/**
 * Options used by DateTime fields
 *
 * @var array
 */
	var $__options = array(
		'day' => array(), 'minute' => array(), 'hour' => array(),
		'month' => array(), 'year' => array(), 'meridian' => array()
	);

/**
 * List of fields created, used with secure forms.
 *
 * @var array
 * @access public
 */
	var $fields = array();

/**
 * Defines the type of form being created.  Set by FormHelper::create().
 *
 * @var string
 * @access public
 */
	var $requestType = null;

/**
 * The default model being used for the current form.
 *
 * @var string
 * @access public
 */
	var $defaultModel = null;


/**
 * Persistent default options used by input(). Set by FormHelper::create().
 *
 * @var array
 * @access protected
 */
	var $_inputDefaults = array();

/**
 * Introspects model information and extracts information related
 * to validation, field length and field type. Appends information into
 * $this->fieldset.
 *
 * @return Model Returns a model instance
 * @access protected
 */
	function &_introspectModel($model) {
		$object = null;
		if (is_string($model) && strpos($model, '.') !== false) {
			$path = explode('.', $model);
			$model = end($path);
		}

		if (ClassRegistry::isKeySet($model)) {
			$object =& ClassRegistry::getObject($model);
		}

		if (!empty($object)) {
			$fields = $object->schema();
			foreach ($fields as $key => $value) {
				unset($fields[$key]);
				$fields[$key] = $value;
			}

			if (!empty($object->hasAndBelongsToMany)) {
				foreach ($object->hasAndBelongsToMany as $alias => $assocData) {
					$fields[$alias] = array('type' => 'multiple');
				}
			}
			$validates = array();
			if (!empty($object->validate)) {
				foreach ($object->validate as $validateField => $validateProperties) {
					if ($this->_isRequiredField($validateProperties)) {
						$validates[] = $validateField;
					}
				}
			}
			$defaults = array('fields' => array(), 'key' => 'id', 'validates' => array());
			$key = $object->primaryKey;
			$this->fieldset[$model] = array_merge($defaults, compact('fields', 'key', 'validates'));
		}

		return $object;
	}



/**
 * Generates a form input element complete with label and wrapper div
 *
 * ### Options
 *
 * See each field type method for more information. Any options that are part of
 * $attributes or $options for the different **type** methods can be included in `$options` for input().i
 * Additionally, any unknown keys that are not in the list below, or part of the selected type's options
 * will be treated as a regular html attribute for the generated input.
 *
 * - `type` - Force the type of widget you want. e.g. `type => 'select'`
 * - `label` - Either a string label, or an array of options for the label. See FormHelper::label()
 * - `div` - Either `false` to disable the div, or an array of options for the div.
 *    See HtmlHelper::div() for more options.
 * - `options` - for widgets that take options e.g. radio, select
 * - `error` - control the error message that is produced
 * - `empty` - String or boolean to enable empty select box options.
 * - `before` - Content to place before the label + input.
 * - `after` - Content to place after the label + input.
 * - `between` - Content to place between the label + input.
 * - `format` - format template for element order. Any element that is not in the array, will not be in the output.
 *    - Default input format order: array('before', 'label', 'between', 'input', 'after', 'error')
 *    - Default checkbox format order: array('before', 'input', 'between', 'label', 'after', 'error')
 *    - Hidden input will not be formatted
 *    - Radio buttons cannot have the order of input and label elements controlled with these settings.
 *
 * @param string $fieldName This should be "Modelname.fieldname"
 * @param array $options Each type of input takes different options.
 * @return string Completed form widget.
 * @access public
 * @link http://book.cakephp.org/view/1390/Automagic-Form-Elements
 */
	function input($fieldName, $options = array()) {
		$this->setEntity($fieldName);

		$options = array_merge(
			array('before' => null, 'between' => null, 'after' => null, 'format' => null),
			$this->_inputDefaults,
			$options
		);

		$modelKey = $this->model();
		$fieldKey = $this->field();
		if (!isset($this->fieldset[$modelKey])) {
			$this->_introspectModel($modelKey);
		}

		if (!isset($options['type'])) {
			$magicType = true;
			$options['type'] = 'text';
			if (isset($options['options'])) {
				$options['type'] = 'select';
			} elseif (in_array($fieldKey, array('psword', 'passwd', 'password'))) {
				$options['type'] = 'password';
			} elseif (isset($this->fieldset[$modelKey]['fields'][$fieldKey])) {
				$fieldDef = $this->fieldset[$modelKey]['fields'][$fieldKey];
				$type = $fieldDef['type'];
				$primaryKey = $this->fieldset[$modelKey]['key'];
			}

			if (isset($type)) {
				$map = array(
					'string'  => 'text',     'datetime'  => 'datetime',
					'boolean' => 'checkbox', 'timestamp' => 'datetime',
					'text'    => 'textarea', 'time'      => 'time',
					'date'    => 'date',     'float'     => 'text'
				);

				if (isset($this->map[$type])) {
					$options['type'] = $this->map[$type];
				} elseif (isset($map[$type])) {
					$options['type'] = $map[$type];
				}
				if ($fieldKey == $primaryKey) {
					$options['type'] = 'hidden';
				}
			}
			if (preg_match('/_id$/', $fieldKey) && $options['type'] !== 'hidden') {
				$options['type'] = 'select';
			}

			if ($modelKey === $fieldKey) {
				$options['type'] = 'select';
				if (!isset($options['multiple'])) {
					$options['multiple'] = 'multiple';
				}
			}
		}
		$types = array('checkbox', 'radio', 'select');

		if (
			(!isset($options['options']) && in_array($options['type'], $types)) ||
			(isset($magicType) && $options['type'] == 'text')
		) {
			$view =& ClassRegistry::getObject('view');
			$varName = Inflector::variable(
				Inflector::pluralize(preg_replace('/_id$/', '', $fieldKey))
			);
			$varOptions = $view->getVar($varName);
			if (is_array($varOptions)) {
				if ($options['type'] !== 'radio') {
					$options['type'] = 'select';
				}
				$options['options'] = $varOptions;
			}
		}

		$autoLength = (!array_key_exists('maxlength', $options) && isset($fieldDef['length']));
		if ($autoLength && $options['type'] == 'text') {
			$options['maxlength'] = $fieldDef['length'];
		}
		if ($autoLength && $fieldDef['type'] == 'float') {
			$options['maxlength'] = array_sum(explode(',', $fieldDef['length']))+1;
		}

		$divOptions = array();
		$div = $this->_extractOption('div', $options, true);
		unset($options['div']);

		if (!empty($div)) {
			$divOptions['class'] = 'input';
			$divOptions = $this->addClass($divOptions, $options['type']);
			if (is_string($div)) {
				$divOptions['class'] = $div;
			} elseif (is_array($div)) {
				$divOptions = array_merge($divOptions, $div);
			}
			if (
				isset($this->fieldset[$modelKey]) &&
				in_array($fieldKey, $this->fieldset[$modelKey]['validates'])
			) {
				$divOptions = $this->addClass($divOptions, 'required');
			}
			if (!isset($divOptions['tag'])) {
				$divOptions['tag'] = 'div';
			}
		}

		$label = null;
		if (isset($options['label']) && $options['type'] !== 'radio') {
			$label = $options['label'];
			unset($options['label']);
		}

		if ($options['type'] === 'radio') {
			$label = false;
			if (isset($options['options'])) {
				$radioOptions = (array)$options['options'];
				unset($options['options']);
			}
		}

		if ($label !== false) {
			$label = $this->_inputLabel($fieldName, $label, $options);
		}

		$error = $this->_extractOption('error', $options, null);
		unset($options['error']);

		$selected = $this->_extractOption('selected', $options, null);
		unset($options['selected']);

		if (isset($options['rows']) || isset($options['cols'])) {
			$options['type'] = 'textarea';
		}

		if ($options['type'] === 'datetime' || $options['type'] === 'date' || $options['type'] === 'time' || $options['type'] === 'select') {
			$options += array('empty' => false);
		}
		if ($options['type'] === 'datetime' || $options['type'] === 'date' || $options['type'] === 'time') {
			$dateFormat = $this->_extractOption('dateFormat', $options, 'MDY');
			$timeFormat = $this->_extractOption('timeFormat', $options, 12);
			unset($options['dateFormat'], $options['timeFormat']);
		}

		$type = $options['type'];
		$out = array_merge(
			array('before' => null, 'label' => null, 'between' => null, 'input' => null, 'after' => null, 'error' => null),
			array('before' => $options['before'], 'label' => $label, 'between' => $options['between'], 'after' => $options['after'])
		);
		$format = null;
		if (is_array($options['format']) && in_array('input', $options['format'])) {
			$format = $options['format'];
		}
		unset($options['type'], $options['before'], $options['between'], $options['after'], $options['format']);

		switch ($type) {
			case 'hidden':
				$input = $this->hidden($fieldName, $options);
				$format = array('input');
				unset($divOptions);
			break;
			case 'checkbox':
				$input = $this->checkbox($fieldName, $options);
				$format = $format ? $format : array('before', 'input', 'between', 'label', 'after', 'error');
			break;
			case 'radio':
				$input = $this->radio($fieldName, $radioOptions, $options);
			break;
			case 'text':
			case 'password':
			case 'file':
				$input = $this->{$type}($fieldName, $options);
			break;
			case 'select':
				$options += array('options' => array());
				$list = $options['options'];
				unset($options['options']);
				$input = $this->select($fieldName, $list, $selected, $options);
			break;
			case 'time':
				$input = $this->dateTime($fieldName, null, $timeFormat, $selected, $options);
			break;
			case 'date':
				$input = $this->dateTime($fieldName, $dateFormat, null, $selected, $options);
			break;
			case 'datetime':
				$input = $this->dateTime($fieldName, $dateFormat, $timeFormat, $selected, $options);
			break;
			case 'textarea':
			default:
				$input = $this->textarea($fieldName, $options + array('cols' => '30', 'rows' => '6'));
			break;
		}

		if ($type != 'hidden' && $error !== false) {
			$errMsg = $this->error($fieldName, $error);
			if ($errMsg) {
				$divOptions = $this->addClass($divOptions, 'error');
				$out['error'] = $errMsg;
			}
		}

		$out['input'] = $input;
		$format = $format ? $format : array('before', 'label', 'between', 'input', 'after', 'error');
		$output = '';
		foreach ($format as $element) {
			$output .= $out[$element];
			unset($out[$element]);
		}

		if (!empty($divOptions['tag'])) {
			$tag = $divOptions['tag'];
			unset($divOptions['tag']);
			$output = $this->Html->tag($tag, $output, $divOptions);
		}
		return $output;
	}


/**
 * Creates a checkbox input widget.
 *
 * ### Options:
 *
 * - `value` - the value of the checkbox
 * - `checked` - boolean indicate that this checkbox is checked.
 * - `hiddenField` - boolean to indicate if you want the results of checkbox() to include
 *    a hidden input with a value of ''.
 * - `disabled` - create a disabled input.
 *
 * @param string $fieldName Name of a field, like this "Modelname.fieldname"
 * @param array $options Array of HTML attributes.
 * @return string An HTML text input element.
 * @access public
 * @link http://book.cakephp.org/view/1414/checkbox
 */
	function checkbox($fieldName, $options = array()) {
		$options = $this->_initInputField($fieldName, $options) + array('hiddenField' => true);
		$value = current($this->value());
		$output = "";

		if (empty($options['value'])) {
			$options['value'] = 1;
		} elseif (
			(!isset($options['checked']) && !empty($value) && $value === $options['value']) ||
			!empty($options['checked'])
		) {
			$options['checked'] = 'checked';
		}
		if ($options['hiddenField']) {
			$hiddenOptions = array(
				'id' => $options['id'] . '_', 'name' => $options['name'],
				'value' => '0', 'secure' => false
			);
			if (isset($options['disabled']) && $options['disabled'] == true) {
				$hiddenOptions['disabled'] = 'disabled';
			}
			$output = $this->hidden($fieldName, $hiddenOptions);
		}
		unset($options['hiddenField']);

		return $output . sprintf(
			$this->Html->tags['checkbox'],
			$options['name'],
			$this->_parseAttributes($options, array('name'), null, ' ')
		);
	}

/**
 * Creates a set of radio widgets. Will create a legend and fieldset
 * by default.  Use $options to control this
 *
 * ### Attributes:
 *
 * - `separator` - define the string in between the radio buttons
 * - `legend` - control whether or not the widget set has a fieldset & legend
 * - `value` - indicate a value that is should be checked
 * - `label` - boolean to indicate whether or not labels for widgets show be displayed
 * - `hiddenField` - boolean to indicate if you want the results of radio() to include
 *    a hidden input with a value of ''. This is useful for creating radio sets that non-continuous
 *
 * @param string $fieldName Name of a field, like this "Modelname.fieldname"
 * @param array $options Radio button options array.
 * @param array $attributes Array of HTML attributes, and special attributes above.
 * @return string Completed radio widget set.
 * @access public
 * @link http://book.cakephp.org/view/1429/radio
 */
	function radio($fieldName, $options = array(), $attributes = array()) {
		$attributes = $this->_initInputField($fieldName, $attributes);
		$legend = false;

		if (isset($attributes['legend'])) {
			$legend = $attributes['legend'];
			unset($attributes['legend']);
		} elseif (count($options) > 1) {
			$legend = __(Inflector::humanize($this->field()), true);
		}
		$label = true;

		if (isset($attributes['label'])) {
			$label = $attributes['label'];
			unset($attributes['label']);
		}
		$inbetween = null;

		if (isset($attributes['separator'])) {
			$inbetween = $attributes['separator'];
			unset($attributes['separator']);
		}

		if (isset($attributes['value'])) {
			$value = $attributes['value'];
		} else {
			$value =  $this->value($fieldName);
		}
		$out = array();

		$hiddenField = isset($attributes['hiddenField']) ? $attributes['hiddenField'] : true;
		unset($attributes['hiddenField']);

		foreach ($options as $optValue => $optTitle) {
			$optionsHere = array('value' => $optValue);

			if (isset($value) && $optValue == $value) {
				$optionsHere['checked'] = 'checked';
			}
			$parsedOptions = $this->_parseAttributes(
				array_merge($attributes, $optionsHere),
				array('name', 'type', 'id'), '', ' '
			);
			$tagName = Inflector::camelize(
				$attributes['id'] . '_' . Inflector::slug($optValue)
			);

			if ($label) {
				$optTitle =  sprintf($this->Html->tags['label'], $tagName, null, $optTitle);
			}
			$out[] =  sprintf(
				$this->Html->tags['radio'], $attributes['name'],
				$tagName, $parsedOptions, $optTitle
			);
		}
		$hidden = null;

		if ($hiddenField) {
			if (!isset($value) || $value === '') {
				$hidden = $this->hidden($fieldName, array(
					'id' => $attributes['id'] . '_', 'value' => '', 'name' => $attributes['name']
				));
			}
		}
		$out = $hidden . implode($inbetween, $out);

		if ($legend) {
			$out = sprintf(
				$this->Html->tags['fieldset'], '',
				sprintf($this->Html->tags['legend'], $legend) . $out
			);
		}
		return $out;
	}

/**
 * Creates a text input widget.
 *
 * @param string $fieldName Name of a field, in the form "Modelname.fieldname"
 * @param array $options Array of HTML attributes.
 * @return string A generated HTML text input element
 * @access public
 * @link http://book.cakephp.org/view/1432/text
 */
	function text($fieldName, $options = array()) {
		$options = $this->_initInputField($fieldName, array_merge(
			array('type' => 'text'), $options
		));
		return sprintf(
			$this->Html->tags['input'],
			$options['name'],
			$this->_parseAttributes($options, array('name'), null, ' ')
		);
	}


/**
 * Creates a textarea widget.
 *
 * ### Options:
 *
 * - `escape` - Whether or not the contents of the textarea should be escaped. Defaults to true.
 *
 * @param string $fieldName Name of a field, in the form "Modelname.fieldname"
 * @param array $options Array of HTML attributes, and special options above.
 * @return string A generated HTML text input element
 * @access public
 * @link http://book.cakephp.org/view/1433/textarea
 */
	function textarea($fieldName, $options = array()) {
		$options = $this->_initInputField($fieldName, $options);
		$value = null;

		if (array_key_exists('value', $options)) {
			$value = $options['value'];
			if (!array_key_exists('escape', $options) || $options['escape'] !== false) {
				$value = h($value);
			}
			unset($options['value']);
		}
		return sprintf(
			$this->Html->tags['textarea'],
			$options['name'],
			$this->_parseAttributes($options, array('type', 'name'), null, ' '),
			$value
		);
	}

/**
 * Creates a hidden input field.
 *
 * @param string $fieldName Name of a field, in the form of "Modelname.fieldname"
 * @param array $options Array of HTML attributes.
 * @return string A generated hidden input
 * @access public
 * @link http://book.cakephp.org/view/1425/hidden
 */
	function hidden($fieldName, $options = array()) {
		$secure = true;

		if (isset($options['secure'])) {
			$secure = $options['secure'];
			unset($options['secure']);
		}
		$options = $this->_initInputField($fieldName, array_merge(
			$options, array('secure' => false)
		));
		$model = $this->model();

		if ($fieldName !== '_method' && $model !== '_Token' && $secure) {
			$this->__secure(null, '' . $options['value']);
		}

		return sprintf(
			$this->Html->tags['hidden'],
			$options['name'],
			$this->_parseAttributes($options, array('name', 'class'), '', ' ')
		);
	}

/**
 * Creates a `<button>` tag.  The type attribute defaults to `type="submit"`
 * You can change it to a different value by using `$options['type']`.
 *
 * ### Options:
 *
 * - `escape` - HTML entity encode the $title of the button. Defaults to false.
 *
 * @param string $title The button's caption. Not automatically HTML encoded
 * @param array $options Array of options and HTML attributes.
 * @return string A HTML button tag.
 * @access public
 * @link http://book.cakephp.org/view/1415/button
 */
	function button($title, $options = array()) {
		$options += array('type' => 'submit', 'escape' => false);
		if ($options['escape']) {
			$title = h($title);
		}
		return sprintf(
			$this->Html->tags['button'],
			$options['type'],
			$this->_parseAttributes($options, array('type'), ' ', ''),
			$title
		);
	}

/**
 * Creates a submit button element.  This method will generate `<input />` elements that
 * can be used to submit, and reset forms by using $options.  image submits can be created by supplying an
 * image path for $caption.
 *
 * ### Options
 *
 * - `div` - Include a wrapping div?  Defaults to true.  Accepts sub options similar to
 *   FormHelper::input().
 * - `before` - Content to include before the input.
 * - `after` - Content to include after the input.
 * - `type` - Set to 'reset' for reset inputs.  Defaults to 'submit'
 * - Other attributes will be assigned to the input element.
 *
 * ### Options
 *
 * - `div` - Include a wrapping div?  Defaults to true.  Accepts sub options similar to
 *   FormHelper::input().
 * - Other attributes will be assigned to the input element.
 *
 * @param string $caption The label appearing on the button OR if string contains :// or the
 *  extension .jpg, .jpe, .jpeg, .gif, .png use an image if the extension
 *  exists, AND the first character is /, image is relative to webroot,
 *  OR if the first character is not /, image is relative to webroot/img.
 * @param array $options Array of options.  See above.
 * @return string A HTML submit button
 * @access public
 * @link http://book.cakephp.org/view/1431/submit
 */
	function submit($caption = null, $options = array()) {
		if (!is_string($caption) && empty($caption)) {
			$caption = __('Submit', true);
		}
		$out = null;
		$div = true;

		if (isset($options['div'])) {
			$div = $options['div'];
			unset($options['div']);
		}
		$options += array('type' => 'submit', 'before' => null, 'after' => null);
		$divOptions = array('tag' => 'div');

		if ($div === true) {
			$divOptions['class'] = 'submit';
		} elseif ($div === false) {
			unset($divOptions);
		} elseif (is_string($div)) {
			$divOptions['class'] = $div;
		} elseif (is_array($div)) {
			$divOptions = array_merge(array('class' => 'submit', 'tag' => 'div'), $div);
		}

		$before = $options['before'];
		$after = $options['after'];
		unset($options['before'], $options['after']);

		if (strpos($caption, '://') !== false) {
			unset($options['type']);
			$out .=  $before . sprintf(
				$this->Html->tags['submitimage'],
				$caption,
				$this->_parseAttributes($options, null, '', ' ')
			) . $after;
		} elseif (preg_match('/\.(jpg|jpe|jpeg|gif|png|ico)$/', $caption)) {
			unset($options['type']);
			if ($caption{0} !== '/') {
				$url = $this->webroot(IMAGES_URL . $caption);
			} else {
				$caption = trim($caption, '/');
				$url = $this->webroot($caption);
			}
			$out .= $before . sprintf(
				$this->Html->tags['submitimage'],
				$url,
				$this->_parseAttributes($options, null, '', ' ')
			) . $after;
		} else {
			$options['value'] = $caption;
			$out .= $before . sprintf(
				$this->Html->tags['submit'],
				$this->_parseAttributes($options, null, '', ' ')
			). $after;
		}

		if (isset($divOptions)) {
			$tag = $divOptions['tag'];
			unset($divOptions['tag']);
			$out = $this->Html->tag($tag, $out, $divOptions);
		}
		return $out;
	}

/**
 * Returns a formatted SELECT element.
 *
 * ### Attributes:
 *
 * - `showParents` - If included in the array and set to true, an additional option element
 *   will be added for the parent of each option group. You can set an option with the same name
 *   and it's key will be used for the value of the option.
 * - `multiple` - show a multiple select box.  If set to 'checkbox' multiple checkboxes will be
 *   created instead.
 * - `empty` - If true, the empty select option is shown.  If a string,
 *   that string is displayed as the empty element.
 * - `escape` - If true contents of options will be HTML entity encoded. Defaults to true.
 * - `class` - When using multiple = checkbox the classname to apply to the divs. Defaults to 'checkbox'.
 *
 * ### Using options
 *
 * A simple array will create normal options:
 *
 * {{{
 * $options = array(1 => 'one', 2 => 'two);
 * $this->Form->select('Model.field', $options));
 * }}}
 *
 * While a nested options array will create optgroups with options inside them.
 * {{{
 * $options = array(
 *    1 => 'bill',
 *    'fred' => array(
 *        2 => 'fred',
 *        3 => 'fred jr.'
 *     )
 * );
 * $this->Form->select('Model.field', $options);
 * }}}
 *
 * In the above `2 => 'fred'` will not generate an option element.  You should enable the `showParents`
 * attribute to show the fred option.
 *
 * @param string $fieldName Name attribute of the SELECT
 * @param array $options Array of the OPTION elements (as 'value'=>'Text' pairs) to be used in the
 *    SELECT element
 * @param mixed $selected The option selected by default.  If null, the default value
 *   from POST data will be used when available.
 * @param array $attributes The HTML attributes of the select element.
 * @return string Formatted SELECT element
 * @access public
 * @link http://book.cakephp.org/view/1430/select
 */
	function select($fieldName, $options = array(), $selected = null, $attributes = array()) {
		$select = array();
		$style = null;
		$tag = null;
		$attributes += array(
			'class' => null,
			'escape' => true,
			'secure' => null,
			'empty' => '',
			'showParents' => false,
			'hiddenField' => true
		);

		$escapeOptions = $this->_extractOption('escape', $attributes);
		$secure = $this->_extractOption('secure', $attributes);
		$showEmpty = $this->_extractOption('empty', $attributes);
		$showParents = $this->_extractOption('showParents', $attributes);
		$hiddenField = $this->_extractOption('hiddenField', $attributes);
		unset($attributes['escape'], $attributes['secure'], $attributes['empty'], $attributes['showParents'], $attributes['hiddenField']);

		$attributes = $this->_initInputField($fieldName, array_merge(
			(array)$attributes, array('secure' => false)
		));

		if (is_string($options) && isset($this->__options[$options])) {
			$options = $this->__generateOptions($options);
		} elseif (!is_array($options)) {
			$options = array();
		}
		if (isset($attributes['type'])) {
			unset($attributes['type']);
		}

		if (!isset($selected)) {
			$selected = $attributes['value'];
		}

		if (!empty($attributes['multiple'])) {
			$style = ($attributes['multiple'] === 'checkbox') ? 'checkbox' : null;
			$template = ($style) ? 'checkboxmultiplestart' : 'selectmultiplestart';
			$tag = $this->Html->tags[$template];
			if ($hiddenField) {
				$hiddenAttributes = array(
					'value' => '',
					'id' => $attributes['id'] . ($style ? '' : '_'),
					'secure' => false,
					'name' => $attributes['name']
				);
				$select[] = $this->hidden(null, $hiddenAttributes);
			}
		} else {
			$tag = $this->Html->tags['selectstart'];
		}

		if (!empty($tag) || isset($template)) {
			if (!isset($secure) || $secure == true) {
				$this->__secure();
			}
			$select[] = sprintf($tag, $attributes['name'], $this->_parseAttributes(
				$attributes, array('name', 'value'))
			);
		}
		$emptyMulti = (
			$showEmpty !== null && $showEmpty !== false && !(
				empty($showEmpty) && (isset($attributes) &&
				array_key_exists('multiple', $attributes))
			)
		);

		if ($emptyMulti) {
			$showEmpty = ($showEmpty === true) ? '' : $showEmpty;
			$options = array_reverse($options, true);
			$options[''] = $showEmpty;
			$options = array_reverse($options, true);
		}

		$select = array_merge($select, $this->__selectOptions(
			array_reverse($options, true),
			$selected,
			array(),
			$showParents,
			array('escape' => $escapeOptions, 'style' => $style, 'name' => $attributes['name'], 'class' => $attributes['class'])
		));

		$template = ($style == 'checkbox') ? 'checkboxmultipleend' : 'selectend';
		$select[] = $this->Html->tags[$template];
		return implode("\n", $select);
	}





/**
 * Creates a checkbox input widget.
 *
 * ### Options:
 *
 * - `value` - the value of the checkbox
 * - `checked` - boolean indicate that this checkbox is checked.
 * - `hiddenField` - boolean to indicate if you want the results of checkbox() to include
 *    a hidden input with a value of ''.
 * - `disabled` - create a disabled input.
 *
 * @param string $fieldName Name of a field, like this "Modelname.fieldname"
 * @param array $options Array of HTML attributes.
 * @return string An HTML text input element.
 * @access public
 * @link http://book.cakephp.org/view/1414/checkbox
 */
	function checkbox($fieldName, $options = array()) {
		$options = $this->_initInputField($fieldName, $options) + array('hiddenField' => true);
		$value = current($this->value());
		$output = "";

		if (empty($options['value'])) {
			$options['value'] = 1;
		} elseif (
			(!isset($options['checked']) && !empty($value) && $value === $options['value']) ||
			!empty($options['checked'])
		) {
			$options['checked'] = 'checked';
		}
		if ($options['hiddenField']) {
			$hiddenOptions = array(
				'id' => $options['id'] . '_', 'name' => $options['name'],
				'value' => '0', 'secure' => false
			);
			if (isset($options['disabled']) && $options['disabled'] == true) {
				$hiddenOptions['disabled'] = 'disabled';
			}
			$output = $this->hidden($fieldName, $hiddenOptions);
		}
		unset($options['hiddenField']);

		return $output . sprintf(
			$this->Html->tags['checkbox'],
			$options['name'],
			$this->_parseAttributes($options, array('name'), null, ' ')
		);
	}

/**
 * Creates a set of radio widgets. Will create a legend and fieldset
 * by default.  Use $options to control this
 *
 * ### Attributes:
 *
 * - `separator` - define the string in between the radio buttons
 * - `legend` - control whether or not the widget set has a fieldset & legend
 * - `value` - indicate a value that is should be checked
 * - `label` - boolean to indicate whether or not labels for widgets show be displayed
 * - `hiddenField` - boolean to indicate if you want the results of radio() to include
 *    a hidden input with a value of ''. This is useful for creating radio sets that non-continuous
 *
 * @param string $fieldName Name of a field, like this "Modelname.fieldname"
 * @param array $options Radio button options array.
 * @param array $attributes Array of HTML attributes, and special attributes above.
 * @return string Completed radio widget set.
 * @access public
 * @link http://book.cakephp.org/view/1429/radio
 */
	function radio($fieldName, $options = array(), $attributes = array()) {
		$attributes = $this->_initInputField($fieldName, $attributes);
		$legend = false;

		if (isset($attributes['legend'])) {
			$legend = $attributes['legend'];
			unset($attributes['legend']);
		} elseif (count($options) > 1) {
			$legend = __(Inflector::humanize($this->field()), true);
		}
		$label = true;

		if (isset($attributes['label'])) {
			$label = $attributes['label'];
			unset($attributes['label']);
		}
		$inbetween = null;

		if (isset($attributes['separator'])) {
			$inbetween = $attributes['separator'];
			unset($attributes['separator']);
		}

		if (isset($attributes['value'])) {
			$value = $attributes['value'];
		} else {
			$value =  $this->value($fieldName);
		}
		$out = array();

		$hiddenField = isset($attributes['hiddenField']) ? $attributes['hiddenField'] : true;
		unset($attributes['hiddenField']);

		foreach ($options as $optValue => $optTitle) {
			$optionsHere = array('value' => $optValue);

			if (isset($value) && $optValue == $value) {
				$optionsHere['checked'] = 'checked';
			}
			$parsedOptions = $this->_parseAttributes(
				array_merge($attributes, $optionsHere),
				array('name', 'type', 'id'), '', ' '
			);
			$tagName = Inflector::camelize(
				$attributes['id'] . '_' . Inflector::slug($optValue)
			);

			if ($label) {
				$optTitle =  sprintf($this->Html->tags['label'], $tagName, null, $optTitle);
			}
			$out[] =  sprintf(
				$this->Html->tags['radio'], $attributes['name'],
				$tagName, $parsedOptions, $optTitle
			);
		}
		$hidden = null;

		if ($hiddenField) {
			if (!isset($value) || $value === '') {
				$hidden = $this->hidden($fieldName, array(
					'id' => $attributes['id'] . '_', 'value' => '', 'name' => $attributes['name']
				));
			}
		}
		$out = $hidden . implode($inbetween, $out);

		if ($legend) {
			$out = sprintf(
				$this->Html->tags['fieldset'], '',
				sprintf($this->Html->tags['legend'], $legend) . $out
			);
		}
		return $out;
	}

/**
 * Creates a text input widget.
 *
 * @param string $fieldName Name of a field, in the form "Modelname.fieldname"
 * @param array $options Array of HTML attributes.
 * @return string A generated HTML text input element
 * @access public
 * @link http://book.cakephp.org/view/1432/text
 */
	function text($fieldName, $options = array()) {
		$options = $this->_initInputField($fieldName, array_merge(
			array('type' => 'text'), $options
		));
		return sprintf(
			$this->Html->tags['input'],
			$options['name'],
			$this->_parseAttributes($options, array('name'), null, ' ')
		);
	}


/**
 * Creates a textarea widget.
 *
 * ### Options:
 *
 * - `escape` - Whether or not the contents of the textarea should be escaped. Defaults to true.
 *
 * @param string $fieldName Name of a field, in the form "Modelname.fieldname"
 * @param array $options Array of HTML attributes, and special options above.
 * @return string A generated HTML text input element
 * @access public
 * @link http://book.cakephp.org/view/1433/textarea
 */
	function textarea($fieldName, $options = array()) {
		$options = $this->_initInputField($fieldName, $options);
		$value = null;

		if (array_key_exists('value', $options)) {
			$value = $options['value'];
			if (!array_key_exists('escape', $options) || $options['escape'] !== false) {
				$value = h($value);
			}
			unset($options['value']);
		}
		return sprintf(
			$this->Html->tags['textarea'],
			$options['name'],
			$this->_parseAttributes($options, array('type', 'name'), null, ' '),
			$value
		);
	}

/**
 * Creates a hidden input field.
 *
 * @param string $fieldName Name of a field, in the form of "Modelname.fieldname"
 * @param array $options Array of HTML attributes.
 * @return string A generated hidden input
 * @access public
 * @link http://book.cakephp.org/view/1425/hidden
 */
	function hidden($fieldName, $options = array()) {
		$secure = true;

		if (isset($options['secure'])) {
			$secure = $options['secure'];
			unset($options['secure']);
		}
		$options = $this->_initInputField($fieldName, array_merge(
			$options, array('secure' => false)
		));
		$model = $this->model();

		if ($fieldName !== '_method' && $model !== '_Token' && $secure) {
			$this->__secure(null, '' . $options['value']);
		}

		return sprintf(
			$this->Html->tags['hidden'],
			$options['name'],
			$this->_parseAttributes($options, array('name', 'class'), '', ' ')
		);
	}

/**
 * Creates a `<button>` tag.  The type attribute defaults to `type="submit"`
 * You can change it to a different value by using `$options['type']`.
 *
 * ### Options:
 *
 * - `escape` - HTML entity encode the $title of the button. Defaults to false.
 *
 * @param string $title The button's caption. Not automatically HTML encoded
 * @param array $options Array of options and HTML attributes.
 * @return string A HTML button tag.
 * @access public
 * @link http://book.cakephp.org/view/1415/button
 */
	function button($title, $options = array()) {
		$options += array('type' => 'submit', 'escape' => false);
		if ($options['escape']) {
			$title = h($title);
		}
		return sprintf(
			$this->Html->tags['button'],
			$options['type'],
			$this->_parseAttributes($options, array('type'), ' ', ''),
			$title
		);
	}

/**
 * Creates a submit button element.  This method will generate `<input />` elements that
 * can be used to submit, and reset forms by using $options.  image submits can be created by supplying an
 * image path for $caption.
 *
 * ### Options
 *
 * - `div` - Include a wrapping div?  Defaults to true.  Accepts sub options similar to
 *   FormHelper::input().
 * - `before` - Content to include before the input.
 * - `after` - Content to include after the input.
 * - `type` - Set to 'reset' for reset inputs.  Defaults to 'submit'
 * - Other attributes will be assigned to the input element.
 *
 * ### Options
 *
 * - `div` - Include a wrapping div?  Defaults to true.  Accepts sub options similar to
 *   FormHelper::input().
 * - Other attributes will be assigned to the input element.
 *
 * @param string $caption The label appearing on the button OR if string contains :// or the
 *  extension .jpg, .jpe, .jpeg, .gif, .png use an image if the extension
 *  exists, AND the first character is /, image is relative to webroot,
 *  OR if the first character is not /, image is relative to webroot/img.
 * @param array $options Array of options.  See above.
 * @return string A HTML submit button
 * @access public
 * @link http://book.cakephp.org/view/1431/submit
 */
	function submit($caption = null, $options = array()) {
		if (!is_string($caption) && empty($caption)) {
			$caption = __('Submit', true);
		}
		$out = null;
		$div = true;

		if (isset($options['div'])) {
			$div = $options['div'];
			unset($options['div']);
		}
		$options += array('type' => 'submit', 'before' => null, 'after' => null);
		$divOptions = array('tag' => 'div');

		if ($div === true) {
			$divOptions['class'] = 'submit';
		} elseif ($div === false) {
			unset($divOptions);
		} elseif (is_string($div)) {
			$divOptions['class'] = $div;
		} elseif (is_array($div)) {
			$divOptions = array_merge(array('class' => 'submit', 'tag' => 'div'), $div);
		}

		$before = $options['before'];
		$after = $options['after'];
		unset($options['before'], $options['after']);

		if (strpos($caption, '://') !== false) {
			unset($options['type']);
			$out .=  $before . sprintf(
				$this->Html->tags['submitimage'],
				$caption,
				$this->_parseAttributes($options, null, '', ' ')
			) . $after;
		} elseif (preg_match('/\.(jpg|jpe|jpeg|gif|png|ico)$/', $caption)) {
			unset($options['type']);
			if ($caption{0} !== '/') {
				$url = $this->webroot(IMAGES_URL . $caption);
			} else {
				$caption = trim($caption, '/');
				$url = $this->webroot($caption);
			}
			$out .= $before . sprintf(
				$this->Html->tags['submitimage'],
				$url,
				$this->_parseAttributes($options, null, '', ' ')
			) . $after;
		} else {
			$options['value'] = $caption;
			$out .= $before . sprintf(
				$this->Html->tags['submit'],
				$this->_parseAttributes($options, null, '', ' ')
			). $after;
		}

		if (isset($divOptions)) {
			$tag = $divOptions['tag'];
			unset($divOptions['tag']);
			$out = $this->Html->tag($tag, $out, $divOptions);
		}
		return $out;
	}

/**
 * Returns a formatted SELECT element.
 *
 * ### Attributes:
 *
 * - `showParents` - If included in the array and set to true, an additional option element
 *   will be added for the parent of each option group. You can set an option with the same name
 *   and it's key will be used for the value of the option.
 * - `multiple` - show a multiple select box.  If set to 'checkbox' multiple checkboxes will be
 *   created instead.
 * - `empty` - If true, the empty select option is shown.  If a string,
 *   that string is displayed as the empty element.
 * - `escape` - If true contents of options will be HTML entity encoded. Defaults to true.
 * - `class` - When using multiple = checkbox the classname to apply to the divs. Defaults to 'checkbox'.
 *
 * ### Using options
 *
 * A simple array will create normal options:
 *
 * {{{
 * $options = array(1 => 'one', 2 => 'two);
 * $this->Form->select('Model.field', $options));
 * }}}
 *
 * While a nested options array will create optgroups with options inside them.
 * {{{
 * $options = array(
 *    1 => 'bill',
 *    'fred' => array(
 *        2 => 'fred',
 *        3 => 'fred jr.'
 *     )
 * );
 * $this->Form->select('Model.field', $options);
 * }}}
 *
 * In the above `2 => 'fred'` will not generate an option element.  You should enable the `showParents`
 * attribute to show the fred option.
 *
 * @param string $fieldName Name attribute of the SELECT
 * @param array $options Array of the OPTION elements (as 'value'=>'Text' pairs) to be used in the
 *    SELECT element
 * @param mixed $selected The option selected by default.  If null, the default value
 *   from POST data will be used when available.
 * @param array $attributes The HTML attributes of the select element.
 * @return string Formatted SELECT element
 * @access public
 * @link http://book.cakephp.org/view/1430/select
 */
	function select($fieldName, $options = array(), $selected = null, $attributes = array()) {
		$select = array();
		$style = null;
		$tag = null;
		$attributes += array(
			'class' => null,
			'escape' => true,
			'secure' => null,
			'empty' => '',
			'showParents' => false,
			'hiddenField' => true
		);

		$escapeOptions = $this->_extractOption('escape', $attributes);
		$secure = $this->_extractOption('secure', $attributes);
		$showEmpty = $this->_extractOption('empty', $attributes);
		$showParents = $this->_extractOption('showParents', $attributes);
		$hiddenField = $this->_extractOption('hiddenField', $attributes);
		unset($attributes['escape'], $attributes['secure'], $attributes['empty'], $attributes['showParents'], $attributes['hiddenField']);

		$attributes = $this->_initInputField($fieldName, array_merge(
			(array)$attributes, array('secure' => false)
		));

		if (is_string($options) && isset($this->__options[$options])) {
			$options = $this->__generateOptions($options);
		} elseif (!is_array($options)) {
			$options = array();
		}
		if (isset($attributes['type'])) {
			unset($attributes['type']);
		}

		if (!isset($selected)) {
			$selected = $attributes['value'];
		}

		if (!empty($attributes['multiple'])) {
			$style = ($attributes['multiple'] === 'checkbox') ? 'checkbox' : null;
			$template = ($style) ? 'checkboxmultiplestart' : 'selectmultiplestart';
			$tag = $this->Html->tags[$template];
			if ($hiddenField) {
				$hiddenAttributes = array(
					'value' => '',
					'id' => $attributes['id'] . ($style ? '' : '_'),
					'secure' => false,
					'name' => $attributes['name']
				);
				$select[] = $this->hidden(null, $hiddenAttributes);
			}
		} else {
			$tag = $this->Html->tags['selectstart'];
		}

		if (!empty($tag) || isset($template)) {
			if (!isset($secure) || $secure == true) {
				$this->__secure();
			}
			$select[] = sprintf($tag, $attributes['name'], $this->_parseAttributes(
				$attributes, array('name', 'value'))
			);
		}
		$emptyMulti = (
			$showEmpty !== null && $showEmpty !== false && !(
				empty($showEmpty) && (isset($attributes) &&
				array_key_exists('multiple', $attributes))
			)
		);

		if ($emptyMulti) {
			$showEmpty = ($showEmpty === true) ? '' : $showEmpty;
			$options = array_reverse($options, true);
			$options[''] = $showEmpty;
			$options = array_reverse($options, true);
		}

		$select = array_merge($select, $this->__selectOptions(
			array_reverse($options, true),
			$selected,
			array(),
			$showParents,
			array('escape' => $escapeOptions, 'style' => $style, 'name' => $attributes['name'], 'class' => $attributes['class'])
		));

		$template = ($style == 'checkbox') ? 'checkboxmultipleend' : 'selectend';
		$select[] = $this->Html->tags[$template];
		return implode("\n", $select);
	}




}
