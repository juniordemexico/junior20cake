<div class="clientes view">
<h2><?php __('cliente_detail_information'); ?></h2>

<dl>
	<dt class="altrow"><?php __("divisa_ditcambio"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Divisa']['ditcambio']; ?>&nbsp;</dd>
	<dt><?php __("clcvecli"); ?></dt>
	<dd><?php echo $cliente['Cliente']['clcvecli']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("vendedor_vt"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Vendedor']['vt']; ?>&nbsp;</dd>
	<dt><?php __("estado_esedo"); ?></dt>
	<dd><?php echo $cliente['Estado']['esedo']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("estado_esedo"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Estado']['esedo']; ?>&nbsp;</dd>
	<dt><?php __("divisa_dinom"); ?></dt>
	<dd><?php echo $cliente['Divisa']['dinom']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("paisa_papais"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Paisa']['papais']; ?>&nbsp;</dd>
	<dt><?php __("vendedor_vecveven"); ?></dt>
	<dd><?php echo $cliente['Vendedor']['vecveven']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("vendedor_vest"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Vendedor']['vest']; ?>&nbsp;</dd>
	<dt><?php __("vendedor_venom"); ?></dt>
	<dd><?php echo $cliente['Vendedor']['venom']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("divisa_dicve"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Divisa']['dicve']; ?>&nbsp;</dd>
	<dt><?php __("cltda"); ?></dt>
	<dd><?php echo $cliente['Cliente']['cltda']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("id"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Cliente']['id']; ?>&nbsp;</dd>
	<dt><?php __("created"); ?></dt>
	<dd><?php echo $cliente['Cliente']['created']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("clnom"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Cliente']['clnom']; ?>&nbsp;</dd>
	<dt><?php __("clrfc"); ?></dt>
	<dd><?php echo $cliente['Cliente']['clrfc']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("modified"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Cliente']['modified']; ?>&nbsp;</dd>
	<dt><?php __("clprecio"); ?></dt>
	<dd><?php echo $cliente['Cliente']['clprecio']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("clplazo"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Cliente']['clplazo']; ?>&nbsp;</dd>
	<dt><?php __("clsuc"); ?></dt>
	<dd><?php echo $cliente['Cliente']['clsuc']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("cldesc1"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Cliente']['cldesc1']; ?>&nbsp;</dd>
	<dt><?php __("cldesc2"); ?></dt>
	<dd><?php echo $cliente['Cliente']['cldesc2']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("cldesc3"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Cliente']['cldesc3']; ?>&nbsp;</dd>
	<dt><?php __("clbanco"); ?></dt>
	<dd><?php echo $cliente['Cliente']['clbanco']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("clcuenta"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Cliente']['clcuenta']; ?>&nbsp;</dd>
	<dt><?php __("clatn"); ?></dt>
	<dd><?php echo $cliente['Cliente']['clatn']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("cllocfor"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Cliente']['cllocfor']; ?>&nbsp;</dd>
	<dt><?php __("clst"); ?></dt>
	<dd><?php echo $cliente['Cliente']['clst']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("clt"); ?></dt>
	<dd class="altrow"><?php echo $cliente['Cliente']['clt']; ?>&nbsp;</dd>
	<dt><?php __("vendedor_vecomis"); ?></dt>
	<dd><?php echo $cliente['Vendedor']['vecomis']; ?>&nbsp;</dd>


</dl>
</div>
<div class="additional actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('edit_cliente', true), array('controller' => 'clientes', 'idd' => false, 'action' => 'edit', $cliente['Cliente']['id'])); ?></li>
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
