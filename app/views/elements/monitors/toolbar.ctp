<div id="toolbarList" class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<ul class="nav navvar">
				<li>
<?php 
				echo $this->Js->link('Refrescar Todo', array('controller' => $this->name, 'action' => 'getlog','update' => '#content')
				); 
?>
				</li>
				<li class="divider-vertical"></li>
			<li class="dropdown ax-navbar-icon-repeat" id="menu2" style="background: url('/img/icons/devine/white/Repeat.png') -8px -8px; padding-left:32px;""><a class="dropdown-toggle" data-toggle="dropdown" href="#menu2">Refrescar<b class="caret"></b>
</a>
				<ul class="dropdown-menu">
				<li><a href="#">Users</a></li>
				<li><a href="#">DB Connections</a></li>
				<li><a href="#">DB Queries</a></li>
				<li><a href="#">APC Cache</a></li>
				<li><a href="#">Mem Cache</a></li>
				<li><a href="#">PHP Info</a></li>
				<li><a href="#">My Sesión</a></li>
				</ul>
			</li>
				<li class="divider-vertical"></li>
<li class="pull-right">
<span id="busy-indicator-div pull-right">
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
		$(this).fadeOut(1000);
	});
	$('#lnkLista').live('click', function(){
		$('#contentForm').hide();
		$('#contentList').fadeIn(500);
	});
	$('#lnkAgregar').live('click', function(){
		$('#contentList').hide();
		$('#contentForm').fadeIn(500);
	});
	$('.dropdown-toggle').dropdown();
</script>
