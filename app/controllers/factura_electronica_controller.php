<?php
class FacturaElectronicaController extends MasterDetailAppController {

	var $uses = array('Factura','Cliente','Vendedor','Divisa');

	var $cacheAction = array();

	var $tableFields = 	array(
							'id','farefer','fafecha','fat','fast','fasuma','faimporte','faimpoimpu','fatotal',
							'fapedido',
							'cliente_id','Cliente.clcvecli','Cliente.cltda','Cliente.clnom','Cliente.clsuc',
							'vendedor_id','Vendedor.vecveven','Vendedor.venom','fadivisa',
							'crefec','modfec');
	var $layout = 'plain';
	
	function index() {
		$this->Factura->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 10,
								'order' => array('Factura.farefer' => 'desc'),
								'fields' => $this->tableFields,
								'conditions' => array("Factura.crefec >" => date('Y-m-d', strtotime("-12 months")),'Factura.faT'=>'0'),
								'doJoinUservendedor'=>true,
								'session' => $this->Auth->User(),
								);

		$filter = $this->Filter->process($this);
		$this->set('facturas', $this->paginate($filter));
	}
	
	function download($id=null, $format='pdf') {
		if ( isset($params['named']['format']) && !empty($params['named']['format']) ) {
			$format=strtolower(trim($params['named']['format']));
		}

		$this->Factura->Recursive=0;
		$result=$this->Factura->read(null, $id);
		// The Requested ID doesn't exists
		if(!$result) { 
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}

		if($format=='pdf') {
			// Search the related media file
			$filename=trim($result['Factura']['farefer']).'.'.$format;
			if(!file_exists(APP . 'files'.DS.'facturaselectronicas' . DS. $filename)) {
				$this->Session->setFlash(__('file does not exist', true).': '.$result['Factura']['farefer'], 'error');
				$this->redirect(array('action' => 'index'));			
			}
		}
		elseif ($format=='xml') {
			// Search the related media file
			$filename='JME910405B83-'.trim($result['Factura']['farefer']).'.'.$format;
			if(!file_exists(APP . 'files'.DS.'facturaselectronicas' . DS. $filename)) {
				$this->Session->setFlash(__('file does not exist', true).': '.$filename, 'error');
				$this->redirect(array('action' => 'index'));			
			}
			
		}

		// Send the requested media file
		$this->view = 'Media';
		$params = array('id' => $filename,
						'name' => trim($result['Factura']['farefer']),
						'download' => true,
						'extension' => $format,
						'path' => APP . 'files'.DS.'facturaselectronicas' . DS);
		$this->set($params);
	}

	public function getAllXmlByCliente($cliente_str=null) {
		if(!$cliente_str) {
			die("El formato de la URL debe ser: http://servidor.com/FacturaElectronica/getAllXmlByCliente/XXXXXX/filename:archivo.zip\n<br/>XXXXX=Nombre o RFC del Cliente<br/>archivo.zip=Nombre del Archivo ZIP donde se empacaran los documentos encontrados");
		}
		if(isset($this->params['named']['filename'])) {
			$zipfilename=$this->params['named']['filename'];
		}
		elseif( isset($this->params['url']['filename']) ) {
			$zipfilename=$this->params['url']['filename'];
		}
		else {
			$zipfilename=''.date('Ymd').'.zip';
		}
		$cmd='sudo find . -type f  -name "JME910405B83*.xml" \( -name "*B00*" -or -name "*B-*" \) -exec grep -il "'.$cliente_str.'" "{}" \; |sort | zip /home/www/junior20cake/app/files/tmp/nuevomundo.xml.zip \@';

	}

}
	
?>