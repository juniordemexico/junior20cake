
class Invfisico extends AppModel 
{
	var $name = 'Invfisico';
	var $table = 'invfisicos';
	var $alias = 'Invfisico';
	var $primaryKey = 'id';
	var $cache=false;

	var $belongsTo = array(
		'Almacen',
		);

	var $hasMany = array(
		'Invfisicodetail',
		);

	var $validate = array(
		'cve' => array(
			'isunique' => array(
				'rule' => array('isUnique'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'La Clave YA Existe'
			),
			'between' => array(
				'rule' => array('between', 1, 8),
				'message' => 'La Clave debe contener entre 1 y 8 caracteres'
			),
		),
		'fecha' => array(
			'isunique' => array(
				'rule' => array('isDate'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'La Clave YA Existe'
			),
			'between' => array(
				'rule' => array('between', 1, 8),
				'message' => 'Debe especificar la fecha correctamente'
			),
		),
		'finicio' => array(
			'isunique' => array(
				'rule' => array('isData'),
				'required' => true,
				'allowEmpty' => true,
				'message' => 'La Clave YA Existe'
			),
			'between' => array(
				'rule' => array('between', 1, 10),
				'message' => 'Debe especificar la fecha correctamente'
			),
		),
		'finicio2' => array(
			'isunique' => array(
				'rule' => array('isData'),
				'required' => true,
				'allowEmpty' => true,
				'message' => 'La Clave YA Existe'
			),
			'between' => array(
				'rule' => array('between', 1, 10),
				'message' => 'Debe especificar la fecha correctamente'
			),
		),
		'ftermino' => array(
			'isunique' => array(
				'rule' => array('isData'),
				'required' => true,
				'allowEmpty' => true,
				'message' => 'La Clave YA Existe'
			),
			'between' => array(
				'rule' => array('between', 1, 10),
				'message' => 'Debe especificar la fecha correctamente'
			),
		),
	);
}
