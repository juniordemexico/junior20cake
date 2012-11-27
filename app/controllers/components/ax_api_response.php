<?php

class AxApiResponse extends Component
{
	protected $_result=0;
	protected $_header=array();
	protected $_messages=array();
	protected $_data=array();
	protected $_elements=array();
	protected $_collections=array();
	
	public function startup( &$controller ) {
		$this->controller =& $controller;
		
		$this->_header=array(	'_id'=>99999,
								'_refererid'=>88888,
								'_timestamp'=>date('Y-m-d H:i:s'),
		);
		$this->_result=0;
		$this->_messages=array();
		$this->_data=array();
		$this->_elements=array();
		$this->_collections=array();
	}


	public function addMessage($text='', $type='info', $sticky=null, $title=null) {
		if(!$text && is_array($text) && !is_string($text)) {
			$this->_messages[]=$text;
		}
		$this->_messages[]=array(	'text'=>$text, 
									'type'=>$type,
									'title'=>$title, 
									'sticky'=>$sticky);
		return (count($this->_messages));
	}

	public function setHeader($header=null) {
		if(!$header) return false;
		if(is_array($header) and !is_string($header)) {
			$this->_header=$header;
			return true;
		}
		return false;
	}
	
	public function setData($data=null) {
		if(!$data) return false;
		
		if (is_string($data) && !is_array($data)) {
			$data=array($data);
		}
		$this->_data=$data;
		
		return(count($this->_data));
	}

	public function newDataCollection($collection=null, $content=null) {		
		if (!$collection) return false;
		if (!empty($collection) && is_string($collection)) {
			if($content && is_array($content)) {
				$this->_data[$collection]=array();
				foreach($content as $item) {
					$this->_data[$collection][]=$item;					
				}
			}
			elseif(!$content || empty($content) || !is_array($content)) {
				$this->_collections[$collection]=array();				
			}
			return(count($this->_data));
		}
		return false;
	}

	public function addCollectionItem($collection, $item=array()) {		
		if(!$collection || !$item) return false;
		if($collection && $item && is_array($item)) {
			$this->_data[$collection][]=$item;
			return (count($this->_data));
		}
		return false;
	}

	public function addDataItem($item=null) {
		if(!$item || (is_array($item) && count($item)<1) {
			return false;
		}
		$this->_data[]=$item;
	}
	
	public function getFullResponse($format='json') {
		$out=array();
		
		return (
			json_encode(array(
			'result'=>$this->_result;
			'header'=>$this->_header,
			'messages'=>$this->_messages,
			'data'=>$this->_data,			
			))
			);
	} 

}
