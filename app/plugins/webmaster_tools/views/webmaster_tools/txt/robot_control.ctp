<?php
	//$this->layout = 'ajax';

	$this->RobotControl->deny('/');
	echo $this->RobotControl->generate();
?>