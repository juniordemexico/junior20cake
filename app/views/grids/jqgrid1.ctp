
<?php

    $this->Html->script('jquery',false);

    $jqGrid = $this->Jqplugins->getJqgrid();
    $jqGrid->make("articulo");
	    
    $jqGrid->grid("articulo", array("limit"=>5))->title("TEST")
		      ->defaultColumnsOptions(array("width"=>100))
                  ->pagerId("pager")
                  ->generalOptions(array("viewRecords"=>true))
                  ->make("articulo");

    

  
  echo "<br/><br/><table id=\"articulo\"></table>";
  echo "<div id=\"pager\"></div>";





?>
