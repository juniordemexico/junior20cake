<?php echo $this->Element('history/toolbar', array('MyController'=>$this->name));?>
<?php echo $this->Element('Flash');?>

<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab">Resumen</a></li>
		<li><a href="#tabs-1" data-toggle="tab">HTTP Access</a></li>
		<li><a href="#tabs-2" data-toggle="tab">HTTP Error</a></li>
		<li><a href="#tabs-3" data-toggle="tab">PHP Error</a></li>
		<li><a href="#tabs-4" data-toggle="tab">CachePHP Error</a></li>
		<li><a href="#tabs-5" data-toggle="tab">CachePHP Debug</a></li>
		<li><a href="#tabs-7" data-toggle="tab">AxBOS Access</a></li>
		<li><a href="#tabs-6" data-toggle="tab">AxBOS Error</a></li>
	</ul>

<div class="tab-content" style="height: 480px; min-height: 480px;">

<div id="tabs-0" class="tab-pane active" style="overflow: auto;">
	RESUMEN
</div>

<div id="tabs-1" class="tab-pane" style="overflow: auto;">
	HTTPD_ACCESS
</div>

<div id="tabs-2" class="tab-pane" style="overflow: auto;">
	HTTPD_ERROR
</div>

<div id="tabs-3" class="tab-pane" style="overflow: auto;">
	PHP_ERROR
</div>

<div id="tabs-4" class="tab-pane" style="overflow: auto;">
	CAKEPHP_ERROR
</div>

<div id="tabs-5" class="tab-pane" style="overflow: auto;">
	CAKEPHP_DEBUG
</div>

<div id="tabs-6" class="tab-pane" style="overflow: auto;">
	AXBOS_ACCESS
</div>

<div id="tabs-7" class="tab-pane" style="overflow: auto;">
	AXBOS_ERROR
</div>

</div>
</div>
<script>

$(document).ready( function () {
	$('#tabs-1').load('/history/getlog/httpdaccess');
	$('#tabs-2').load('/history/getlog/httpderror');
	$('#tabs-3').load('/history/getlog/phperror');
	$('#tabs-4').load('/history/getlog/cakephperror');
	$('#tabs-5').load('/history/getlog/cakephpdebug');
});
</script>
<?php


?>

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
