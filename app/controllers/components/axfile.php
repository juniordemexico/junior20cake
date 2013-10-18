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

	function FileToArray($filename) {
		$File = @fopen($filename, "r");
		if ($File) {
			$out=array();
    		while (($buffer = fgets($File, 8192)) !== false) {
				$buffer=str_replace("\n",'', $buffer);
				$buffer=str_replace("\r",'', $buffer);
				$out[]=$buffer;
			}
			if (!feof($File)) {
				echo "Error: un expected fgets() fail\n";
			}
			fclose($File);
			return $out;
		}
		return false;
	}

	function ArrayToFile($filename, array &$data, $mode='w', $backup=true, $newline="\n", $charset=null) {
		if($backup && file_exists($filename)) {
			rename($filename, $filename.'.'.date('Ymd_Hi').'.old');
			if(!file_exists($filename)) return false;
		}
		
		$totalLength=0;
		$File=fopen($filename, $mode);
		
		foreach($data as $item) {
			$itemLength=strlen($item).strlen($newLine);
			fputs($File, $item, strlen($itemLength) );
			$totalLength+=$itemLength;
		}

		fclose($File);

		if (file_exists($filename)) return $totalLength;
		return false;
	}

	function UUID() {
		return sprintf(
			"%08x-%04x-%04x-%02x%02x-%04x%08x", (int)microtime(true), (int)substr(microtime(true), 2) & 0xffff,
			mt_rand(0, 0xfff) | 0x4000, mt_rand(0, 0x3f) | 0x80, mt_rand(0, 0xff), '127.0.0.1', '129.168.3.5'
		);
	}

}
