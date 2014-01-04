<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Ifisico', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class="cveart"><?php echo $form->text('Articulo.arcveart', array('label' => false, 'type' => 'search', 'maxLength' => '32', 'placeholder'=>'Clave', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('Color.cve',array('label' => false, 'type' => 'search', 'maxLength' => '32', 'placeholder'=>'Color', 'class' => 'search-query'));?></th>
				<th class="cveart"><?php echo $form->text('Articulo.arlinea', array('label' => false, 'type' => 'search', 'maxLength' => '32', 'placeholder'=>'Clave', 'class' => 'search-query'));?></th>
				<th class="cant"><?php echo $form->text('existencia',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'Exist', 'class' => 'search-query'));?></th>
				<th class="cant"><?php echo $form->text('cant_1',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'Cont 1', 'class' => 'search-query'));?></th>
				<th class="cant"><?php echo $form->text('cant_2',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'Cont 2', 'class' => 'search-query'));?></th>
				<th class="cant"><?php echo $form->text('t0_1',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'T0', 'class' => 'search-query'));?></th>
				<th class="cant"><?php echo $form->text('t0_1',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'T0', 'class' => 'search-query'));?></th>
				<th class="cant"><?php echo $form->text('t0_1',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'T0', 'class' => 'search-query'));?></th>
				<th class="cant"><?php echo $form->text('t0_1',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'T0', 'class' => 'search-query'));?></th>
				<th class="cant"><?php echo $form->text('t0_1',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'T0', 'class' => 'search-query'));?></th>
				<th class="cant"><?php echo $form->text('t0_1',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'T0', 'class' => 'search-query'));?></th>
				<th class="cant"><?php echo $form->text('t0_1',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'T0', 'class' => 'search-query'));?></th>
				<th class="cant"><?php echo $form->text('t0_1',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'T0', 'class' => 'search-query'));?></th>
				<th class="cant"><?php echo $form->text('t0_1',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'T0', 'class' => 'search-query'));?></th>
				<th class="cant"><?php echo $form->text('t0_1',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'T0', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('arst',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'ST', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php echo $this->Js->submit('Filtrar', array('update' => '#content', 'class'=>'btn btn-mini', 'escape'=>false)); ?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class=""><?php echo $this->Paginator->sort('Clave','Articulo.arcveart'); ?></th>
				<th class="cveart"><?php echo $this->Paginator->sort('Color','Color.cve'); ?></th>
				<th class="cveart"><?php echo $this->Paginator->sort('Linea','Articulo.arlinea'); ?></th>
				<th class="cant"><?php echo $this->Paginator->sort('Exist','Ifisico.existencia'); ?></th>
				<th class="cant"><?php echo $this->Paginator->sort('Cont 1','Ifisico.cant_1'); ?></th>
				<th class="cant"><?php echo $this->Paginator->sort('Cont 2','Ifisico.cant_2'); ?></th>
				<th class="cant"><?php echo $this->Paginator->sort('T0','Ifisico.t0_1'); ?></th>
				<th class="cant"><?php echo $this->Paginator->sort('T1','Ifisico.t1_1'); ?></th>
				<th class="cant"><?php echo $this->Paginator->sort('T2','Ifisico.t2_1'); ?></th>
				<th class="cant"><?php echo $this->Paginator->sort('T3','Ifisico.t3_1'); ?></th>
				<th class="cant"><?php echo $this->Paginator->sort('T4','Ifisico.t4_1'); ?></th>
				<th class="cant"><?php echo $this->Paginator->sort('T5','Ifisico.t5_1'); ?></th>
				<th class="cant"><?php echo $this->Paginator->sort('T6','Ifisico.t6_1'); ?></th>
				<th class="cant"><?php echo $this->Paginator->sort('T7','Ifisico.t7_1'); ?></th>
				<th class="cant"><?php echo $this->Paginator->sort('T8','Ifisico.t8_1'); ?></th>
				<th class="cant"><?php echo $this->Paginator->sort('T9','Ifisico.t9_1'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','Articulo.arst'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','Ifisico.id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($items as $item): ?>
			<tr id="<?php echo $item['Ifisico']['id'];?>" class="t-row">
				<td class="<?php if($item['Ifisico']['cant_2']==$item['Ifisico']['existencia'] && $item['Ifisico']['existencia']<>0) echo "text-info";?><?php if($item['Ifisico']['cant_2']<>$item['Ifisico']['existencia'] && $item['Ifisico']['existencia']<>0 && $item['Ifisico']['modified_user_id']>0) echo "text-error";?>" title="<?php echo $item['Articulo']['ardescrip']; ?> [articulo_id: <?php echo $item['Ifisico']['articulo_id']; ?>]"><strong><?php echo $item['Articulo']['arcveart']; ?></strong></td>
				<td class="cveart" title="<?php echo $item['Color']['cve']; ?> [color_id: <?php echo $item['Color']['id']; ?>]"><?php echo $item['Color']['cve'];?></td>
				<td class="cveart"><?php echo $item['Articulo']['arlinea'];?></td>
				<td class="cant"><strong><?php echo $item['Ifisico']['existencia']; ?></strong></td>
				<td class="cant <?php if($item['Ifisico']['cant_1']<>$item['Ifisico']['existencia']) echo "text-error";?>"><strong><?php echo $item['Ifisico']['cant_1']; ?></strong></td>
				<td class="cant <?php if($item['Ifisico']['cant_2']<>$item['Ifisico']['existencia'] && $item['Ifisico']['modified_user_id']>0 ) echo "text-error";?>"><strong><?php echo $item['Ifisico']['cant_2']; ?></strong></td>
				<td class="cant"><?php echo $item['Ifisico']['t0_1']; ?></td>
				<td class="cant"><?php echo $item['Ifisico']['t1_1']; ?></td>
				<td class="cant"><?php echo $item['Ifisico']['t2_1']; ?></td>
				<td class="cant"><?php echo $item['Ifisico']['t3_1']; ?></td>
				<td class="cant"><?php echo $item['Ifisico']['t4_1']; ?></td>
				<td class="cant"><?php echo $item['Ifisico']['t5_1']; ?></td>
				<td class="cant"><?php echo $item['Ifisico']['t6_1']; ?></td>
				<td class="cant"><?php echo $item['Ifisico']['t7_1']; ?></td>
				<td class="cant"><?php echo $item['Ifisico']['t8_1']; ?></td>
				<td class="cant"><?php echo $item['Ifisico']['t9_1']; ?></td>
				<td class="st"><?php echo $item['Articulo']['arst']; ?></td>
				<td class="id" title="Modificado: <?php echo $item['Ifisico']['modified']; ?> [modified_user_id: <?php echo $item['Ifisico']['modified_user_id']; ?>]"><?php echo $item['Ifisico']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Ifisico','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".
$this->Html->url(array('action'=>(isset($clickAction)?$clickAction:'edit'))).
"/'+this.id);"
, array('stop' => true));
?>

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
