<?php 
/* Meta Tags */
echo CR.
'<meta charset="utf-8">'.CR.
//	$this->Html->charset().CR.
	$this->Html->meta(array('name'=>'viewport', 'content '=> 'width=1024, initial-scale=1.0')).CR.
'<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1,webkit=1,safari=1">'.CR.
	$this->Html->meta(array('name'=>'description', 'content' => $title_for_layout)).CR.
	$this->Html->meta(array('name'=>'keywords', 'content' => 'axbos idd erp intranet junior oggi '.$this->name)).CR.
	$this->Html->meta('icon').CR.
	CR;
	

