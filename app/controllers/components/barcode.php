<?php

class AxbarcodeComponent extends Component	{

	public $barcode_printer_cmd=array('text'=>'A', 'barcode'=>'B');
	
	public $barcode_types=array(
		'39'=>array('code'=>'3', 'minWidth'=>1,'maxWidth'=>10),
		'39C'=>array('code'=>'3C', 'minWidth'=>1,'maxWidth'=>10),
		'CODABAR'=>array('code'=>'K', 'minWidth'=>1,'maxWidth'=>10),
		'EAN128'=>array('code'=>'1E', 'minWidth'=>1,'maxWidth'=>10),
		'128'=>array('code'=>'1', 'minWidth'=>1,'maxWidth'=>10),
		'128A'=>array('code'=>'1A', 'minWidth'=>1,'maxWidth'=>10),
		'128B'=>array('code'=>'1B', 'minWidth'=>1,'maxWidth'=>10),
		'128C'=>array('code'=>'1C', 'minWidth'=>1,'maxWidth'=>10),
		'EAN8'=>array('code'=>'E80', 'minWidth'=>2,'maxWidth'=>4),
		'EAN13'=>array('code'=>'E30', 'minWidth'=>2,'maxWidth'=>4),
		'UPCA'=>array('code'=>'UA0', 'minWidth'=>2,'maxWidth'=>4),
		'UPCE'=>array('code'=>'UE0', 'minWidth'=>2,'maxWidth'=>4),
		'INTERLEAVED25'=>array('code'=>'2', 'minWidth'=>1,'maxWidth'=>10),
		'INTERLEAVED2510'=>array('code'=>'2C', 'minWidth'=>1,'maxWidth'=>10)
	);

	public $barcodeString=array(
		'p1'=>array('name'=>'Posicion Horizontal', 'value'=>0),
		'p2'=>array('name'=>'Posicion Vertical', 'value'=>0),
		'p3'=>array('name'=>'Rotacion', 'value'=>0, 'validValues'=>array('0'=>'Sin Rotacion','1'=>'90 grados','2'=>'180 grados','3'=>'270 grados') ),
		'p4'=>array('name'=>'Tipo de Codigo', 'value'=>array(), 'validValues'=>array()),
		'p5'=>array('name'=>'Ancho (delgados)', 'value'=>array() ),
		'p6'=>array('name'=>'Ancho (anchos)', 'value'=>0, 'minValue'=>2, 'maxValue'=>30),
		'p7'=>array('name'=>'Alto', 'value'=>20),
		'p8'=>array('name'=>'Imprimir codigo como texto', 'value'=>'B', 'validValues'=>array()),
		'p9'=>array('name'=>'Texto o Codigo', 'value'=>'12345'),
	);
/*
	$output=
	"S3".LF.
	"Q100,10".LF.
	"q1000".LF.
	'B5,10,0,1E,1,1,130,N,"'.$rs->fields('Cve').'"'.LF.
	'A5,30,0,3,1,1,N,"'.$rs->fields('Cve').'"'.LF.
	'A5,50,0,3,1,1,N,"'.$rs->fields('PV1').'"'.LF
	;
*/
	public function ean13_checkdigit($message) {
		$checksum = 0;
		$message=(string)$message;
		foreach (str_split(strrev($message)) as $pos => $val) {
			$checksum += $val * (3 - 2 * ($pos % 2));
		}
		$check_digit = ((10 - ($checksum % 10)) % 10);
		return ((string)$check_digit);
	}



/*
ALTERNATIVE EAN-13 CHECK DIGIT
	//first change digits to a string so that we can access individual numbers
	$message =(string)$message;
	// 1. Add the values of the digits in the even-numbered positions: 2, 4, 6, etc.
	$even_sum = $message{1} + $message{3} + $message{5} + $message{7} + $message{9} + $message{11};
	// 2. Multiply this result by 3.
	$even_sum_three = $even_sum * 3;
	// 3. Add the values of the digits in the odd-numbered positions: 1, 3, 5, etc.
	$odd_sum = $message{0} + $message{2} + $message{4} + $message{6} + $message{8} + $message{10};
	// 4. Sum the results of steps 2 and 3.
	$total_sum = $even_sum_three + $odd_sum;
	// 5. The check character is the smallest number which, when added to the result in step 4,  produces a multiple of 10.
	$next_ten = (ceil($total_sum/10))*10;
	$check_digit = $next_ten - $total_sum;
	return ($message . $check_digit);

*/

}

