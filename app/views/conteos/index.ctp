<div class="span12 existencias-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Conteos', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class="cveart"><?php echo $form->text('Articulo.arcveart', array('id'=>'cveart', 'label' => false, 'type' => 'search', 'maxLength' => '24', 'placeholder'=>'Clave', 'class' => 'search-query cveart'));?></th>
				<th class="cveart"><?php //echo $form->text('Color.cve', array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Color', 'class' => 'search-query cveart'));?></th>
				<th class="licve"><?php echo $form->text('Linea.licve',array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Linea', 'class' => 'search-query licve'));?></th>
				<th class="macve"><?php echo $form->text('Marca.macve',array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Marca', 'class' => 'search-query macve'));?></th>
				<th class="precio"><?php echo $form->text('Invfisicodenormal.conteo_1',array('label' => false, 'type' => 'search', 'maxLength' => '12', 'placeholder'=>'Cant 1', 'class' => 'search-query precio'));?></th>
				<th class="precio"><?php echo $form->text('Invfisicodenormal.conteo_2',array('label' => false, 'type' => 'search', 'maxLength' => '12', 'placeholder'=>'Cant 2', 'class' => 'search-query precio'));?></th>
				<th class="precio"><?php //echo $form->text('Invfisicodenormal.conteo_1',array('label' => false, 'type' => 'search', 'maxLength' => '12', 'placeholder'=>'Cant 1', 'class' => 'search-query precio'));?></th>
				<th class="precio"><?php //echo $form->text('Invfisicodenormal.conteo_2',array('label' => false, 'type' => 'search', 'maxLength' => '12', 'placeholder'=>'Cant 2', 'class' => 'search-query precio'));?></th>
				<th class="precio"><?php //echo $form->text('Invfisicodenormal.conteo_2',array('label' => false, 'type' => 'search', 'maxLength' => '12', 'placeholder'=>'Cant 2', 'class' => 'search-query precio'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>
			</tr>
			<tr class="row-labels">
				<th class="cveart"><?php echo $this->Paginator->sort('Clave','Articulo.arcveart'); ?></th>
				<th class="cveart"><?php echo $this->Paginator->sort('Color','Color.cve'); ?></th>
				<th class="licve"><?php echo $this->Paginator->sort('Linea','Linea.licve'); ?></th>
				<th class="macve"><?php echo $this->Paginator->sort('Marca','Marca.macve'); ?></th>
				<th class="precio"><?php echo $this->Paginator->sort('Conteo 1','Invfisicodenormal.conteo_1'); ?></th>
				<th class="precio"><?php echo $this->Paginator->sort('Conteo 2','Invfisicodenormal.conteo_2'); ?></th>
				<th class="precio"><?php echo $this->Paginator->sort('Exist','existencia'); ?></th>
				<th class="precio"><?php echo $this->Paginator->sort('Dif 1','Invfisicodenormal.conteo_1'); ?></th>
				<th class="precio"><?php echo $this->Paginator->sort('Dif 2','Invfisicodenormal.conteo_2'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($items as $item):
			$class = null;
			$thisID=trim($item['Articulo']['id']);
	//		if($i++==0) print_r($item);
		?>
			<tr id="<?php echo $thisID?>" cve="<?php echo $item['Articulo']['arcveart']; ?>" class="t-row">
				<td class="cveart" title="<?php echo $item['Articulo']['ardescrip'];?>">
					<?php echo $item['Articulo']['arcveart']; ?>
				</td>
				<td class="cveart"><?php echo $item['Color']['color_cve']; ?></td>
				<td class="licve"><?php echo $item['Linea']['licve']; ?></td>
				<td class="macve"><?php echo $item['Marca']['macve']; ?></td>
				<td class="precio" title="<?php echo $this->Number->precision($item[0]['conteo_1'],0); ?> pzas en <?php echo $this->Number->precision($item[0]['marbetes_conteo_1'],0); ?> marbetes."><?php echo $this->Number->precision($item[0]['conteo_1'],0); ?></td>
				<td class="precio" title="<?php echo $this->Number->precision($item[0]['conteo_2'],0); ?> pzas en <?php echo $this->Number->precision($item[0]['marbetes_conteo_2'],0); ?> marbetes."><?php echo $this->Number->precision($item[0]['conteo_2'],0); ?></td>
				<td class="precio"><?php echo $this->Number->precision($item[0]['existencia'],0);?></td>
				<td class="precio" title="<?php echo $item[0]['ubicacion_cves']?>"><?php echo '<em class="'.(abs($item[0]['conteo_1']-$item[0]['existencia'])<=1?'':(abs($item[0]['conteo_1']-$item[0]['existencia'])>100?'text-error':'text-info')).'">'.$this->Number->precision($item[0]['conteo_1']-$item[0]['existencia'],0).'</em>'; ?></td>
				<td class="precio"><?php echo $item[0]['conteo_2']>0?$this->Number->precision($item[0]['conteo_2']-$item[0]['existencia'],0):''; ?></td>
				<td class="id"><?php echo $item['Articulo']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Articulo')); ?>

<div id="dialogArticuloExistencia" class="modal hide fade">
</div>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
'
$( "#dialogArticuloExistencia" ).html(this.id); 
$( "#dialogArticuloExistencia" ).dialog( "open" );
'
, array('stop' => true));
?>

<script>

$( "#dialogArticuloExistencia" ).dialog({
			autoOpen: false,
			height: 320,
			width: 780,
   			position: ["center","center"], 
			zIndex: 999999,
			modal: true,
			stack: true,
			resizable: false,
			hide: 'fade',
			show: 'fade',
			autoOpen: false,
			draggable: false,
			rezisable: false,
			buttons: {
				Cerrar: function() {
					$( this ).dialog( "close" );
				}
			},
			open: function() {
/*
			if ( typeof $('#busy-indicator')=='object') {
				$('#busy-indicator').show();
			}
*/
				$( "#dialogArticuloExistencia" ).load('/articulos/tallacolor/'+$( "#dialogArticuloExistencia" ).html()+'/control:articulos/action:tallacolorexistenciadata');
			},
			close: function() {
				$("#dialogArticuloExistencia").html('');
/*
				if ( typeof $('#busy-indicator')=='object') {
					$('#busy-indicator').hide();
				}
*/				
			}
		});
</script>
