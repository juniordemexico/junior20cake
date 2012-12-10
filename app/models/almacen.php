
class Almacen extends AppModel 
{
	var $name = 'Almacen';
	var $table = 'almacenes';
	var $alias = 'Almacen';
	var $primaryKey = 'id';
	var $cache=true;

	var $hasMany = array(
		'Ubicacion',
		'Invfisico'
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
				'rule' => array('between', 1, 2),
				'message' => 'La Clave debe contener entre 1 y 2 caracteres'
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
