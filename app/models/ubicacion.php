
class Ubicacion extends AppModel 
{
	var $name = 'Ubicacion';
	var $table = 'ubicaciones';
	var $alias = 'Ubicacion';
	var $primaryKey = 'id';
	var $cache=true;

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
		'descrip' => array(
			'between' => array(
				'rule' => array('between', 1, 32),
				'required' => false,
				'allowEmpty' => true,
				'message' => 'La Descripcion debe contener entre 1 y 32 caracteres'
			),
		),
	);
}
