<?php


class InvfisicosmovilController extends MasterDetailAppController {
	var $name='Invfisicosmovil';

	var $uses = array('Invfisicodetail', 'Invfisico', 'Almacen', 'Articulo', 'Color', 'Talla', 'Ubicacion', 'Printer', 'User' );

	var $layout = 'almacenmovil';

	var $currentPrinter=array('id'=>11, 'cve'=>'Zebra01', 'printqueue'=>'barcodes-viaducto01');

	public function beforeFilter() {
/*
		if($this->Auth->User('id')<>2) {
			die("TIEMPO AGOTADO. DEPOSITE OTRA MONEDA :)");
		}
		parent::beforeFilter();	
*/
	}

	public function index() {
		$this->set('title_for_layout', "Inventario Físico");		
//		$this->set('items', $this->paginate($filter));
	}

	public function materiales() {
		$this->set('title_for_layout', "Inventario Físico Materiales");	
		
//		$this->set('items', $this->paginate($filter));
	}

	public function addItem() {
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

			if(!isset($theData['conteo'])) {
				$theData['conteo']=1;
			}

			if($theData['conteo']==1) {
				$tipomovinvfisico_id=1;
			}
			else {
				$tipomovinvfisico_id=100;				
			}
			
			$data=array(
				'invfisico_id'=>1,
				'ubicacion_id'=>$theData['ubicacion_id'],
				'articulo_id'=>$theData['articulo_id'],
				'color_id'=>$theData['color_id'],
				'talla_index'=>$theData['talla_index'],
				'cant'=>$theData['cantidad'],
				'tipomovinvfisico_id'=>$tipomovinvfisico_id,
				'st'=>'A',
				'user_id'=>$this->Auth->user('id')
				);
			
//			$existeConteo2=$this->Invfisicodetail->Value;
			$this->data['Invfisicodetail']=$data;
			$this->Invfisicodetail->create();

			if($this->Invfisicodetail->save($this->data)) {
				// Print the Inventory's label for this entry....
				$data['id']=$this->Invfisicodetail->id;
				$data['created']=date('Y/m/d H:i:s');
				if(isset($theData['printlabel']) && $theData['printlabel']) {
					$this->_printlabel($data);
				}

				// Success...
				$out=array(
					'result'=>'recibido',
					'message'=>'GUARDADO MARBETE: '.$data['id'].(isset($theData['printlabel']) && $theData['printlabel']?' Impreso en '.$this->currentPrinter['cve']:'')
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
					(!isset($theData['articulo_id']) || !($theData['articulo_id']>0) ? ' Falta el Articulo.' : '').
					(!isset($theData['color_id']) || !($theData['color_id']>0) ? ' Falta el Color.' : '').
					(!isset($theData['talla_index']) || !($theData['talla_index']>=0) ? ' Falta la Talla.' : '').
					(!isset($theData['cantidad']) || !($theData['cantidad']>0) ? ' Falta la Cantidad.' : '')
					)
			);
		}

		echo json_encode($out);
	}

/*
	public function printlabelByMarbete($id=null) {
		if(!$id || !($id>0)) return false;
		$rs=$this->Invfisicodetail->
	}
*/	
	
	public function pasasegundo($articulo_id=null) {
		$this->autoRender=false;
		if(!$articulo_id) {
			echo "Error: No se Especifica el Articulo a Copiar";
			exit;
		}

		$articulo=$this->Articulo->findById($articulo_id);


		$options=array(		'order'=>array('Invfisicodetail.id'),
							'conditions'=>array(
								'Invfisicodetail.articulo_id'=>$articulo_id,
								'Invfisicodetail.st'=>'A', 
								'Invfisicodetail.tipomovinvfisico_id'=>1
								));
		$itemsPrimero=$this->Invfisicodetail->find('all', $options);

		$out=array(	'result'=>'',
					'message'=>''
				);

		if($itemsPrimero && count($itemsPrimero)>0 ) {
			$total=0;
			$count=0;
			foreach($itemsPrimero as $item) {
				$marbete_id=$item['Invfisicodetail']['id'];
				$item['Invfisicodetail']['invfisicodetail_id']=$marbete_id;
				$item['Invfisicodetail']['tipomovinvfisico_id']=100;
				unset($item['Invfisicodetail']['id']);
				unset($item['Invfisicodetail']['created']);
				unset($item['Invfisicodetail']['modified']);
				$data=array('Invfisicodetail'=>$item['Invfisicodetail']);
				$total=$total+$data['Invfisicodetail']['cant'];
				$count++;

				$ok=true;
				$this->Invfisicodetail->create();
				if( $this->Invfisicodetail->save($item) ) {
						// nice
				}
				else {
					$ok=false;
				}

			}
			if($ok) {
				$out='Se copió '.$articulo['Articulo']['arcveart'].
					'('.$total.' Pzas en '.$count.' Marbetes) al Segundo Conteo.';
			}
			else {
					$out=	'Error al generar Segundo Conteo. Articulo: '.$articulo['Articulo']['arcveart'];				
			}
		}
		else {
			$out='No se encontro Primer Conteo. Articulo: '.$articulo['Articulo']['arcveart'];
		}
		echo $out;
	}
	
	
	function cancelamarbete($id=null) {
		if(!$id || !is_numeric($id) || !($id>0)) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			exit;
		}
		$data=$this->Invfisicodetail->findById($id);
		if($data && isset($data['Invfisicodetail']['id']) && $data['Invfisicodetail']['id']>0) {
			$this->Invfisicodetail->read(null, $id);
			if($this->Invfisicodetail->saveField('st', 'C')) {
				$this->Session->setFlash('Marbete <strong>'.$data['Invfisicodetail']['articulo_id'].'</strong> '.
										'Capturado el <strong>'.$data['Invfisicodetail']['created'].'</strong> '.
										'SE CANCELÓ.',
										'success');				
			}
			else {
				$this->Session->setFlash('El Marbete <strong>'.$id.'</strong> NO se pudo Cancelar', 
										'error');				
			}
		}
		else {
			$this->Session->setFlash('El Marbete <strong>'.$id.'</strong> NO Existe', 
									'error');			
		}
	}

	function imprimemarbete($id=null) {
		if(!$id || !is_numeric($id) || !($id>0)) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			exit;
		}
		$data=$this->Invfisicodetail->findById($id);
		if($data && isset($data['Invfisicodetail']['id']) && $data['Invfisicodetail']['id']>0) {
			$this->_printlabel($data['Invfisicodetail']);
			$this->Session->setFlash('Marbete <strong>'.$data['Invfisicodetail']['articulo_id'].'</strong> '.
									'Capturado el <strong>'.$data['Invfisicodetail']['created'].'</strong> '. 
									'Se imprimió en '.$this->currentPrinter['cve'].'.',
									'success');
		}
		else {
			$this->Session->setFlash('El Marbete <strong>'.$id.'</strong> NO Existe', 
									'error');			
		}
	}
	
	function _printlabel($data=array()) {
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
		
		$rsuser=$this->User->findById($data['user_id']);
		$username=$rsuser['User']['username'];
		$rs=$this->Articulo->findById($data['articulo_id']);
		if($rs) {
			$label='

N
D14
A025,025,0,4,1,1,N,"'.$data['created'].'"
A450,025,0,4,1,1,N,"Oper: '.$username.'"
A025,75,0,5,1,1,N,"'.$articulo_cve.'"
A025,150,0,5,1,1,N,"'.$color_cve.'"
A025,225,0,5,1,1,N,"TALLA: '.$talla_label.'"
A450,225,0,5,1,1,N,"CANT:'.(int)$data['cant'].'"
B050,300,0,1,2,3,75,N,"t%p,id%'.$data['articulo_id'].',c%'.$data['color_id'].',t%'.$data['talla_index'].'"
A050,400,0,4,1,1,N,"MARBETE: '.$data['id'].'"
A450,400,0,4,1,1,N,"UBICACION: '.$ubicacion_cve.'"
B050,425,0,1,4,6,100,N,"t%m,id%'.$data['id'].'"
A050,535,0,4,1,1,N,"'.(abs($data['tipomovinvfisico_id'])>=100?'S  E  G  U  N  D  O    C  O  N  T  E  O':' ').'"
P1
';				
			$filename='/home/www/junior20cake/app/webroot/'.
					'files/tmp/tmp.marbete.'.$data['id'].'.label.test.txt';
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
				if($item['id']==$color_id) {
					$color[]=array('id'=>$item['id'], 'cve'=>trim($item['cve']) );
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
			$color=array();
			$color[]=array('id'=>1, 'cve'=>'NEGRO');


			foreach($rs['Color'] as $item) {
				$color[]=array('id'=>$item['id'], 'cve'=>trim($item['cve']) );
			}
	
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

}
