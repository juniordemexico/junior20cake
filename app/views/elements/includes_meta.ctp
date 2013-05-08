<?php 
/* Meta Tags */
echo CR.
'<meta charset="utf-8">'.CR.
$this->Html->meta(array('name'=>'viewport', 'content '=> 'width=1024, initial-scale=1.0')).LF.
'<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1,webkit=1,safari=1">'.LF.
$this->Html->meta(array('name'=>'description', 'content' => $title_for_layout)).LF.
$this->Html->meta(array('name'=>'keywords', 'content' => 'axbos idd erp intranet junior oggi '.$this->name.' '.$this->action.' '.$title_for_layout)).LF.
$this->Html->meta('icon').LF.
LF;
//	$this->Html->charset().CR.

