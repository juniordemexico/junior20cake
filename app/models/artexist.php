<?php

class Artexist extends AppModel 
{
	var $name = 'Artexist';
	var $table = 'Artexist';
	var $useTable = 'Artexist';
	var $alias = 'Artexist';

	var $belongsTo = array(
		'Articulo', 'Color'
		);
}
