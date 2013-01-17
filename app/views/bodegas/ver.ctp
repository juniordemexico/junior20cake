<div class="span12 existencias-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Bodega', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover table-bodega">
		<thead>
			<tr class="row-filter">
				<th class="refer"><?php echo $form->text('Invfisicodetail.Folio', array('label' => false, 'type' => 'search', 'maxLength' => '8', 'placeholder'=>'Refer...', 'class' => 'search-query cveart'));?></th>
				<th class="cveart"><?php echo $form->text('Invfisicodetail.Created', array('label' => false, 'type' => 'search', 'maxLength' => '12', 'placeholder'=>'Fecha...', 'class' => 'search-query datetime'));?></th>
				<th class="cveart"><?php echo $form->text('Ubicacion.cve', array('label' => false, 'type' => 'search', 'maxLength' => '24', 'placeholder'=>'Clave', 'class' => 'search-query cveart'));?></th>
				<th class="cveart"><?php echo $form->text('Articulo.arcveart', array('id'=>'cveart', 'label' => false, 'type' => 'search', 'maxLength' => '24', 'placeholder'=>'Clave', 'class' => 'search-query cveart'));?></th>
				<th class="cveart"><?php echo $form->text('Color.cve', array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Color...', 'class' => 'search-query cveart'));?></th>
				<th class="st"><?php //echo $form->text('', array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Talla...', 'class' => 'search-query cveart'));?></th>
				<th class="precio"><?php echo $form->text('Artmovbodegadetail.cant',array('label' => false, 'type' => 'search', 'maxLength' => '12', 'placeholder'=>'Cantidad...', 'class' => 'search-query precio'));?></th>
				<th class=""><?php echo $form->text('Tipoartmovbodega.cve', array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Tipo Transacción...', 'class' => 'search-query cveart'));?></th>
				<th class="st"><?php echo $form->text('Artmovbodegadetail.st', array('id'=>'st', 'label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'ST', 'class' => 'search-query st'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>
			</tr>
			<tr class="row-labels">
				<th class="refer"><?php echo $this->Paginator->sort('Refer','folio'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Fecha','created'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Ubicacion','Ubicacion.cve'); ?></th>
				<th class="cveart"><?php echo $this->Paginator->sort('Producto','Articulo.arcveart'); ?></th>
				<th class="cveart"><?php echo $this->Paginator->sort('Color','Color.cve'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('Talla','talla_index'); ?></th>
				<th class="precio"><?php echo $this->Paginator->sort('Cantidad','cant'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('T Mov','Tipoartmovbodega.cve'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','st'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($items as $item):
			$class = null;
			$thisID=trim($item['Artmovbodegadetail']['id']);
		?>
			<tr id="<?php echo $thisID?>" cve="<?php echo $item['Artmovbodegadetail']['id']; ?>" class="t-row">
				<td class="refer"><?php echo $item['Artmovbodegadetail']['folio'];?></td>
				<td class="datetime"><?php echo $item['Artmovbodegadetail']['created'];?></td>
				<td class="datetime"><?php echo $item['Ubicacion']['cve'];?></td>
				<td class="cveart" title="<?php echo $item['Articulo']['ardescrip'];?>">
					<?php echo $item['Articulo']['arcveart']; ?>
				</td>
				<td class="cveart"><?php echo $item['Color']['cve']; ?></td>
				<td class="st"><?php echo $item['Talla']['tat'.$item['Artmovbodegadetail']['talla_index']]; ?></td>
				<td class="precio"><?php echo $this->Number->precision($item['Artmovbodegadetail']['cant'],0);?></td>
				<td class=""><?php echo $item['Tipoartmovbodega']['cve']; ?></td>
				<td class="st"><?php echo $item['Artmovbodegadetail']['st']; ?></td>
				<td class="id"><?php echo $item['Artmovbodegadetail']['id']; ?></td>
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
