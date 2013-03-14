<?php 


class Facturadocto extends AppModel 
{
	// This is a MongoDB collection model
	public $useDbConfig = 'mongo';
	public $name = 'Facturadocto';

	public $table = 'facturadoctos';
	public $alias = 'Facturadocto';

	var $mongoSchema = array(
			'_id' => array('type'=>'integer'),
			'folio'=>array('type'=>'string'),
			'fecha'=>array('type'=>'date'),
			'content'=>array('type'=>'string'),
			'created'=>array('type'=>'datetime'),
			'modified'=>array('type'=>'datetime')
			);

}
