<div class="span12 existencias-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Materialexistencia', array('inputDefaults' => array(
															'label' => false,
															'div'   => false,
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover table-bodega">
		<thead>
			<tr class="row-filter">
				<th class="cveart"><?php echo $form->text('Articulo.arcveart', array('id'=>'cveart', 'label' => false, 'type' => 'search', 'maxLength' => '24', 'placeholder'=>'Producto...', 'class' => 'search-query cveart'));?></th>
				<th class="cveart"><?php echo $form->text('Color.cve', array('label' => false, 'type' => 'search', 'maxLength' => '24', 'placeholder'=>'Color...', 'class' => 'search-query cveart'));?></th>
				<th class="st"><?php //echo $form->text('', array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Talla...', 'class' => 'search-query cveart'));?></th>
				<th class="cant"><?php echo $form->text('cant',array('label' => false, 'type' => 'number', 'maxLength' => '8', 'placeholder'=>'Existencia...', 'class' => 'search-query cant'));?></th>
				<th class="refer"><?php echo $form->text('Ubicacion.cve', array('label' => false, 'type' => 'search', 'maxLength' => '8', 'placeholder'=>'Ubicación...', 'class' => 'search-query refer'));?></th>
				<th class="id">
				<?php echo $this->Js->submit('Filtrar', array('update' => '#content', 'class'=>'btn btn-mini', 'escape'=>false)); ?>
				</th>
			</tr>
			<tr class="row-labels">
				<th class="cveart"><?php echo $this->Paginator->sort('Producto','Articulo.arcveart'); ?></th>
				<th class="cveart"><?php echo $this->Paginator->sort('Color','Color.cve'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('Talla','talla_index'); ?></th>
				<th class="cant"><?php echo $this->Paginator->sort('Existencia','existencia'); ?></th>
				<th class="refer"><?php echo $this->Paginator->sort('Ubicacion','Ubicacion.cve'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','Articulo.id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($items as $item):
			$class = null;
			$thisID=$item['Artmovbodegaexistencia']['articulo_id'].'_'.$item['Artmovbodegaexistencia']['color_id'].'_'.
					$item['Artmovbodegaexistencia']['talla_index'].'_'.$item['Artmovbodegaexistencia']['ubicacion_id'];
		?>
			<tr id="<?php echo $thisID?>" 
				data-articulo_cve="<?php echo $item['Articulo']['arcveart']; ?>" 
				data-color_cve="<?php echo $item['Color']['cve']; ?>" 
				data-talla_index="<?php echo $item['Artmovbodegaexistencia']['talla_index']; ?>" 
				class="t-row">
				<td class="cveart" title="<?php echo $item['Articulo']['ardescrip'];?>">
					<?php echo $item['Articulo']['arcveart']; ?>
				</td>
				<td class="cveart"><?php echo $item['Color']['cve']; ?></td>
				<td class="st"><?php echo $item['Talla']['tat'.$item['Artmovbodegaexistencia']['talla_index']]; ?></td>
				<td class="cant"><?php echo $this->Number->precision($item['Artmovbodegaexistencia']['existencia'],0);?></td>
				<td class="refer"><?php echo $item['Ubicacion']['cve'];?></td>
				<td class="id"><?php echo $item['Articulo']['id'];?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Articulo')); ?>

<div id="dialogArticuloExistencia" class="modal hide fade">
</div>

</div> <!-- index-form -->


<?php

// Event for PASASEGUNDO Conteo1 -> to -> Conteo2

$this->Js->get('.detailPasaSegundo')->event(
'click', "

var el=$('#'+this.id);
var theID=el.data('id');
var theCve=el.data('value');
var theUrl=el.data('url');
var theButton=$('#btnPasaSegundo_'+theID);
var theSegundo=$('#cellSegundo_'+theID);
if(!(theID>0)) return;

bootbox.confirm('¿ Seguro de Pasar al Segundo Conteo ' + theCve + ' ?', 
function(result) {
    if (result) {
		$.ajax({
			dataType: 'html', 
			type: 'post', 
			url: theUrl+'/'+theID,
			success: function (data, textStatus) {
				if(data!='Error') {
	//				$('#'+theID).remove();
//					axAlert('Articulo ' + theCve + ' Procesado al Segundo Conteo', 'success', false);
					axAlert(data, 'success', false);
					theButton.addClass('disabled');
					theButton.data('id', '0');
					theSegundo.html('<strong><em class=\"text-info\">Copiado</em></strong>');
					}
				else {
					axAlert('Respuesta ('+textStatus+'):<br />'+data, 'error');
				}
			},
		});

    }
}
);

"
, array('stop' => true));

?>

<?php 
/*
echo 
$this->Js->get('.t-row')->event(
'click',
'
$( "#dialogArticuloExistencia" ).html(this.id); 
$( "#dialogArticuloExistencia" ).dialog( "open" );
'
, array('stop' => true));



				<td class="st">
					<?php if( $item[0]['conteo_2']==0 || empty($item[0]['conteo_2']) ):?>
							<button type="button" class="btn btn-mini btn-primary clickaction detailPasaSegundo"
									id="btnPasaSegundo_<?php e($item['Articulo']['id']); ?>"
									data-type="clickaction"
									data-url="/Invfisicosmovil/pasasegundo" 
									data-id="<?php e($item['Articulo']['id']); ?>" 
									data-value="<?php e(trim($item['Articulo']['arcveart'])); ?>"
									data-confirm="label" 
									data-confirm-msg="¿Seguro de pasar al Segundo Conteo el Articulo?"
									data-icon="ok">
									<i class="icon icon-ok icon-white"></i>
							</button>
					<?php endif;?>
				</td>

*/
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
