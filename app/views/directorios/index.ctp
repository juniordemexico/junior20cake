<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Directorio',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>

	<table id="datagrid" class="table table-bordered table-striped table-condensed">
		<thead>
			<tr class="row-filter">
				<th class="span1"><?php echo $form->text('cve', array('type' => 'search', 'maxLength' => '16', 'placeholder' => 'Clave', 'class' => 'search-query'));?></th>
				<th class="span1"><?php echo $form->text('tda',array('type' => 'search', 'maxLength' => '4', 'placeholder' => 'Tda', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('nom',array('type' => 'search', 'maxLength' => '64', 'placeholder' => 'Nombre o Razón Social', 'class' => 'search-query'));?></th>
				<th class="span2"><?php echo $form->text('suc',array('type' => 'search', 'placeholder' => 'Sucursal', 'class' => 'search-query'));?></th>
				<th class="span1"><?php echo $form->text('vendedor.vecveven',array('type' => 'search', 'placeholder' => 'Vend', 'class' => 'search-query'));?></th>
				<th class="span2"><?php echo $form->text('Estado.esedo',array('type' => 'search', 'placeholder' => 'Estado', 'class' => 'search-query'));?></th>
				<th class="tel"><?php echo $form->text('tel',array('type' => 'search', 'placeholder' => 'Telefono', 'class' => 'search-query'));?></th>
				<th class="span1"><?php echo $form->text('tipopersona_cve',array('type' => 'search', 'placeholder' => 'Tipo', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="span1"><?php echo $this->Paginator->sort('Clave','cve'); ?></th>
				<th class="span1"><?php echo $this->Paginator->sort('Tda','tda'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Razon Social','nom'); ?></th>
				<th class="span2"><?php echo $this->Paginator->sort('Sucursal','suc'); ?></th>
				<th class="span1"><?php echo $this->Paginator->sort('Vend','Vendedor.vecveven'); ?></th>
				<th class="span2"><?php echo $this->Paginator->sort('Estado', 'Estado.esedo'); ?></th>
				<th class="tel"><?php echo $this->Paginator->sort('Telefonos','tel'); ?></th>
				<th class="span1"><?php echo $this->Paginator->sort('Tipo','tipopersona_cve'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($directorios as $directorio):
			$class = null;
			$thisID=trim($directorio['Directorio']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class="span1"><?php echo $directorio['Directorio']['cve']; ?></td>
				<td class="span1"><?php echo $directorio['Directorio']['tda']; ?></td>
				<td class=""><?php echo $directorio['Directorio']['nom']; ?></td>
				<td class="span2"><?php echo $directorio['Directorio']['suc']; ?></td>
				<td class="span1"><?php echo $directorio['Vendedor']['vecveven']; ?></td>
				<td class="span2"><?php echo $directorio['Estado']['esedo']; ?></td>
				<td class="tel"><?php echo $directorio['Directorio']['tel']; ?></td>
				<td class="span1"><?php echo $directorio['Directorio']['tipopersona_cve']; ?></td>
				<td class="st"><?php echo $directorio['Directorio']['st']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Directorio','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'ick',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>