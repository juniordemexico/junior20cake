<?php

class NcreditoController extends MasterDetailAppController {

	var $uses = array('Ncredito', 'Ncreditodet', 'Cliente','Vendedor','Divisa');

	var $cacheAction = array();

	var $tableFields = 	array(
							'id','ncrefer','ncfecha','nct','ncst','ncsuma','ncimporte','ncimpoimpu','nctotal',
							'ncfactura','ncdevol', 'ncvobo',
							'cliente_id','Cliente.clcvecli','Cliente.cltda','Cliente.clnom','Cliente.clsuc',
							'vendedor_id','Vendedor.vecveven','Vendedor.venom','ncdivisa',
							'crefec','modfec');
	var $layout = 'plain';
	
	var $pathDOCS;
	
	function index() {
		$this->Ncredito->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 10,
								'order' => array('Ncredito.ncrefer' => 'desc'),
								'fields' => $this->tableFields,
								'conditions' => array("Ncredito.crefec >" => date('Y-m-d', strtotime("-12 months")),'Ncredito.nct'=>'0'),
								'doJoinUservendedor'=>true,
								'session' => $this->Auth->User(),
								);

		$filter = $this->Filter->process($this);
		$this->set('items', $this->paginate($filter));
	}

	public function imprime( $id = null ) {
		if (!$id || !$id>0) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}

		$data=$this->{$this->masterModelName}->getItemWithDetails($id);

		$data['Comprobante']=array(
			'uuid'=>'0749CF42-905C-4419-8095-15A4667B5FD7',
			'sello_emisor'=>'aegaMjno7PYJ512c0OZIxKrsWX0x5xYA7/qbT3Xn//Fby4pyfntTuD+msJXMcB6/TqmEmt1lPKGurCvHgxJg0kAgV3zxTH1H85gJboxSDdv98tp5+BApBIGA0KYm0TdcXnzHR/UAL+5jEKblWCHvoHb+mgW5LZaPDjVk7DxMZpo=',
			'fecha_timbrado'=>'2013-11-19 01:00:00',
			'no_certificado_sat'=>'01000006746677',
			'sello_cfd'=>'aegaMjno7PYJ512c0OZIxKrsWX0x5xYA7/qbT3Xn//Fby4pyfntTuD+msJXMcB6/TqmEmt1lPKGurCvHgxJg0kAgV3zxTH1H85gJboxSDdv98tp5+BApBIGA0KYm0TdcXnzHR/UAL+5jEKblWCHvoHb+mgW5LZaPDjVk7DxMZpo=',
			'sello_sat'=>'5aLqDjNxqBZ8skNBZa03+WHpgwE6lbcEtGJ3EPlUqkndlFDoK9/Ub4GZQS0rheqbcl5A2zlWIzAbtL+GWFdDOXVLzNkL6qNl8VV+OZOcVB6/34sVJyEq4/8fxeIh7UIGKwz9gl7vwHMik0C7F4N622Yv6q7Zcrg5trszkCXvBU4=',
			'codigo_qr'=>'?re=JME910405B83&rr=GOCG650610IXA&tt=0000003336.060000&id=0749CF42-905C-4419-8095-15A4667B5FD7'
);
		$this->layout='print';
		$this->set('result', 'ok' );
		$this->set('data', $data );
		$this->set('title_for_layout', ucfirst($this->name).'::'.
					$data['Master'][$this->masterModelTitle]
				);
	}

	public function imprimepdf( $id = null ) {
		if (!$id || !$id>0) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}

		$data=$this->{$this->masterModelName}->getItemWithDetails($id);

		$data['Comprobante']=array(
			'uuid'=>'0749CF42-905C-4419-8095-15A4667B5FD7',
			'sello_emisor'=>'aegaMjno7PYJ512c0OZIxKrsWX0x5xYA7/qbT3Xn//Fby4pyfntTuD+msJXMcB6/TqmEmt1lPKGurCvHgxJg0kAgV3zxTH1H85gJboxSDdv98tp5+BApBIGA0KYm0TdcXnzHR/UAL+5jEKblWCHvoHb+mgW5LZaPDjVk7DxMZpo=',
			'fecha_timbrado'=>'2013-11-19 01:00:00',
			'no_certificado_sat'=>'01000006746677',
			'sello_cfd'=>'aegaMjno7PYJ512c0OZIxKrsWX0x5xYA7/qbT3Xn//Fby4pyfntTuD+msJXMcB6/TqmEmt1lPKGurCvHgxJg0kAgV3zxTH1H85gJboxSDdv98tp5+BApBIGA0KYm0TdcXnzHR/UAL+5jEKblWCHvoHb+mgW5LZaPDjVk7DxMZpo=',
			'sello_sat'=>'5aLqDjNxqBZ8skNBZa03+WHpgwE6lbcEtGJ3EPlUqkndlFDoK9/Ub4GZQS0rheqbcl5A2zlWIzAbtL+GWFdDOXVLzNkL6qNl8VV+OZOcVB6/34sVJyEq4/8fxeIh7UIGKwz9gl7vwHMik0C7F4N622Yv6q7Zcrg5trszkCXvBU4=',
			'codigo_qr'=>'?re=JME910405B83&rr=GOCG650610IXA&tt=0000003336.060000&id=0749CF42-905C-4419-8095-15A4667B5FD7'
);
		$this->layout='pdf';
		$this->set('result', 'ok' );
		$this->set('data', $data );
		$this->set('title_for_layout', ucfirst($this->name).'::'.
					$data['Master'][$this->masterModelTitle]
				);
	}


	public function generaxml($id=null) {
		if (!$id) {
			if(isset($this->params['url']['id'])) {
				$id=$this->params['url']['id'];
			}
			else {
				die("ERROR. NO PASA EL ID");
			}
		}
		
		// Generamos el XML con Cadena Original y Sello
		$docto=$this->Ncredito->getDoctoForCFDI( $id );
		
		if ( !$this->AxFolioselectronicos->createCFDI( $docto ) ) {
			echo '<div class="well well-small text-error"><h3>Error al Crear XML CFDi</h3>'.
				$this->AxFolioselectronicos->message.
				'</div>';
			return;
		}
		else {
			echo '<div class="well well-small text-success"><h3>Creación de XML para CFDi</h3>'.
				$this->AxFolioselectronicos->message.
				'</div>';
		}

		// Envia el documento a timbrar por medio del Webservice
		if ( !$this->AxFolioselectronicos->timbrarComprobanteFiscal() ) { 
			echo '<div class="well well-small text-error"><h3>Error al Timbrar XML CFDi</h3>'.
				$this->AxFolioselectronicos->message.
				'</div>';
			return;
		}
		else {
			echo '<div class="well well-small text-success"><h3>Timbrado del CFDi por el PAC</h3>'.
				$this->AxFolioselectronicos->message.
				'</div>';
		}

		echo '<div class="well well-small text-info"><h3>Respuesta del PAC</h3>'.
			'<p>'.$this->AxFolioselectronicos->message.'</p>'.
			'<code>'.htmlspecialchars($this->Axfile->FileToString($this->AxFolioselectronicos->pathDOCS.DS.$this->AxFolioselectronicos->documento['filename'])).'</code>'.
			'</div>';

		echo '<div class="well well-small text-error"><h3>Datos obtenidos del PAC</h3><code>';
		print_r($this->AxFolioselectronicos->documento);
		echo '</code></div>';

	}

	public function qrcode($id=null) {
		if(!$id) {
			$id=$this->params['url']['id'];
		}

		$appPath=APP.DS.'files/comprobantesdigitales/';
		$filename='JME910405B83-'.$id.'.png';
		$format='png';
		
		$this->view = 'Media';
		$params = array('id' => $filename,
						'name' => $filename,
						'download' => false,
						'extension' => $format,
						'path' => $appPath.DS);
		$this->set($params);
	}


	function download($id=null, $format='pdf') {
		if ( isset($params['named']['format']) && !empty($params['named']['format']) ) {
			$format=strtolower(trim($params['named']['format']));
		}
		if ( isset($params['url']['format']) && !empty($params['url']['format']) ) {
			$format=strtolower(trim($params['url']['format']));
		}

//		$appPath=APP;
		$appPath='/home/www/junior20cake/app/';
		
		$this->Ncredito->Recursive=0;
		$result=$this->Ncredito->read(null, $id);
		// The Requested ID doesn't exists
		if(!$result) { 
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}

		if($format=='pdf') {
			// Search the related media file
			$folder='pdf';
			$filename=trim($result['Ncredito']['ncrefer']).'.'.$format;
			if(!file_exists($appPath.'files'.DS.'nccturaselectronicas'.DS.$folder.DS.$filename)) {
				$this->Session->setFlash(__('file does not exist', true).': '.$appPath.'files'.DS.'nccturaselectronicas'.DS.$folder.DS.$filename, 'error');
				$this->redirect(array('action' => 'index'));			
			}
		}
		elseif ($format=='xml') {
			// Search the related media file
			$folder='xml';
			$filename='JME910405B83-'.trim($result['Ncredito']['ncrefer']).'.'.$format;
			if(!file_exists($appPath.'files'.DS.'nccturaselectronicas'.DS.$folder.DS.$filename)) {
				$this->Session->setFlash(__('file does not exist', true).': '.$filename, 'error');
				$this->redirect(array('action' => 'index'));			
			}
			
		}

		// Send the requested media file
		$this->view = 'Media';
		$params = array('id' => $filename,
						'name' => 'JME910405B83'.'-'.trim($result['Ncredito']['ncrefer']),
						'download' => true,
						'extension' => $format,
						'path' => $appPath . 'files'.DS.'nccturaselectronicas'.DS.$folder.DS);
		$this->set($params);
	}


}
