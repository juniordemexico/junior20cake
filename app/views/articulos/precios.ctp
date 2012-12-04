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
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class="cveart"><?php echo $form->text('arcveart', array('id'=>'cveart', 'label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Clave', 'class' => 'search-query cveart'));?></th>
				<th class=""><?php echo $form->text('ardescrip',array('id'=>'descrip','label' => false, 'type' => 'search', 'maxLength' => '64', 'placeholder'=>'Descripción', 'class' => 'search-query'));?></th>
				<th class="licve"><?php echo $form->text('Linea.licve',array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Linea', 'class' => 'search-query licve'));?></th>
				<th class="macve"><?php echo $form->text('Marca.macve',array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Marca', 'class' => 'search-query macve'));?></th>
				<th class="precio"><?php echo $form->text('arpva',array('label' => false, 'type' => 'search', 'maxLength' => '12', 'placeholder'=>'PVA', 'class' => 'search-query precio'));?></th>
				<th class="precio"><?php echo $form->text('arpvb',array('label' => false, 'type' => 'search', 'maxLength' => '12', 'placeholder'=>'PVB', 'class' => 'search-query precio'));?></th>
				<th class="precio">&nbsp;</th>
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
				<th class="precio"><?php echo $this->Paginator->sort('Precio A','arpva'); ?></th>
				<th class="precio"><?php echo $this->Paginator->sort('Precio B','arpvb'); ?></th>
				<th class="precio"><?php echo $this->Paginator->sort('Exist','existencia'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($articulos as $articulo):
			$class = null;
			$thisID=trim($articulo['Articulo']['id']);
		?>
			<tr id="<?php echo $thisID?>" cve="<?php echo $articulo['Articulo']['arcveart']; ?>" class="t-row">
				<td class="cveart"><?php echo $articulo['Articulo']['arcveart']; ?></td>
				<td class=""><?php echo $articulo['Articulo']['ardescrip'];?></td>
				<td class="licve"><?php echo $articulo['Linea']['licve']; ?></td>
				<td class="macve"><?php echo $articulo['Marca']['macve']; ?></td>
				<td class="precio"><?php echo $this->Number->currency($articulo['Articulo']['arpva']); ?></td>
				<td class="precio"><?php echo $this->Number->currency($articulo['Articulo']['arpvb']); ?></td>
				<td class="precio"><?php echo $this->Number->precision($articulo[0]['existencia'],0); ?>
							<a href="/Articulos/tallacolor/<?php echo$articulo['Articulo']['id']; ?>/control:articulos/action:tallacolorexistenciadata" 
							class="btnModalTallaColor"
							data-toggle="modal" 
							data-target="#dialogArticuloExistencia" 
							data-item-id="<?php echo $articulo['Articulo']['id']; ?>"
							data-item-title="<?php echo $articulo['Articulo']['arcveart']; ?> :: <?php echo $articulo['Articulo']['ardescrip']; ?>"
							>
							<i class="icon icon-eye-open pull-right"></i>
							</a>
				</td>
				<td class="id"><?php echo $articulo['Articulo']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Articulo')); ?>

<div id="dialogArticuloExistencia"  class="modal hide fade tallacolorModal">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="#dialogArticuloExistenciaTitle">Detalle de Tallas y Colores</h3>
  </div>
  <div class="modal-body">
  </div>
</div>

</div> <!-- index-form -->

<script>

// Load the dynamic content before the Modal is Displayed
$('#datagrid').on('click touchstart', '.btnModalTallaColor', function(event) {
	var el=this;
	var theUrl=el.href;
	$('#dialogArticuloExistencia').find('h3').html($(el).data('itemTitle'));
	$('#dialogArticuloExistencia').find('.modal-body').load(theUrl);
	event.preventDefault();
});

</script>
