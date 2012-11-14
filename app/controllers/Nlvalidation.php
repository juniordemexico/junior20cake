<?php

/* Locale and Misc Model Validation Methods */

class NlValidation {

/*
	function phone($check) {
	}

	function postal($check) {
	}
*/
	function rfc($check) {
		if(strlen($check>14) || strlen($check)<12) return false;
		if(is_numeric(substr($check,0,3)) ) return false;
		if(!is_numeric(substr($check,strlen($check)-9,6))) return false;
		return true;
	}
}

?>