<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div id="gridWrapper">
<?php 
echo $form->create('Factura',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>

	<table id="datagrid"  class="table table-bordered table-striped table-condensed" cellspacing="0">
		<thead>
			<tr id="trFilter">
				<th class="refer"><?php echo $form->text('farefer', array('label' => '', 'type' => 'search', 'maxlength' => '8', 'placeholder' => 'Folio', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('fafecha',array('label' => '', 'type' => 'search', 'maxlength' => '10', 'placeholder' => 'Fecha', 'class' => 'search-query'));?></th>
				<th class="cvecli"><?php echo $form->text('Cliente.clcvecli',array('label' => '', 'type' => 'search', 'maxlength' => '8', 'placeholder' => 'Cliente', 'class' => 'search-query'));?></th>
				<th class="tda"><?php echo $form->text('Cliente.cltda',array('label' => '', 'type' => 'search', 'maxlength' => '4', 'placeholder' => 'Tda', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('Cliente.clnom',array('label' => '', 'type' => 'search', 'maxlength' => '64', 'placeholder' => 'Nombre o Razón Social', 'class' => 'search-query'));?></th>
				<th class="cveven"><?php echo $form->text('Vendedor.vecveven',array('label' => '', 'type' => 'search', 'maxlength' => '4', 'placeholder' => 'Vend', 'class' => 'search-query'));?></th>
				<th class="total"><?php echo $form->text('fatotal', array('label' => '', 'type' => 'search', 'maxlength' => '14', 'placeholder' => 'Total', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('fast',array('label' => '', 'type' => 'search', 'maxLength' => '1', 'placeholder' => 'ST', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr>
				<th class="refer"><?php echo $this->Paginator->sort('Folio','farefer'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Fecha','fafecha'); ?></th>
				<th class="cvecli"><?php echo $this->Paginator->sort('Cte','Cliente.clcvecli'); ?></th>
				<th class="tda"><?php echo $this->Paginator->sort('Tda','Cliente.cltda'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Razón Social','Cliente.clnom'); ?></th>
				<th class="cveven"><?php echo $this->Paginator->sort('Vend','Vendedor.vecveven'); ?></th>
				<th class="total"><?php echo $this->Paginator->sort('Total','fatotal'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','fast'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($facturas as $factura):
			$class = null;
			$thisID=trim($factura['Factura']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class="refer" title="<?php echo 'Pedido: '.$factura['Factura']['fapedido']; ?>"><?php echo $factura['Factura']['farefer']; ?></td>
				<td class="date"><?php echo substr($factura['Factura']['fafecha'],0,10); ?></td>
				<td class="cvecli"><?php echo $factura['Cliente']['clcvecli']; ?></td>
				<td class="tda" title="<?php echo trim($factura['Cliente']['clsuc']); ?>"><?php echo $factura['Cliente']['cltda']; ?></td>
				<td class=""><?php echo $factura['Cliente']['clnom']; ?></td>
				<td class="cveven" title="<?php echo $factura['Vendedor']['venom']; ?>"><?php echo $factura['Vendedor']['vecveven']; ?></td>
				<td class="total"><?php echo $this->Number->currency($factura['Factura']['factura__fatotal']); ?></td>
				<td class="st"><?php echo $factura['Factura']['fast']; ?></td>
				<td class="id" title="<?php echo 'Creado: '.$factura['Factura']['crefec'].'. Modificado: '.$factura['Factura']['modfec'].'.'; ?>"><?php echo $factura['Factura']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div>
</div>

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Factura','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>