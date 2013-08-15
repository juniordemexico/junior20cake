<div class="proveedors view">
<h2><?php __('proveedor_detail_information'); ?></h2>

<dl>
	<dt class="altrow"><?php __("prcvepro"); ?></dt>
	<dd class="altrow"><?php echo $proveedor['Transporte']['prcvepro']; ?>&nbsp;</dd>
	<dt><?php __("id"); ?></dt>
	<dd><?php echo $proveedor['Transporte']['id']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("prnom"); ?></dt>
	<dd class="altrow"><?php echo $proveedor['Transporte']['prnom']; ?>&nbsp;</dd>
	<dt><?php __("created"); ?></dt>
	<dd><?php echo $proveedor['Transporte']['created']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("prst"); ?></dt>
	<dd class="altrow"><?php echo $proveedor['Transporte']['prst']; ?>&nbsp;</dd>
	<dt><?php __("modified"); ?></dt>
	<dd><?php echo $proveedor['Transporte']['modified']; ?>&nbsp;</dd>


</dl>
</div>
<div class="additional actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('edit_proveedor', true), array('controller' => 'proveedors', 'idd' => false, 'action' => 'edit', $proveedor['Transporte']['id'])); ?></li>
		<li>&nbsp;</li>
		<li><?php echo $this->Html->link(__('add_artexist', true), array('controller' => 'artexists', 'idd' => false, 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_artexists', true), array('controller' => 'artexists', 'idd' => false, 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_articulo', true), array('controller' => 'articulos', 'idd' => false, 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_articulos', true), array('controller' => 'articulos', 'idd' => false, 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_cliente', true), array('controller' => 'clientes', 'idd' => false, 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_clientes', true), array('controller' => 'clientes', 'idd' => false, 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_color', true), array('controller' => 'colors', 'idd' => false, 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_colors', true), array('controller' => 'colors', 'idd' => false, 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_divisa', true), array('controller' => 'divisas', 'idd' => false, 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_divisas', true), array('controller' => 'divisas', 'idd' => false, 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_estado', true), array('controller' => 'estados', 'idd' => false, 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_estados', true), array('controller' => 'estados', 'idd' => false, 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_linea', true), array('controller' => 'lineas', 'idd' => false, 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_lineas', true), array('controller' => 'lineas', 'idd' => false, 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_marca', true), array('controller' => 'marcas', 'idd' => false, 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_marcas', true), array('controller' => 'marcas', 'idd' => false, 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_paisa', true), array('controller' => 'paisas', 'idd' => false, 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_paisas', true), array('controller' => 'paisas', 'idd' => false, 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_proveedor', true), array('controller' => 'proveedors', 'idd' => false, 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_proveedors', true), array('controller' => 'proveedors', 'idd' => false, 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_talla', true), array('controller' => 'tallas', 'idd' => false, 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_tallas', true), array('controller' => 'tallas', 'idd' => false, 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_temporada', true), array('controller' => 'temporadas', 'idd' => false, 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_temporadas', true), array('controller' => 'temporadas', 'idd' => false, 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_unidad', true), array('controller' => 'unidads', 'idd' => false, 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_unidads', true), array('controller' => 'unidads', 'idd' => false, 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('add_vendedor', true), array('controller' => 'vendedors', 'idd' => false, 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list_of_vendedors', true), array('controller' => 'vendedors', 'idd' => false, 'action' => 'index')); ?></li>
	</ul>
</div>
