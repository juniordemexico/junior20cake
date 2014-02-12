<?php

class MaterialesController extends MasterDetailAppController {
	var $name='Materiales';

	var $uses = array(
		 'Articulo', 'Color', 'Linea', 'Marca', 'ArticulosColor', 'Familia', 'Unidad'
	);

	var $cacheAction = array('view');
							
	var $tipoarticulo_id = 1;

	var $paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGE_ROWS,
								'order' => array('Linea.licve', 'Articulo.arcveart'),
								'fields' => array('Articulo.id','Articulo.arcveart','Articulo.ardescrip',
												'Articulo.tipoarticulo_id','Articulo.tipoflujo','Articulo.arst','Articulo.art',
												'Articulo.familia_id', 'Articulo.linea_id', 'Articulo.marca_id',
												'Tipoarticulo.cve',
												'Familia.cve', 'Marca.macve','Linea.licve', 'Unidad.cve',
												'Articulo.modified'),
								'conditions' => array('Articulo.tipoarticulo_id'=>1),
								);

	function beforeFilter() {
		$this->Articulo->tipoarticulo=$this->tipoarticulo_id;

		if(isset($this->data['Articulo'])) {
			$this->data['Articulo']['tipoarticulo_id']=$this->tipoarticulo_id;
			if(isset($this->data['Articulo']['arcveart'])) {
				$this->data['Articulo']['arcveart']=strtoupper(trim($this->data['Articulo']['arcveart']));
			}
			if(isset($this->data['Articulo']['familia_id']) && empty($this->data['Articulo']['familia_id']) ) {
				$this->data['Articulo']['familia_id']=null;
			}
		}
		parent::beforeFilter();
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true));
				$this->redirect(array('action' => 'index'));
		}
		$this->set('articulo', $this->Articulo->read(null, $id));
	}

	function edit($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			exit;
		}
		$this->Articulo->recursive=1;
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

	}

	public function add() { 
		if (!empty($this->data)) {
			$this->data['Articulo']['arcveart']=strtoupper($this->data['Articulo']['arcveart']);
			$this->Articulo->create();
			if (
				$this->Articulo->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Articulo->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

		$this->set($this->Articulo->loadDependencies(1));
//		$divisas = $this->Articulo->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
//		$this->set(compact('divisas'));

	}


	public function delete($id) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
 		if ($this->Articulo->delete($id)) {
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
				$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('item_was_not_deleted', true), 'error');
		$this->redirect(array('action' => 'index'));
	}

	function archivos($id = null) {
		$this->set('listAction', 'archivos');
		$this->set('clickAction', 'archivos');
		if (!$id) {
			$this->autoRender = false;
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

	function existencias() {
//		if(!$this->RequestHandler->isAjax()) $this->layout='plain';
//		$this->Articulo->recursive = 0;

		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGE_ROWS,
								'order' => array('Linea.licve', 'Articulo.arcveart'),
								'fields' => array('Articulo.id','Articulo.arcveart','Articulo.ardescrip',
												'Articulo.tipoarticulo_id','Articulo.arst','Articulo.art',
												'Articulo.familia_id', 'Articulo.linea_id', 'Articulo.marca_id',
												'Tipoarticulo.cve',
												'Familia.cve', 'Marca.macve','Linea.licve', 'Unidad.cve',
												'Articulo.modified',
												'(SELECT SUM(ament)-SUM(amsal) FROM artmov WHERE articulo_id=Articulo.id) existencia'),
								'conditions' => array(	'Articulo.tipoarticulo_id=1'
/*														'(SELECT SUM(ament)-SUM(amsal) FROM artmov WHERE amcveart=Articulo.arcveart) > 0',*/
														),								
								);
		$filter = $this->Filter->process($this);
		$this->set('items', $this->paginate($filter));
//		$this->set('clickAction', 'edit');
	}

	public function details($id=null) {
		$this->data = $this->Articulo->read(null, $id);
    	echo json_encode($this->data);
    	exit;		
	}

	public function indexData() {
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

	public function testtallacolor() {
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
								'conditions' => array('Articulo.tipoarticulo_id'=>$this->tipoarticulo_id)
								);

		$filter = $this->Filter->process($this);
		$this->set('articulos', $this->paginate($filter));
	}

	/* Text Field Autocomplete action */
	public function autoComplete() {
 		Configure::write ( 'debug', 0 );
		$this->autoRender=false;
  		$this->layout = 'ajax';

		/* Validate and Format the search term */
		$term=strtoupper(substr(trim($this->params['url']['term']),0,32));

		/* Configure and Execute the Query */
		$this->Articulo->recursive=0;
  		$articulos = $this->Articulo->find('all', array(
			'fields'=>array('Articulo.id', 'Articulo.arcveart', 'Articulo.ardescrip',
							'Articulo.arlinea', 'Articulo.armarca'),
			'order'=>'Articulo.arcveart ASC',
			'limit'=>32,
			'conditions' => array(
   					'OR' => array(
/*    					'Articulo.id'=>(is_numeric($term)?$term:0),*/
    					'Articulo.arcveart LIKE'=>$term.'%',
    					'Articulo.ardescrip LIKE'=>'%'.$term.'%'
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
   			$response[$i]['label']='('.trim($articulo['Articulo']['arcveart']) . ') ' . $articulo['Articulo']['ardescrip'] . ' (' . $articulo['Articulo']['arlinea'].')';
   			$i++;
  		}
		/* Send the response in json format */
  		echo json_encode($response);
	}

	public function tallacolor($id=null) {
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


	public function tallacolorexistenciadata($id=null) {
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

	function bajas() {
		$filename='/home/www/junior20cake/app/files/materiales_para_baja_20130903.txt';
		$myFile=$this->Axfile->FileToArray($filename);
 
		foreach($myFile as $item) {
			$this->Articulo->query("UPDATE articulo SET arst='B' WHERE id=$item AND arst<>'B' and tipoarticulo_id=1");
			echo "$item\n";
		}
		die();
	}

	function inventario() {
//		$filename='/home/www/junior20cake/app/files/materiales_para_baja_20130903.txt';
$this->autoRender=false;
		$filename=APP . DS . 'files/tmp/INVENTARIO-NOVIEMBRE2013-v2.csv'; // '/home/www/junior20cake/app/files/tmp/materiales_inventario_20130917.txt';
		$myFile=$this->Axfile->FileToArray($filename);
//		print "trabajaando";
//		print_r($myFile);
		$records=array();
		foreach($myFile as $item) {
			$fields=split("\t",$item,16);
			if($fields && count($fields)>4 && isset($fields[0]) && trim($fields[0])<>'' && $fields[0]>0) {
			$record=array(
				'articulo_id'=>$fields[0],
				'articulo_cve'=>$fields[1],			
				'color_id'=>$fields[2],
				'color_cve'=>$fields[3],			
//				'familia_cve'=>$fields[4],
				'proveedor_cve'=>$fields[4],
				'costo'=>$fields[5],
				'existencia'=>$fields[6]
				);
			$records[]=$record;

			echo "<pre style='border: 1px solid #000'>\n\r";
			echo "MATERIALES:<br/>"."\n";
			print_r($record);

echo "<code style='background-color: #CCC'>INSERT INTO tmpbodegamaterial(
											articulo_id,articulo_cve,color_id,color_cve,
											proveedor_cve,COSTO,existencia)
			 						VALUES (
									{$record['articulo_id']}, '{$record['articulo_cve']}',
									{$record['color_id']}, '{$record['color_cve']}',
									'{$record['proveedor_cve']}',									
									{$record['costo']},									
									{$record['existencia']}
									)";
									
			echo "</code></pre>\n\r";
			}
			$this->Articulo->query("INSERT INTO tmpbodegamaterial(
											articulo_id,articulo_cve,color_id,color_cve,
											proveedor_cve,costo,existencia)
			 						VALUES (
									{$record['articulo_id']}, '{$record['articulo_cve']}',
									{$record['color_id']}, '{$record['color_cve']}',
									'{$record['proveedor_cve']}',
									{$record['costo']},
									{$record['existencia']}
									);");
	//		echo "$item\n";
		}
		die();
	}

	function inventario_old() {
//		$filename='/home/www/junior20cake/app/files/materiales_para_baja_20130903.txt';
$this->autoRender=false;
		$filename='/home/www/junior20cake/app/files/tmp/materiales_inventario_20130917.txt';
		$myFile=$this->Axfile->FileToArray($filename);
//		print "trabajaando";
//		print_r($myFile);
		$records=array();
		foreach($myFile as $item) {
			$fields=split("\t",$item,16);
			if($fields && count($fields)>4 && isset($fields[0]) && trim($fields[0])<>'') {
			$record=array(
				'articulo_id'=>$fields[0],
				'articulo_cve'=>$fields[1],			
				'color_id'=>$fields[7],
				'color_cve'=>$fields[8],			
				'familia_cve'=>$fields[3],
				'proveedor_cve'=>$fields[9],
				'costo'=>$fields[10],
				'existencia'=>$fields[11]
				);
			$records[]=$record;

			echo "<pre style='border: 1px solid #000'>\n\r";
			echo "MATERIAL:<br/>"."\n";
			print_r($record);

echo "<code style='background-color: #CCC'>INSERT INTO tmpbodegamaterial(
											articulo_id,articulo_cve,color_id,color_cve,
											proveedor_cve,familia_cve,costo,existencia)
			 						VALUES (
									{$record['articulo_id']}, '{$record['articulo_cve']}',
									{$record['color_id']}, '{$record['color_cve']}',
									'{$record['proveedor_cve']}', '{$record['familia_cve']}',
									{$record['costo']}, {$record['existencia']}
									)";
									
			echo "</code></pre>\n\r";
			}
			$this->Articulo->query("INSERT INTO tmpbodegamaterial(
											articulo_id,articulo_cve,color_id,color_cve,
											proveedor_cve,familia_cve,costo,existencia)
			 						VALUES (
									{$record['articulo_id']}, '{$record['articulo_cve']}',
									{$record['color_id']}, '{$record['color_cve']}',
									'{$record['proveedor_cve']}', '{$record['familia_cve']}',
									{$record['costo']}, {$record['existencia']}
									);");
	//		echo "$item\n";
		}
		die();
	}
/*
INSERT INTO ARTMOV 
(ALMACEN_ID, ARTICULO_ID, COLOR_ID, TALLA_ID,
AMTMOV, AMFECHA, AMREFER, AMCONCEP,
AMT0,amcosto
) 
select 
100, articulo_id,color_id,0,100, '2013-08-31', 'INVAGO13', 'INV FISICO AGOSTO 2013', existencia,costo
from tmpbodegamaterial t
where color_id in (select id from colores where id=t.color_id rows 1)
*/
}

