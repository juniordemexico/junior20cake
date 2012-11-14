<?php
class HistoryController extends AppController {

	var $name = 'History';
	var $uses = array();
	var $components = array('Auth');
	var $cacheAction = array('index');

	var $logfileMinFragment= 65536;
	var $logShortTail = 65536;
	var $logFullTail = 262144;
	
	function index() {
		
	}

	function getlog($logID=null) {
		$this->layout='empty';
		$this->autoRender=false;
	    $files=array('httpdaccess'=>array('filename'=>'/usr/local/apache22/logs/junior20cake-access_log', 'content'=>'httpd access'),
					'httpderror'=>array('filename'=>'/usr/local/apache22/logs/junior20cake-error_log', 'content'=>'httpd error'),
					'cakephperror'=>array('filename'=> APP.DS.'tmp/logs/error.log', 'content'=>'cakephp log'),
					'cakephpdebug'=>array('filename'=> APP.DS.'tmp/logs/debug.log', 'content'=>'cakephp debug'),
					'axbos-access'=>array('filename'=> APP.DS.'tmp/logs/axbos-access.log', 'content'=>'axbos acess'),
					'axbos-error'=>array('filename'=> APP.DS.'tmp/logs/axbos-error.log', 'content'=>'axbos error'),
					'phperror'=>array('filename'=>'/Users/Shared/Develop/www/log/php5/php5-error.log', 'content'=>'php error'),
					);

		/* Check if the requested log file exists and is accesible */
		
		if(!array_key_exists($logID,$files) || !file_exists($files[$logID]['filename'])) {
			echo "ERROR: ARCHIVO DE REGISTRO INEXISTENTE";
			exit;
		}
		
		if(isset($this->params['url']['limit:short']))
			$logTail=$this->logShortTail;
		else
			$logTail=$this->logFullTail;
		
		echo "<pre>\n\n".file_get_contents($files[$logID]['filename'], FILE_TEXT, null,(filesize($files[$logID]['filename'])-$logTail),$logTail)."\n\n</pre>\n";
		exit;
	}

}
?>