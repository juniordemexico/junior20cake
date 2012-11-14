<?php


class ArticulosReportsController extends MasterDetailAppController {
	var $name='ArticulosReports';

	var $uses = array(
		'Articulo','Talla','Linea','Marca','Temporada','Divisa','Unidad','Cliente','Proveedor','Vendedor'
	);

/*
	var $paginate = array(	'update' => '#content',
							'evalScripts' => true,
							'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
							'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
							'limit' => 15,
							'order' => array('Articulo.arcveart' => 'asc'),
						);
*/

	function index() {
		$this->Render('/reports/articulos/index');
	}


}

	function indice() {
	}

function indextable()
{
/*
	if(!isset($page)) $page=1;
	if(!isset($rows)) $rows=20;
	if(!isset($sidx)) $sidx=1;
	if(!isset($sord)) $sord=1;
*/	
$this->layout= 'empty';
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 20,
								'order' => array('Articulo.arcveart' => 'asc')
								);

		$this->Articulo->recursive = 1;
		$filter = $this->Filter->process($this);
		$this->set('result', $this->paginate($filter));
//$result = $this->Articulo->find('all',array('fields' => array('id', 'arcveart')) );


}



function viewPdf($id = null) { 
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

?>