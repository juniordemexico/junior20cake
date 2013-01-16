<section id="sectionToolBar">
<div id="divNavbar" class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container table-bodega">
			<a href="/Desktop" class="brand right">OGGI JEANS, Co.</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<ul class="nav navvar">
				<li class="divider-vertical active">&nbsp;</li>
				<li>
					<?php echo $this->Html->link('<i class="icon icon-list icon-white"></i> Menu', array('action' => (isset($listAction)?$listAction:'index')), array('escape'=>false)); ?>
				</li>
				<li class="divider-vertical active">&nbsp;</li>
				<li>
					<?php echo $this->Html->link('<i class="icon icon-list icon-white"></i> Consulta', array('action' => 'ver'), array('escape'=>false)); ?>
				</li>
				<li class="divider-vertical">&nbsp;</li>
				<li>
					<?php echo $this->Html->link('<i class="icon icon-plus-sign icon-white"></i> Entrada', array('action' => 'entradas'), array('escape'=>false)); ?>
				</li>
				<li class="divider-vertical">&nbsp;</li>
				<li>
					<?php echo $this->Html->link('<i class="icon icon-plus-sign icon-white"></i> Salida', array('action' => 'salidas'), array('escape'=>false)); ?>
				</li>
				<li class="divider-vertical">&nbsp;</li>
				<li>
					<span id="busy-indicator-div" class="pull-right">
					<?php echo $this->Html->image('/img/loading_circle.gif', array('id' => 'busy-indicator', 'alt' => 'Transmitiendo', 'style'=>'display: none; float: right;')); ?>
					</span>
				</li>
			</ul>
		</div> <!-- container -->
	</div>  <!-- navbar-inner -->

</div>  <!-- divNavbar -->
</section>
