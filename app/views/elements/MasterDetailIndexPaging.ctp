
<div class="row-fluid">
<div class="span12" id="pagination-container">
<div class="pagination centered">
<?php if( $paginator->hasNext() || $paginator->current()>1 ) :?>
	<ul class="pagination">
	<?php echo $paginator->first('<i class="icon icon-fast-backward icon-white"></i> '.__('first',true), array('tag'=>'li', 'separator'=>'', 'class'=>'first', 'escape'=>false), null, array('tag'=>'li', 'class'=>'first disabled'));?>
		<?php if($paginator->current()==1):?>
			<li class="first disabled"><a href="#"><?php echo '<i class="icon icon-fast-backward icon-white"></i> '.__('first',true); ?></a></li>
			<li class="previous disabled"><a href="#"><?php echo '<i class="icon icon-step-backward icon-white"></i> '; ?></a></li>
		<?php else:?>
		<?php echo $paginator->prev(' <i class="icon icon-step-backward icon-white"></i> ', array('tag'=>'li', 'class'=>'first', 'escape'=>false),null, array('tag'=>'li', 'class'=>'previous disabled', 'separator'=>'', 'escape'=>false));?>
		<?php endif;?>
		<?php echo $paginator->numbers(array('tag'=>'li', 'separator'=>'', 'class'=>'paginate'),true,array('tag'=>'li', 'separator'=>'xx', 'class'=>'disabled')); ?>
		<?php if($paginator->current()==$paginator->last() || !$paginator->hasNext()):?>
			<li class="next disabled"><a href="#"><?php echo ' <i class="icon icon-step-forward icon-white"></i> '; ?></a></li>
			<li class="last disabled"><a href="#"><?php echo __('last',true).' <i class="icon icon-fast-forward icon-white"></i>'; ?></a></li>
		<?php else:?>
		<?php echo $paginator->next(' <i class="icon icon-step-forward icon-white"></i> ', array('tag'=>'li', 'separator'=>'', 'class'=>'next', 'escape'=>false), null, array('tag'=>'li', 'class'=>'next disabled', 'separator'=>'', 'escape'=>false)) ;?>
		<?php echo $paginator->last(__('last',true).' <i class="icon icon-fast-forward icon-white"></i>', array('tag'=>'li','separator'=>'', 'class'=>'last', 'escape'=>false), null,array('tag'=>'li','class'=>'last disabled', 'separator'=>'', 'escape'=>false));?>
		<?php endif;?>
	</ul>
	<?php endif;?>
<div>
<?php
	echo '<label class="label">'.$paginator->counter(array(
		'format' => __('Página %page% de %pages% ( %count% registros )', true),
		'tag'=>false,'label'=>false
	)).'</label>';
?>
</div>
</div> <!-- pagination -->

</div> <!-- span12 -->
</div> <!-- row-fluid -->

