<section id="sectionToolBar">
<div id="toolbarContainer" class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<ul class="nav navvar">
				<li>
<?php 
				echo $this->Html->link('<i class="icon icon-refresh icon-white"></i> Refrescar', array(), array('update' => '#content', 'escape'=>false
				)); 
?>
				</li>
				<li class="divider-vertical"></li>
				<li>
					<?php echo $this->Html->link('<i class="icon icon-list icon-white"></i>  Lista', array('action' => (isset($listAction)?$listAction:'index')), array('escape'=>false)); ?>
				</li>
				<li class="divider-vertical"></li>
				<li>
					<?php echo $this->Html->link('<i class="icon icon-plus-sign icon-white"></i>  Agregar', array('action' => 'add'), array('escape'=>false)); ?>
				</li>
				<li class="divider-vertical"></li>
				<?php if($this->action=='edit'): ?>
				<li>
					<?php if(is_array($this->data)) {echo $this->Html->link('<i class="icon icon-trash icon-white"></i>  Eliminar', 
										array('action' => 'delete', $this->data[array_shift(array_keys($this->data))]['id']), 
										array('escape'=>false),
										sprintf(__('¿ Seguro de Eliminar # %s ?', true), $this->data[array_shift(array_keys($this->data))]['id'])); 


			//							array('action' => 'delete', $this->data[$MyModel]['id']),
			//							null, sprintf(__('¿ Seguro de Eliminar # %%s ?', true), $this->data[$MyModel]['id'])
										}
										?>


				</li>
				<li class="divider-vertical"></li>
<?php endif;?>
<?php
/*
			<li class="dropdown" id="menu2"><a class="dropdown-toggle" data-toggle="dropdown" href="#menu2"><i class="icon icon-music icon-white"></i> Acciones<b class="caret"></b>
</a>
				<ul class="dropdown-menu">
				<li><a href="#as">Autorizar</a></li>
				<li><a href="#as">Desautorizar</a></li>
				<li><a href="#as">Cancelar</a></li>
				<li><?php 	//echo $this->Html->link(__('delete', true),
//								array('controller' => $this->name, 'action' => 'delete', 0),
//								null, sprintf(__('¿ Seguro de Eliminar # %%s ?', true), 0)); ?>
				</li>
				</ul>
			</li>
				<li class="divider-vertical"></li>
			<li class="dropdown navbar-icon-signal" id="menu1"><a class="dropdown-toggle " data-toggle="dropdown" href="#menu1"><i class="icon icon-envelope icon-white"></i> Compartir <b class="caret"></b></a>
				<ul class="dropdown-menu">
				<li><a href="#as">Imprimir</a></li>
				<li><a href="#as">Correo</a></li>
				<li><a href="#as">Mensaje</a></li>
				</ul>
			</li>
				<li class="divider-vertical"></li>
*/
?>
<li class="pull-right">
<span id="busy-indicator-div" class="pull-right">
			<?php echo $this->Html->image('loading.gif', array('id' => 'busy-indicator', 'alt' => 'Espere')); ?>
		</span>
				</li>
			</ul>
		</div>
	</div>

</div>
</section>
