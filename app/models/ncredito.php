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

class Ncredito extends AppModel 
{
	public $name = 'Ncredito';
	public $table = 'Ncredito';
	public $useTable = 'Ncredito';
	public $alias = 'Ncredito';
	public $cache=false;
	public $recursive=1;

	public $title = 'ncrefer';
	public $longTitle = null;
	public $dateField='ncfecha';
	public $dateLimitField='ncfvence';
	public $stField='ncst';

	public $detailsModel='Ncreditodet';

	public $virtualFields = array(
		'ncimporte' => 'ncimporte',
		'ncimpoimpu' => 'ncimpoimpu',
		'nctotal' => 'nctotal'
		);


	public $validate = array(
		'nct' => array(
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
		'ncst' => array(
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

//	public $hasOne = array('Comprobante'=>array('className'=>'Comprobante','foreignKey'=>'id', 'conditions'=>array('Comprobante.model'=>'Ncredito')));

	public $hasMany = array('Ncreditodet'=>array(
							'className'=>'Ncreditodet',
							'foreignKey'=>'ncredito_id'));
	
	function beforeFind( $options ) {
		if( isset( $options['doJoinUservendedor'] )) {
			return(parent::beforeFind($this->generateJoinUservendedor($options)));
		}
		return (parent::beforeFind($options));
	}

	public function getDoctoForCFDI( $id=null ) {

		$docto=$this->query("SELECT Ncredito.id, Ncredito.ncrefer folio,
								Ncredito.ncfecha fecha,
								Divisa.ditcambio tcambio,	
								Ncredito.divisa_id, Divisa.dicve divisa_cve,
								Ncredito.ncimpu impuesto_tasa,
								Ncredito.ncsuma suma,
								Ncredito.ncimporte importe,
								Ncredito.ncimpoimpu impoimpu,
								Ncredito.nctotal total,
								Ncredito.crefec created,
								Ncredito.modfec modified,
								Cliente.*
								FROM Ncredito Ncredito
								JOIN Clientes Cliente ON (Cliente.id=Ncredito.cliente_id)
								JOIN Vendedores Vendedor ON (Vendedor.id=Ncredito.vendedor_id)
								JOIN Divisas Divisa ON (Divisa.id=Ncredito.divisa_id)
								WHERE Ncredito.id=$id
							");

		if(!$docto || !is_array($docto) || count($docto)<1) {
			return false;
		}

		// Datos del Documento (la factura)
		$docto=$docto[0];
		$master=array();
		$master=$docto['0'];
		$master["pago_numcta"]="NO IDENTIFICADO";
		$master["lugar_expedicion"]="DISTRITO FEDERAL";
		$master["formapago"]="TRANSFERENCIA";
		$master["comprobante_tipo"]="egreso";
		$master["metodo_pago"]="PAGO EN UNA SOLA EXHIBICION";
		$master["impuesto_cve"]="IVA";
		$master["divisa_cve"]=$docto['Divisa']['divisa_cve'];

		// Datos del Receptor (nuestro cliente)
		$receptor=$docto['Cliente'];
		$receptor["clcalle"]="CALLE DE PRUEBA";
		$receptor["clnumext"]="SN EXT";
		$receptor["clnumint"]="NA";
		$receptor["clcolonia"]="COL. OBRERA";
		$receptor["clciu"]="MIGUEL HIDALGO";
		$receptor["cledo"]="DISTRITO FEDERAL";
		$receptor["clpais"]="MEXICO";

		// Datos del Emisor (nuestra empresa)
		$emisor=array(
					"emnom"=>"JUNIOR DE MEXICO, S.A. de C.V.",
					"emrfc"=>"JME910405B83",
					"emcalle"=>"AV PASEO DE LA REFORMA",
					"emnumext"=>"2654",
					"emnumint"=>"1501",
					"emcol"=>"LOMAS ALTAS",	
					"emciu"=>"MIGUEL HIDALGO",
					"emedo"=>"DISTRITO FEDERAL",
					"empais"=>"MEXICO",
					"emcp"=>"11950",
					"vlocalidad"=>"",
					"vref"=>"",
					"regimen_fiscal"=>"Regimen General de ley Personas Morales"
					);

		$items=$this->query("SELECT Ncreditodet.id, Ncreditodet.articulo_id,
			 					Ncreditodet.ncdprecio, 
								CAST(SUM(Ncreditodet.ncdcant) AS NUMERIC(14,0)) ncdcant,
								CAST(SUM(Ncreditodet.ncdimporte) AS NUMERIC(14,2)) ncdimporte,
								Articulo.arcveart, Articulo.ardescrip, Unidad.cve unidad_cve
								FROM Ncredito Ncredito
								JOIN Ncreditodet Ncreditodet ON (Ncredito.id=Ncreditodet.ncredito_id)
								JOIN Articulo Articulo ON (Ncreditodet.articulo_id=Articulo.id)
								JOIN Unidades Unidad ON (Articulo.unidad_id=Unidad.id)
								WHERE Ncredito.id=$id
								GROUP BY Ncreditodet.id, Ncreditodet.articulo_id,
			 					Ncreditodet.ncdprecio, Articulo.arcveart, Articulo.ardescrip, Unidad.cve");

		$Details=array();		
		foreach($items as $item) {
			$Details[]=array(
					'id'=>$item['0']['id'],
					'articulo_id'=>$item[0]['articulo_id'],
					'precio'=>$item[0]['ncdprecio'],
					'cant'=>$item[0]['ncdcant'],
					'importe'=>$item[0]['ncdimporte'],
					'arcveart'=>$item['Articulo']['arcveart'],
					'ardescrip'=>trim($item['Articulo']['ardescrip']),
					'unidad_cve'=>trim($item[0]['unidad_cve']),
					);
		}

		$out=array(
			"Master"	=>$master,
		 	"Details"	=>$Details,
		 	"Receptor"	=>$receptor,
		 	"Emisor"	=>$emisor,
			);

		return json_encode($out);

	} 

}

