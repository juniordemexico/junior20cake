<?php 
class ImageController extends AppController { 
     
    var $name = 'Image'; 
	var $uses = array();
	
    function index() { 
    } 
	
    function search($query=array()) {
	 
    } 

	function process($options) {
		
	}

	function resize($options) {
		
	}

	function watermark($options) {
		
	}


/*
Error handling
--------------------------------

Most image processing functions return either true or false (depending if action was successfull). Only exception is when
you don't specify output (or set it to null/empty) - in such cases (if action was successfull) GD resource is returned.


Available functions
--------------------------------

* autorotate - autorotate JPG images (by exif data)
* averageColor - get image's average color
* dominatingColor - get image's dominating color
* flip - flip image
* grayscale - desaturate image
* meshify - add mesh (grid of dots) over image
* pixelate - pixelate image
* resize - resize image
* rotate - rotate image (only degrees divisible by 90)
* unsharpMask - sharpen image
* watermark - add watermark

Examples
--------------------------------

Make thumbnail 100x100px in size

	$status = $this->ImageTool->resize(array(
		'input' => $input_file,
		'output' => $output_file,
		'width' => 100,
		'height' => 100
	));

Resize image (while keeping ratio) with max width and height both set to 600px. After that place watermark
image in bottom-right corner and sharpen end result (with default settings)

	$status = $this->ImageTool->resize(array(
		'input' => $input_file,
		'output' => $output_file,
		'width' => 600,
		'height' => 600,
		'keepRatio' => true,
		'paddings' => false,
		'afterCallbacks' => array(
			array('watermark', array('watermark' => $watermark_file, 'position' => 'bottom-right')),
			array('unsharpMask'),
		)
	));

Autorotate image (getting back GD resource and then passing it to the next function (greyscale) - similar to previous
example but without using afterCallbacks option)

	$image = $this->ImageTool->autorotate(array(
		'input' => $input_file,
		'output' => null
	));

	if ($image) {
		$status = $this->ImageTool->grayscale(array(
			'input' => $image,
			'output' => $output_file
		));
	} else {
		$status = false;
	}

*/

} 
?> 
