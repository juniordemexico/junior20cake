<?php

//	cldesc2 DECIMAL(10,2) NOT NULL
//	clsuc VARCHAR(64) DEFAULT '' NOT NULL
//	clcvecli VARCHAR(16) DEFAULT NOT NULL
//	clbanco VARCHAR(16) DEFAULT NOT NULL
//	clcuenta VARCHAR(16) DEFAULT NOT NULL
//	clprecio CHAR(1) DEFAULT '' NOT NULL
//	clatn VARCHAR(64) DEFAULT '' NOT NULL
//	cllocfor CHAR(1) DEFAULT '' NOT NULL
//	clrfc VARCHAR(16) DEFAULT NOT NULL
//	cldesc3 DECIMAL(10,2) NOT NULL
//	cltda VARCHAR(16) DEFAULT NOT NULL
//	clt CHAR(1) DEFAULT '' NOT NULL
//	clnom VARCHAR(16) DEFAULT NOT NULL
//	clst CHAR(1) DEFAULT '' NOT NULL
//	cldesc1 DECIMAL(10,2) NOT NULL
//	clplazo INT(10) NOT NULL

class Factura extends AppModel 
{
	public $name = 'Factura';
	public $table = 'Factura';
//	public $useTable = 'Factura';
	public $alias = 'Factura';
	public $cache=false;
	public $recursive=1;

	public $virtualFields = array(
		'faimporte' => 'faimporte',
		'faimpoimpu' => 'faimpoimpu',
		'fatotal' => 'fatotal'
		);


	public $validate = array(
		'fat' => array(
			'inlist' => array(
				'rule' => array(
					'inList',
					array(
						'0',
						'1'
					)
				),
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'Los posibles valores son 0 y 1'
			)
		),
		'fast' => array(
			'inlist' => array(
				'rule' => array(
					'inList',
					array(
						'C',
						'A',
						'S'
					)
				),
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'Not in list, please enter an item within Clst list'
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Cliente', 'Vendedor', 'Divisa'
	);

	public $hasMany = array('Facturadet'=>array('className'=>'Facturadet','foreignKey'=>'factura_id'));
	
	function beforeFind( $options ) {
		if( isset( $options['doJoinUservendedor'] )) {
			return(parent::beforeFind($this->generateJoinUservendedor($options)));
		}
		return (parent::beforeFind($options));
	}

	public function getDoctoCFDI( $id=null ) {
		$master=$this->findById($id);
		if(!$master || !is_array($master)) {
			return false;
		}

		$master['Factura']["regegfis"]="Regimen General de ley Personas Morales";
 		$master['Factura']["pcta"]="NO IDENTIFICADO";
		$master['Factura']["lugar_expedicion"]="DISTRITO FEDERAL";
      	$master['Factura']["formapago"]="TRANSFERENCIA";
      	$master['Factura']["comprobante_tipo"]="INGRESO";
      	$master['Factura']["metodopago"]="PAGO EN UNA SOLA EXHIBICION";
		$master['Factura']["faimpu_cve"]="IVA";

		$master['Cliente']["clcalle"]="CALLE DE PRUEBA";
		$master['Cliente']["clnoext"]="SN";
		$master['Cliente']["clnoint"]="NA";
		$master['Cliente']["clcolonia"]="COL. OBRERA";
		$master['Cliente']["cllocalidad"]="";
		$master['Cliente']["clbancocta"]="NO IDENTIFICADO";

		$out=array(	"Master"	=>$master['Factura'],
					"Divisa"	=>$master['Divisa'],
					"Cliente"	=>$master['Cliente'],
					"Empresa"=>array(
						"emnom"=>"JUNIOR DE MEXICO, S.A. de C.V.",
						"emrfc"=>"JME910405B83",
						"emcalle"=>"AV PASEO DE LA REFORMA",
						"emnoext"=>"2654",
						"emnoint"=>"1501",
						"emcolonia"=>"LOMAS ALTAS",	
						"emciu"=>"MIGUEL HIDALGO",
						"emedo"=>"DISTRITO FEDERAL",
						"empais"=>"MEXICO",
						"emcp"=>"11950",
						"vlocalidad"=>"",
						"vref"=>""
					),
		 		'Details'=>array()
				);

		$items=$this->query("SELECT Facturadet.id, Facturadet.articulo_id,
			 					Facturadet.fadprecio, 
								CAST(SUM(Facturadet.fadcant) AS NUMERIC(14,0)) fadcant,
								CAST(SUM(Facturadet.fadimporte) AS NUMERIC(14,2)) fadimporte,
								Articulo.arcveart, Articulo.ardescrip, Unidad.cve unidad_cve
								FROM Factura Factura
								JOIN Facturadet Facturadet ON (Factura.id=Facturadet.factura_id)
								JOIN Articulo Articulo ON (Facturadet.articulo_id=Articulo.id)
								JOIN Unidades Unidad ON (Articulo.unidad_id=Unidad.id)
								WHERE Factura.id=$id
								GROUP BY Facturadet.id, Facturadet.articulo_id,
			 					Facturadet.fadprecio,Articulo.arcveart, Articulo.ardescrip, Unidad.cve");

		$details=array();
		
		foreach($items as $item) {
			$details[]=array('Detail'=>array(
					'id'=>$item['Facturadet']['id'],
					'articulo_id'=>$item['Facturadet']['articulo_id'],
					'fadprecio'=>$item['Facturadet']['fadprecio'],
					'fadcant'=>$item[0]['fadcant'],
					'fadimporte'=>$item[0]['fadimporte'],
					'unidad_cve'=>$item[0]['unidad_cve'],
					'arcveart'=>$item['Articulo']['arcveart'],
					'ardescrip'=>$item['Articulo']['ardescrip'],
				));
		}

		$out['Details']=$details;

		pr($out);
		return json_encode($out);


die();
/*
					"Detail"=>array(
						"id"=>5969847,
						"articulo_id"=>106634,
						"color_id"=>942,
						"fadprecio"=>"240.68",
						"fadcant"=>"40.00",
						"fadimporte"=>"9627.52"
					),
         			"Articulo"=>array(
						"id"=>106634,
						"arcveart"=>"POWERINGINK",
						"ardescrip"=>"PANTALON POWER RING INK",
						"armarca"=>"OGGI",
						"arunidad"=>"PZAS"
					)
*/

	} 

}



/*

*
*		return json_encode(
			array(
				"Master"=>array(
      				"id"=>5969846,
      				"farefer"=>"A0083571",
      				"fafecha"=>"2013-09-20 14:32:12",
      				"faplazo"=>60,
      				"formapago"=>"TRANSFERENCIA",
      				"comprobante_tipo"=>"ingreso",
      				"metodopago"=>"PAGO EN UNA SOLA EXHIBICION",
					"fasuma"=>"9627.52",
					"fadesc1"=>"0.00",
					"faimpu_cve"=>"IVA",
					"faimpu1"=>"16.00",
					"faimpoimpu"=>"1492.4032",
					"fatotal"=>"11119.9232",
					"regegfis"=>"Regimen General de ley Personas Morales",
 					"pcta"=>"NO IDENTIFICADO",
					"lugar_expedicion"=>"DISTRITO FEDERAL"
					),
				"Divisa"=>array(
					"id"=>1,
					"dicve"=>"MN",
					"ditcambio"=>"1.0000",
					"dinom"=>"PESOS"
					),
				"Cliente"=>array(
					"clnom"=>"COMERCIAL POZA RICA, SA DE CV (TUXPAN)",
					"clrfc"=>"CPR741118S31",
					"clsuc"=>"      ",
					"clbancocta"=>"NO IDENTIFICADO",
					"clcalle"=>"CALLE 6",
					"clnoext"=>"SN",
					"clnoint"=>"NA",
					"clcolonia"=>"COL. OBRERA",
					"cllocalidad"=>"",
					"clreferencia"=>"",	
					"clciu"=>"POZA RICA",
					"cledo"=>"VERACRUZ",
					"clpais"=>"MEXICO",
					"clcp"=>"93260"
					),
				"Empresa"=>array(
					"emnom"=>"JUNIOR DE MEXICO, S.A. de C.V.",
					"emrfc"=>"JME910405B83",
					"emcalle"=>"AV PASEO DE LA REFORMA",
					"emnoext"=>"2654",
					"emnoint"=>"1501",
					"emcolonia"=>"LOMAS ALTAS",	
					"emciu"=>"MIGUEL HIDALGO",
					"emedo"=>"DISTRITO FEDERAL",
					"empais"=>"MEXICO",
					"emcp"=>"11950",
					"vlocalidad"=>"",
					"vref"=>""
					),
			"Details"=>array(
				array(
					"Detail"=>array(
						"id"=>5969847,
						"articulo_id"=>106634,
						"color_id"=>942,
						"fadprecio"=>"240.68",
						"fadcant"=>"40.00",
						"fadimporte"=>"9627.52"
					),
         			"Articulo"=>array(
						"id"=>106634,
						"arcveart"=>"POWERINGINK",
						"ardescrip"=>"PANTALON POWER RING INK",
						"armarca"=>"OGGI",
						"arunidad"=>"PZAS"
					)
				),  
//				array(),  
				)
			)
		);



**/