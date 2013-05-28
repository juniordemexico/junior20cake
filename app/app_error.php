<?php

/*
* App Custom Error Handling Class
* Created by: Lev A Gutierrez (IDD)
*/

class AppError extends ErrorHandler {

	function itemInvalid( $params=array() ) {
		if(!empty($params) && isset($params['error'])) {
			$result='error';
			$message='Item Inválido';
		}
		$this->controller->set('result', $params['error']);
	}

	function itemNotFound( $params=array() ) {
		if(empty($params)) {

		}
		$this->controller->set('result', $params['error']);
	}

	function itemSaving( $params=array() ) {
		if(empty($params)) {

		}
		$this->controller->set('result', $params['error']);
	}

	function itemDeleting( $params=array() ) {
		if(empty($params)) {

		}
		$this->controller->set('result', $params['error']);
	}

}
