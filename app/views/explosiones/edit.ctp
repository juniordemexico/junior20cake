<div class="page-header">
<h1><?php e($articulo['Articulo']['arcveart']);?> 
	<small><?php e($articulo['Articulo']['ardescrip']);?></small>
</h1>
</div>

<div id="detailContent" class="row-fluid">

<?php echo $this->Form->create('Explosion', array('action'=>'/add', 'class'=>'form-search')); ?>
<?php echo $this->Form->hidden('Articulo.id'); ?>

<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab">Telas</a></li>
		<li><a href="#tabs-1" data-toggle="tab">Habilitacion</a></li>
		<li><a href="#tabs-2" data-toggle="tab">Servicios</a></li>
	</ul>

<div class="tab-content">

<div id="tabs-0" class="tab-pane active">

		<div class="controls controls-row well well-small">
			<!-- Typeahead term -->
			<input type="text" maxlength="16" id="ExplosionTelacve" name="data[Proveedor][Telacve]" class="span2"
			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
			data-autocomplete-url="/Articulos/autocomplete/tipo:1"
			/>
			<input type="text" maxlength="16" id="ExplosionTelacant" name="data[Explosion][Telacant]" field="Explosion.telacant" class="span1" title="Especifique la cantidad requerida por unidad producida" />
			<input type="checkbox" class="detailPropio" id="ExplosionTelainsumopropio" name="data[Explosion][Telainsumopropio]" field="Explosion.Telainsumopropio" title="Marcar en caso de ser un insumo propio" />
			<button id="btnMaterialSubmit" class="btn" type="button"><i class="icon icon-plus-sign"></i> Agregar</button>
		</div>

		<div id="detailContentTelasTable">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th class="span2">Tela</th>
				<th class="">Descripcion</th>
				<th class="span2">Promedio</th>
				<th class="span1">Inventario Propio</th>
				<th class="span1">&nbsp</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($explosion['tela'] as $item): ?>
			<tr id="<?php e($item['Explosion']['id']);?>" class="t-row">
				<td class="cveart" id="<?php e($item['Explosion']['material_id'])?>"><?php e($item['Articulo']['arcveart'])?></td>
				<td class=""><?php e($item['Articulo']['ardescrip'])?></td>
				<td class=""><?php e($item['Explosion']['cant'])?></td>
				<td class=""><input type="checkbox" 
								class="clickaction detailToggleInsumoPropio" 
								id="chkToggeInsumoPropio_<?php e($item['Explosion']['id']) ?>"
								title="Marcar en caso de ser un insumo propio" 
								data-type="clickaction"
								data-url="/Explosiones/toggleInsumoPropio" 
								data-id="<?php e($item['Explosion']['id']) ?>" 
								data-value="<?php e(trim($item['Articulo']['arcveart'])); ?>"
								data-confirm=false 
								<?php e($item['Explosion']['insumopropio']==1?'checked="true"':'');?>" 
							/>
				</td>
				<td class=""><button type="button" class="btn btn-mini clickaction detailDelete"
									id="btnDelete_<?php e($item['Explosion']['id']); ?>"
									data-type="clickaction"
									data-url="/Explosiones/delete" 
									data-id="<?php e($item['Explosion']['id']); ?>" 
									data-value="<?php e(trim($item['Articulo']['arcveart'])); ?>"
									data-confirm="label" 
									data-confirm-msg="Seguro de Eliminar el Item?"
									data-icon="trash">
									<i class="icon icon-trash"></i>
							</button>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>

</div> <!-- div tabs0 -->

<div id="tabs-1" class="tab-pane">

		<div class="controls controls-row well well-small">
			<!-- Typeahead term -->
			<input type="text" maxlength="16" id="ExplosionMaterialcve" name="data[Explosion][Materialcve]" class="span2"
			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
			data-autocomplete-url="/Articulos/autocomplete/tipo:1"
			/>
			<input type="text" maxlength="16" id="ExplosionHabilcant" name="data[Explosion][Habilcant]" field="Explosion.habilcant" class="span1" title="Especifique la cantidad requerida por unidad producida" />
			<input type="checkbox" class="detailPropio" id="ExplosionHabilinsumopropio" name="data[Explosion][Habilinsumopropio]" field="Explosion.habilinsumopropio" title="Marcar en caso de ser un insumo propio" />
			<button id="btnHabilSubmit" class="btn" type="button"><i class="icon icon-plus-sign"></i> Agregar</button>
		</div>

		<div id="detailContentHabilTable">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th class="span2">Material</th>
				<th class="">Descripcion</th>
				<th class="span2">Cantidad</th>
				<th class="span1">Inventario Propio</th>
				<th class="span1">&nbsp</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($explosion['habilitacion'] as $item): ?>
			<tr id="<?php e($item['Explosion']['id']);?>" class="t-row" data-cve="<?php e($item['Articulo']['arcveart'])?>">
				<td class="cveart" id="<?php e($item['Explosion']['material_id'])?>"><?php e($item['Articulo']['arcveart'])?></td>
				<td class=""><?php e($item['Articulo']['ardescrip'])?></td>
				<td class=""><?php e($item['Explosion']['cant'])?></td>
				<td class=""><input type="checkbox" 
								class="clickaction detailToggleInsumoPropio" 
								id="chkToggeInsumoPropio_<?php e($item['Explosion']['id']) ?>"
								title="Marcar en caso de ser un insumo propio" 
								data-type="clickaction"
								data-url="/Explosiones/toggleInsumoPropio" 
								data-id="<?php e($item['Explosion']['id']) ?>" 
								data-value="<?php e(trim($item['Articulo']['arcveart'])); ?>"
								data-confirm=false 
								<?php e($item['Explosion']['insumopropio']==1?'checked="true"':'');?>" 
							/>
				</td>
				<td class=""><button type="button"
									class="btn btn-mini clickaction detailDelete"
									id="btnDelete_<?php e($item['Explosion']['id']); ?>"
									title="Quitar el Insumo de la Explosion de Materiales" 
									data-type="clickaction"
									data-url="/Explosiones/delete" 
									data-id="<?php e($item['Explosion']['id']); ?>" 
									data-value="<?php e(trim($item['Articulo']['arcveart'])); ?>"
									data-confirm="label" 
									data-confirm-msg="Seguro de Eliminar el Item?"
									data-icon="trash">
									<i class="icon icon-trash"></i>
							</button>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>

</div> <!-- div tabs1 -->

<div id="tabs-2" class="tab-pane">

		<div class="controls controls-row well well-small">
			<!-- Typeahead term -->
			<input type="text" maxlength="16" id="ExplosionServiciocve" name="data[Explosion][Serviciocve]" class="span2"
			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
			data-autocomplete-url="/Articulos/autocomplete/tipo:3"
			/> &nbsp;&nbsp;
			<input type="text" maxlength="16" id="ExplosionServiciocant" name="data[Explosion][Serviciocant]" field="Explosion.serrviciocant" class="span1" title="Especifique la cantidad requerida por unidad producida" />
			<button id="btnServicioSubmit" class="btn" type="button"><i class="icon icon-plus-sign"></i> Agregar</button>
		</div>

		<div id="detailContentTelasTable">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th class="cveart">Servicio</th>
				<th class="">Descripcion</th>
				<th class="span2">Cantidad</th>
				<th class="span1">Costo</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($explosion['servicio'] as $item): ?>
			<tr id="<?php e($item['Explosion']['id']);?>" class="t-row">
				<td class="cveart" id="<?php e($item['Explosion']['material_id'])?>"><?php e($item['Articulo']['arcveart'])?></td>
				<td class=""><?php e($item['Articulo']['ardescrip'])?></td>
				<td class="span1"><?php e($item['Explosion']['cant'])?></td>
				<td class=""><button type="button" 
									class="btn btn-mini clickaction detailDelete"
									id="btnDelete_<?php e($item['Explosion']['id']); ?>"
									title="Quitar el Servicio de la Explosion de Materiales" 
									data-type="clickaction"
									data-url="/Explosiones/delete" 
									data-id="<?php e($item['Explosion']['id']); ?>" 
									data-value="<?php e(trim($item['Articulo']['arcveart'])); ?>"
									data-confirm="label" 
									data-confirm-msg="Seguro de Eliminar el Item?"
									data-icon="trash">
									<i class="icon icon-trash"></i>
							</button>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>

</div> <!-- div tabs2 -->

</div> <!-- div tab-content -->

</div> <!-- div tabbable -->

<?php echo $this->Form->end();?>

<?php

// Event for Detail's Delete Button
$this->Js->get('.detailDelete')->event(
'click', "

var el=$('#'+this.id);
var theID=el.data('id');
var theCve=el.data('value');
var theUrl=el.data('url');
bootbox.confirm('Seguro de ELIMINAR la partida ' + theCve + ' de la explosion ?', 
function(result) {
    if (result) {
		$.ajax({
			dataType: 'html', 
			type: 'post', 
			url: theUrl+'/'+theID,
			success: function (data, textStatus) {
				if(data=='OK') {
					$('#'+theID).remove();
					axAlert('Insumo ' + theCve + ' Eliminado', 'success', false);
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

// Event for Detail's Checkbox

$this->Js->get('.detailToggleInsumoPropio')->event(
'change', "

var el=$('#'+this.id);
var theID=el.data('id');
var theCve=el.data('value');
var theValue=(el.attr('checked')=='checked');
$.ajax({
	dataType: 'html', 
	type: 'post',
/*	data: seriealize(edtCveArt, edtCant, ckInsumopropio),*/
	url: '/Explosiones/toggleInsumoPropio/'+theID+'/value:'+theValue,
	success: function (data, textStatus) {
		if(data=='OK') {
			axAlert('Insumo ' + theCve + ' Actualizado', 'success', false);
			return true;
		}
		else {
			axAlert('Respuesta ('+textStatus+'):<br />'+data, 'error');
			return false;
		}
	},
});

"
, array('stop' => true));

?>
