<?php
/**
 * Embed Media Validation Behavior
 * 
 * The behavior provides a selection of validation methods that can be used to
 * check if the user input contains a media ID key and how it will be stored
 * in the database. 
 *
 * @package Embeddable Plugin
 * @author Dean Sofer
 * @version $Id$
 * @copyright __MyCompanyName__
 **/
class EmbedBehavior extends ModelBehavior {
	
	var $keys = array(
		'youtube' => '/youtube\.com\/watch\?v=([A-Za-z0-9._%-]*)[&\w;=\+_\-]*/',
		
	);

/**
 * Contains configuration settings for use with individual model objects.
 * Individual model settings should be stored as an associative array, 
 * keyed off of the model name.
 *
 * @var array
 * @access public
 * @see Model::$alias
 */
	var $settings = array();

/**
 * Allows the mapping of preg-compatible regular expressions to public or
 * private methods in this class, where the array key is a /-delimited regular
 * expression, and the value is a class method.  Similar to the functionality of
 * the findBy* / findAllBy* magic methods.
 *
 * @var array
 * @access public
 */
	var $mapMethods = array();

/**
 * DataSource error callback
 *
 * @param object $model Model using this behavior
 * @param string $error Error generated in DataSource
 * @access public
 */
	function onError(&$model, $error) { 
	
	}
	
	/**
	 * Validation method which allows users to specify which service they wish
	 * to validate for.
	 *
	 * @param string $check 
	 * @param string $key 
	 * @return void
	 * @author Dean Sofer
	 */
	function mediaUrl($check, $key) {
    // $data array is passed using the form field name as the key
    // have to extract the value to make the function generic
    $value = array_values($check);
    $value = $value[0];
    
    return preg_match($this->keys[$key], $value);
	}

} // End of EmbedBehavior

?>