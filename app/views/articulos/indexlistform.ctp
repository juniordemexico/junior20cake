<?php if(isset($renderForm)): ?>
<?php echo $this->Element('ToolBar', array('MyController'=>'Articulos', 'MyModel' => 'Articulo'));?>
<?php endif;?>
<?php
$this->Paginator->options(array('update' => '#contentList',
								'evalScripts' => true,
								));
?>
<div id="contentList" class="articulo index">
<?php echo $this->Element('Flash');?>

<div id="gridWrapper">
<?php 
echo $form->create('Articulo',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed" cellspacing="0">
		<thead>
			<tr id="trFilter">
				<th class="articulo cveart"><?php echo $form->text('arcveart', array('label' => '', 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Clave', 'class' => 'cveart'));?></th>
				<th class="articulo descrip"><?php echo $form->text('ardescrip',array('label' => '', 'type' => 'search', 'maxLength' => '64', 'placeholder'=>'Descripción', 'class' => 'descrip'));?></th>
				<th class="articulo licve"><?php echo $form->text('Linea.licve',array('label' => '', 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Linea', 'class' => 'licve'));?></th>
				<th class="articulo macve"><?php echo $form->text('Marca.macve',array('label' => '', 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Marca', 'class' => 'macve'));?></th>
				<th class="articulo tecve"><?php echo $form->text('Temporada.tecve',array('label' => '', 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Temporada', 'class' => 'tecve'));?></th>
				<th class="articulo artipo"><?php echo $form->text('artipo',array('label' => '', 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'Tipo', 'class' => 'tipo'));?></th>
				<th class="articulo st"><?php echo $form->text('arst',array('label' => '', 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'ST', 'class' => 'st'));?></th>
				<th class="articulo id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#contentList'));
				?>
				</th>	
			</tr>
			<tr id="trLabels">
				<th class="articulo cveart"><?php echo $this->Paginator->sort('Clave','arcveart'); ?></th>
				<th class="articulo descrip"><?php echo $this->Paginator->sort('Descripción','ardescrip'); ?></th>
				<th class="articulo licve"><?php echo $this->Paginator->sort('Linea','Linea.licve'); ?></th>
				<th class="articulo macve"><?php echo $this->Paginator->sort('Marca','Marca.macve'); ?></th>
				<th class="articulo tecve"><?php echo $this->Paginator->sort('Temporada','Temporada.tecve'); ?></th>
				<th class="articulo artipo"><?php echo $this->Paginator->sort('Tipo','artipo'); ?></th>
				<th class="articulo st"><?php echo $this->Paginator->sort('ST','arst'); ?></th>
				<th class="articulo id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($articulos as $articulo):
			$class = null;
			$thisID=trim($articulo['Articulo']['id']);
			$class = ($i++ % 2 == 0) ?
					' class="renglon altrow"' :
					' class="renglon"';
		?>
			<tr id="<?php echo $thisID?>" <?php echo $class;?>>
				<td class="articulo cveart"><?php echo $articulo['Articulo']['arcveart']; ?></td>
				<td class="articulo descrip"><?php echo $articulo['Articulo']['ardescrip'];?></td>
				<td class="articulo licve"><?php echo $articulo['Linea']['licve']; ?></td>
				<td class="articulo macve"><?php echo $articulo['Marca']['macve']; ?></td>
				<td class="articulo tecve"><?php echo $articulo['Temporada']['tecve']; ?></td>
				<td class="articulo artipo"><?php echo $articulo['Articulo']['artipo']; ?></td>
				<td class="articulo st"><?php echo $articulo['Articulo']['arst']; ?></td>
				<td class="articulo id"><?php echo $articulo['Articulo']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div>

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Articulo','MyRowClickAction' => 'edit')); ?>

<?php echo $this->Element('ListScriptEvents',array('MyController'=>$this->name,'MyModel'=>'Articulo','MyRowClickAction' => 'edit')); ?>

</div>
<?php if(isset($renderForm)): ?>
<div id="contentForm" class="articulos edit form">
<?php echo $session->flash();?>
<?php echo $this->element('articulos/form', array('mode' => 'edit')); ?>
</div>
<?php endif;?>


