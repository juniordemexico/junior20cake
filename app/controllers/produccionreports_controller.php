<?php


class ProduccionreportsController extends ReportAppController {
	var $name='Produccionreports';

	var $uses = array(
		'SystemTable', 'Corte', 'Articulo', 'Color', 'Talla', 'Artexist'
	);

	var $layout = 'report';

	function beforeFilter() {
//		$this->Corte->recursive=-1;
				Configure::write ( 'debug', 2 );
	}

	// Reporte General de Produccion
	function General($p=array()) {
		$p['cveartini']="ATRA";
		$p['cveartfin']="PO";
		$p['proveedor_cve']="";
		$p['linea_cve']="";
		$p['marca_cve']="";
		$p['temporada_cve']="";
		$p['fechaini']='2013-01-01';
		$p['fechafin']='2013-08-01';
		$p['fentregaini']="";
		$p['fentregafin']="";
		$p['stcompterm']=0;
		$p['tipo']=0;
		$p['orden']=0;
		
		
		$sql="SELECT ooRefer,ooMesProd,ooOCFecha,ooCOFecha,ooCveArt articulo_cve,ooOCTrazo,
				ooCOTrazo,ooOCTela,
				ooOCCant,ooCOCant,ooEntCant,ooFUEntrada,
				arDescrip,arLinea,
				ooCveProMaq,ooCveProc,ooST,
				Linea.licve linea_cve, Marca.macve marca_cve, Temporada.tecve temporada_cve
				FROM Cortes Corte 
				JOIN Articulo Articulo ON(arCveArt=ooCveArt)
				JOIN Lineas Linea ON(Linea.id=Articulo.linea_id)
				JOIN Marcas Marca ON(Marca.id=Articulo.marca_id)
				JOIN Temporadas Temporada ON(Temporada.id=Articulo.temporada_id)
				WHERE ooT=1 ";

		switch ( $p['tipo'] ) {
		    case 1: $sql.=" AND ooOCFecha>='${p['fechaini']}' AND ooOCFecha<='${p['fechafin']}'
		                    AND ooCOFecha IS NULL AND ooST='A' "; break;
		    case 2: $sql.=" AND ooCOFecha>='${p['fechaini']}' AND ooCOFecha<='${p['fechafin']}'
		                   AND ooCOFecha IS NOT NULL AND ooFUEntrada IS NULL
		                   AND ooST='A' "; break;
		    case 3: $sql.=" AND ooOCFecha>='${p['fechaini']}' AND ooOCFecha<='${p['fechafin']}'
		                    AND ooFUEntrada IS NULL AND ooST='A' "; break;
		    case 4: $sql.=" AND ooFUEntrada>='${p['fechaini']}' AND ooFUEntrada<='${p['fechafin']}'
		                    AND ooFUEntrada IS NOT NULL AND ooST='A' "; break;
			default: 
					$sql.=" AND ooOCFecha>='${p['fechaini']}' AND ooOCFecha<='${p['fechafin']}' ";
		}

	 	if ( !empty($p['fentregaini']) ) $sql.=" AND oofentrega>=${p['fentregaini']} ";
	 	if ( !empty($p['fentregafin']) ) $sql.=" AND oofentrega<=${p['fentregafin']} ";
	 	if ( !empty($p['cveartini']) ) $sql.=" AND oocveart>='${p['cveartini']}' ";
	 	if ( !empty($p['cveartfin']) ) $sql.=" AND oocveart<='${p['cveartfin']}' ";
	 	if ( !empty($p['proveedor_cve']) ) $sql.=" AND oocvepromaq<=${p['proveedor_cve']} ";
		if ( $p['stcompterm']>0 ) {	
			$sql.=" AND arstcompterm=${p['stcompterm']}"; // iStCompterm-1
			$p['tipo_label']='Comprados';
		}
		else {
			$p['tipo_label']='Manufacturado';			
		}
	 	switch ($p['orden']) {
	    	case 1: $sql.=" ORDER BY oocveart, "; $p['order_label']='Producto'; break;
	    	case 2: $sql.=" ORDER BY arlinea, "; $p['order_label']='Linea'; break;
	    	case 3: $sql.=" ORDER BY oocvepromaq, "; $p['order_label']='Maquilero'; break;
	    default:
			$sql.=" ORDER BY "; $p['order_label']='Folio'; break;
		}

		$sql.=" ooRefer ";

		$rs=$this->SystemTable->query($sql);
		
		// Initialize and Configure the Report's Component
		$header=array(
			'reportFormat'=>array(	'size'=>'letter',
									'orientation'=>'portrait'
			),
			'reportHeader'=>array(
				'title' => 'Reporte General de Produccion',
				'subtitle' => 'Resumen de Ordenes de Corte, Cortes y Entregas',
				'ranges' => array( 	'Fecha Ini' => $p['fechaini'],
				 					'Fecha Fin' => $p['fechafin'],
				 					'Articulo Ini' => $p['cveartini'],
				 					'Articulo Fin' => $p['cveartfin'],
									'F. Entrega Ini' => $p['fentregaini'],
									'F. Entrega Fin' => $p['fentregafin'],
									'Proveedor' => $p['proveedor_cve'],
									'Linea' => $p['linea_cve'],
									'Marca' => $p['marca_cve'],
									'Temporada' => $p['temporada_cve'],	
				 					'Tipo de Producto' => $p['tipo_label'],
									),
				'order'=> array( $p['order_label'] ),
			),		
			'columnHeaders'=>array(
				'Folio',
				'Producto',
				'Linea',
				'Maqui',
				'ST',
				array( 'Orden' => array('Fecha', 'Prom', 'Cant') ),
				array( 'Corte' => array('Fecha', 'Trazo', 'Cant') ),
				array( 'Entregas' => array('Fecha', 'Cant') ),
			),
			'group'=>array(	'field'=>'Corte.articulo_cve',
			 				'groupHeader'=>array('1','2')
			),
		);

		$fields=array(
			'folio'=>array(		'field'=>'Corte.oorefer', 'label'=>'Folio',
								'width'=>'3', 'type'=>'string'),
			'articulo'=>array(	'field'=>'Corte.articulo_cve', 'label'=>'Producto',
								'width'=>'', 'type'=>'string',
								'count'=>true),
			'linea'=>array(		'field'=>'Linea.linea_cve', 'label'=>'Linea',
								'width'=>'2', 'align'=>'left', 'type'=>'string'),
			'maquilero'=>array(	'field'=>'Corte.oocvepromaq', 'label'=>'Maq',
								'width'=>'2', 'align'=>'left', 'type'=>'string'),
			'st'=>array(		'field'=>'Corte.oost', 'label'=>'ST',
								'width'=>'1', 'align'=>'center', 'type'=>'string'),
			'ordenfecha'=>array('field'=>'Corte.ooocfecha', 'label'=>'Fecha',
								'width'=>'3', 'type'=>'date'),
			'ordentrazo'=>array('field'=>'Corte.oooctrazo', 'label'=>'Prom',
								'width'=>'2', 'type'=>'decimal2'),
			'ordenunidad'=>array('field'=>'Corte.oooccant', 'label'=>'Unidades',
								'width'=>'2', 'type'=>'integer', 'totalize'=>true),
			'cortefecha'=>array('field'=>'Corte.oocofecha', 'label'=>'Fecha',
								'width'=>'3', 'type'=>'date'),
			'cortetrazo'=>array('field'=>'Corte.oocotrazo', 'label'=>'Trazo',
								'width'=>'2', 'type'=>'decimal2'),
			'corteunidad'=>array('field'=>'Corte.oococant', 'label'=>'Unidades',
								'width'=>'2', 'type'=>'integer', 'totalize'=>true),			
			'entfecha'=>array(	'field'=>'Corte.oofuentrada', 'label'=>'Fecha',
								'width'=>'3', 'type'=>'date'),			
			'entunidad'=>array('field'=>'Corte.ooentcant', 'label'=>'Unidades',
								'width'=>'2', 'type'=>'integer', 'totalize'=>true),			
			);

		$this->Axreport->initReport($header, $fields, $rs, $sql);
		$this->Axreport->generateHTML();

		// Pass the Report's Content to the View and Client's User-Agent
		$this->set('records', $this->Axreport->getContent() );
		$this->set('sql', $sql);
	}

	// Entradas a Producto Terminado
	function EntradasDeProducto() {
		
	}

	// Existencia + Produccion
	function ExistenciaMasProduccion() {
		$tipo=0;
		$fechaini='2012-06-01';
		$fechafin='2012-08-01';
		$fpedidosini="";
		$fpedidosfin="";
		$fventasini="";
		$fventasfin="";
		$cveartini="POWEBLACK";
		$cveartfin="POWEBORINC";
		$linea_cve="";
		$marca_cve="";
		$t=1;
		
		$sql="SELECT * FROM prcExistProdPed(
			'${fechaini}', '${fechafin}', 
			$t, 
			'${cveartini}', '${cveartfin}' ) Corte
			WHERE Tipo IN(0,2) ";

		if (!empty($linea_cve)) {
	    	$sql.=" AND linea='${linea_cve}' ";
		}
		if (!empty($marca_cve)) {
	    	$sql.=" AND marca='${marca_cve}' ";
		}
		
		$sql.=" ORDER BY cveart, tipo, ocorte ";
	 
		$this->set('sql', $sql);
		$this->set('rs', $this->SystemTable->query($sql) );
	}

	// Existencia + Produccion - Pedidos
	function ExistenciaMasProduccionMenosPedidos() {
		$tipo=0;
		$pedaut=1;
		$fechaini='2012-06-01';
		$fechafin='2012-08-01';
		$fpedidosini="";
		$fpedidosfin="";
		$fventasini="";
		$fventasfin="";
		$cveartini="POWEBLACK";
		$cveartfin="POWEBORINC";
		$linea_cve="";
		$marca_cve="";
		$t=1;
		
		$theProcedure=(empty($pedaut)||$pedaut==0?'prcExistProdPed':'prcExistProdPed_Aut');
		$sql="SELECT * FROM ${theProcedure}(
			'${fechaini}', '${fechafin}', 
			$t, 
			'${cveartini}', '${cveartfin}' ) Corte
			WHERE Tipo IN(0,2) ";

		if (!empty($linea_cve)) {
	    	$sql.=" AND linea='${linea_cve}' ";
		}
		if (!empty($marca_cve)) {
	    	$sql.=" AND marca='${marca_cve}' ";
		}
		
		$sql.=" ORDER BY cveart, tipo, ocorte ";
	 
		$this->set('sql', $sql);
		$this->set('rs', $this->SystemTable->query($sql) );
		
	}

	// Existencia + Produccion - Pedidos
/*
	function ExistenciaMasProduccionMenosPedidos() {
		
	}
*/
	// Existencia + Produccion - Pedidos y Ventas
	function ExistenciaMasProduccionMenosPedidosVentas() {
		
	}


}

?>