<?php


class Ttmppartida extends AppModel 
{
	public $name = 'Ttmppartida';

	public $table = 'Ttmppartidas';
	public $alias = 'Ttmppartida';
	public $primaryKey = 'id';
	
	public $persistModel = true;
	public $cacheQueries = false;
	public $recursive = 2;
	public $cache=false;
	
	public $validate = array(

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Articulo' =>
			array(
			'className' => 'Articulo',
			'foreignKey' => 'articulo_id',
			'order' => 'Articulo.arcveart',
			'counterCache' => ''
			)
		,
		'Color' =>
			array(
			'className' => 'Color',
			'foreignKey' => 'color_id',
			'order' => 'Color.nom',
			'counterCache' => ''
			)
		,
		'Talla' =>
			array(
			'className' => 'Talla',
			'foreignKey' => 'talla_id',
			'order' => 'Talla.tacve',
			'counterCache' => ''
			)
		, 
		'User' =>
			array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'order' => 'User.username',
			)
		,
	);

	function getDetail($id=null) {
		if(!$id) return false;
		$rs=$this->Query();
	}

	function getDetailTallaColor($id=null) {
		if(!$id) return false;
		$rs=$this->Query();
	}

	function getLine($id=null) {
		if(!$id) return false;
		$rs=$this->Query();
	}

	function getLineTallaColor($id=null) {
		if(!$id) return false;
		$rs=$this->Query();
	}
	
	function getArticulos() {
		$articulos = $this->Articulo->find
		(
			'list',
			array
			(
				'fields' => array('id', 'arcveart'),
				'order' => 'Articulo.arcveart ASC',
				'recursive' => -1
			)
		);
		return compact('articulos');
	}

	function getColores() {
		$colores = $this->Color->find
		(
			'list',
			array
			(
				'fields' => array('id', 'cve'),
				'order' => 'Color.cve ASC',
				'recursive' => -1
			)
		);
		return compact('colores');
	}

	function getTallas() {
		$tallas = $this->Talla->find
		(
			'list',
			array
			(
				'fields' => array('id', 'cve'),
				'order' => 'Talla.cve ASC',
				'recursive' => -1
			)
		);
		return compact('tallas');
	}

	function getUsers() {
		$users = $this->User->find
		(
			'list',
			array
			(
				'fields' => array('id', 'username'),
				'order' => 'User.username ASC',
				'recursive' => -1
			)
		);
		return compact('users');
	}

}

/*
	CREATE TABLE TTMPPARTIDAS
	(
	  ID Integer,
	  TMPID Integer,
	  ARTICULO_ID Integer,
	  COLOR_ID Integer,
	  TALLA_ID Integer DEFAULT 1,
	  T0 Decimal(12,4) DEFAULT 0,
	  T1 Decimal(12,4) DEFAULT 0,
	  T2 Decimal(12,4) DEFAULT 0,
	  T3 Decimal(12,4) DEFAULT 0,
	  T4 Decimal(12,4) DEFAULT 0,
	  T5 Decimal(12,4) DEFAULT 0,
	  T6 Decimal(12,4) DEFAULT 0,
	  T7 Decimal(12,4) DEFAULT 0,
	  T8 Decimal(12,4) DEFAULT 0,
	  T9 Decimal(12,4) DEFAULT 0,
	  T10 Decimal(12,4) DEFAULT 0,
	  T11 Decimal(12,4) DEFAULT 0,
	  PRECIO Numeric(14,4) DEFAULT 0,
	  DESC1 Numeric(5,2) DEFAULT 0,
	  DESC2 Numeric(5,2) DEFAULT 0,
	  IMPU1 Numeric(5,2) DEFAULT 0,
	  IMPU2 Numeric(5,2) DEFAULT 0,
	  USER_ID Integer DEFAULT 0,
	  CREATED Timestamp DEFAULT CURRENT_TIMESTAMP ,
	  MODIFIED Timestamp DEFAULT CURRENT_TIMESTAMP,
	  OBSER Varchar(1024) DEFAULT '',
	  PRIMARY KEY (ID)
	);
	
	ALTER TABLE TTMPPARTIDAS ADD CANT COMPUTED BY (t0+t1+t2+t3+t4+t5+t6+t7+t8+t9+t10+t11);
	ALTER TABLE TTMPPARTIDAS ADD PRECIODESC COMPUTED BY (( ( Precio*(1-(Desc1/100)) ) *(1-(Desc2/100)) ));
	ALTER TABLE TTMPPARTIDAS ADD IMPORTE COMPUTED BY ((PrecioDesc*cant));
	ALTER TABLE TTMPPARTIDAS ADD IMPOIMPU1 COMPUTED BY ((Importe*(Impu1/100)));
	ALTER TABLE TTMPPARTIDAS ADD IMPOIMPU2 COMPUTED BY ((Importe*(Impu2/100)));
	ALTER TABLE TTMPPARTIDAS ADD CONSTRAINT FK_TTMPPARTIDAS_TALLAS
	  FOREIGN KEY (TALLA_ID) REFERENCES TALLAS (ID) ON UPDATE CASCADE ON DELETE SET NULL;
	ALTER TABLE TTMPPARTIDAS ADD
	  FOREIGN KEY (ARTICULO_ID) REFERENCES ARTICULO (ID) ON UPDATE CASCADE ON DELETE CASCADE;
	ALTER TABLE TTMPPARTIDAS ADD
	  FOREIGN KEY (COLOR_ID) REFERENCES COLORES (ID) ON UPDATE CASCADE ON DELETE SET NULL;
	GRANT DELETE, INSERT, REFERENCES, SELECT, UPDATE
	 ON TTMPPARTIDAS TO  SYSDBA WITH GRANT OPTION;

*/
?>