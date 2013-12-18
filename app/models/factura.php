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

	public $title = 'farefer';
	public $longTitle = null;
	public $dateField='fafecha';
	public $dateLimitField='fafvence';
	public $stField='fast';

	public $detailsModel='Facturadet';

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

//	public $hasOne = array('Comprobante'=>array('className'=>'Comprobante','foreignKey'=>'id', 'conditions'=>array('Comprobante.model'=>'Factura')));

	public $hasMany = array('Facturadet'=>array('className'=>'Facturadet','foreignKey'=>'factura_id'));
	
	function beforeFind( $options ) {
		if( isset( $options['doJoinUservendedor'] )) {
			return(parent::beforeFind($this->generateJoinUservendedor($options)));
		}
		return (parent::beforeFind($options));
	}

	public function getDoctoForCFDI( $id=null ) {

		$docto=$this->query("SELECT Factura.id, Factura.farefer folio,
								Factura.fafecha fecha,
								Factura.fatcambio tcambio,	
								Factura.divisa_id, Divisa.dicve divisa_cve,
								Factura.faplazo plazo,
								Factura.faimpu impuesto_tasa,
								Factura.fasuma suma,
								Factura.faimporte importe,
								Factura.faimpoimpu impoimpu,
								Factura.fatotal total,
								Factura.crefec created,
								Factura.modfec modified,
								Clientesdireccione.*,
								Cliente.clnom,
								Cliente.clsuc,
								Cliente.clcveven,
								Cliente.clst,
								Cliente.clrfc
								FROM Factura Factura
								JOIN Clientes Cliente ON (Cliente.id=Factura.cliente_id)
								JOIN Vendedores Vendedor ON (Vendedor.id=Factura.vendedor_id)
								JOIN Divisas Divisa ON (Divisa.id=Factura.divisa_id)
								LEFT JOIN Clientesdirecciones Clientesdireccione ON (Clientesdireccione.cliente_id=Cliente.id AND Clientesdireccione.cltpodir='Fiscal')
								WHERE Factura.id=$id
							");

		if(!$docto || !is_array($docto) || count($docto)<1) {
			return false;
		}

		// Datos del Documento (la factura)
		$docto=$docto[0];
		$master=array();
		$master=$docto['Factura'];
		$master["pago_numcta"]="NO IDENTIFICADO";
		$master["lugar_expedicion"]="DISTRITO FEDERAL";
		$master["formapago"]="TRANSFERENCIA";
		$master["comprobante_tipo"]="ingreso";
		$master["metodo_pago"]="PAGO EN UNA SOLA EXHIBICION";
		$master["impuesto_cve"]="IVA";
		$master["divisa_cve"]=$docto['Divisa']['divisa_cve'];

		// CAMBIAR PARA PROPDUCCION  (IDD)
//		$master["fecha"]=$master['fecha']date('Y-m-d').'T'.date('H:i:s', time()-600); //date('H:i:s'); //$docto['Divisa']['divisa_cve'];
//		$master["folio"]="D0000001";


		// Datos del Receptor (nuestro cliente)
		$receptor=array_merge($docto['Clientesdireccion'], $docto['Cliente']);

/*
		$receptor["clcalle"]="CALLE DE PRUEBA";
		$receptor["clnumext"]="SN EXT";
		$receptor["clnumint"]="NA";
		$receptor["clcolonia"]="COL. OBRERA";
		$receptor["clciu"]="MIGUEL HIDALGO";
		$receptor["cledo"]="DISTRITO FEDERAL";
		$receptor["clpais"]="MEXICO";
*/

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

		$items=$this->query("SELECT Facturadet.id, Facturadet.articulo_id,
			 					Facturadet.fadprecio, 
								CAST(SUM(Facturadet.fadcant) AS NUMERIC(14,0)) fadcant,
								CAST(SUM(Facturadet.fadimporte) AS NUMERIC(14,2)) fadimporte,
								CAST( SUM( 
									    ((Facturadet.fadimporteneto*
										(1-(Factura.fadesc1/100))
										)*
										(1-(Factura.fadesc2/100))
										)*
										(1-(Factura.fadesc3/100))
									) as NUMERIC(14,6)) fadimportefinal,
								Articulo.arcveart, Articulo.ardescrip, Unidad.cve unidad_cve
								FROM Factura Factura
								JOIN Facturadet Facturadet ON (Factura.id=Facturadet.factura_id)
								JOIN Articulo Articulo ON (Facturadet.articulo_id=Articulo.id)
								JOIN Unidades Unidad ON (Articulo.unidad_id=Unidad.id)
								WHERE Factura.id=$id
								GROUP BY Facturadet.id, Facturadet.articulo_id,
			 					Facturadet.fadprecio, Articulo.arcveart, Articulo.ardescrip, Unidad.cve");

		$Details=array();		
		foreach($items as $item) {
			$Details[]=array(
					'id'=>$item['Facturadet']['id'],
					'articulo_id'=>$item['Facturadet']['articulo_id'],
					'precio'=>round($item[0]['fadimportefinal']/$item[0]['fadcant'],6),
					'cant'=>$item[0]['fadcant'],
					'importe'=>$item[0]['fadimportefinal'],
					'arcveart'=>$item['Articulo']['arcveart'],
					'ardescrip'=>trim($item['Articulo']['ardescrip']),
					'unidad_cve'=>trim($item[0]['unidad_cve']),
					);
		}

		$out=array(
			"Master"		=>$master,
		 	"Details"		=>$Details,
		 	"Receptor"		=>$receptor,
		 	"Emisor"		=>$emisor,
			);

		return json_encode($out);

	} 

}

