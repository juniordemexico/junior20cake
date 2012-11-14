<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Articulo', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed">
		<thead>
			<tr class="row-filter">
				<th class="cveart"><?php echo $form->text('arcveart', array('id'=>'cveart', 'label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Clave', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('ardescrip',array('id'=>'descrip','label' => false, 'type' => 'search', 'maxLength' => '64', 'placeholder'=>'Descripción', 'class' => 'search-query'));?></th>
				<th class="licve"><?php echo $form->text('Linea.licve',array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Linea', 'class' => 'search-query'));?></th>
				<th class="macve"><?php echo $form->text('Marca.macve',array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Marca', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('arst',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'ST', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="cveart"><?php echo $this->Paginator->sort('Clave','arcveart'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Descripción','ardescrip'); ?></th>
				<th class="licve"><?php echo $this->Paginator->sort('Linea','Linea.licve'); ?></th>
				<th class="macve"><?php echo $this->Paginator->sort('Marca','Marca.macve'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','arst'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($articulos as $articulo): ?>
			<tr id="<?php echo $articulo['Articulo']['id'];?>" class="t-row">
				<td class="cveart"><?php echo $articulo['Articulo']['arcveart']; ?></td>
				<td class=""><?php echo $articulo['Articulo']['ardescrip'];?></td>
				<td class="licve"><?php echo $articulo['Linea']['licve']; ?></td>
				<td class="macve"><?php echo $articulo['Marca']['macve']; ?></td>
				<td class="st"><?php echo $articulo['Articulo']['arst']; ?></td>
				<td class="id"><?php echo $articulo['Articulo']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Articulo','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".
$this->Html->url(array('action'=>(isset($clickAction)?$clickAction:'edit'))).
"/'+this.id);"
, array('stop' => true));
?>

