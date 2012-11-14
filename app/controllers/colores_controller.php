<?php


class ColoresController extends MasterDetailAppController {
	var $name='Colores';

	var $uses = array(
		'Color', 'Articulo'
	);

	var $layout = 'default';
	
	var $cacheAction = array('view',
							);


	function beforeFilter() {
		if($this->action=='index' && isset($this->data['Color']['cve'])) {
			if(isset($this->data['Color']['tipoarticulo_id_0']) && $this->data['Color']['tipoarticulo_id_0']=='on') $this->data['Color']['tipoarticulo_id_0']='1';
			if(isset($this->data['Color']['tipoarticulo_id_1']) && $this->data['Color']['tipoarticulo_id_1']=='on') $this->data['Color']['tipoarticulo_id_1']='1';
			if(isset($this->data['Color']['tipoarticulo_id_2']) && $this->data['Color']['tipoarticulo_id_2']=='on') $this->data['Color']['tipoarticulo_id_2']='1';
				if(!$this->data['Color']['tipoarticulo_id_0'] &&
				!$this->data['Color']['tipoarticulo_id_1'] &&
				!$this->data['Color']['tipoarticulo_id_2'] 
				) {
				for($i=0; $i<4; $i++) {
					unset($this->data['Color']['tipoarticulo_id_'.$i]); //='0';
				}
			}
		}

 		if (!empty($this->data)) {
			$this->data['Color']['cve']=strtoupper($this->data['Color']['cve']);
		}
		parent::beforeFilter();
	}
	
	function index() {
		$this->Color->recursive = -1;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Color.cve' => 'asc'),
								'conditions' => array(),
								);
		$filter = $this->Filter->process($this);
		$this->set('colores', $this->paginate($filter));
	}

	function add() { 
		if (!empty($this->data)) {
			$this->Color->recursive=-1;
			if ($this->Color->create($this->data, array('validate'=>'first')) &&
				$this->Color->save($this->data, array('validate'=>'first') ) 
				) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Color->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true));
				$this->redirect(array('action' => 'index'));
		}
		$this->set('color', $this->Color->read(null, $id));
	}

	function delete($id) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Color->delete($id)) {
				$this->Session->setFlash(__('item_has_been_deleted', true).' ('.$id.')', 'success');
				$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('item_was_not_deleted', true), 'error');
		$this->redirect(array('action' => 'index'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Color->recursive=-1;
		if (!empty($this->data)) {
			if ($this->Color->save($this->data, array('validate'=>'first'))) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Color->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			}
			else {
				$dates = $this->Color->findById($id);
				$this->data['Articulo'] = $dates['Articulo'];
				$this->data['Color']['created'] = $dates['Color']['created'];
				$this->data['Color']['modified'] = $dates['Color']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Color->read(null, $id);
		}
		pr($this->data);
	}

	function indexlistform() {
		$this->Color->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 20,
								'order' => array('Color.arcveart' => 'asc'),
								'fields' => array('Color.id','Color.arcveart','Color.ardescrip',
												'Color.artipo','Color.arst','Color.art',
												'Marca.macve','Linea.licve','Temporada.tecve','Unidad.cve'),
								'conditions' => array('Color.artipo'=>'0')
								);

		$filter = $this->Filter->process($this);
		if (!$this->RequestHandler->isAjax()) {
			$this->set('renderForm',1);

		$tipoarticulos = $this->Color->Tipoarticulo->find('list', array('fields' => array('Tipoarticulo.id', 'Tipoarticulo.cve')));
		$this->set(compact('tipoarticulos'));
		}
		$this->set('colores', $this->paginate($filter));

	}

	function details($id=null) {
		$this->data = $this->Color->read(null, $id);
    	echo json_encode($this->data);
    	exit;		
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


	/* Text Field Autocomplete action */
	function autoComplete() {
 		Configure::write ( 'debug', 0 );
		$this->autoRender=false;
  		$this->layout = 'ajax';

		/* Validate and Format the search term */
		$term=strtoupper(substr(trim($this->params['url']['term']),0,32));

		/* Configure and Execute the Query */
		$this->Color->recursive=0;
  		$colores = $this->Color->find('all', array(
			'fields'=>array('Color.id','Color.cve','Color.descrip','Color.tipoarticulo_id','Color.st', 'Tipoarticulo.cve'),
			'order'=>array('Color.tipoarticulo_id ASC', 'Color.cve ASC'),
			'limit'=>32,
			'conditions' => array(
   					'OR' => array(
/*    					'Color.id'=>(is_numeric($term)?$term:0),*/
    					'Color.cve LIKE'=>$term.'%',
    					'Color.descrip LIKE'=>'%'.$term.'%'
   						),
					'Color.st'=>'A',
  					)
			));

		/* Create the dataset to be returned */
		$response = array();
		$i=0;
		foreach($colores as $color) {
   			$response[$i]['id']=$color['Color']['id'];
   			$response[$i]['value']=trim($color['Color']['cve']);
   			$response[$i]['label']='('.trim($color['Color']['cve']) . ') ' . $color['Color']['ardescrip'] . ' (' . $color['Tipoarticulo']['cve'].')';
   			$i++;
  		}
		/* Send the response in json format */
  		echo json_encode($response);
	}

}

?>