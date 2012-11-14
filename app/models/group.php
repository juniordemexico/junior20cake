<?php

//	vest CHAR(1) DEFAULT '' NOT NULL

class Group extends AppModel 
{
	public $name = 'Group';
	public $table = 'groups';
	public $useTable = 'groups';
	public $alias = 'Group';
	public $cache=true;


	public $validate = array(
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $hasMany = array(
		'User',
	);

}

?>