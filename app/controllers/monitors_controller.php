<?php
class MonitorsController extends AppController {

	var $name = 'Monitors';
	var $uses = array('Linea');
	var $cacheAction = array();
	var $layout = 'plain';
	
	function index() {
		
	}
	
	function monitordbactive() {
		$sql='select u.mon$attachment_id, u.mon$state, u.mon$user,u.mon$remote_address,
				u.mon$timestamp, u.mon$server_pid
			FROM mon$attachments u
			ORDER BY u.MON$ATTACHMENT_ID';
		$dataset=$this->Linea->query($sql);
		$this->set('data',$dataset);
	}

	function runningdbquerys() {
		$sql='select u.mon$attachment_id, u.mon$state, d.mon$timestamp, d.MON$TRANSACTION_ID,
			d.MON$SQL_TEXT, u.mon$user, u.mon$remote_address 
			FROM mon$attachments u
			JOIN MON$STATEMENTS d on u.MON$ATTACHMENT_ID = d.MON$ATTACHMENT_ID
			ORDER BY u.MON$ATTACHMENT_ID, d.MON$TRANSACTION_ID';
		$dataset=$this->Linea->query($sql);
		$this->set('data',$dataset);
	}

	function abracadabra() {
		$this->layout='empty';
	}

	function apc() {
		$this->layout='empty';
	}

	function memcache() {
		$this->layout='empty';
	}

}
?>