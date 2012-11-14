<?php
/**
 * Automagically handles requests for autocomplete fields
 *
 * CakePHP :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright (c)	2006, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright (c) 2006, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP Project
 * @package			cake
 * @subpackage		cake.cake.libs.controller.components
 * @since			CakePHP v 0.10.4.1076
 * @version			$Revision: _ $
 * @modifiedby		$LastChangedBy: rbmatt $
 * @lastmodified	$Date: 2007-01-17 00:32:15 -0500 (Wed, 17 Jan 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Autocomplete Handler
 *
 * @package		cake
 * @subpackage	cake.cake.libs.controller.components
 *
 */
class AutocompleteComponent extends Object {
	var $layout = 'ajax';
	var $enabled = true;
	var $components = array('RequestHandler');
	var $handles = array();

/**
 * Startup
 *
 * @param object A reference to the controller
 * @return null
 */
	function startup(&$controller) {

		if (!$this->enabled || !$this->RequestHandler->isAjax() || !$this->RequestHandler->isPost()) {
			return true;
		}

		$data = $controller->data;
		if (empty($data) || count($data) != 1) {
			return false;
		}

		list($model) = array_keys($data);
		if (!is_array($data[$model]) || count($data[$model]) != 1 || 
			!isset($controller->{$model}) || !is_object($controller->{$model})) {
			return false;
		}

		list($field) = array_keys($data[$model]);
		$conditions = array();

		if (!empty($this->handles)) {

			$handled = false;
			$fields = array();

			foreach ($this->handles as $key => $val) {
				if (is_int($key)) {
					$key = $val;
					$val = array();
				}
				if ($key == $model.'.'.$field || $key == $field || $key == $model.'.*') {
					$handled = true;
					$conditions = $val;
					break;
				}
			}
			if (!$handled) {
				return true;
			}
		}

		$base = array($model.'.'.$field.' LIKE' => '%'.$data[$model][$field].'%');
		if (!empty($conditions)) {
			$conditions = array($base, $conditions);
		} else {
			$conditions = $base;
		}

		if(isset($controller->{$model}->autoCompleteFields[$field])) {
			$fieldAutocompleteData=$controller->{$model}->autoCompleteFields[$field];
			if(isset($fieldAutocompleteData['scope'])) {
				$conditions[]=$fieldAutocompleteData['scope'];			
			}
			if(isset($fieldAutocompleteData['fields'])) {
				$fields=$fieldAutocompleteData['fields'];			
			}
			else $fields='';
			if(isset($fieldAutocompleteData['order'])) {
				$order=$fieldAutocompleteData['order'];			
			}
			else $order='';
			if(isset($fieldAutocompleteData['limit'])) {
				$limit=$fieldAutocompleteData['limit'];			
			}
			else $limit=32;
			if(isset($fieldAutocompleteData['group'])) {
				$listgroup=$fieldAutocompleteData['group'];			
			}
			else $listgroup=null;

		}
		
		$results = $controller->{$model}->find('all', 
					array(
						'conditions' => $conditions,
						'fields' => $fields,
						'order' => $order,
						'limit' => $limit,
					));

		if (is_array($results) && !empty($results)) {
			$elements = array();
			$actualGroup=-1;
			foreach ($results as $rec) {
				if (!$listgroup) {
					if (isset($rec[$model][$field])){
//						$elements[]=$rec[$model][$field];
						$elements[0][]=$rec[$model][$field];
					}					
				}
				else {
					if(isset($rec[$model][$listGroup]) &&
						$actualGroup<>$rec[$model][$listGroup]) {
						$actualGroup=$rec[$model][$listGroup];
						$elements[$actualGroup]=array();
					}
					if (isset($rec[$model][$field])){
					$elements[$actualGroup][]=$rec[$model][$field];					
					}
				}
			}
			$elements = array_unique($elements);
			echo "<ul>\n";
			foreach($elements as $group=>$groupdata) {
				foreach($groupdata as $element) {
					echo "\t<li>".$element."</li>\n";
				}
				echo "\t<li><span class=\"label\">".$group."</span></li>\n";				
			}
			echo "</ul>\n";
		}

		exit();
	}
}
