<?php


class TipoequiposController extends MasterAppController {
	public $name='Tipoequipos';

	public $uses = array('Tipoequipo');

	public $cacheAction = array('view',
							);

	public $paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Tipoequipo.cve'),
								'conditions' => array(),
								); 

}

