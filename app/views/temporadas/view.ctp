<div class="temporadas view">

<dl>
	<dt class="altrow"><?php __("tecve"); ?></dt>
	<dd class="altrow"><?php echo $temporada['Temporada']['tecve']; ?>&nbsp;</dd>
	<dt><?php __("id"); ?></dt>
	<dd><?php echo $temporada['Temporada']['id']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("created"); ?></dt>
	<dd class="altrow"><?php echo $temporada['Temporada']['created']; ?>&nbsp;</dd>
	<dt><?php __("modified"); ?></dt>
	<dd><?php echo $temporada['Temporada']['modified']; ?>&nbsp;</dd>


</dl>
</div>
<div class="additional actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('edit_temporada', true), array('controller' => 'temporadas', 'action' => 'edit', $temporada['Temporada']['id'])); ?></li>
		<li>&nbsp;</li>
		<li><?php echo $this->Html->link(__('add_articulo', true), array('controller' => 'articulos', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_articulos', true), array('controller' => 'articulos', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_divisa', true), array('controller' => 'divisas', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_divisas', true), array('controller' => 'divisas', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_estado', true), array('controller' => 'estados', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_estados', true), array('controller' => 'estados', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_marca', true), array('controller' => 'marcas', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_marcas', true), array('controller' => 'marcas', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_paisa', true), array('controller' => 'paisas', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_paisas', true), array('controller' => 'paisas', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_temporada', true), array('controller' => 'temporadas', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_temporadas', true), array('controller' => 'temporadas', 'action' => 'index')); ?></li>
	</ul>
</div>
