<?php    
if ($this->Session->check('Message.flash')) {       
	echo '<div class="alert alert-info">';
	echo '<h4 class="alert-heading">Atención!</h4>';
	echo $session->flash();
	echo '</div>';
}
if ($this->Session->check('Message.auth')) {       
	echo '<div class="alert alert-info">';
	echo '<h4 class="alert-heading">Atención!</h4>';
	 echo $this->Session->flash('auth');
	echo '</div>';
}
?>
<div class="form login">
<?php echo $this->Form->create('User', array('action' => 'login', 
											'class'=>'form login',
											'style'=>'background-color: #909090;')); ?>
<table width="100%" cellpadding="0" cellspacing="0" style="line-height:8pt; background-color: #909090;">
<tr>
<td style="width:50px; background-color: #909090;">
<?php echo $this->Html->image("icons/devine/white/User.png", array('width'=>'48','height'=>'48')); ?>
</td>
<td style="background-color: #909090;">
<?php echo $this->Form->input('username',array('label'=>'', 'maxlenght'=>32, 'type'=>'text', 'autofocus'=>'true', 'autocomplete'=>'false', 'placeholder'=>'Usuario...')); ?>
<?php echo $this->Form->input('password',array('label'=>'', 'maxlenght'=>32, 'type'=>'password', 'placeholder'=>'Su Contraseña...')); ?>
<?php echo $this->Form->hidden('redirect', array('id'=>'redirect', 'value'=>$redirect)); ?>
<?php echo $this->Form->button('Entrar', array('type'=>'submit', 'class'=>'ui-button-primary')); ?>
</td>
</tr>

</table>
<?php echo $this->Form->end();?>