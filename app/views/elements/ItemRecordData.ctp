<?php if (isset($this->data[$MyModel]['id'])): ?>
<div class="control-group">
	<label class="control-label"><?php __('id'); ?></label>&nbsp;
	<input class="span2 uneditable-input" readonly="true" value="<?php echo $this->data[$MyModel]['id']; ?>" />
</div>
<?php endif; ?>

<?php if (isset($this->data[$MyModel]['created'])): ?>
<div class="control-group">
	<label class="control-label"><?php __('created'); ?></label>&nbsp;
	<input class="span2 uneditable-input" readonly="true" value="<?php echo $this->data[$MyModel]['created']; ?>" />
</div>
<?php endif; ?>

<?php if (isset($this->data[$MyModel]['modified'])): ?>
<div class="control-group">
	<label class="control-label"><?php __('modified'); ?></label>&nbsp;
	<input class="span2 uneditable-input" readonly="true" value="<?php echo $this->data[$MyModel]['modified']; ?>" />
</div>
<?php endif; ?>

<?php if (isset($this->data[$MyModel]['lastsync'])): ?>
<div class="control-group">
	<label class="control-label"><?php __('last_sync'); ?></label>&nbsp;
	<input class="span2 uneditable-input" readonly="true" value="<?php echo $this->data[$MyModel]['lastsync']; ?>" />
</div>
<?php endif; ?>

<?php
/*
<div class="label readonly">
	<label class="readonly"><?php __("id"); ?></label>
	<em><?php echo $this->data['Cliente']['id']; ?>&nbsp;</em>
</div>
<div class="label readonly">
	<label class="readonly"><?php __("created"); ?></label>
	<em><?php echo $this->data['Cliente']['created']; ?>&nbsp;</em>
</div>
<div class="label readonly">
	<label class="readonly"><?php __("modified"); ?></label>
	<em><?php echo $this->data['Cliente']['modified']; ?>&nbsp;</em>
</div>

*/

?>

