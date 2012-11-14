<?php echo $this->element('nocache/sub2'); ?>

<cake<cake:nocache>
	<?php $foobar = 'in sub1'; ?>
	<?php echo $foobar; ?>
</cake<cake:nocache>

<?php echo 'printing: "' . $foobar . '"'; ?>