<section id="sectionToolBar">
<div id="divNavbar" class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a href="/Desktop" class="brand right">OGGI JEANS, Co.</a>
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
					<?php if(is_array($this->data)) {echo $this->Html->link('<i class="icon icon-trash"></i>  Eliminar', 
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
			<li class="dropdown" id="menu2"><a class="dropdown-toggle" data-toggle="dropdown" href="#menu2"><i class="icon icon-music"></i> Acciones<b class="caret"></b>
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
			<li class="dropdown navbar-icon-signal" id="menu1"><a class="dropdown-toggle " data-toggle="dropdown" href="#menu1"><i class="icon icon-envelope"></i> Compartir <b class="caret"></b></a>
				<ul class="dropdown-menu">
				<li><a href="#as">Imprimir</a></li>
				<li><a href="#as">Correo</a></li>
				<li><a href="#as">Mensaje</a></li>
				</ul>
			</li>
				<li class="divider-vertical"></li>
*/
?>
			</ul>
<span id="busy-indicator-div" class="pull-right" style="float:right;">
			<?php echo $this->Html->image('/img/loading_circle.gif', array('id' => 'busy-indicator', 'alt' => 'Transmitiendo', 'style'=>'display: none; float: right;')); ?>
</span>
		</div> <!-- container -->
	</div>  <!-- navbar-inner -->

</div>  <!-- divNavbar -->
</section>
