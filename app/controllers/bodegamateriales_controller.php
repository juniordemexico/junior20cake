<?php


class BodegamaterialesController extends MasterDetailAppController {
	var $name='Bodegamateriales';

	var $uses = array('Artmovbodegadetail', 'Articulo', 'Color', 'Talla', 'Almacen', 'Ubicacion', 'Printer', 'User', 'Linea', 'Marca', 'Temporada', 'Tipoartmovbodega');

	var $layout = 'bodegamaterial';

	var $currentPrinter=array('id'=>11, 'cve'=>'Zebra01', 'printqueue'=>'barcodes-viaducto01');

	var $printLabelCounter=0;
	
	var $tipoarticulo_id = 1;

	public function beforeFilter() {
		$this->Articulo->tipoarticulo=$this->tipoarticulo_id;
		if(isset($this->data['Bodegamaterial'])) {
			$this->data['Artmovbodegadetail']=$this->data['Bodegamaterial'];
		}
		parent::beforeFilter();
	}
	
	public function index() {
		$this->set('title_for_layout', "BODEGA MATERIALES");	
	}

	public function ver() {
		$this->Artmovbodegadetail->recursive = 1;
		$this->paginate = array(
					'update' => '#content',
					'evalScripts' => true,
					'limit' => 20,
					'fields'=>array('"ARTMOVBODEGADETAIL".*, "ARTICULO".*, "TALLA".*, "COLOR".*, "UBICACION".*, "TIPOARTMOVBODEGA".*, "USER".username'),
					'conditions'=>array('Articulo.tipoarticulo_id'=>$this->tipoarticulo_id),
				);
		$filter = $this->Filter->process($this);
		$this->set('items', $this->paginate($filter));
	}

	public function existenciaxubicacion() {
		$this->uses = array('Artmovbodegamaterialubicadenormal', 'Artmovbodegadetail', 'Color', 'Talla', 'Almacen', 'Ubicacion', 'Printer', 'User', 'Linea', 'Marca', 'Temporada', 'Tipoartmovbodegamaterial');
		$this->Artmovbodegamaterialubicadenormal->recursive = 1;
/*
		$this->paginate = array(
					'update' => '#content',
					'evalScripts' => true,
					'limit' => 20,
					'fields'=>array('Artmovbodegamaterialubicadenormal.*, Articulo.*, Talla.*, Color.*, Ubicacion.*'
					'joins'=>array(
							array(
								),
						)
					),
					'conditions'=>array('Articulo.tipoarticulo_id'=>0),
				);
*/
		$filter = $this->Filter->process($this);
		$this->set('items', $this->paginate($filter));
	}

	public function entradas() {
		$this->set('title_for_layout', "BODEGA :: ENTRADAS");	
	}

	public function salidas() {
		$this->set('title_for_layout', "BODEGA :: SALIDAS");	
	}

	public function etiquetas() {
		$this->set('title_for_layout', "BODEGA :: ETIQUETAS");	
	}

	public function movimientos() {
		$this->set('title_for_layout', "BODEGA :: MOVIMIENTOS");	
	}

	public function addTransaction() {
		$this->autoRender=false;
		$theData=$this->params['url'];
		unset($theData['url']);

		if(
			isset($theData['articulo_id']) && $theData['articulo_id']>0 &&
			isset($theData['color_id']) &&
			isset($theData['talla_index']) && $theData['talla_index']>=0 &&
			isset($theData['tipoartmovbodega_id']) && $theData['tipoartmovbodega_id']<>0 &&
			isset($theData['cantidad']) && $theData['cantidad']>0 
			)
		{
			if(!isset($theData['ubicacion_id'])) $theData['ubicacion_id']=1;
			
			if($theData['color_id']==0) {
				$rsfirstcolor=$this->ArticuloColor->find('first', array('articulo_id'=>$theData['articulo_id']) );
				if(!$rsfirstcolor || !isset($rsfirstcolor['ArticuloColor']['color_id'])) {
					$theData['color_id']=$rsfirstcolor['ArticuloColor']['color_id'];
				}
			}

			if(!isset($theData['selectedprinter']) || !($theData['selectedprinter']>0) ) {
				$this->currentPrinter=array('id'=>11, 'cve'=>'Zebra01', 'printqueue'=>'barcodes-viaducto01');
			}
			else {
				$this->currentPrinter=array('id'=>$theData['selectedprinter']);
			}
			if(isset($theData['printlabelperpackage'])) {
				if($theData['printlabelperpackage']==1 || $theData['printlabelperpackage']=='1' ||
					$theData['printlabelperpackage']=='true' || $theData['printlabelperpackage']==true)
					$theData['printlabelperpackage']=true;
				else
					$theData['printlabelperpackage']=false;					
			}

			$data=array(
				'folio'=>$theData['folio'],
				'tipoartmovbodega_id'=>$theData['tipoartmovbodega_id'],
				'almacen_id'=>100,
				'ubicacion_id'=>$theData['ubicacion_id'],
				'articulo_id'=>$theData['articulo_id'],
				'color_id'=>$theData['color_id'],
				'talla_index'=>$theData['talla_index'],
				'cant'=>$theData['cantidad'],
				't'.$theData['talla_index']=>$theData['cantidad'],
				'concep'=>'',
				'transito_st'=>'',
				'st'=>'A',
				'user_id'=>$this->Auth->user('id')
				);
			
			$this->data['Artmovbodegadetail']=$data;
			$this->Artmovbodegadetail->create();

			if($this->Artmovbodegadetail->save($this->data)) {
				// Print the Inventory's label for this entry....
				$data['id']=$this->Artmovbodegadetail->id;
				$data['created']=date('Y/m/d H:i:s');
				if(isset($theData['printlabel']) && $theData['printlabel']) {
					$this->printLabelCounter=0;
					if(!isset($theData['printlabelperpackage']) || !$theData['printlabelperpackage']) {
						// Etiquetas Individuales
						$unidades=$data['cant'];
						$paquetes=0;
						$data['label_count']=$data['cant'];
						$data['cant']=1;
						$this->_printlabel($data);						
					}
					else {
						// Etiquetas Por Paquetes
						$paquetes=(int)($data['cant']/10);
						$unidades=$data['cant']-($paquetes*10);

						// Imprime Paquetes
						$data['cant']=10;
						$data['label_count']=$paquetes;
						if($paquetes>0) $this->_printlabel($data);						

						// Imprime Unidades
						$data['cant']=1;
						$data['label_count']=$unidades;
						if($unidades>0) $this->_printlabel($data);					
					}
				}

				// Success...
				$out=array(
					'result'=>'recibido',
					'message'=>'Transacción Guardada ('.$data['id'].') '.
							(isset($theData['printlabel']) && $theData['printlabel']?
							' Impresas '.($paquetes+$unidades).' etiquetas en '.$this->currentPrinter['cve']:
							''),
					'_id'=>$data['id'],
					'_timestamp'=>date('H:i:s')
				);
			}
			else {
				$out=array(
					'result'=>'error',
					'message'=>'ERROR AL GUARDAR'
				);

			}
		}
		else {
			// Error...
			$out=array(
				'result'=>'error',
				'message'=>'Error en la Solicitud'.(
					(!isset($theData['tipoartmovbodega_id']) || !is_numeric($theData['tipoartmovbodega_id']) ? ' Falta el Tipo de Movimiento.' : '').
					(!isset($theData['articulo_id']) || !($theData['articulo_id']>0) ? ' Falta el Articulo.' : '').
					(!isset($theData['color_id']) || !($theData['color_id']>0) ? ' Falta el Color.' : '').
					(!isset($theData['talla_index']) || !($theData['talla_index']>=0) ? ' Falta la Talla.' : '').
					(!isset($theData['cantidad']) || !($theData['cantidad']>0) ? ' Falta la Cantidad.' : '')
					)
			);
		}

		echo json_encode($out);
	}


	public function printlabels() {
		$this->autoRender=false;
		$theData=$this->params['url'];
		unset($theData['url']);

		if(
			isset($theData['articulo_id']) && $theData['articulo_id']>0 &&
			isset($theData['color_id']) &&
			isset($theData['talla_index']) && $theData['talla_index']>=0 &&
			isset($theData['cantidad']) && $theData['cantidad']>0 
			)
		{
			if(!isset($theData['ubicacion_id'])) $theData['ubicacion_id']=1;
			
			if($theData['color_id']==0) {
				$rsfirstcolor=$this->ArticuloColor->find('first', array('articulo_id'=>$theData['articulo_id']) );
				if(!$rsfirstcolor || !isset($rsfirstcolor['ArticuloColor']['color_id'])) {
					$theData['color_id']=$rsfirstcolor['ArticuloColor']['color_id'];
				}
			}

			if(!isset($theData['selectedprinter']) || !($theData['selectedprinter']>0) ) {
				$this->currentPrinter=array('id'=>11, 'cve'=>'Zebra01', 'printqueue'=>'barcodes-viaducto01');
			}
			else {
				$this->currentPrinter=array('id'=>$theData['selectedprinter']);
			}
			if(isset($theData['printlabelperpackage'])) {
				if($theData['printlabelperpackage']==1 || $theData['printlabelperpackage']=='1' ||
					$theData['printlabelperpackage']=='true' || $theData['printlabelperpackage']==true)
					$theData['printlabelperpackage']=true;
				else
					$theData['printlabelperpackage']=false;					
			}

			$data=array(
				'id'=>-1,
				'folio'=>$theData['folio'],
				'almacen_id'=>1,
				'ubicacion_id'=>$theData['ubicacion_id'],
				'articulo_id'=>$theData['articulo_id'],
				'color_id'=>$theData['color_id'],
				'talla_index'=>$theData['talla_index'],
				'cant'=>$theData['cantidad'],
				't'.$theData['talla_index']=>$theData['cantidad'],
				'concep'=>'',
				'transito_st'=>'',
				'st'=>'A',
				'user_id'=>$this->Auth->user('id')
				);
			
			$this->data['Artmovbodegadetail']=$data;

			$data['created']=date('Y/m/d H:i:s');
			$this->printLabelCounter=0;
			if(!isset($theData['printlabelperpackage']) || !$theData['printlabelperpackage']) {
				// Etiquetas Individuales
				$unidades=$data['cant'];
				$paquetes=0;
				$data['label_count']=$data['cant'];
				$data['cant']=1;
				$this->_printlabel($data);						
			}
			else {
				// Etiquetas Por Paquetes
				$paquetes=(int)($data['cant']/10);
				$unidades=$data['cant']-($paquetes*10);

					// Imprime Paquetes
				$data['cant']=10;
				$data['label_count']=$paquetes;
				if($paquetes>0) $this->_printlabel($data);						

					// Imprime Unidades
				$data['cant']=1;
				$data['label_count']=$unidades;
				if($unidades>0) $this->_printlabel($data);					
			}

			// Success...
			$out=array(
				'result'=>'recibido',
				'message'=>(isset($theData['printlabel']) && $theData['printlabel']?
						' Impresas '.($paquetes+$unidades).' etiquetas en '.$this->currentPrinter['cve']:
						''),
				'_id'=>$data['id'],
				'_timestamp'=>date('H:i:s')
			);
		}

		echo json_encode($out);
	}
	
	public function _printlabel($data=array()) {
		// If we don't have a Product
		if(!$data || !is_array($data) || !isset($data['articulo_id'])) {
			return false;
		}

		// Get Articulos's data...
		$rs=$this->Articulo->findById($data['articulo_id']);
		if(!$rs || !isset($rs['Articulo']['arcveart'])) return false;
		$articulo_cve=trim($rs['Articulo']['arcveart']);

		// Get Ubicacion's data, if we got it...
		if(!isset($data['ubicacion_id']) || !($data['ubicacion_id']>0) ) $data['ubicacion_id']=1;
		$rsubica=$this->Ubicacion->findById($data['ubicacion_id']);
		$ubicacion_cve=($rsubica && isset($rsubica['Ubicacion']['cve'])) ? trim($rsubica['Ubicacion']['cve']):'';
		
		// Get Color's data
		if(!isset($data['color_id']) || !($data['color_id']>0) ) $data['color_id']=1;
		$rscolor=$this->Color->findById($data['color_id']);
		$color_cve=($rscolor && isset($rscolor['Color']['cve'])) ? trim($rscolor['Color']['cve']):'';

		// Get Tallas's data
		if(!isset($data['talla_index']) || !($data['talla_index']>=0) ) $data['talla_index']=0;
		$rstalla=$this->Talla->findById($rs['Articulo']['talla_id']);
		$talla_label=($rstalla && isset($rstalla['Talla']['id'])) ? trim($rstalla['Talla']['tat'.$data['talla_index']]):'';

		// Get Label's Number of Copies
		if(!isset($data['label_count']) || !is_numeric($data['label_count']) || !($data['label_count']>=1) ) {
			$label_count=1;
		}
		else {
			$label_count=$data['label_count'];
		}

		// Get Label's 'Cantidad' field (number of items or piezes)
		if(!isset($data['cant']) || !is_numeric($data['cant']) || !($data['cant']>=1) ) {
			$cant=$data['cant']=1;
		}
		else {
			$cant=$data['cant'];
		}
		
		$rsuser=$this->User->findById($data['user_id']);
		$username=$rsuser['User']['username'];
		$rs=$this->Articulo->findById($data['articulo_id']);
		
		if($data['label_count']<>0 && $rs) {
			$label='

N
D14
A025,025,0,4,1,1,N,"'.$data['created'].'"
A450,025,0,4,1,1,N,"Oper: '.$username.'"
A025,75,0,5,1,1,N,"'.$articulo_cve.'"
A025,150,0,5,1,1,N,"'.$color_cve.'"
A025,225,0,5,1,1,N,"TALLA: '.$talla_label.'"
A450,225,0,5,1,1,N,"CANT: *'.$cant.'*"
B050,300,0,1,2,3,75,N,"t%p,id%'.$data['articulo_id'].',c%'.$data['color_id'].',t%'.$data['talla_index'].',p%'.$data['cant'].'"
A050,400,0,4,1,1,N,"TRANSACCION: '.$data['id'].'"
A450,400,0,4,1,1,N,"REFER: '.$data['folio'].'"
B050,425,0,1,4,6,100,N,"t%t,id%'.$data['id'].'"
P'.$label_count.'
';
			$filename='/home/www/junior20cake/app/webroot/'.
					'files/tmp/tmp.'.$data['id'].'.'.($this->printLabelCounter++).'.label.txt';
			$this->Axfile->StringToFile($filename, $label);

			$rsprinter=$this->Printer->findById($this->currentPrinter['id']);
			if($rsprinter && isset($rsprinter['Printer']['id']) && $rsprinter['Printer']['id']>0 ) {
				$this->currentPrinter=$rsprinter['Printer'];
				system("lpr -P ".$this->currentPrinter['printqueue']." $filename > /dev/null");
				return true;
			}
		}
		return false;
	}

	public function cancel($id=null) {
		if(!$id || !is_numeric($id) || !($id>0)) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			exit;
		}
		$data=$this->Artmovbodegadetail->findById($id);
		if($data && isset($data['Artmovbodegadetail']['id']) && $data['Artmovbodegadetail']['id']>0) {
			$this->Artmovbodegadetail->read(null, $id);
			if($this->Artmovbodegadetail->saveField('st', 'C')) {
				$this->Session->setFlash('Transacción <strong>'.$data['Artmovbodegadetail']['articulo_id'].'</strong> '.
										'Capturada el <strong>'.$data['Artmovbodegadetail']['created'].'</strong> '.
										'SE CANCELÓ.',
										'success');				
			}
			else {
				$this->Session->setFlash('La transacción <strong>'.$id.'</strong> NO se pudo Cancelar', 
										'error');				
			}
		}
		else {
			$this->Session->setFlash('La transacción <strong>'.$id.'</strong> NO Existe', 
									'error');			
		}
	}

	public function getItemByCve($cve=null) {
		$this->autoRender=false;
		$this->Articulo->recursive=1;
		$rs=$this->Articulo->findByArcveart($cve);
		$out=array(
			'result'=>'error',
			'errorMessage'=>'Producto Inválido',
		);

		if($rs && isset($rs['Articulo']['id']) && $rs['Articulo']['id']>0) {
			$color=array();
//			$color[]=array('id'=>1, 'cve'=>'NEGRO');


			foreach($rs['Color'] as $item) {
				$color[]=array('id'=>$item['id'], 'cve'=>trim($item['cve']) );
			}
	
			$out=array(
				'articulo_id'=>$rs['Articulo']['id'],
				'articulo_cve'=>trim($rs['Articulo']['arcveart']),
				'articulo_descrip'=>trim($rs['Articulo']['ardescrip']),
				'color_id'=>null,
				'color_cve'=>null,
				'talla_id'=>$rs['Articulo']['talla_id'],
				'talla_cve'=>trim($rs['Talla']['tadescrip']),
				'talla'=>array(
					array('label'=>$rs['Talla']['tat0'], 'index'=>'0'),
					array('label'=>$rs['Talla']['tat1'], 'index'=>'1'),
					array('label'=>$rs['Talla']['tat2'], 'index'=>'2'),
					array('label'=>$rs['Talla']['tat3'], 'index'=>'3'),
					array('label'=>$rs['Talla']['tat4'], 'index'=>'4'),
					array('label'=>$rs['Talla']['tat5'], 'index'=>'5'),
					array('label'=>$rs['Talla']['tat6'], 'index'=>'6'),
					array('label'=>$rs['Talla']['tat7'], 'index'=>'7'),
					array('label'=>$rs['Talla']['tat8'], 'index'=>'8'),
					array('label'=>$rs['Talla']['tat9'], 'index'=>'9')
				),
				'color'=>$color

			);

		}
		else {
			$out=array(
				'result'=>'error',
				'errorMessage'=>'Producto Inválido',
				);
		}
		echo json_encode($out);
	}

	public function getItem($articulo_id=null,$color_id=null,$talla_index=null) {
		$this->autoRender=false;
		$this->Articulo->recursive=1;
		$rs=$this->Articulo->findById($articulo_id);
		$out=array(
			'result'=>'error',
			'errorMessage'=>'Producto Inválido',
		);

		if($rs && isset($rs['Articulo']['id']) && $rs['Articulo']['id']>0) {
			$color=array();
//			$color[]=array('id'=>1, 'cve'=>'NEGRO');


			foreach($rs['Color'] as $item) {
				$color[]=array('id'=>$item['id'], 'cve'=>trim($item['cve']) );
				if($item['id']==$color_id) {
					$color_cve=trim($item['cve']);		
				}
			}
	
			$out=array(
				'articulo_id'=>$rs['Articulo']['id'],
				'articulo_cve'=>trim($rs['Articulo']['arcveart']),
				'articulo_descrip'=>trim($rs['Articulo']['ardescrip']),
				'color_id'=>$color_id,
				'color_cve'=>$color_cve,
				'talla_id'=>$rs['Articulo']['talla_id'],
				'talla_cve'=>trim($rs['Talla']['tadescrip']),
				'talla_index'=>$talla_index,
				'talla_label'=>trim($rs['Talla']['tat'.$talla_index]),
				'talla'=>array(
					array('label'=>$rs['Talla']['tat0'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat1'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat2'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat3'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat4'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat5'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat6'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat7'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat8'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat9'], 'cant'=>'')
				),
				'color'=>$color
			);

		}
		else {
			$out=array(
				'result'=>'error',
				'errorMessage'=>'Producto Inválido',
				);
		}
		echo json_encode($out);
	}


	public function getUbicacion($cve=null) {
		$this->autoRender=false;
		$this->Articulo->recursive=1;

		$out=array(
			'result'=>'error',
			'errorMessage'=>'Ubicación Inválida',
		);
		
		if(!$cve or empty($cve)) {
			echo json_encode($out);
			return;
		}
		
		if(is_numeric($cve)) {
			$rs=$this->Ubicacion->findById($cve);
		}
		else {
			$rs=$this->Ubicacion->findByCve($cve);
		}

		$out=array(
			'result'=>'error',
			'errorMessage'=>'Ubicación Inválida',
		);

		if($rs && isset($rs['Ubicacion']['id']) && $rs['Ubicacion']['id']>0) {
			$out=array(
				'id'=>$rs['Ubicacion']['id'],
				'cve'=>$rs['Ubicacion']['cve'],
				'zona'=>$rs['Ubicacion']['zona'],
				'fila'=>$rs['Ubicacion']['fila'],
				'espacio'=>$rs['Ubicacion']['espacio'],
			);
		}
		else {
			$out=array(
				'result'=>'error',
				'errorMessage'=>'Producto Inválido',
				);
		}
		echo json_encode($out);
	}

	public function getTransaccion($id=null) {
		$this->autoRender=false;
		$this->Artmovbodegadetail->recursive=1;

		$out=array(
			'result'=>'error',
			'errorMessage'=>'Transacción Inválida',
		);
		
		if(!$id || empty($id)) {
			echo json_encode($out);
			return;
		}
		
		if(is_numeric($id)) {
			$rs=$this->Artmovbodegadetail->findById($id);
		}
		else {
			$rs=$this->Artmovbodegadetail->findByFolio($id);
		}

		$out=array(
			'result'=>'error',
			'errorMessage'=>'Transacción Inválida',
		);

		if($rs && isset($rs['Artmovbodegadetail']['id']) && $rs['Artmovbodegadetail']['id']>0) {
			$out=$rs['Artmovbodegadetail'];
		}
		else {
			$out=array(
				'result'=>'error',
				'errorMessage'=>'Transacción Inválida',
				);
		}
		echo json_encode($out);
	}

}
