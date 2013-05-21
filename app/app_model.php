<?php

class AppModel extends Model
{
	public $recursive = 0;

	public $persistModel = true;
	public $cacheQueries = true;
	public $cache=false;

	public $transactionResult=false;
	public $transactionMessages=array();

	public $autoCompleteDefaults=array();

	public $title='cve';
	public $longTitle='descrip';

	public $stField='st';
	public $autorizeField='fautoriza';
	public $autorizeUserField='uautoriza';
	
	public function __construct($id=false, $table=null, $ds=null) {
  		parent::__construct($id, $table, $ds);
		$this->autoCompleteDefaults=array('fields' => array($this->name.'.'.$this->primaryKey,
															$this->name.'.'.$this->title,
															$this->name.'.'.$this->longTitle),
										'limit' => AX_AUTOCOMLPETE_ITEMS_LIMIT, 
										);

		// If the passed $options doesn't have the 'conditions' index, then initialize it.
		if(isset($this->stField) && !empty($this->stField)) {
			$this->autoCompleteDefaults['conditions']=array($this->stField => 'A');
		}
		
		// Set the default fieldnames used in the response 
		$this->autoCompleteDefaults['responseFieldnames']=array('id', 'text', 'title');

/*
		$this->autoCompleteDefaults['responseFieldnames']=array($this->primaryKey,
																$this->title,
																$this->longTitle,
																);
*/
//    	'name'=>"CONCAT(`{$this->alias}`.`first_name`,' ',`{$this->alias}`.`last_name`)"
	}

	function find($type=null, $params=null) 
	{
		if ($this->cache) { 
			$tag = isset($this->name) ? '_' . $this->name : 'appmodel';
			$paramsHash = md5(serialize($params));
			$version = (int)Cache::read($tag);
			$fullTag = $tag . '_' . $type . '_' . $paramsHash;
			if ($result = Cache::read($fullTag)) {
				if ($result['version'] == $version)
					return $result['data'];
			}
			$result = array('version' => $version, 'data' => parent::find($type, $params), );
			Cache::write($fullTag, $result);
			Cache::write($tag, $version);
			return $result['data'];
		}
		else { 
			return parent::find($type, $params); 
		} 
	} 

	function updateCounter() 
	{ 
		if ($this->cache) { 
			$tag = isset($this->name) ? '_' . $this->name : 'appmodel'; 
			Cache::write($tag, 1 + (int)Cache::read($tag));
		}
	}

	// Record/Field store methods
/*
	function beforeSave($data) { 
    	if(!parent::beforeSave($data)) return false; 
		
		// Allow inserting new records with a known or predeterminated Primary Key (id field) 

    	if(isset($data['id']) && $data['id']) { 
        	if(!isset($this->data[$this->name][$this->primaryKey])) { 
            	$this->data[$this->name][$this->primaryKey] = $data['id']; 
    		} 
    	}
    	return true; 
	} 
*/

    function afterSave($created) 
    { 
 
       $this->updateCounter(); 
        $tag = isset($this->name) ? '_' . $this->name : 'appmodel'; 
   		$fullTag = $tag . '_' . 'count' ; 
		$version=Cache::read($tag);
        Cache::write($tag, $version+1); 
         
        return(parent::afterSave($created)); 
    }

	function afterDelete() 
	{ 

		$this->updateCounter(); 
		$tag = isset($this->name) ? '_' . $this->name : 'appmodel'; 
		$fullTag = $tag . '_' . 'count' ; 
		$version=Cache::read($tag);
        Cache::write($tag, $version+1); 

		return(parent::afterDelete()); 
	} 


	public function getNextFolio( $serie='', $advance=0, $model=null ) {
		$model=strtolower($model && is_string($model)?$model:$this->name);
		$serie=strtoupper($serie);
		$rs=$this->query("SELECT Folio.serie, Folio.generador, Folio.seriesize 
							FROM Folios Folio
							WHERE Folio.model='${model}'
								AND Folio.serie='${serie}'"
//								AND Folio.t=${t}"
			);
		if($rs && isset($rs[0][0]) && is_array($rs[0][0])) {
			$rs=$rs[0][0];
			$generador=$rs['generador'];
			$seriesize=$rs['seriesize'];
			
			$rs=$this->query("SELECT GEN_ID(${generador}, ${advance}) generatorvalue ".
							'FROM RDB$DATABASE Folio',
							array('cache'=>false)
							);
			if($rs && isset($rs[0][0]) && is_array($rs[0][0])) {
				$newValue=$rs[0][0]['generatorvalue'];
				// Fill with zeroes
				$newFolio=$serie.str_repeat('0',$seriesize-strlen($serie.$newValue)).$newValue;
				return ($newFolio);
			}
		}
		return false;

	}

/*
	function getNewTmpID($generator=null) {
		if(!$generator || strlen(trim($generator))>16) $generator='tmp';
		$newValue=0;
		$rs=$this->query('SELECT GEN_ID('.$generator.',1) tmpid FROM RDB$DATABASE '.$generator, array('cache'=>'false'));
		if($rs) {
			if(isset($rs[0][0]['tmpid']) && isset($rs[0][0]['tmpid'])>0)
				$newValue=$rs[0][0]['tmpid'];
			unset($rs);
		}
		return($newValue);
	}
*/
	public function autoCompleteRecords($keyword='', $type=null) {
		if(!$type && !$this->defaultRecordType) {
			$type=$this->defaultRecordType;
		}

		$this->recursive=-1;

  		$result = $this->Articulo->find('all', array(
			'fields'=>$this->autoCompleteOptions['fields'],
			'order'=>$this->autoCompleteOptions['order'],
			'limit'=>$this->autoCompleteOptions['limit'],
			'conditions' => $this->autoCompleteOptions['conditions'],
			));
		if($result && !empty($result))
			return $result;
		else
			return false;
	}

	function generateJoinUservendedor( $options ) {
		// If session's data was submitted
		if(isset($options['session']) && is_array($options['session']) ) {
			// Check if 'joins' option was submitted
			if(!isset($options['joins']) || !is_array($options['joins']) ) {
				$options['joins']=array();
			}
			$thisModel=$this->name;

			$options['joins'][]=array(	'table' => 'users_vendedores',
										'alias' => 'Usersvendedores',
										'type' => 'INNER',
										'conditions' => array(
											'Usersvendedores.user_id='.$options['session']['User']['id'],
											array('OR'=>array(
											"${thisModel}.vendedor_id=Usersvendedores.vendedor_id",
											"${thisModel}.vendedor_id IS NULL"
												))
											),
										);

		}
		return $options;
	}

	public function autoComplete($keyword=null, $options=array() ) {
		// Check for a valid keyword
		$out=array();
		if(!$keyword || empty($keyword)) {
			return false;
		}
		
		// If no $options['conditions'] passed, then automagically determine the query's conditions
//		$options['conditons']=array($this->name.'.'.$this->title." LIKE '$keyword%'");
//		$options['conditons']=array("Articulo.arcveart LIKE '$keyword%'");

		if(!isset($options['fields'])) {
			$options['fields']=$this->autoCompleteFields;
		}
		
		if(!isset($options['conditions'])) {
			$options['conditons']=array($this->name.'.'.$this->title." LIKE '$keyword%'");
			$options['conditons'][]=array($this->stField=>'A');
		}
		if(!isset($options['conditions2'])) {
			$options['conditons2']=array($this->title.' LIKE'=>'%'.$keyword.'%');
			$options['conditons2'][]=array($this->stField=>'A');
		}
	
		if(!isset($options['responseFieldnames']) && isset($this->autoCompleteDefaults['responseFieldnames']) ) {
			$options['responseFieldnames']=$this->autoCompleteDefaults['responseFieldnames'];
		}

		if(!isset($options['limit'])) $options['limit']=16;
		
		// Merge autoCompleteDefaults with the passed $options paremeters
//		$options=array_merge($options);

		// Get the RecordSet
		$oldRecursive=$this->recursive;
		$this->recursive=0;

		// Get the first Recordset of results (item codes starting with $keyword)
		$rs1=$this->find('all', $options);
		
		// Get the second Recordset of results (item codes and descriptions that contains $keyword)

		if(isset($options['conditions2'])) {
			$options['conditions']=$options['conditions2'];
			$rs2=$this->find('all', $options);
		}
		
		$this->recursive=$oldRecursive;

		// Merge the Resultsets
		if(isset($rs1) && isset($rs2)) {
			$rs=Set::merge($rs1,$rs2);
		}
		elseif(isset($rs1) && !isset($rs2)) {
			$rs=$rs1;
		}
		elseif(!isset($rs1) && isset($rs2)) {
			$rs=$rs2;
		}
		else {
			$rs=array();
		}

		// Iterate thru recordset's items in order to create the response array
		if ($rs && sizeof($rs)>0) {
			$out=array();
			foreach($rs as $item) {
				$record=array();
				foreach( $item as $model=>$fields ) {
					if( strtolower($model)===strtolower($this->name) && isset($fields[$this->primaryKey]) ) {
						if( isset($options['responseFieldnames']) &&
							sizeof($options['responseFieldnames'])>0 ) {
							$record[$options['responseFieldnames'][0]]=$fields[$this->primaryKey];
						}
						else {
							$record[$this->primaryKey]=$fields[$this->primaryKey];							
						}
					}

					$i=0;
					foreach( $fields as $fieldName=>$fieldValue ) {
						if(!is_numeric($fieldValue) && !is_integer($fieldValue)) {
							$fieldValue=trim($fieldValue);
						}
						if( isset($options['responseFieldnames']) &&
						 	sizeof($options['responseFieldnames'])>0 &&
						 	$i < sizeof($options['responseFieldnames'])
						) {
							if(!isset($record[$options['responseFieldnames'][$i]]) ) {
								$record[$options['responseFieldnames'][$i]]=(string)$fieldValue;
							}						
							$i++;
						}
						else {
							$record[$fieldName]=(string)$fieldValue;
						}
					}
				}
				if( sizeof($record)>0 ) $out[]=$record;
			}
		}

		// Return the recordset's array. Or 'false' if there are no ocurrencies
		if( sizeof($out)>0 ) return $out; else return false;
	}

    public function toJsonListArray($arr = null)
    {
        $ret = null;
		
        if (!empty($arr)) {
            $ret = array();
            foreach ($arr as $k => $v) {
                $ret[] = array('id' => $k, 'cve' => $v);
            }
        }
		return $ret;
    }

}
