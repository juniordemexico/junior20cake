<?php


class TallaColorController extends AppController {
	var $name='TallaColor';

	var $uses = array(
		'Articulo','Artexist','Talla', 'Divisa','Unidad'
	);
	
	function index($id=null) {
		$this->layout = 'empty';
		if(!$id) {
				$this->Session->setFlash(__('invalid_item', true),'default');
		}
		Configure::write ( 'debug', 0 );
		$result = $this->Articulo->read(null, $id);
		$this->set('result',$result);
		$this->set('control' $this->params['']['control']);
		$this->set('master_id' $this->params['']['master_id']);
	}

	function tallacolordata($id=null) {
		$this->layout = 'empty';
		if(!$id) {
				$this->Session->setFlash(__('invalid_item', true),'default');
		}
		Configure::write ( 'debug', 2 );
  		$result = $this->Artexist->query("SELECT Articulo.id, Articulo.arcveart, Articulo.talla_id,
										Artexist.id,Artexist.colorid,Artexist.aecolor,
										Talla.tadescrip,
										Talla.tat0,Talla.tat1,Talla.tat2,Talla.tat3,
										Talla.tat4,Talla.tat5,Talla.tat6,Talla.tat7,
										Talla.tat8,Talla.tat9
										FROM Articulos Articulo
										JOIN Artexist Artexist ON Artexist.artid=Articulo.id
										JOIN Tallas Talla ON Talla.id=Articulo.talla_id
										WHERE Articulo.id=$id
										ORDER BY Artexist.aecolor ASC;
										");
										
		$this->set('result', $result);	
	}

	function tallacolortableedit($id=null) {
		$this->layout = 'empty';
		Configure::write ( 'debug', 2 );
		$this->autoRender=false;
		echo "ID: ".$id;
		$form=$this->params['form'];
		$data=array(
			'color'=> $form['id'],
			't0'=> $form['tat0'],
			't1'=> $form['tat1'],
			't2'=> $form['tat2'],
			't3'=> $form['tat3'],
			't4'=> $form['tat4'],
			't5'=> $form['tat5'],
			't6'=> $form['tat6'],
			't7'=> $form['tat7'],
			't8'=> $form['tat8'],
			't9'=> $form['tat9'],
			);
		foreach($data as $item => $value) {
			echo "I:".$item." V:".$value;				
		}
	}
	

}


?>