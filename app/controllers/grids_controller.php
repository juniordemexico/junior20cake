
<?php

App::import('Component', 'jq_plugins_bridge.jqGrid');

class GridsController extends AppController
{
	var $uses = array('Articulo','Linea','Marca','Temporada');
	var $model='Articulo';
  var $name = "Grids";	
  var $components = array("JqGrid");  //////you can use this component in your controller if you wish,
                                     ///////however make() method is not exposed in this level, which is on purpose...
									 
  var $paginate = array("model"=>"Articulo","limit"=>'20' , "page"=>1,
						'fields' => array('Articulo.id','Articulo.arcveart','Articulo.ardescrip',
											'Articulo.artipo','Articulo.arst','Articulo.art',
											'Articulo.talla_id','Talla.tacve','Talla.tadescrip',
											'Marca.macve','Linea.licve','Temporada.tecve','Unidad.cve'),
						'scope' => array('Articulo.arst'=>'A','Articulo.artipo'=>'0')
											);  /////////// JqGrid uses standard $paginate options for retrieving data
                                                   //////////  but these options get overwritten, if they are found in second parameter
												   ///////// of gird() method

  function jqgrid1() { 
      $this->Articulo->recursive=1;
      $this->JqGrid  ////////////just the name of your model is enough
	     ->grid("Articulo")
		 ->defaultColumnsOptions(array("width"=>'0')); 
  }
  
  function jqgrid2() { 
          
      $this->JqGrid
	     ->grid("Articulo", array("limit"=>'10' , "fields" => array("Articulo.arcveart","Articulo.ardescrip",'Linea.licve','Marca.macve',"Articulo.linea_id",'Articulo.id')))
		 ->defaultColumnsOptions(array("width"=>140, "resizable" => false , "sortable" => true, "align"=>"left" ))
		 ->generalOptions(array("height" => 300))
		 ->columnOptions("arcveart" , array("searchable"=>true, "width" => 100 ));
		   
	
  }
  
  function jqgrid3() { 
      
      $this->JqGrid
	     ->grid("User", 
				array("limit"=>10 , "fields" => array("Articulo.arcveart","Articulo.ardescrip","Articulo.arst","Articulo.art","Articulo.linea_id")),
				array("Clave","Descripción","Age","E-mail","Country"))
		 ->title("ARTICULOS") 
		 ->generalOptions(array("height" => 220 , "hiddengrid" => "true" , "altrows" => true))
		 ->columnOptions("user_name" , array("width" => 210 , "align"=>"center" , "resizable" => false , "sortable" => false));
	
  }
  
  
  
  function gridCallback(){}   ////////defining this function is neccessary, since all ajax calls will be using this channel 
                              //////// for retrieving data. 'gridCallback' is the default name and you can easily change it 
							  //////// via setAjaxAction($actionName) of JqGrid component 
 
}
?>
