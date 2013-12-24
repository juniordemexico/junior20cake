<?php 
/** 
 * Be able to easily save and retrieve PHP arrays to/from a database's column 
 * 
 * @author Lucas Pelegrino <lucas.wxp@gmail.com> 
 */ 

class CompressedColumnBehavior extends ModelBehavior { 
/** 
 * The default options for the behavior 
 * 
 * @var array 
 * @access public 
 */ 
    public $settings = array( 
        'fields' => array() 
    ); 

/** 
 * Setup the behavior. 
 * 
 * @param object $model Reference to model 
 * @param array $settings Settings 
 * @return void 
 * @access public 
 */ 
    public function setup(Model $model, $settings) { 
        $this->settings = array_merge($this->settings, $settings); 
    } 

/** 
 * 
 * @param object $model Reference to model 
 * @access public 
 */ 
    public function beforeSave(Model $model) { 
        foreach($this->settings['fields'] as $field){ 
            if(isset($model->data[$model->alias][$field])) 
                $model->data[$model->alias][$field] = $this->_encode($model->data[$model->alias][$field]); 
        } 
        return true; 
    } 


/** 
 * 
 * @param object $model Reference to model 
 * @access public 
 */ 
    public function afterFind(Model $model, $results) { 
        foreach($results as $i => &$res){ 
            foreach($this->settings['fields'] as $field){ 
                if(isset($res[$model->alias][$field])) 
                    $res[$model->alias][$field] = $this->_decode($res[$model->alias][$field]); 
            } 
        } 
        return $results; 
    } 

/** 
 * Encode json 
 * 
 * @param $data 
 * @return mixed 
 */ 
    protected function _encode($data){ 
        return gzcompress($data); 
    } 

/** 
 * Decode json 
 * 
 * @param $data 
 * @return mixed 
 */ 
    protected function _decode($data){ 
//        $decode = gzuncompress($data); 
        return gzuncompress($data); 
    } 
} 

/*

In my Model:

class Recipe extends AppModel{ 

    public $actsAs = array( 
        'CompressColumn' => array( 
            'fields' => array('additional_info') // add the fields you wanna encode here
        ) 
    ); 



In my Controller:

class RecipesController extends AppController { 
    public function save(){ 
         // add some fake data here. This could come from a submit/form, for instance 
         $this->request->data('Recipe.additional_info', $theContentToCompressAndStore)); 
         $this->Recipe->save($this->request->data); 
    } 
} 


*/