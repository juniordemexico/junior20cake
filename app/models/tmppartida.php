<?php


class Tmppartida extends AppModel 
{
	public $name = 'Tmppartida';

	public $table = 'Tmppartidas';
	public $alias = 'Tmppartida';
	public $primaryKey = 'id';
	
	public $persistModel = true;
	public $cacheQueries = false;
	public $recursive = 2;
	public $cache=false;
	
	public $validate = array(

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'User' =>
			array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'order' => 'User.username',
			'counterCache' => true
			)
		,
		'Articulo' =>
			array(
			'className' => 'Articulo',
			'foreignKey' => 'articulo_id',
			'order' => 'Articulo.arcveart',
			'counterCache' => ''
			)
		,
		'Color' =>
			array(
			'className' => 'Color',
			'foreignKey' => 'color_id',
			'order' => 'Color.nom',
			'counterCache' => ''
			)
		,
	);

	function getDetail($id=null) {
		if(!$id) return false;
		$rs=$this->Query();
	}

	function getDetailTallaColor($id=null) {
		if(!$id) return false;
		$rs=$this->Query();
	}

	function getLine($id=null) {
		if(!$id) return false;
		$rs=$this->Query();
	}

	function getLineTallaColor($id=null) {
		if(!$id) return false;
		$rs=$this->Query();
	}
	
	function getArticulos() {
		$articulos = $this->Articulo->find
		(
			'list',
			array
			(
				'fields' => array('id', 'arcveart'),
				'order' => 'Articulo.arcveart ASC',
				'recursive' => -1
			)
		);
		return compact('articulos');
	}

	function getColores() {
		$colores = $this->Color->find
		(
			'list',
			array
			(
				'fields' => array('id', 'cve'),
				'order' => 'Color.cve ASC',
				'recursive' => -1
			)
		);
		return compact('colores');
	}

}

?>