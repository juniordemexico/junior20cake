<section id="sectionToolBar">
<div id="toolbarContainer" class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<ul class="nav navvar">
				<li>
<?php 
				echo $this->Js->link('<i class="icon icon-refresh icon-white"></i> Refrescar', array('action' => 'index'), array('update' => '#contentupdatable', 'escape'=>false
				)); 
?>
				</li>
				<li class="divider-vertical"></li>
				<li>
					<?php echo $this->Html->link('<i class="icon icon-list icon-white"></i>  Vista Previa', array('action' => 'index'), array('escape'=>false)); ?>
				</li>
				<li class="divider-vertical"></li>
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
