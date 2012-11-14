<div id="toolbarList" class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<ul class="nav navvar">
				<li>
<?php 
				echo $this->Js->link('Refrescar', array('controller' => $this->name, 'action' => 'index', 'page' => isset($returnpage)?$returnpage:1), array('update' => '#contentList'
				)); 
?>
				</li>
				<li class="divider-vertical"></li>
				<li>
<?php 
				echo $this->Js->link('Agregar', array('controller' => $this->name, 'action' => 'add'), array('update' => '#content','before' => $this->Js->get('#toolbarList')->effect('fadeOut', array('buffer' => false)),
														'complete' => $this->Js->get('#content')->effect('fadeIn', array('buffer' => false)).$this->Js->get('#toolbarForm')->effect('fadeIn', array('buffer' => false))
				)); 
?>
				</li>
				<li class="divider-vertical"></li>
				<li>
				<form id="frmSearch" class="navbar-search pull-right" action="/articulos/search" method="GET">
  					<input id="textToSearch" name="textToSearch" type="search" class="search-query" placeholder="Buscar..." />
				</form>
				</li>
				<li class="divider-vertical"></li>

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
</script>
