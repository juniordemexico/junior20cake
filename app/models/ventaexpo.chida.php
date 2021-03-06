<?php

class Ventaexpo extends AppModel 
{
	var $name = 'Ventaexpo';
//	var $table = 'Ventaexpos';
//	var $useTable= 'Ventaexpos';
	var $alias = 'Ventaexpo';

	public $primaryKey = 'id';
	public $title = 'folio';
	public $longTitle = null;

	public $detailsModel='Ventaexpodet';

	var $cache=false;


	public $_schema = array(
		'folio' => array(
			'type' => 'string', 
			'length' => 8
		),
		'fecha' => array(
			'type' => 'date',
			'length' => 10
		),
		'obser' => array(
			'type' => 'string', 
			'length' => 255
		),
	);

	//The Associations below have been 	, those that are not needed can be removed
	var $belongsTo = array(
		'Vendedor',
		'Cliente',
	);


	public $hasMany = array(
		'Ventaexpodet',
	);


	var $validate = array(
		'folio' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Especifica el Folio de la transacción'
			),
			'isunique' => array(
				'rule' => array('isUnique'),
				'message' => 'El Folio especificado YA existe'
				),
			'inbetween' => array(
				'rule' => array('between', 2, 8),
				'message' => 'El Folio debe contener de 2 a 8 caracteres'
				),
		),
		'fecha' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Especifica la Fecha de la transacción'
			),
			'isdate' => array(
				'rule' => 'date',
				'message' => 'Proporciona una Fecha válida (aaaa-mm-dd)'
			),
		),
		'fvence' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Especifica la Fecha de Vencimiento (surtido)'
			),
			'isdate' => array(
				'rule' => 'date',
				'message' => 'Proporciona una Fecha válida (aaaa-mm-dd)'
			),
		),
		'cliente_id' => array(
			'inbetween' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe especificar el cliente'
				),
		),
		'vendedor_id' => array(
			'inbetween' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe especificar el vendedor'
				),
		),
		'obser' => array( 
			'inbetween' => array(
				'rule' => array('between', 0, 255),
				'required' => false,
				'allowEmpty' => false,
				'message' => 'Las Observaciones deben contener hasta 255 caracteres'
				),
		),

	);

	public function loadDependencies() {
		$Cliente = $this->toJsonListArray( $this->Cliente->find('list', 
							array(	'fields' => array('Cliente.id', 'Cliente.clcvecli'),
									'conditions'=>array('clst'=>'A'),
									'order'=>array('Cliente.clcvecli', 'Cliente.cltda') 
									)));
		$Vendedor = $this->toJsonListArray( $this->Vendedor->find('list', 
							array(	'fields' => array('Vendedor.id', 'Vendedor.vecveven'),
									'conditions'=>array('vest'=>0),
									'order'=>array('Vendedor.vecveven') 
									 )));
		return compact('Cliente', 'Vendedor');		
	}

}


/*

create table ventaexpos(
id integer not null,
folio varchar(8) not null,
fecha timestamp default CURRENT_TIMESTAMP not null,
fvence timestamp default CURRENT_TIMESTAMP not null,
vendedor_id integer not null,
cliente_id integer not null,
st char(1) default 'A' not null,
t char(1) default '0' not null,
created timestamp default CURRENT_TIMESTAMP not null,
modified timestamp,
uuid varchar(32) default '' not null,
obser varchar(255) default '' not null,
primary key(id),
unique(folio),
unique(uuid),
foreign key (vendedor_id) references vendedores(id) on delete no action on update cascade,
foreign key (cliente_id) references clientes(id) on delete no action on update cascade,
foreign key (catalogoventa_id) references catalogoventas(id) on delete no action on update cascade
);


create index idx_ventaexpos_x_fecha on ventaexpos(fecha);


create table ventaexpodets(
id integer not null,
ventaexpo_id integer not null,
articulo_id integer not null,
color_id integer default 1 not null,
talla_id integer default 0 not null,
t0 numeric(12,2) default 0 not null,
t1 numeric(12,2) default 0 not null,
t2 numeric(12,2) default 0 not null,
t3 numeric(12,2) default 0 not null,
t4 numeric(12,2) default 0 not null,
t5 numeric(12,2) default 0 not null,
t6 numeric(12,2) default 0 not null,
t7 numeric(12,2) default 0 not null,
t8 numeric(12,2) default 0 not null,
t9 numeric(12,2) default 0 not null,
cant numeric(12,2) default 0 not null,
precio numeric(12,2) default 0 not null,
importe numeric(14,2) default 0 not null,
primary key(id),
foreign key(ventaexpo_id) references ventaexpos(id) on delete cascade on update cascade,
foreign key(articulo_id) references articulo(id) on delete no action on update cascade,
foreign key(color_id) references colores(id) on delete no action on update cascade,
foreign key(talla_id) references tallas(id) on delete no action on update cascade
);


**/