<div id="toolbarForm" class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<ul class="nav navvar">
				<li>
<?php 
				echo $this->Js->link('Lista', array('controller' => $this->name, 'action' => 'index', 'page' => isset($returnpage)?$returnpage:1), array('update' => '#content','before' => $this->Js->get('#content')->effect('fadeOut', array('buffer' => false)).$this->Js->get('#toolbarForm')->effect('fadeOut', array('buffer' => false)),
														'complete' => 
$this->Js->get('#content')->effect('fadeIn', array('buffer' => false)).$this->Js->get('#toolbarList')->effect('fadeIn', array('buffer' => false))
				)); 
?>
				</li>
<?php if ($MyMode <> 'add') { ?>
				<li class="divider-vertical"></li>
				<li>
<?php 
				echo $this->Js->link('Agregar', array('controller' => $this->name, 'action' => 'add'), array('update' => '#content')); 
?>
				</li>
				<li class="divider-vertical"></li>
				<li>
				<?php echo $this->TBS->link(__('delete', true),
								array('controller' => $this->name, 'action' => 'delete', $this->data[$MyModel]['id']),
								null, sprintf(__('¿ Seguro de Eliminar # %%s ?', true), $this->data[$MyModel]['id'])); ?>
			</li>
				<li class="divider-vertical"></li>
				<li>
				<?php echo $this->Html->link(__('cancel', true),
								array('controller' => $this->name, 'action' => 'cancel', $this->data[$MyModel]['id']),
								null, sprintf(__('¿ Seguro de Cancelar # %%s ?', true), $this->data[$MyModel]['id'])); ?>
			</li>
				<li class="divider-vertical"></li>
				<li>
				<?php echo $this->Html->link(__('mail', true),
								array('controller' => $this->name, 'action' => 'mail', $this->data[$MyModel]['id']),
								null, sprintf(__('Enviar por Correo al Destinatario:', true), $this->data[$MyModel]['id'])); ?>
			</li>
<?php } ?>
				<li class="divider-vertical pull-right"></li>

<li>
<span id="busy-indicator-div">
			<?php echo $this->Html->image('loading.gif', array('id' => 'busy-indicator', 'alt' => 'Espere')); ?>
		</span>
</li>
			</ul>
		</div>
	</div>
</div>
<script>
	$('#busy-indicator').ajaxStart( function() {
		$(this).show();
	});
	$('#busy-indicator').ajaxStop( function() {
		$(this).hide();
	});
	bootbox.confirm('HOla pues');
</script>
