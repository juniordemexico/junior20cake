<?php

class Partida extends AppModel 
{
	var $name = 'Partida';
	var $table = 'Partidas';
	var $alias = 'Partidas';

	var $belongsTo = array(
		'Articulo' =>
			array(
			'className' => 'Articulo',
			'foreignKey' => 'articulo_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
			)
		);

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

}
