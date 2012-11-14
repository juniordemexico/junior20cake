<?php

//	desc2 DECIMAL(10,2) NOT NULL
//	suc VARCHAR(64) DEFAULT '' NOT NULL
//	cvecli VARCHAR(16) DEFAULT NOT NULL
//	banco VARCHAR(16) DEFAULT NOT NULL
//	cuenta VARCHAR(16) DEFAULT NOT NULL
//	precio CHAR(1) DEFAULT '' NOT NULL
//	atn VARCHAR(64) DEFAULT '' NOT NULL
//	locfor CHAR(1) DEFAULT '' NOT NULL
//	rfc VARCHAR(16) DEFAULT NOT NULL
//	desc3 DECIMAL(10,2) NOT NULL
//	tda VARCHAR(16) DEFAULT NOT NULL
//	t CHAR(1) DEFAULT '' NOT NULL
//	nom VARCHAR(16) DEFAULT NOT NULL
//	st CHAR(1) DEFAULT '' NOT NULL
//	desc1 DECIMAL(10,2) NOT NULL
//	plazo INT(10) NOT NULL

class Directorio extends AppModel 
{
	var $name = 'Directorio';
	var $table = 'Directorios';
	var $alias = 'Directorio';
	
	var $validate = array(
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Estado', 'Pais', 'Vendedor'
	);


	function beforeFind($options) {
		if(isset($options) && isset($options['session'])) {
			if(!isset($options['conditions'])) $options['conditions']=array();
			if($options['session']['User']['group_id']=='30') {			
				$options['doJoinUservendedor']=true;			
				$options['conditions'][]=array('tipopersona_id'=>array('30', '40'));
			}

			if($options['session']['User']['group_id']==21) {
				$options['conditions'][]=array('tipopersona_id'=>array('30', '50'));
			}

		}
		return(parent::beforeFind($options));
	}
}

?>