<div class="Subdocuments form">
<?php echo $this->Form->create('Subdocument' , array( 'type' => 'post' ));?>
	<fieldset>
 		<legend><?php __('Edit Subdocument');?></legend>
	<?php
		echo $this->Form->hidden('_id');
		echo $this->Form->input('title');
		echo $this->Form->input('body');
		echo $this->Form->input('Subdocument.subdoc.0.name');
		echo $this->Form->input('Subdocument.subdoc.0.age');
		echo $this->Form->input('Subdocument.subdoc.1.name');
		echo $this->Form->input('Subdocument.subdoc.1.age');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Subdocuments', true), array('action'=>'index'));?></li>
	</ul>
</div>

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
