
<?php

App::import('Component', 'jq_plugins_bridge.jqPlot');

class PlotsController extends AppController
{
	
  var $name = "Plots";	
  var $components = array("JqPlot");  //////you can use this component in your controller if you wish,
                                     ///////however draw() method is not exposed in this level, which is on purpose...
  var $uses=array();
	 
  function jqplot($type) { 
	$this->set('type',$type); }
 
 
}
?>
