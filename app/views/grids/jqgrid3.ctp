
<?php

    $this->Html->script('jquery',false);

    $jqGrid = $this->Jqplugins->getJqgrid();
    $jqGrid->enableNavigation(true)->changeLanguage("ja")->pagerId("pager")->make("user");
	    
  
  echo "<br/><br/><table id=\"user\"></table>";
  echo "<div id=\"pager\"></div>";





?>
