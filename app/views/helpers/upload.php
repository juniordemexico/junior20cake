<?php 
/**
 *
 * Dual-licensed under the GNU GPL v3 and the MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2012, Suman (srs81 @ GitHub)
 * @package       plugin
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 *                and/or GNU GPL v3 (http://www.gnu.org/copyleft/gpl.html)
 */
 
class UploadHelper extends AppHelper {

	public function view ($model, $id, $edit=false) {
		$results = $this->listing ($model, $id);
				
		$directory = $results['directory'];
		$baseUrl = $results['baseUrl'];
		$files = $results['files'];

		$str = "<dd>";
		$count = 0;
//		$webroot = Router::url("/") . "ajax_multi_upload";
		$webroot = Router::url("/");
		foreach ($files as $file) {
			$type = pathinfo($file, PATHINFO_EXTENSION);
			$filesize = $this->format_bytes (filesize ($file));
			$f = basename($file);
			$url = $baseUrl . "/$f";
			if ($edit) {
				$baseEncFile = base64_encode ($file);
				$delUrl = "/Uploads/delete/$baseEncFile/";			
				$str .= '<a class="btn btn-mini btn-primary" href="'.$delUrl.'">'.
						'<i class="icon icon-white icon-trash" alt="Delete">&nbsp;</i>'.
						'</a>'.CR;
			}
			$str .= "<img src='" . Router::url("/") . "img/ajaxmultiupload/fileicons/$type.png' /> ";
			$str .= "<a href='$url' target='_new'>" . $f . "</a> ($filesize)";
			$str .= "<br />\n";
		}
		$str .= "</dd>\n"; 
		return $str;
	}

	public function listing ($model, $id) {
//		require_once (ROOT . DS . APP_DIR . DS . 'plugins'.DS.'ajax_multi_upload'.DS.'config'.DS.'bootstrap.php');
		$dir = Configure::read('AMU.directory');
		if (strlen($dir) < 1) $dir = "files";

		$lastDir = $this->last_dir ($model, $id);
		$directory = WWW_ROOT . DS . $dir . DS . $lastDir;
		$baseUrl = Router::url("/") . $dir . "/" . $lastDir;
		$files = glob ("$directory/*");
		return array("baseUrl" => $baseUrl, "directory" => $directory, "files" => $files);
	}

	public function edit ($model, $id) {
//		require_once (ROOT . DS . APP_DIR . DS . 'plugins'.DS.'ajax_multi_upload'.DS.'config'.DS.'bootstrap.php');
		$dir = Configure::read('AMU.directory');
		if (strlen($dir) < 1) $dir = "files";

		$str = $this->view ($model, $id, true);
//		$webroot = Router::url("/") . "ajax_multi_upload";
		$webroot = Router::url("/");
		// Replace / with underscores for Ajax controller
		$lastDir = str_replace ("/", "___", 
			$this->last_dir ($model, $id));
		$str .= <<<END
			<br /><br />
			<link rel="stylesheet" type="text/css" href="/css/ajaxmultiupload/fileuploader.css" />
			<script src="/js/jquery/fileuploader.js" type="text/javascript"></script>
			<div id="AjaxMultiUpload$lastDir" name="AjaxMultiUpload">
				<noscript>
					 <p>Please enable JavaScript to use file uploader.</p>
				</noscript>
			</div>
			<script src="/js/jquery/fileuploader.js" type="text/javascript"></script>
			<script>
				function createUploader(){
					var amuCollection = document.getElementsByName("AjaxMultiUpload");
					for (var i = 0, max = amuCollection.length; i < max; i++) {
							action = amuCollection[i].id.replace('AjaxMultiUpload', '');
							window['uploader'+i] = new qq.FileUploader({
								element: amuCollection[i],
								action: '/uploads/upload/' + action + '/',
								debug: true
							});
						}
					}
				window.onload = createUploader;     
			</script>
END;
		return $str;
	}

	// The "last mile" of the directory path for where the files get uploaded
	function last_dir ($model, $id) {
		return $model . "/" . $id;
	}

	// From http://php.net/manual/en/function.filesize.php
	function format_bytes($size) {
		$units = array(' B', ' KB', ' MB', ' GB', ' TB');
		for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
		return round($size, 2).$units[$i];
	}
}
