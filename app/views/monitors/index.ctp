<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab">General</a></li>
		<li><a href="#tabs-1" data-toggle="tab">Sessions</a></li>
		<li><a href="#tabs-2" data-toggle="tab">Database</a></li>
		<li><a href="#tabs-3" data-toggle="tab">APC Cache</a></li>
		<li><a href="#tabs-4" data-toggle="tab">Mem Cache</a></li>
		<li><a href="#tabs-5" data-toggle="tab">PHP Info</a></li>
		<li><a href="#tabs-6" data-toggle="tab">My Session</a></li>
	</ul>

<div class="tab-content">

<div id="tabs-0" class="tab-pane active">
GENERALES <?php echo $this-Session?>
</div>

<div id="tabs-1" class="tab-pane">a
	<iframe id="frame-tabs-1" class="monitor-frame" src="/monitors/monitordbactive">
	</iframe>
</div>

<div id="tabs-2" class="tab-pane">
	<iframe id="frame-tabs-2" class="monitor-frame" src="/monitors/runningdbquerys">
	</iframe>
</div>

<div id="tabs-3" class="tab-pane">
	<iframe id="frame-tabs-3" class="monitor-frame" src="/apc.php">
	</iframe>
</div>

<div id="tabs-4" class="tab-pane">
	<iframe id="frame-tabs-4" class="monitor-frame" src="/memcache.php">
	</iframe>

</div>

<div id="tabs-5" class="tab-pane">
	<iframe id="frame-tabs-2" class="monitor-frame" src="/monitors/abracadabra">
	</iframe>
</div>

<div id="tabs-6" class="tab-pane">
	<iframe id="frame-tabs-2" class="monitor-frame" src="/monitors/abracadabra">
<code>
	<?php print_r($this->Session)?>
</code>
	</iframe>

</div>

</div>
</div>
