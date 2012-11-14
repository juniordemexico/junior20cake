
<?php

    $this->Html->script('jquery',false);

    $jqGrid = $this->Jqplugins->getJqgrid();
    $jqGrid->pagerId("pager")->enableNavigation(true)->make("articulo");
   
                          ////////you can use different headers
    $jqGrid->grid("articulo",null,
   array("arcveart",
"ardescrip",
"Addr_state",
"Addr_city",
"Addr_street",
"Addr_post"))->title("ARTICULOS")->pagerId("pager")
             ->enableNavigation(true)
             ->columnOptions("id" , array("searchable" => false,"classes" => "impCol"))
             ->generalOptions(array("viewrecords" => true , "autowidth" => true, 'editrecord'=>true))
             ->make("articulo");	    

  


  echo "<br/><table id=\"articulo\"></table>";
  echo "<div id=\"pager\"></div>";




?>
