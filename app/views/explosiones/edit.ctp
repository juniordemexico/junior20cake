<div class="page-header">
<h1><?php e($articulo['Articulo']['arcveart']);?> 
	<small><?php e($articulo['Articulo']['ardescrip']);?></small>
</h1>
</div>

<div id="detailContent" class="row-fluid">

<?php echo $this->Form->create('Explosion', array('action'=>'/add', 'class'=>'form-search')); ?>
<?php echo $this->Form->hidden('Articulo.id', array("value"=>$articulo['Articulo']['id'])); ?>

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
			<input type="text" maxlength="16" id="edtTelaCve" name="data[Explosion][Telacve]" class="span2"
			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
			data-autocomplete-url="/Articulos/autocomplete/tipo:1"
			/>
			<input type="text" maxlength="8" id="edtTelaCant" name="data[Explosion][TelaCant]" class="span1" title="Especifique la cantidad requerida por unidad producida" />
			<input type="checkbox" class="detailPropio" id="chkTelaInsumoPropio" name="data[Explosion][TelaPropio]" title="Marcar en caso de ser un insumo propio" />
			<button id="submitTela" class="btn" type="button"
			data-url="/Explosiones/add"
			><i class="icon icon-plus-sign"></i> Agregar</button>
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
			<input type="text" maxlength="16" id="edtHabilCve" name="data[Explosion][HabilCve]" class="span2"
			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
			data-autocomplete-url="/Articulos/autocomplete/tipo:1"
			/>
			<input type="text" maxlength="8" id="edtHabilCant" name="data[Explosion][HabilCant]" class="span1" title="Especifique la cantidad requerida por unidad producida" />
			<input type="checkbox" class="detailPropio" id="chkHabilPropio" name="data[Explosion][HabilPropio]" title="Marcar en caso de ser un insumo propio" />
			<button id="submitHabil" class="btn" type="button"><i class="icon icon-plus-sign"></i> Agregar</button>
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
			<input type="text" maxlength="16" id="ExplosionServiciocant" name="data[Explosion][Serviciocant]" class="span1" title="Especifique la cantidad requerida por unidad producida" />
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
var theUrl=el.data('url');
$.ajax({
	dataType: 'html', 
	type: 'post',
	url: theUrl+'/'+theID+'/value:'+theValue,
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

// Add Detail Button Event

$this->Js->get('#submitTela')->event(
'click', "

var el=$('#'+this.id);
var theTipoExplosion=1;
var theArticuloID=$('#ArticuloId').val();
var theCve=$('#edtTelaCve').val();
var theCant=$('#edtTelaCant').val();
var theInsumoPropio=(($('#chkTelaInsumoPropio').attr('checked')=='checked')?1:0);
var theUrl=el.data('url');
/*
axAlert('articulo_id:'+theArticuloID);
axAlert('cve:'+theCve);
axAlert('cant:'+theCant);
axAlert('propio:'+theInsumoPropio);
*/
axAlert(theUrl+'/'+theArticuloID+'/cve:'+theCve+'/cant:'+theCant+'/insumopropio:'+theInsumoPropio);
$.ajax({
	dataType: 'html', 
	type: 'post',
	url: theUrl+'/'+theArticuloID+'/cve:'+theCve+'/cant:'+theCant+'/insumopropio:'+theInsumoPropio+'/tipoexplosionid:'+theTipoExplosion,
	success: function (data, textStatus) {
		if(data.substring(0,2)=='OK') {
			axAlert('Insumo ' + theCve + ' Agregado', 'success', false);
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
