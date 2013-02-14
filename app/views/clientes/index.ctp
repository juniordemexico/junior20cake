<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Cliente',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class="cvecli"><?php echo $form->text('clcvecli', array('type' => 'search', 'maxLength' => '16', 'placeholder' => 'Clave', 'class' => 'search-query'));?></th>
				<th class="tda"><?php echo $form->text('cltda',array('type' => 'search', 'maxLength' => '4', 'placeholder' => 'Tda', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('clnom',array('type' => 'search', 'maxLength' => '64', 'placeholder' => 'Nombre o Razón Social', 'class' => 'search-query'));?></th>
				<th class="suc"><?php echo $form->text('clsuc',array('type' => 'search', 'maxLength' => '16', 'placeholder' => 'Sucursal', 'class' => 'search-query'));?></th>
				<th class="esedo"><?php echo $form->text('Estado.esedo',array('type' => 'search', 'placeholder' => 'Estado', 'maxLength' => '32', 'class' => 'search-query'));?></th>
				<th class="cveven"><?php echo $form->text('Vendedor.vecveven',array('type' => 'search', 'maxLength' => '4', 'placeholder' => 'Vendedor', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('clst',array('type' => 'search', 'maxLength' => '1', 'placeholder' => 'st', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php echo $this->Js->submit('Filtrar', array('update' => '#content', 'class'=>'btn btn-mini', 'escape'=>false)); ?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="cvecli"><?php echo $this->Paginator->sort('Clave','clcvecli'); ?></th>
				<th class="tda"><?php echo $this->Paginator->sort('Tda','cltda'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Razon Social','clnom'); ?></th>
				<th class="suc"><?php echo $this->Paginator->sort('Sucursal','clsuc'); ?></th>
				<th class="esedo"><?php echo $this->Paginator->sort('Estado', 'Estado.esedo'); ?></th>
				<th class="cveven"><?php echo $this->Paginator->sort('Vend','Vendedor.vecveven'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','clst'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($clientes as $cliente):
			$class = null;
			$thisID=trim($cliente['Cliente']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class="cvecli"><?php echo $cliente['Cliente']['clcvecli']; ?></td>
				<td class="tda"><?php echo $cliente['Cliente']['cltda']; ?></td>
				<td class=""><?php echo $cliente['Cliente']['clnom']; ?></td>
				<td class="suc"><?php echo $cliente['Cliente']['clsuc']; ?></td>
				<td class="esedo"><?php echo $cliente['Estado']['esedo']; ?></td>
				<td class="cveven"><?php echo $cliente['Vendedor']['vecveven']; ?></td>
				<td class="st"><?php echo $cliente['Cliente']['clst']; ?></td>
				<td class="id"><?php echo $cliente['Cliente']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Cliente','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>