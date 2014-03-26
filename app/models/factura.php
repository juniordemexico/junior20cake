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
	public $longTitle = 'uuid';
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

	public $hasMany = array('Facturadet'=>array('className'=>'Facturadet', 'foreignKey'=>'factura_id'));
	
	function beforeFind( $options ) {
		if( isset( $options['doJoinUservendedor'] )) {
			return(parent::beforeFind($this->generateJoinUservendedor($options)));
		}
		return (parent::beforeFind($options));
	}

	public function getDoctoForCFDI( $id=null, $validateModel = false ) {

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

		$docto=$this->query("SELECT Factura.id, Factura.farefer folio,
								Factura.fafecha fecha,
								Factura.fapedido pedido,
								Factura.fatcambio tcambio,	
								Factura.cliente_id cliente_id,	
								Factura.divisa_id, Divisa.dicve divisa_cve,
								Factura.faplazo plazo,
								Factura.faimpu impuesto_tasa,
								CAST(Factura.fasuma AS numeric(14,2)) suma,
								CAST(Factura.fatotal-Factura.faimpoimpu as NUMERIC(14,2)) importe,
								CAST(Factura.faimpoimpu AS NUMERIC(14,2)) impoimpu,
								CAST(Factura.fatotal AS NUMERIC(14,2)) total,
								Factura.crefec created,
								Factura.modfec modified,
								Factura.faobser observaciones,
								Factura.uuid uuid,
								Factura.fechatimbrado fechatimbrado,
								Factura.cadenaoriginal cadenaoriginal,
								Factura.sellocfd sellocfd,
								Factura.nocertificadosat nocertificadosat,
								Factura.sellosat sellosat,
								Direccioncte.*,
								Cliente.clnom,
								Cliente.clsuc,
								Cliente.clcveven,
								Cliente.clst,
								Cliente.clrfc,
								Cliente.clmtdopago,
								Cliente.clbancocta,
								Cliente.clenviara
								FROM Factura Factura
								JOIN Clientes Cliente ON (Cliente.id=Factura.cliente_id)
								JOIN Vendedores Vendedor ON (Vendedor.id=Factura.vendedor_id)
								JOIN Divisas Divisa ON (Divisa.id=Factura.divisa_id)
								LEFT JOIN Direccioncte Direccioncte ON (Direccioncte.cliente_id=Cliente.id AND Direccioncte.cltpodir='Fiscal')
								WHERE Factura.id=$id
							");
		

		// Datos del Documento (la factura)
		$docto=$docto[0];

		if(!$docto || !is_array($docto) || count($docto)<1) {
			return false;
		}

		$docto['Cliente']['clrfc']=trim($docto['Cliente']['clrfc']);
		$docto['Cliente']['clmtdopago']=trim($docto['Cliente']['clmtdopago']);
		$docto['Cliente']['clbancocta']=trim($docto['Cliente']['clbancocta']);

		$this->Cliente->read(null, $docto['Factura']['cliente_id']);

		if ( !$this->Cliente->validates( array('fieldList' => array('clrfc') ) )) {
			return "Error. El RFC del Cliente tiene un formato incorrecto. Corrigelo en el Catálogo de Clientes.";
		}
		if ( !$this->Cliente->validates( array('fieldList' => array('clnom') ) )) {
			return "Error. La Razón Social del Cliente es Incorrecta. Corrigelo en el catálogo de Clientes.";
		}
		
		$master=array();
		$master=$docto['Factura'];
		$master["folio"]=trim($master["folio"]);
		$master["comprobante_tipo"]="ingreso";
		$master["divisa_cve"]=trim($docto['Divisa']['divisa_cve'])=='MN'?'MXP':trim($docto['Divisa']['divisa_cve']);
		$master["impuesto_cve"]="IVA";
		$master["formapago"]="PAGO EN UNA SOLA EXHIBICION";
		$master["lugar_expedicion"]="DISTRITO FEDERAL";
		$master['suma']=$docto[0]['suma'];
		$master['importe']=$docto[0]['importe'];
		$master['impoimpu']=$docto[0]['impoimpu'];
		$master['total']=$docto[0]['total'];
		$master['tcambio']=(isset($docto['Factura']['tcambio']) && $docto['Factura']['tcambio']<>0 && $docto['Factura']['tcambio']<>1 ? round($docto['Factura']['tcambio'],2):'1.00');
		$master['plazo']=(isset($docto['Factura']['plazo']) && $docto['Factura']['plazo']<>0 ? $docto['Factura']['plazo']:'0');

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

		$items=$this->query("SELECT Facturadet.id, Facturadet.articulo_id,
			 					Facturadet.fadprecio, 
			 					MAX(Facturadet.fadpreciodesc) fadpreciodesc, 
			 					SUM(Facturadet.fadimporteneto) fadimporteneto, 
								CAST(SUM(Facturadet.fadcant) AS NUMERIC(14,0)) fadcant,
								CAST(SUM(Facturadet.fadimporte) AS NUMERIC(14,2)) fadimporte,
								CAST( SUM( 
									    ((Facturadet.fadimporteneto*
										(1-(cast(Factura.fadesc1 as float)/100))
										)*
										(1-(cast(Factura.fadesc2 as float)/100))
										)*
										(1-(cast(Factura.fadesc3 as float)/100))
									) as NUMERIC(14,2)) fadimportefinal,
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
					'precio'=>$item[0]['fadpreciodesc'],
/*					'precio'=>round($item[0]['fadimportefinal']/$item[0]['fadcant'],2), */
					'cant'=>$item[0]['fadcant'],
					'importe'=>$item[0]['fadimporteneto'],
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

