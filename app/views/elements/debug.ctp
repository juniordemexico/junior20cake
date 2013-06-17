<!-- ********** CAKE - IDD  DEBUG INFORMATION **************** -->
			<div id="debug" class="row text-center centered ax-debug">
			<div class="span1 text-left">
	<ul class="unstyled">
		<li>
			<button type="button" class="btn btn-small" data-ng-click="app.state.isDebugCollapsed=!app.state.isDebugCollapsed">
			<i class="icon icon-search"></i>dbg
			</button>
		</li>
		<li>
			<button type="button" class="btn btn-small" data-ng-click="saveDetailsToCache()" title="Guarda Detalle en Cache Local" alt="putCache"><i class="icon icon-plus-sign"></i> put</button>
			<button type="button" class="btn btn-small" data-ng-click="loadDetailsFromCache()" title="Carga Detalle desde Cache Local" alt="getCache"><i class="icon icon-minus-sign "></i> get</button>
		</li>
	</ul>
			</div>
			<div class="span11" class="well well-small" collapse="app.state.isDebugCollapsed">
				<pre id="preCakeDebug" style="font-size: 10px; margin:0px; padding:0px;">
				<?php echo $this->element('sql_dump'); ?>
				</pre>
			</div>
			</div>
