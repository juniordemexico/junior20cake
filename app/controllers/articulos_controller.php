<?php

App::import('Component', 'Barcode');

class ArticulosController extends MasterDetailAppController {
	var $name='Articulos';

	var $uses = array(
		 'Articulo', 'Color', 'Linea', 'Marca', 'Temporada'
	);

	var $cacheAction = array('view',
//							'viewpdf',
//							'precios',
							);

	var $tipoarticulo_id = 0;

	function beforeFilter() {
		parent::beforeFilter();

		$this->Articulo->tipoarticulo=$this->tipoarticulo_id;

		if(isset($this->data['Articulo'])) {
			$this->data['Articulo']['tipoarticulo_id']=$this->tipoarticulo_id;
			if(isset($this->data['Articulo']['arcveart'])) {
				$this->data['Articulo']['arcveart']=strtoupper(trim($this->data['Articulo']['arcveart']));
			}
		}
	}

	function index() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGE_ROWS,
								'order' => array('Linea.licve', 'Articulo.arcveart'),
								'fields' => array('Articulo.id','Articulo.arcveart','Articulo.ardescrip',
												'Articulo.tipoarticulo_id','Articulo.arst','Articulo.art',
												'Tipoarticulo.cve',
												'Marca.macve','Linea.licve','Temporada.tecve','Unidad.cve'),
								'conditions' => array('Articulo.tipoarticulo_id'=>$this->tipoarticulo_id),
								);
		$filter = $this->Filter->process($this);
		$this->set('articulos', $this->paginate($filter));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true));
				$this->redirect(array('action' => 'index'));
		}
		$this->set('articulo', $this->Articulo->read(null, $id));
	}

	function edit($id = null) {
		$this->Articulo->recursive=1;
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Articulo->save($this->data)) {
//				$this->Axnotification->sendNotification(array('title'=>'Modificacion de producto',
//				array('subject'=>'Modificacion Articulo: '.$this->Articulo->arcveart), 'Este es el contenido chido chdo' ) );
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Articulo->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} 
			else {
			//	$dates = $this->Articulo->find(array('Articulo.id'=>$id),array('Articulo.created','Articulo.modified','Color.id','Color.cve'));
				$dates=$this->Articulo->findById($id);
				$this->data['Color']=$dates['Color'];
				$this->data['Articulo']['created'] = $dates['Articulo']['created'];
				$this->data['Articulo']['modified'] = $dates['Articulo']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Articulo->read(null, $id);
			$this->set('title_for_layout', $this->name.'::'.$this->data['Articulo']['arcveart']);
		}

		$this->set($this->Articulo->loadDependencies($this->tipoarticulo_id));
		$divisas = $this->Articulo->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		$this->set(compact('divisas'));

	}

	function add() { 
		if (!empty($this->data)) {
			$this->Articulo->create();
			if (
				$this->Articulo->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Articulo->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

		$this->set($this->Articulo->loadDependencies());
//		$divisas = $this->Articulo->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
//		$this->set(compact('divisas'));

	}


	function delete($id) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
 		if ($this->Articulo->delete($id)) {
			$this->arcante($id);
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
				$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('item_was_not_deleted', true), 'error');
		$this->redirect(array('action' => 'index'));
	}

	function precios() {
		if(!$this->RequestHandler->isAjax()) $this->layout='plain';
//		$this->Articulo->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGE_ROWS,
								'order' => array('Linea.licve', 'Articulo.arcveart'),
								'fields' => array('Articulo.id','Articulo.arcveart','Articulo.ardescrip','Articulo.art',
												'Articulo.arpva','Articulo.arpvb','Articulo.arpvc','Articulo.arpvd',
												'Marca.macve','Linea.licve','Temporada.tecve',
												'(SELECT SUM(ament)-SUM(amsal) FROM artmov WHERE amcveart=Articulo.arcveart) existencia'),
								'conditions' => array(	'Articulo.tipoarticulo_id'=>$this->tipoarticulo_id,
								 						'Articulo.arst'=>'A', 
														'(SELECT SUM(ament)-SUM(amsal) FROM artmov WHERE amcveart=Articulo.arcveart) > 0',
														),								
								'joins' => array(
										array(	'table'=>'Catalogoventas',
												'alias'=>'Catalogoventa',
												'type'=> 'inner',
												'conditions'=>array(
													'Catalogoventa.st'=>'A'
											)
										),
										array(	'table'=>'Catalogoventasdetails',
												'alias'=>'Catalogoventasdetail',
												'type'=> 'inner',
												'conditions'=>array(
													'Catalogoventa.id=Catalogoventasdetail.catalogoventa_id',
													'Catalogoventasdetail.articulo_id=Articulo.id'
												)
											),
									),
								);
		$filter = $this->Filter->process($this);
		$this->set('articulos', $this->paginate($filter));
		$this->set('clickAction', 'edit');
	}

	function explosiones() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Articulo.arcveart' => 'asc'),
								'fields' => array('Articulo.id', 'Articulo.arcveart', 'Articulo.ardescrip',
												'Articulo.tipoarticulo_id','Articulo.arst','Articulo.art',
												'Marca.macve','Linea.licve','Temporada.tecve','Unidad.cve', '(SELECT MAX(modified) FROM explosiones as Explosion WHERE Explosion.articulo_id=Articulo.id) AS modified'),
								'conditions' => array('Articulo.tipoarticulo_id'=>'0', 'Articulo.arst'=>'A'),
								);
		$filter = $this->Filter->process($this);
		$this->set('articulos', $this->paginate($filter));
		$this->set('clickAction', 'explosion');
	}

	function explosion($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action'=>'index'));
		}
//		$this->Articulo->recursive=1;
		if (!empty($this->data)) {
			if ($this->Articulo->save($this->data)) {
//				$this->Axnotification->sendNotification(array('title'=>'Modificacion de producto',
//				array('subject'=>'Modificacion Articulo: '.$this->Articulo->arcveart), 'Este es el contenido chido chdo' ) );
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Articulo->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} 
			else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Articulo->read(null, $id);
			$this->set('title_for_layout', 'Explosion de Materiales');
		}

	}

		function existencias() {
			if(!$this->RequestHandler->isAjax()) $this->layout='plain';
			$this->paginate = array(
									'update' => '#content',
									'evalScripts' => true,
									'limit' => PAGE_ROWS,
									'order' => array('Linea.licve', 'Articulo.arcveart'),
									'fields' => array('Articulo.id','Articulo.arcveart','Articulo.ardescrip','Articulo.art',
													'Articulo.arpva','Articulo.arpvb','Articulo.arpvc','Articulo.arpvd',
													'Marca.macve','Linea.licve','Temporada.tecve',
													'(SELECT SUM(ament)-SUM(amsal) FROM artmov WHERE amcveart=Articulo.arcveart) existencia'),
									'conditions' => array(	'Articulo.tipoarticulo_id'=>$this->tipoarticulo_id,
									 						'Articulo.arst'=>'A', 
															),								
									);
			$filter = $this->Filter->process($this);
			$this->set('articulos', $this->paginate($filter));
			$this->set('clickAction', 'edit');
//			$this->autoRender=false;
//			$this->render('precios');			
		}

	function archivos($id = null) {
		$this->set('listAction', 'archivos');
		$this->set('clickAction', 'archivos');
		if (!$id) {
			$this->autoRender=false;
			$this->paginate = array(
									'update' => '#content',
									'evalScripts' => true,
									'limit' => PAGE_ROWS,
									'order' => array('Linea.licve', 'Articulo.arcveart'),
									'fields' => array('Articulo.id','Articulo.arcveart','Articulo.ardescrip',
													'Articulo.tipoarticulo_id','Articulo.arst','Articulo.art',
													'Tipoarticulo.cve',
													'Marca.macve','Linea.licve','Temporada.tecve','Unidad.cve'),
									'conditions' => array('Articulo.tipoarticulo_id'=>$this->tipoarticulo_id),
									);
			$filter = $this->Filter->process($this);
			$this->set('articulos', $this->paginate($filter));
			$this->render('index');
		}
		$this->data = $this->Articulo->read(null, $id);
	}

	function details($id=null) {
		$this->data = $this->Articulo->read(null, $id);
    	echo json_encode($this->data);
    	exit;
	}


	function indexlistform() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGE_ROWS,
								'order' => array('Articulo.arcveart' => 'asc'),
								'fields' => array('Articulo.id','Articulo.arcveart','Articulo.ardescrip',
												'Articulo.tipoarticulo_id','Tipoarticulo.cve','Articulo.arst','Articulo.art',
												'Marca.macve','Linea.licve','Temporada.tecve','Unidad.cve'),
								'conditions' => array('Articulo.tipoarticulo_id'=>$this->tipoarticulo_id)
								);

		$filter = $this->Filter->process($this);
		if (!$this->RequestHandler->isAjax()) {
			$this->set('renderForm',1);
		$divisas = $this->Articulo->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		$this->set(compact('divisas'));
		$unidades = $this->Articulo->Unidad->find('list', array('fields' => array('Unidad.id', 'Unidad.cve')));
		$this->set(compact('unidades'));
		$lineas = $this->Articulo->Linea->find('list', array('fields' => array('Linea.id', 'Linea.licve')));
		$this->set(compact('lineas'));
		$temporadas = $this->Articulo->Temporada->find('list', array('fields' => array('Temporada.id', 'Temporada.tecve')));
		$this->set(compact('temporadas'));
		$tallas = $this->Articulo->Talla->find('list', array('fields' => array('Talla.id', 'Talla.tadescrip')));
		$this->set(compact('tallas'));
		$marcas = $this->Articulo->Marca->find('list', array('fields' => array('Marca.id', 'Marca.macve')));
		$this->set(compact('marcas'));
		}
		$this->set('articulos', $this->paginate($filter));

	}

	function indexData() {
		if(isset($this->params['query']['page']) ) $this->params['named']['page']=$this->params['query']['page'];
		$page = $this->params['query']['page']; // get the requested page
		if(isset($this->params['query']['rows']) ) $this->params['named']['limit']=$this->params['query']['rows'];
		$limit = $this->params['named']['limit']; // get how many rows we want to have into the grid
		if(isset($this->params['query']['sord']) ) $this->params['named']['ord']=$this->params['query']['sord'];
		$sord = $this->params['named']['ord']; // get the direction
		$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
		if(!$sidx) $sidx =1;

/* Search / Filtering */
$examp = $_GET["q"]; //query number
if(isset($_GET["nm_mask"]))
	$nm_mask = $_GET['nm_mask'];
else
	$nm_mask = "";
if(isset($_GET["cd_mask"]))
	$cd_mask = $_GET['cd_mask'];
else
	$cd_mask = "";
//construct where clause
	$where = "WHERE 1=1";
	if($nm_mask!='')
		$where.= " AND item LIKE '$nm_mask%'";
	if($cd_mask!='')
		$where.= " AND item_cd LIKE '$cd_mask%'";

		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		}
		else {
			$total_pages = 0;
		}
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)


		$response->page = $page;
		$response->total = $total_pages;
		$response->records = $count;
		$amttot=0; $taxtot=0; $total=0;

		$i=0;
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
    		$response->rows[$i]['id']=$row[id];
    		$response->rows[$i]['cell']=array($row[id],$row[invdate],$row[name],$row[amount],$row[tax],$row[total],$row[note]);

    		$i++;
		}   
		/* compact data */
		/*
		$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
    $response->rows[$i]=$response->rows[$i]['cell']=array($row[id],$row[invdate],$row[name],$row[amount],$row[tax],$row[total],$row[note]);
    $i++;
} 
*/
$response->userdata['amount'] = $amttot;
$response->userdata['tax'] = $taxtot;
$response->userdata['total'] = $total;
$response->userdata['name'] = 'Totals:';

		echo json_encode($response);
	}

	function testtallacolor() {
		$this->Articulo->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGE_ROWS,
								'order' => array('Articulo.arcveart' => 'asc'),
								'fields' => array('Articulo.id','Articulo.arcveart','Articulo.ardescrip',
												'Articulo.tipoarticulo_id','Articulo.arst','Articulo.art',
												'Articulo.talla_id','Talla.tacve','Talla.tadescrip',
												'Marca.macve','Linea.licve','Temporada.tecve','Unidad.cve'),
								'conditions' => array('Articulo.tipoarticulo_id'=>'0')
								);

		$filter = $this->Filter->process($this);
		$this->set('articulos', $this->paginate($filter));
	}

	public function autocomplete($keyword='', $tipo=0) {
 		Configure::write ( 'debug', 0 );
  		$this->layout = 'json';
		$this->autoRender=false;

		$keyword=trim(Sanitize::paranoid($keyword, array('.','_','-',' ')));

		// If keyword comes into a 'named' parameter, take it first.
		if(empty($keyword)) {
			// If keyword comes into the GET's querystring (ie, /autocomplete&keyword=ABC )
			if(isset($this->params['url']['keyword']) &&
				!empty($this->params['url']['keyword'])) {
				$keyword=$this->params['url']['keyword'];			
			}
			// If keyword comes into the GET's named parameters (ie, /autocomplete/keyword:ABC )
			elseif(isset($this->params['named']['keyword']) &&
				!empty($this->params['named']['keyword'])) {
				$keyword=$this->params['url']['keyword'];			
			}
			// The client didn't send any search term
			else {
				exit;
			}
		}

		// Sanitize and truncate the Keyword in order to search
		$keyword=strtoupper(substr($keyword,0,32));
		if(empty($keyword)) {
			exit;
		}

		// Tipo de Articulo (0:producto, 1:material, 2:servicio, 3:varios, 4:activo)
		if(isset($this->params['url']['tipo'])) {
			$tipo=$this->params['url']['tipo'];
		}
		elseif(isset($this->params['named']['tipo'])) {
			$tipo=$this->params['named']['tipo'];
		}
		else {
			$tipo=0;
		}

		/* Configure and Execute the Query */
//		$this->Articulo['belongsTo']['Linea']=array('conditions'=>array("Linea.tipoarticulo_id=1"));

//		$results = $this->Articulo->autoCompleteRecords();
		
//		echo "KAKA::".$keyword."($tipo)";
/*		
  		$results = $this->Articulo->find('all', array(
			'order'=>'Articulo.arcveart ASC',
			'limit'=>16,
			'conditions' => array(
					'Articulo.tipoarticulo_id'=>$tipo,
					'Articulo.arst'=>'A',
   					'OR' => array(
    					'Articulo.arcveart LIKE'=> $keyword.'%',
    					'Articulo.ardescrip LIKE'=> '%'.$keyword.'%',
   						),
 					)
			));
*/
		$options=array(
			'fields'=>array('Articulo.id', 'Articulo.arcveart', 'Articulo.ardescrip',
							'Articulo.arpcosto', 'Articulo.arpva','Articulo.arpvb',
							'Linea.licve', 'Marca.macve', 'Temporada.tecve'),
			'limit'=>16,
			'order'=>'Articulo.arcveart',
			'conditions' => array(
					'Articulo.tipoarticulo_id'=>$tipo,
					'Articulo.arst'=>'A',
   					'OR' => array(
    					'Articulo.arcveart LIKE'=> $keyword.'%',
    					'Articulo.ardescrip LIKE'=> '%'.$keyword.'%',
   						),
 					),
			'responseFieldnames'=>array('id', 'value', 'title', 'pcosto'),
			);
			
		if ( $response=$this->Articulo->autoComplete( $keyword, $options ) ) {
			echo json_encode($response);
		}
		else {
			return;
		}
	}

	/* Text Field Autocomplete action */
	function autoCompleteOLD() {
 		Configure::write ( 'debug', 0 );
		$this->autoRender=false;
  		$this->layout = 'ajax';

		/* Validate and Format the search term */
		$keyword=strtoupper(substr(trim($this->params['url']['term']),0,32));

		/* Configure and Execute the Query */
		$this->Articulo->recursive=0;
  		$articulos = $this->Articulo->find('all', array(
			'fields'=>array('Articulo.id', 'Articulo.arcveart', 'Articulo.ardescrip',
							'Linea.licve', 'Marca.macve','Temporada.tecve'),
			'order'=>'Articulo.arcveart ASC',
			'limit'=>16,
			'conditions' => array(
   					'OR' => array(
/*    					'Articulo.id'=>(is_numeric($keyword)?$keyword:0),*/
    					'Articulo.arcveart LIKE'=>$keyword.'%',
    					'Articulo.ardescrip LIKE'=>'%'.$keyword.'%'
   						),
					'Articulo.arst'=>'A',
					'Articulo.tipoarticulo_id'=>$this->tipoarticulo_id
  					)
			));

		/* Create the dataset to be returned */
		$response = array();
		$i=0;
		foreach($articulos as $articulo) {
   			$response[$i]['id']=$articulo['Articulo']['id'];
   			$response[$i]['value']=trim($articulo['Articulo']['arcveart']);
   			$response[$i]['label']=trim($articulo['Articulo']['arcveart']) .' - '. $articulo['Articulo']['ardescrip'] . ' (' . $articulo['Linea']['licve'].')';
   			$i++;
  		}
		/* Send the response in json format */
  		echo json_encode($response);
	}

	function tallacolor($id=null) {
		$this->layout = 'empty';
		$thecontroller='tallacolor';
		if(!$id) {
				$this->Session->setFlash(__('invalid_item', true));
		}
		Configure::write ( 'debug', 2 );
		$this->Articulo->recursive=0;
		$result = $this->Articulo->read(null, $id);
		
		$this->set('result',$result);
		$this->set('thecontroller', $this->params['named']['control']);
		$this->set('theaction', $this->params['named']['action']);
		if(isset($this->params['named']['iseditable']))
			$this->set('isEditable', 'true');
		else
			$this->set('isEditable', 'false');
		
		if(isset($this->params['named']['master_id']))
			$this->set('master_id', $this->params['named']['master_id']);
		if(isset($this->params['named']['child_id']))
			$this->set('child_id', $this->params['named']['child_id']);
		elseif(isset($id))
			$this->set('child_id', $id);
	}


	function tallacolorexistenciadata($id=null) {
		$this->layout = 'empty';
		if(!$id) {
				$this->Session->setFlash(__('invalid_item', true),'default');
		}
		Configure::write ( 'debug', 0 );
		
  		$result = $this->Articulo->query("SELECT Articulo.id id,
												 Artmov.amcolor color_cve,
												 SUM(amT0) t0,SUM(amT1) t1,SUM(amT2) t2,SUM(amT3) t3,
												 SUM(amT4) t4,SUM(amT5) t5,SUM(amT6) t6,SUM(amT7) t7,
												 SUM(amT8) t8,SUM(amT9) t9
												FROM articulo Articulo
												JOIN ArtMov Artmov on Artmov.amCveArt=Articulo.arcveart
										        WHERE Articulo.id=$id
												GROUP BY Articulo.id, Artmov.amcolor
											    ORDER BY Artmov.amcolor");
		$this->set('result', $result);
	}

	// Captura de codigos de barra
	function barcodes($id=null) {
		if(empty($this->data)) {
			if(isset($id) && $id>0) {
				$this->data = $this->Articulo->read(null, $id);

			}
			else {
				$this->Session->setFlash(__('invalid_item', true), 'error');								
			}
		} 
		else {
			// Save the Item's Barcode
			//$this->Pedido->saveField('pefauto', $theDate)
		}

	}

function viewpdf($id = null) { 
	if (!$id) { 
		$this->Session->setFlash('Sorry, there was no property ID submitted.'); 
		$this->redirect(array('action'=>'index'), null, true); 
	} 
	Configure::write('debug',2); // Otherwise we cannot use this method while developing 

	$id = intval($id); 

	$records = $this->Articulo->read(null, $id);

	if (empty($records)) 
        { 
            $this->Session->setFlash('Sorry, there is no property with the submitted ID.'); 
            $this->redirect(array('action'=>'index'), null, true); 
        } 
		$this->set('property',$records);
        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render(); 
    } 




	function arcante($id=null,$type=null) {
		if (!is_null($id) && $id<=0) {
			$this->set('myMessage','El ID proporcionado es Incorrecto');
			return;
		}

		/* Initialize the query filter conditions */
		$conditions=array('Articulo.tipoarticulo_id' => $this->tipoarticulo_id, 'Articulo.arst'=>'A');
		if (!is_null($id) && $id>0) {
			$conditions['Articulo.id']=$id;
		}

		/* Execute the query */
		$this->Articulo->recursive = 1;		
		$myRecords=$this->Articulo->find('all', array(
										'limit'=>'10000',
										'order'=>'Articulo.arcveart ASC',
										'conditions' => $conditions,
										'fields' => array('Articulo.id','Articulo.modified','Articulo.arcveart','Articulo.ardescrip','Articulo.arunidad','Articulo.arpva','Articulo.arlinea','Articulo.arst','Articulo.art'),
										));
//		$myRecord=$this->Articulo->read(null, $id);
//		$myRecords=$this->Articulo->Query("SELECT articulo.arcveart,articulo.ardescrip,arunidad,arpva,arlinea FROM articulo as articulo WHERE tipoarticulo_id=0 and arst='A' order by arcveart;");
		/* Check if the recordset is filled */
		if(!isset($myRecords) || !is_array($myRecords) || sizeof($myRecords)<1) {
			$this->set('myMessage','El ID proporcionado NO Existe');
			return;
		}

		/* Initialize the required elements to create the export files */
		$myMyUpdateType='MOD';
		$myString='';	
		foreach($myRecords as $myRecord) {
		$myArticuloRefer=$myRecord['Articulo']['arcveart'];
		$myString.=	$myMyUpdateType.ARC_SEP. /* Tipo de Movimiento (ADD,MOD,DEL) */
					$myRecord['Articulo']['arcveart'].ARC_SEP.
					$myRecord['Articulo']['ardescrip'].ARC_SEP.
					ARC_SEP. /* Referencia del propietario de la referencia (C 20) */
					ARC_SEP. /* Altura Maxima que se puede ubicar la referencia (N 5) */
					ARC_SEP. /* Almacenar restos (SN) */
					ARC_SEP. /* Referencia de Agrupacion (DEFECTOS, SALDOS, LENTOMOV, CADENAS, etc 10) */
					ARC_SEP. /* Referencia de Rotacion Agrupacion (A-Z 10) */
					ARC_SEP. /* Gestion de Calidad a la entrada (SN) */
					ARC_SEP. /* Dias minimos de caducidad que puede tener la referencia (N4) */
					ARC_SEP. /* Dias maximos de caducidad que puede tener la referencia (N4) */
					ARC_SEP. /* Gestion de Temperatura (SN) */
					ARC_SEP. /* Temperatura Maxima en la Recepción (N 3) */
					ARC_SEP. /* Temperatura Minima en la Recepción (N 3) */
					ARC_SEP. /* Tipo de rotacion para la expedición de la referencia (FIXEN, LOTE, FIFO, FXCAD 5) */
					ARC_SEP. /* Dias minimos de caducidad a la salida (N 4) */
					ARC_SEP. /* Gestionar peso variable (SN) */
					ARC_SEP. /* Peso maximo en la recepcion para articulos de peso variable (N 5,2) */
					ARC_SEP. /* Peso minimo en la recepcion para articulos de peso variable (N 5,2) */
					ARC_SEP. /* Gestionar longitud variable (SN) */
					ARC_SEP. /* Gestionar numeros de serie variable (SN) */
					ARC_SEP. /* Gestionar lotes (SN) */
					ARC_SEP. /* Referencia perteneciente al sector textil (SN) */
					ARC_SEP. /* Gestion independiente de variable logistica (SN) */
					$myRecord['Articulo']['arunidad'].ARC_SEP. /* Variable logistica minima (UD CJ PL PZ KG PQ MT PI CM G PR 2) */
					'UD'.ARC_SEP. /* Variable logistica que se mostrara en las pantallas de transporte interno */
					'UD'.ARC_SEP. /* Variable logistica que se mostrara en las pantallas PC */
					'UD'.ARC_SEP. /* Variable logistica que se mostrara en las pantallas Picking */
					$myRecord['Articulo']['arpva'].ARC_SEP. /* Precio Unitario */
					ARC_SEP. /* Precio Unitario Precio Local (N 5,2) */
					ARC_SEP. /* Código de Partida Arancelaria (16) */
					$myRecord['Articulo']['arlinea'].ARC_SEP. /* Familia del articulo (10) */
					ARC_SEP. /* Tipo de Palet por Defecto (PAQUETE 10) */
					'N'. /* Indicar si es Kit (SN) */
					"<br/>\n";
		}
		$this->set('myString',$myString);
		$this->set('myMessage','Generado Correctamente');

	}


}







	/**********************************************************************************************************
		Function:	createReport()
		Action:		Build a dynamic report.
	**********************************************************************************************************/
/*
	function createReport()
	{
		if (!empty($this->data)) 
		{ 
			//Determine if user is pulling existing report or deleting report
			if(isset($this->params['form']['existing']))
			{
				if($this->params['form']['existing']=='Pull')
				{
					//Pull report
					$this->Report->pull_report($this->data['Misc/saved_reports']); 
				}
				else if($this->params['form']['existing']=='Delete')
				{
					//Delete report
					$this->Report->delete_report($this->data['Misc']['saved_reports']);

					//Return user to form
					$this->flash('Your report has been deleted.','/'.$this->name.'/'.$this->action.'');
				}
			}
			else
			{
				//Filter out fields
				$this->Report->init_display($this->data);
				
				//Set sort parameter
				if(!isset($this->params['form']['order_by_primary'])) { $this->params['form']['order_by_primary']=NULL; }
				if(!isset($this->params['form']['order_by_secondary'])) { $this->params['form']['order_by_secondary']=NULL; }
				$this->Report->get_order_by($this->params['form']['order_by_primary'], $this->params['form']['order_by_secondary']);

				//Store report name
				if(!empty($this->params['form']['report_name']))
				{
					$this->Report->save_report_name($this->params['form']['report_name']);
				}

				//Store report if save was executed
				if($this->params['form']['submit']=='Create And Save Report')
				{
					if(empty($this->params['form']['report_name']))
					{
						//Return user to form
						$this->flash('Must enter a report name when saving.','/'.$this->name.'/'.$this->action.'');
					}
					else
					{
						$this->Report->save_report();
					}
				}
			}
			
			//Set report fields
			$this->set('report_fields', $this->Report->report_fields);

			//Set report name
			$this->set('report_name', $this->Report->report_name);

			//Allow search to go 2 associations deep
			$this->{$this->modelClass}->recursive = 2;

			//Set report data
			print_r($this->Report->order_by);
			$this->set('report_data', $this->{$this->modelClass}->find('list',array('order' => $this->Report->order_by)));
		} 
		else
		{
*/
			//Setup options for report component
			/*
				You can setup a level two association by doing the following:
				"VehicleDriver"=>"Employee" ie $models = Array ("Vehicle", "VehicleDriver"=>"Employee");
				Please note that all fields within a level two association cannot be sorted.
			*/
/*
			$models =	Array ("Articulo",'Marca','Linea','Temporada');

			//Set array of fields
			$this->set('report_form', $this->Report->init_form($models));

			//Set current controller
			$this->set('cur_controller', $this->name);

			//Pull all existing reports
			$this->set('existing_reports', $this->Report->existing_reports());
		}
	}	

*/
/*
// search options
<input type="BUTTON" id="bsdata" value="Search" />

// set propierties
<a href="javascript:void(0)" id="s1">Set new url</a>
<br />
<a href="javascript:void(0)" id="s2">Set Sort to amount column</a>
<br />
<a href="javascript:void(0)" id="s3" >Set Sort new Order</a>
<br />
<a href="javascript:void(0)" id="s4">Set to view second Page</a>
<br />
<a href="javascript:void(0)" id="s5">Set new Number of Rows(15)</a>
<br />
<a href="javascript:void(0)" id="s6" >Set Data Type from json to xml</a>

// get proerties
<br />
<a href="javascript:void(0)" id="g1" onclick="alert(jQuery('#list6').jqGrid('getGridParam','url'));">Get url</a>
<br />
<a href="javascript:void(0)" id="g2" onclick="alert(jQuery('#list6').jqGrid('getGridParam','sortname'));">Get Sort Name</a>
<br />
<a href="javascript:void(0)" id="g3" onclick="alert(jQuery('#list6')jqGrid('getGridParam','sortorder'));">Get Sort Order</a>
<br />
<a href="javascript:void(0)" id="g4" onclick="alert(jQuery('#list6')jqGrid('getGridParam','selrow'));">Get Selected Row</a>
<br />
<a href="javascript:void(0)" id="g5" onclick="alert(jQuery('#list6')jqGrid('getGridParam','page'));">Get Current Page</a>
<br />
<a href="javascript:void(0)" id="g6" onclick="alert(jQuery('#list6').jqGrid('getGridParam','rowNum'));">Get Number of Rows requested</a>
<br />
<a href="javascript:void(0)" id="g7" onclick="alert('See Multi select rows example');">Get Selected Rows</a>
<br />
<a href="javascript:void(0)" id="g8" onclick="alert(jQuery('#list6').jqGrid('getGridParam','datatype'));">Get Data Type requested</a>
<br />
<a href="javascript:void(0)" id="g9" onclick="alert(jQuery('#list6').jqGrid('getGridParam','records'));">Get number of records in Grid</a>

<table id="list10"></table>
<div id="pager10"></div>
<br />
Invoice Detail
<table id="list10_d"></table>
<div id="pager10_d"></div>
<a href="javascript:void(0)" id="ms1">Get Selected id's</a>


<div class="h">Search By:</div>
<div>
	<input type="checkbox" id="autosearch" onclick="enableAutosubmit(this.checked)"> Enable Autosearch <br/>
	Code<br />
	<input type="text" id="search_cd" onkeydown="doSearch(arguments[0]||event)" />
</div>
<div>
	Name<br>
	<input type="text" id="item" onkeydown="doSearch(arguments[0]||event)" />
	<button onclick="gridReload()" id="submitButton" style="margin-left:30px;">Search</button>
</div>

<br />

<a href="javascript:void(0)" id="hc">Hide column Tax</a><br/>
<a href="javascript:void(0)" id="sc">Show column Tax</a>

<a href="javascript:void(0)" id="sids">Get Grid id's</a><br/>

function mycheck(value) {
	if(parseFloat(value) >= 200 && parseFloat(value)<=300) {
		return [true,"",""];
	} else {
		return [false,"The value should be between 200 and 300!",""];
	}
}


var lastsel;
function my_input(value, options) {
	return $("<input type='text' size='10' value='"+value+"'/>");
}
function my_value(value) {
	return "My value: "+value.val();
}


jQuery("#celltbl").jqGrid({
   	url:'server.php?q=2',
	datatype: "json",

	ajaxGridOptions : {type:"POST"},
	serializeGridData : function(postdata) {
		postdata.page = 1;
		return postdata;
	},

   	colNames:['Inv No','Date', 'Client', 'Amount','Tax','Total','Notes',' '],
   	colModel:[
   		{name:'id',index:'id', width:55},
   		{name:'invdate',index:'invdate', width:90,editable:true},
{
			name:'name',
			index:'name',
			width:100,
			editable:true,
			edittype:'custom',
			editoptions:{
				custom_element:my_input,
				custom_value:my_value
			}
		}   		{name:'amount',index:'amount', width:80, align:"right",editable:true,editrules:{custom:true,custom_func:mycheck}},
   		{name:'tax',index:'tax', width:80, align:"right",editable:true,editrules:{number:true}},		
   		{name:'total',index:'total', width:80,align:"right"},		
   		{name:'note',index:'note', width:150, sortable:false}		
		{name: 'myac', width:80, fixed:true, sortable:false, resize:false, formatter:'actions',
			formatoptions:{keys:true}},

   	],
   	rowNum:10,
   	rowList:[10,20,30],
   	pager: '#pcelltbl',
   	sortname: 'id',
    viewrecords: true,
    sortorder: "desc",
    caption:"Cell Edit Example",

    hiddengrid: true

  	pgbuttons: false,
   	pgtext: false,
   	pginput:false,

	subGrid : true,
	subGridUrl: 'subgrid.php?q=3',
    subGridModel: [{ name  : ['No','Item','Qty','Unit','Line Total'], 
                    width : [55,200,80,80,80],
					params:['invdate']} 
    ]
	,
 
	scroll: 1,
   	scroll: true, 
jsonReader: {
		repeatitems : true,
		cell:"",
		id: "0"
	},
	footerrow : true,
	userDataOnFooter : true,
	altRows : true

	// Master Detail Grid
	onSelectRow: function(ids) {
		if(ids == null) {
			ids=0;
			if(jQuery("#list10_d").jqGrid('getGridParam','records') >0 )
			{
				jQuery("#list10_d").jqGrid('setGridParam',{url:"subgrid.php?q=1&id="+ids,page:1});
				jQuery("#list10_d").jqGrid('setCaption',"Invoice Detail: "+ids)
				.trigger('reloadGrid');
			}
		} else {
			jQuery("#list10_d").jqGrid('setGridParam',{url:"subgrid.php?q=1&id="+ids,page:1});
			jQuery("#list10_d").jqGrid('setCaption',"Invoice Detail: "+ids)
			.trigger('reloadGrid');			
		}
	}

	onSelectRow: function(id){
		if(id && id!==lastsel){
			jQuery('#cinput').jqGrid('restoreRow',lastsel);
			jQuery('#cinput').jqGrid('editRow',id,true);
			lastsel=id;
		}
	},

    // grid as subgrid
subGridRowExpanded: function(subgrid_id, row_id) {
		// we pass two parameters
		// subgrid_id is a id of the div tag created whitin a table data
		// the id of this elemenet is a combination of the "sg_" + id of the row
		// the row_id is the id of the row
		// If we wan to pass additinal parameters to the url we can use
		// a method getRowData(row_id) - which returns associative array in type name-value
		// here we can easy construct the flowing
		var subgrid_table_id, pager_id;
		subgrid_table_id = subgrid_id+"_t";
		pager_id = "p_"+subgrid_table_id;
		$("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
		jQuery("#"+subgrid_table_id).jqGrid({
			url:"subgrid.php?q=2&id="+row_id,
			datatype: "xml",
			colNames: ['No','Item','Qty','Unit','Line Total'],
			colModel: [
				{name:"num",index:"num",width:80,key:true},
				{name:"item",index:"item",width:130},
				{name:"qty",index:"qty",width:70,align:"right"},
				{name:"unit",index:"unit",width:70,align:"right"},
				{name:"total",index:"total",width:70,align:"right",sortable:false}
			],
		   	rowNum:20,
		   	pager: pager_id,
		   	sortname: 'num',
		    sortorder: "asc",
		    height: '100%'
		});
		jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false})
	},
	subGridRowColapsed: function(subgrid_id, row_id) {
		// this function is called before removing the data
		//var subgrid_table_id;
		//subgrid_table_id = subgrid_id+"_t";
		//jQuery("#"+subgrid_table_id).remove();
	}

	gridComplete: function(){
		var ids = jQuery("#rowed2").jqGrid('getDataIDs');
		for(var i=0;i < ids.length;i++){
			var cl = ids[i];
			be = "<input style='height:22px;width:20px;' type='button' value='E' onclick=\"jQuery('#rowed2').editRow('"+cl+"');\"  />"; 
			se = "<input style='height:22px;width:20px;' type='button' value='S' onclick=\"jQuery('#rowed2').saveRow('"+cl+"');\"  />"; 
			ce = "<input style='height:22px;width:20px;' type='button' value='C' onclick=\"jQuery('#rowed2').restoreRow('"+cl+"');\" />"; 
			jQuery("#rowed2").jqGrid('setRowData',ids[i],{act:be+se+ce});
		}	
	},

	loadComplete: function(){
		var ret;
		alert("This function is executed immediately after\n data is loaded. We try to update data in row 13.");
		ret = jQuery("#list15").jqGrid('getRowData',"13");
		if(ret.id == "13"){
			jQuery("#list15").jqGrid('setRowData',ret.id,{note:"<font color='red'>Row 13 is updated!</font>"})
		}
	}

    loadonce: true,

	rownumbers: true,
	rownumWidth: 40,

    grouping: true,
   	groupingView : {
   		groupField : ['name'],
   		groupColumnShow : [true],
   		groupText : ['<b>{0}</b>'],
   		groupCollapse : false,
		groupOrder: ['asc'],
		groupSummary : [true],
		showSummaryOnHide: true,
		groupDataSorted : true
// custom group header
   		groupField : ['name'],
   		groupColumnShow : [false],
   		groupText : ['<b>{0} - {1} Item(s)</b>']

   	},
    footerrow: true,
    userDataOnFooter: true



	forceFit : true,
	cellEdit: true,
	cellsubmit: 'clientArray',
	afterEditCell: function (id,name,val,iRow,iCol){
		if(name=='invdate') {
			jQuery("#"+iRow+"_invdate","#celltbl").datepicker({dateFormat:"yy-mm-dd"});
		}
	},
	afterSaveCell : function(rowid,name,val,iRow,iCol) {
		if(name == 'amount') {
			var taxval = jQuery("#celltbl").jqGrid('getCell',rowid,iCol+1);
			jQuery("#celltbl").jqGrid('setRowData',rowid,{total:parseFloat(val)+parseFloat(taxval)});
		}
		if(name == 'tax') {
			var amtval = jQuery("#celltbl").jqGrid('getCell',rowid,iCol-1);
			jQuery("#celltbl").jqGrid('setRowData',rowid,{total:parseFloat(val)+parseFloat(amtval)});
		}
	}
});
jQuery("#celltbl").jqGrid('navGrid','#pgwidth',{edit:false,add:false,del:false});

jQuery("#hc").click( function() {
	jQuery("#list17").jqGrid('navGrid','hideCol',"tax");
});
jQuery("#sc").click( function() {
	jQuery("#list17").jqGrid('navGrid','showCol',"tax");
});


jQuery("#sids").click( function() {
	alert("Id's of Grid: \n"+jQuery("#list15").jqGrid('getDataIDs'));
});



var timeoutHnd;
var flAuto = false;

function doSearch(ev){
	if(!flAuto)
		return;
//	var elem = ev.target||ev.srcElement;
	if(timeoutHnd)
		clearTimeout(timeoutHnd)
	timeoutHnd = setTimeout(gridReload,500)
}

function gridReload(){
	var nm_mask = jQuery("#item_nm").val();
	var cd_mask = jQuery("#search_cd").val();
	jQuery("#bigset").jqGrid('setGridParam',{url:"bigset.php?nm_mask="+nm_mask+"&cd_mask="+cd_mask,page:1}).trigger("reloadGrid");
}
function enableAutosubmit(state){
	flAuto = state;
	jQuery("#submitButton").attr("disabled",state);
}


// Master Detail Grid
jQuery("#list10_d").jqGrid({
	height: 100,
   	url:'subgrid.php?q=1&id=0',
	datatype: "json",
   	colNames:['No','Item', 'Qty', 'Unit','Line Total'],
   	colModel:[
   		{name:'num',index:'num', width:55},
   		{name:'item',index:'item', width:180},
   		{name:'qty',index:'qty', width:80, align:"right"},
   		{name:'unit',index:'unit', width:80, align:"right"},		
   		{name:'linetotal',index:'linetotal', width:80,align:"right", sortable:false, search:false}
   	],
   	rowNum:5,
   	rowList:[5,10,20],
   	pager: '#pager10_d',
   	sortname: 'item',
    viewrecords: true,
    sortorder: "asc",
	multiselect: true,
	caption:"Invoice Detail"
}).navGrid('#pager10_d',{add:false,edit:false,del:false});
jQuery("#ms1").click( function() {
	var s;
	s = jQuery("#list10_d").jqGrid('getGridParam','selarrrow');
	alert(s);
});

// Set propierties
jQuery("#s1").click( function() {
	jQuery("#list7").jqGrid('setGridParam',{url:"server.php?q=2"}).trigger("reloadGrid")
});
jQuery("#s2").click( function() {
	jQuery("#list7").jqGrid('setGridParam',{sortname:"amount",sortorder:"asc"}).trigger("reloadGrid");
});
jQuery("#s3").click( function() {
	var so = jQuery("#list7").jqGrid('getGridParam','sortorder');
	so = so=="asc"?"desc":"asc";
	jQuery("#list7").jqGrid('setGridParam',{sortorder:so}).trigger("reloadGrid");
});
jQuery("#s4").click( function() {
	jQuery("#list7").jqGrid('setGridParam',{page:2}).trigger("reloadGrid");
});
jQuery("#s5").click( function() {
	jQuery("#list7").jqGrid('setGridParam',{rowNum:15}).trigger("reloadGrid");
});
jQuery("#s6").click( function() {
	jQuery("#list7").jqGrid('setGridParam',{url:"server.php?q=1",datatype:"xml"}).trigger("reloadGrid");
});
jQuery("#s7").click( function() {
	jQuery("#list7").jqGrid('setCaption',"New Caption");
});
jQuery("#s8").click( function() {
	jQuery("#list7").jqGrid('sortGrid',"name",false);
});

// search options
$("#bsdata").click(function(){
	jQuery("#search").jqGrid('searchGrid',
		{sopt:['cn','bw','eq','ne','lt','gt','ew']}
	);
});
/7 data from an array
var mydata = [
		{id:"1",invdate:"2007-10-01",name:"test",note:"note",amount:"200.00",tax:"10.00",total:"210.00"},
		{id:"2",invdate:"2007-10-02",name:"test2",note:"note2",amount:"300.00",tax:"20.00",total:"320.00"},
		{id:"3",invdate:"2007-09-01",name:"test3",note:"note3",amount:"400.00",tax:"30.00",total:"430.00"},
		{id:"4",invdate:"2007-10-04",name:"test",note:"note",amount:"200.00",tax:"10.00",total:"210.00"},
		{id:"5",invdate:"2007-10-05",name:"test2",note:"note2",amount:"300.00",tax:"20.00",total:"320.00"},
		{id:"6",invdate:"2007-09-06",name:"test3",note:"note3",amount:"400.00",tax:"30.00",total:"430.00"},
		{id:"7",invdate:"2007-10-04",name:"test",note:"note",amount:"200.00",tax:"10.00",total:"210.00"},
		{id:"8",invdate:"2007-10-03",name:"test2",note:"note2",amount:"300.00",tax:"20.00",total:"320.00"},
		{id:"9",invdate:"2007-09-01",name:"test3",note:"note3",amount:"400.00",tax:"30.00",total:"430.00"}
		];
for(var i=0;i<=mydata.length;i++)
	jQuery("#list4").jqGrid('addRowData',i+1,mydata[i]);




// search options

Description 
This method uses colModel names and url parameters from jqGrid 
Calling: jQuery("#grid_id").searchGrid( options ); 
options 
top : 0 the initial top position of search dialog
left: 0 the initinal left position of search dialog
If the left and top positions are not set the dialog apper on
upper left corner of the grid 
width: 360, the width of serch dialog - default 360
height: 70, the height of serch dialog default 70
modal: false, determine if the dialog should be in modal mode default is false
drag: true,determine if the dialog is dragable default true
caption: "Search...",the caption of the dialog
Find: "Find", the text of the button when you click to search data default Find
Reset: "Reset",the text of the button when you click to clear search string default Reset
dirty: false, applicable only in navigator see the last example
These parameters are passed to the url 
sField:'searchField', is the name that is passed to url the value is the name from colModel
sValue:'searchString',is the name that is passed to url the value is the entered value
sOper: 'searchOper', is the name that is passed to the url the value is the type of search - see sopt array
// translation string for the search options
odata : ['equal', 'not equal', 'less', 'less or equal','greater','greater or equal', 'begins with','ends with','contains' ],
// if you want to change or remove the order change it in sopt
sopt: null // ['bw','eq','ne','lt','le','gt','ge','ew','cn'] 
by default all options are allowed. The codes are as follow:
bw - begins with ( LIKE val% )
eq - equal ( = )
ne - not equal ( <> )
lt - little ( < )
le - little or equal ( <= )
gt - greater ( > )
ge - greater or equal ( >= )
ew - ends with (LIKE %val )
cn - contain (LIKE %val% )
*/
