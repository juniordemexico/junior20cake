<div class="span12 edit-form">

<?php echo '<h2>REGISTRO DE USUARIOS</h2>'; ?>

<?php    
if ($session->check('Message.flash')) {       
	 echo $session->flash();
}
if ($session->check('Message.auth')) {
	 echo $session->flash('auth');
}
?>

<?php //echo $this->Form->create('User', array('action'=>'register', 'class'=>'form-horizontal')); ?>
<?php // if ($mode == 'edit') {?>
<?php	//echo $this->Form->hidden('id'); ?>
<?php //}?>

<?php
echo $this->Form->create('User', array('action'=>'register', 'class'=>'form-horizontal'));
echo $this->TBS->input('username', array('label'=>'Usuario', 'placeholder'=>'Nombre de Usuario','ly_w'=>'2'));
echo $this->TBS->input('password', array('label'=>'Contrasena', 'placeholder'=>'Password', 'ly_w'=>'2'));
echo $this->TBS->input('password_confirm',array('type'=>'password', 'label'=>'Confirma Contrasena', 'placeholder'=>'Password Confirm', 'ly_w'=>'2'));
echo $this->TBS->input('nom', array('label'=>'Nombre', 'placeholder'=>'Nombre Completo', 'ly_w'=>'4'));
echo $this->TBS->input('email',  array('label'=>'EMail', 'placeholder'=>'Correo Electronico', 'ly_w'=>'4'));
echo $this->TBS->input('group_id',  array('label'=>'Grupo / Departamento', 'placeholder'=>'Grupo', 'ly_w'=>'3'));
echo $this->TBS->input('remoteaccess', array('type'=>'checkbox', 'label'=>'Acceso Remoto'));
echo $this->TBS->input('st', array('type'=>'radiogroup', 'label'=>'Estatus', 
							'selectOptions'=>array('A'=>'Activo', 'B'=>'Baja', 'S'=>'Suspendido'))
							);

echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'type'=>'button', 'update' => '#content'));
echo $this->Form->end();
?>


</div> <!-- span12 -->
