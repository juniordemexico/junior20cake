<?php

class AxfileComponent extends Component
{


	function startup( &$controller ) {
		$this->controller =& $controller;
	}


	function FileToString($filename) {
 		$file=fopen($filename, 'r');
 		if (!$file) return false;
 		$contents=fread($file, filesize($filename));
 		fclose($file);
 		return $contents;
	}
     
	function StringToFile($filename, &$string, $mode='w') {
 		$File=fopen($filename, $mode);
 		fputs($File, $string, strlen($string));
 		fclose($File);
 		if (file_exists($filename)) return true; else return false;
	}


}
