class AxExport extends object {
	
	var $exportStructure=array();
	
	
	function AxExport($tipo='MOD') {

		$this->exportStructure=array(
								array(	'descripcion'=>'Tipo de operacion a realizar',
										'campo'=>'.$tipo',
										'alias'=>'Articulo',
										'tipo'=>'STRING',
										'longitud'=>'3',
										'default'=>'MOD'
										)
							)
		
	}
}