<?php


class VendedoresController extends MasterDetailAppController {
	var $name='Vendedores';

	var $uses = array('Vendedor', 'Cliente', 'Pais', 'Estado');
	
	var $layout='default';
	
	var $cacheAction = array('view'
							);

	function add() { 
		if (!empty($this->data)) {
			if ($this->Vendedor->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Vendedor->id.')', 'success');
				$this->redirect(array('action' => 'index', 'idd' => false));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		$paises = $this->Vendedor->Pais->find('list', array('fields' => array('Pais.id', 'Pais.papais')));
		$this->set(compact('paises'));
		$divisas = $this->Vendedor->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		$this->set(compact('divisas'));
		$estados = $this->Vendedor->Estado->find('list', array('fields' => array('Estado.id', 'Estado.esedo')));
		$this->set(compact('estados'));
	}

	function delete($id) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Vendedor->delete($id)) {
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
				$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('item_was_not_deleted', true), 'error');
		$this->redirect(array('action' => 'index'));
	}

	function index() {
		$this->Vendedor->recursive = 0;
		$this->set('vendedores', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_vendedor', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		$this->set('vendedor', $this->Vendedor->read(null, $id));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_vendedor', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Vendedor->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Vendedor->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Vendedor->find(array('id'=>$id),array('created','modified'));
				$this->data['Vendedor']['created'] = $dates['Vendedor']['created'];
				$this->data['Vendedor']['modified'] = $dates['Vendedor']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Vendedor->read(null, $id);
		}
		$paises = $this->Vendedor->Pais->find('list', array('fields' => array('Pais.id', 'Pais.papais')));
		$this->set(compact('paises'));
		$divisas = $this->Vendedor->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		$this->set(compact('divisas'));
		$estados = $this->Vendedor->Estado->find('list', array('fields' => array('Estado.id', 'Estado.esedo')));
		$this->set(compact('estados'));
	}

	/* Text Field Autocomplete action */
	function autoComplete() {
 		Configure::write ( 'debug', 0 );
		$this->autoRender=false;
  		$this->layout = 'ajax';

		/* Validate and Format the search term */
		$term=strtoupper(substr(trim($_GET['term']),0,32));

		/* Configure and Execute the Query */
		$this->Vendedor->recursive=0;
  		$results = $this->Vendedor->find('all', array(
			'fields'=>array('Vendedor.id','Vendedor.vecveven','Vendedor.venom'),
			'order'=>'Vendedor.vecveven ASC',
			'limit'=>32,
			'conditions' => array(
   					'OR' => array(
    					'Vendedor.vecveven LIKE'=>$term.'%',
    					'Vendedor.venom LIKE'=>'%'.$term.'%'
   						),
/*					'Vendedor.prst'=>'A'*/
  					)
			));

		/* Create the dataset to be returned */
		$response = array();
		$i=0;
		foreach($results as $result) {
   			$response[$i]['id']=$result['Vendedor']['id'];
   			$response[$i]['value']=trim($result['Vendedor']['vecveven']);
   			$response[$i]['label']='('.trim($result['Vendedor']['vecveven']) . ') ' . $result['Vendedor']['venom'];
   			$i++;
  		}
		/* Send the response in json format */
  		echo json_encode($response);
	}

}

?>
