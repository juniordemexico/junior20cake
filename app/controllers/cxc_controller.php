<?php


class CxcController extends MasterDetailAppController {
	var $name='Cxc';

	var $uses = array(
		'Cxc'
	);

/*
	var $paginate = array(	'update' => '#content',
							'evalScripts' => true,
							'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
							'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
							'limit' => 15,
							'order' => array('Cxc.arcveart' => 'asc'),
						);
*/
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_transaction', true));
				$this->redirect(array('action' => 'index'));
		}
		$this->set('pedido', $this->Cxc->read(null, $id));
	}

	function delete($id) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_transaction', true));
				$this->redirect(array('action' => 'index'));
		}
		if ($this->Cxc->delete($id)) {
			$this->Session->setFlash(__('transaction_has_been_deleted', true).': '.$id,'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('transaction_was_not_deleted', true));
				$this->redirect(array('action' => 'index'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_transaction', true));
				$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Cxc->save($this->data)) {
				$this->Session->setFlash(__('transaction_has_been_saved', true),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Cxc->find(array('id'=>$id),array('created','modified'));
				$this->data['Cxc']['created'] = $dates['Cxc']['created'];
				$this->data['Cxc']['modified'] = $dates['Cxc']['modified'];
				$this->Session->setFlash(__('transaction_could_not_be_saved', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cxc->read(null, $id);
		}
		$divisas = $this->Cxc->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		$this->set(compact('divisas'));
		$temporadas = $this->Cxc->Temporada->find('list', array('fields' => array('Cliente.id', 'Cliente.clnom')));
		$this->set(compact('clientes'));
	}

	function add() { 
		if (!empty($this->data)) {
			if ($this->Cxc->save($this->data)) {
				$this->Session->setFlash(__('transaction_has_been_saved', true),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('transaction_could_not_be_saved', true));
			}
		}
		$divisas = $this->Cxc->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		$this->set(compact('divisas'));
		$temporadas = $this->Cxc->Temporada->find('list', array('fields' => array('Cliente.id', 'Cliente.clnom')));
		$this->set(compact('clientes'));
	}

	function index() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 15,
								'order' => array('Cxc.arcveart' => 'asc')
								);
//										'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
//										'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),

		$this->Cxc->recursive = 1;
//		if(!isset($toTemplateVarName) || empty($toTemplateVarName)) {
			$toTemplateVarName=strtolower($this->name);
//		}
	//	$this->Cxc->recursive = 0;
		$filter = $this->Filter->process($this);
		$this->set('Cxc', $this->paginate($filter));
//		parent::index();
	}

	/**********************************************************************************************************
		Function:	createReport()
		Action:		Build a dynamic report.
	**********************************************************************************************************/
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
			//Setup options for report component
			/*
				You can setup a level two association by doing the following:
				"VehicleDriver"=>"Employee" ie $models = Array ("Vehicle", "VehicleDriver"=>"Employee");
				Please note that all fields within a level two association cannot be sorted.
			*/
			$models =	Array ("Cxc",'Marca','Linea','Temporada');

			//Set array of fields
			$this->set('report_form', $this->Report->init_form($models));

			//Set current controller
			$this->set('cur_controller', $this->name);

			//Pull all existing reports
			$this->set('existing_reports', $this->Report->existing_reports());
		}
	}	

	function Monitor() {
		$this->Cxc->recursive = 1;
		$this->data = $this->Cxc->readAll();			
	}
}

?>