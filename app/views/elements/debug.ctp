<!-- ********** CAKE - IDD  DEBUG INFORMATION **************** -->
<div id="debug" class="row text-center centered ax-page-debug">
	<button type="button" class="btn btn-small" data-ng-click="isDebugCollapsed=!isDebugCollapsed">
		<i class="icon icon-search"></i>Debug
	</button>
	<div id="debugsql" class="span12 ax-page-debug-sql" collapse="isDebugCollapsed">
		<?php echo $this->element('sql_dump'); ?>
	</div>
</div>
