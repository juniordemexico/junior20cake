<?php 
/* Meta Tags */
echo
	'<meta charset="UTF-8">'.CR.
	$this->Html->charset().CR.
	$this->Html->meta(array('name'=>'viewport', 'content '=> 'width=device-width, initial-scale=1.0')).CR.
	$this->Html->meta('icon').CR.
	$this->Html->meta(array('name'=>'description', 'content' => $title_for_layout)).CR.
	$this->Html->meta(array('name'=>'keywords', 'content' => 'axbos idd erp intranet junior oggi '.$this->name)).CR.
	CR;
	

