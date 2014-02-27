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
//	public $useTable = 'Ncredito';
	public $alias = 'Ncredito';
	public $cache=false;
	public $recursive=1;

	public $title = 'ncrefer';
	public $longTitle = 'uuid';
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

	public $hasMany = array('Ncreditodet'=>array('className'=>'Ncreditodet','foreignKey'=>'ncredito_id'));
	
	function beforeFind( $options ) {
		if( isset( $options['doJoinUservendedor'] )) {
			return(parent::beforeFind($this->generateJoinUservendedor($options)));
		}
		return (parent::beforeFind($options));
	}

	public function getDoctoForCFDI( $id=null ) {

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

		$docto=$this->query("SELECT Ncredito.id, Ncredito.ncrefer folio,
								Ncredito.ncfecha fecha,
								Ncredito.nctcambio tcambio,
								Ncredito.ncdevol ncdevol,
								Ncredito.ncfactura ncfactura,
								Ncredito.divisa_id, Divisa.dicve divisa_cve,
								Ncredito.ncimpu impuesto_tasa,
								CAST(Ncredito.ncsuma AS numeric(14,2)) suma,
								CAST(Ncredito.nctotal-Ncredito.ncimpoimpu as NUMERIC(14,2)) importe,
								CAST(Ncredito.ncimpoimpu AS NUMERIC(14,2)) impoimpu,
								CAST(Ncredito.nctotal AS NUMERIC(14,2)) total,
								Ncredito.crefec created,
								Ncredito.modfec modified,
								Ncredito.ncobser observaciones,
								Ncredito.uuid uuid,
								Ncredito.fechatimbrado fechatimbrado,
								Ncredito.cadenaoriginal cadenaoriginal,
								Ncredito.sellocfd sellocfd,
								Ncredito.nocertificadosat nocertificadosat,
								Ncredito.sellosat sellosat,
								Direccioncte.*,
								Cliente.clnom,
								Cliente.clsuc,
								Cliente.clcveven,
								Cliente.clst,
								Cliente.clrfc,
								Cliente.clmtdopago,
								Cliente.clbancocta,
								Cliente.clenviara
								FROM Ncredito Ncredito
								JOIN Clientes Cliente ON (Cliente.id=Ncredito.cliente_id)
								JOIN Vendedores Vendedor ON (Vendedor.id=Ncredito.vendedor_id)
								JOIN Divisas Divisa ON (Divisa.id=Ncredito.divisa_id)
								LEFT JOIN Direccioncte Direccioncte ON (Direccioncte.cliente_id=Cliente.id AND Direccioncte.cltpodir='Fiscal')
								WHERE Ncredito.id=$id
							");

		if(!$docto || !is_array($docto) || count($docto)<1) {
			return false;
		}

		// Datos del Documento (nota de credito)
		$docto=$docto[0];
		$docto['Cliente']['clmtdopago']=trim($docto['Cliente']['clmtdopago']);
		$docto['Cliente']['clbancocta']=trim($docto['Cliente']['clbancocta']);
		
		$master=array();
		$master=$docto['Ncredito'];
		$master["comprobante_tipo"]="egreso";
		$master["divisa_cve"]=trim($docto['Divisa']['divisa_cve'])=='MN'?'MXP':trim($docto['Divisa']['divisa_cve']);
		$master["impuesto_cve"]="IVA";
		$master["formapago"]="PAGO EN UNA SOLA EXHIBICION";
		$master["lugar_expedicion"]="DISTRITO FEDERAL";
		$master['suma']=$docto[0]['suma'];
		$master['importe']=$docto[0]['importe'];
		$master['impoimpu']=$docto[0]['impoimpu'];
		$master['total']=$docto[0]['total'];
		$master['tcambio']=(isset($docto['Ncredito']['tcambio']) && $docto['Ncredito']['tcambio']<>0 && $docto['Ncredito']['tcambio']<>1 ? round($docto['Ncredito']['tcambio'],2):'1.00');
		$master['plazo']=(isset($docto['Ncredito']['plazo']) && $docto['Ncredito']['plazo']<>0 ? $docto['Ncredito']['plazo']:'0');

		// Determina el metodo y la cta de pago
		if(	($docto['Cliente']['clmtdopago']=='CHEQUE' || 
			$docto['Cliente']['clmtdopago']=='TRANSFERENCIA BANCARIA') &&
			!empty($docto['Cliente']['clbancocta']) && strlen($docto['Cliente']['clbancocta'])>=4
		) {
			$master["metodo_pago"]=$docto['Cliente']['clmtdopago'];
			$master["num_cta_pago"]=$docto['Cliente']['clbancocta'];
		}
		elseif(	$docto['Cliente']['clmtdopago']=='EFECTIVO' ) {
			$master["metodo_pago"]=$docto['Cliente']['clmtdopago'];
			$master["num_cta_pago"]='NO IDENTIFICADO';
		}
		else {
			$master["metodo_pago"]='NO IDENTIFICADO';
			$master["num_cta_pago"]='NO IDENTIFICADO';			
		}


		// Datos del Receptor (nuestro cliente)
		$receptor=array_merge($docto[0], $docto['Cliente']);

		$items=$this->query("SELECT Ncreditodet.id, Ncreditodet.articulo_id,
			 					Ncreditodet.ncdprecio, 
								CAST(SUM(Ncreditodet.ncdcant) AS NUMERIC(14,0)) ncdcant,
								CAST(SUM(Ncreditodet.ncdimporte) AS NUMERIC(14,2)) ncdimporte,
								CAST( SUM( 
									    ((Ncreditodet.ncdimporteneto*
										(1-(cast(Ncredito.ncdesc1 as float)/100))
										)*
										(1-(cast(Ncredito.ncdesc2 as float)/100))
										)*
										(1-(cast(Ncredito.ncdesc3 as float)/100))
									) as NUMERIC(14,6)) ncdimportefinal,
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
					'id'=>$item['Ncreditodet']['id'],
					'articulo_id'=>$item['Ncreditodet']['articulo_id'],
					'precio'=>round($item[0]['ncdimportefinal']/$item[0]['ncdcant'],6),
					'cant'=>$item[0]['ncdcant'],
					'importe'=>$item[0]['ncdimportefinal'], 
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


	public function getItemWithDetails($id=null) {
		if( !$id && isset($this->id) && 
			(is_numeric($this->id) || is_string($this->id)) ) {
			$id=$this->id;
		}
		$item=parent::getItemWithDetails($id);
		
		$dircte=$this->query("SELECT 
								Direccioncte.*,
								Cliente.clnom,
								Cliente.clsuc,
								Cliente.clcveven,
								Cliente.clst,
								Cliente.clrfc
								FROM Clientes Cliente
								LEFT JOIN Direccioncte Direccioncte ON (Direccioncte.cliente_id=Cliente.id AND Direccioncte.cltpodir='Fiscal')
								WHERE Cliente.id=".$item['Master']['cliente_id']
							);
		$dircte=$dircte[0];
		$item['Direccioncte']=$dircte[0];

		$item['Cliente']['clmtdopago']=trim($item['Cliente']['clmtdopago']);
		$item['Cliente']['clbancocta']=trim($item['Cliente']['clbancocta']);
		// Determina el metodo y la cta de pago
		if(	($item['Cliente']['clmtdopago']=='CHEQUE' || 
			$item['Cliente']['clmtdopago']=='TRANSFERENCIA BANCARIA') &&
			!empty($item['Cliente']['clbancocta']) && strlen($item['Cliente']['clbancocta'])>=4
		) {
			$item['Cliente']['clmtdopago']=$item['Cliente']['clmtdopago'];
			$item['Cliente']['clbancocta']=$item['Cliente']['clbancocta'];
		}
		elseif(	$item['Cliente']['clmtdopago']=='EFECTIVO' ) {
			$item['Cliente']['clmtdopago']=$item['Cliente']['clmtdopago'];
			$item['Cliente']['clbancocta']='NO IDENTIFICADO';
		}
		else {
			$item['Cliente']['clmtdopago']='NO IDENTIFICADO';
			$item['Cliente']['clbancocta']='NO IDENTIFICADO';
		}

		return( $item );
	}

}

