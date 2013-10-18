<?php


class EquiposController extends MasterAppController {
	public $name='Equipos';

	public $uses = array('Equipo');

	public $cacheAction = array('view',
							);

	public $paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Group.cve','User.username'),
								'conditions' => array(),
								);

}

