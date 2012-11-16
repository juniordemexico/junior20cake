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
			<input type="text" maxlength="16" id="material_cve" name="data[Proveedor][material_cve]" class="span2"
			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
			data-autocomplete-url="/Articulos/autocomplete/tipo:1"
			/>
			<button id="btnMaterialSubmit" class="btn" type="button"><i class="icon icon-plus-sign"></i> Agregar</button>
		</div>

		<div id="detailContentTelasTable">
		<table class="table table-condensed">
			<thead>
			<tr>
				<th class="span2">Tela</th>
				<th class="">Descripcion</th>
				<th class="span2">Promedio</th>
				<th class="span3">Costo</th>
				<th class="span1">Inventario Propio</th>
				<th class="span1">&nbsp</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($items['tela'] as $item): ?>
			<tr id="<?php e($item['Explosion']['id']);?>" class="t-row">
				<td class="span2" id="<?php e($item['Explosion']['material_id'])?>"><?php e($item['Articulo']['arcveart'])?></td>
				<td class=""><?php e($item['Articulo']['ardescrip'])?></td>
				<td class="span2"><?php e($item['Explosion']['cant'])?></td>
				<td class="span3">

				<div class="btn-group span3">
					<button class="btn btn-info" data-costo="">
					<?php if(isset($item['Costo'][0]) ):?>
					<?php e($item['Costo'][0]['ArticuloProveedor']['costo'])?> (<?php e($item['Costo'][0]['Proveedor']['prcvepro'])?>)
					<?php endif;?>
					</button>
					<button class="btn dropdown-toggle btn-info" data-toggle="dropdown">
					<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">					
					<?php foreach($item['Costo'] as $costo): ?>
					<li data-costo="" data-proveedorid=""><?php e($costo['ArticuloProveedor']['costo'])?> (<?php e($costo['Proveedor']['prcvepro'])?>)</li>
					<?php endforeach;?>
  					</ul>
				</div>

				</td>
				<td class="span1"><input type="checkbox" class="detailPropio" id="propio[<?php e($item['Explosion']['id']) ?>]" title="Marcar en caso de ser un insumo propio" <?php e($item['Explosion']['insumopropio']==1?'checked="true"':'');?>" /></td>
				<td class="span1"><button type="button" class="btn btn-mini detailDelete"><i class="icon icon-trash"></i></button></td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>

</div> <!-- div tabs0 -->

<div id="tabs-1" class="tab-pane">

		<div class="controls controls-row well well-small">
			<!-- Typeahead term -->
			<input type="text" maxlength="16" id="material_cve" name="data[Proveedor][material_cve]" class="span2"
			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
			data-autocomplete-url="/Articulos/autocomplete/tipo:1"
			/>
			<button id="btnHabilSubmit" class="btn" type="button"><i class="icon icon-plus-sign"></i> Agregar</button>
		</div>

		<div id="detailContentHabilTable">
		<table class="table table-condensed">
			<thead>
			<tr>
				<th class="cveart">Material</th>
				<th class="">Descripcion</th>
				<th class="span1">Cantidad</th>
				<th class="span3">Costo</th>
				<th class="span1">Inventario Propio</th>
				<th class="span1">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($items['habilitacion'] as $item): ?>
			<tr id="<?php e($item['Explosion']['id']);?>" class="t-row" data-cve="<?php e($item['Articulo']['arcveart'])?>">
				<td class="cveart" id="<?php e($item['Explosion']['material_id'])?>"><?php e($item['Articulo']['arcveart'])?></td>
				<td class=""><?php e($item['Articulo']['ardescrip'])?></td>
				<td class="span1"><?php e($item['Explosion']['cant'])?></td>
				<td class="span3">

				<div class="btn-group span3">
					<button class="btn btn-info" data-costo="">
					<?php if(isset($item['Costo'][0]) ):?>
					<?php e($item['Costo'][0]['ArticuloProveedor']['costo'])?> (<?php e($item['Costo'][0]['Proveedor']['prcvepro'])?>)
					<?php endif;?>
					</button>
					<button class="btn dropdown-toggle btn-info" data-toggle="dropdown">
					<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">					
					<?php foreach($item['Costo'] as $costo): ?>
					<li data-costo="" data-proveedorid=""><?php e($costo['ArticuloProveedor']['costo'])?> (<?php e($costo['Proveedor']['prcvepro'])?>)</li>
					<?php endforeach;?>
  					</ul>
				</div>

				</td>
				<td class="span1"><input type="checkbox" class="detailPropio" data-id="<?php e($item['Explosion']['id']) ?>" id="propio[<?php e($item['Explosion']['id']) ?>]" title="Marcar en caso de ser un insumo propio" <?php e($item['Explosion']['insumopropio']==1?'checked="true"':'');?>" /></td>
				<td class="span1"><button type="button" class="btn btn-mini detailDelete" data-id="<?php e($item['Explosion']['id']) ?>"><i class="icon icon-trash"></i></button></td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>

</div> <!-- div tabs1 -->

<div id="tabs-2" class="tab-pane">

		<div class="controls controls-row well well-small">
			<!-- Typeahead term -->
			<input type="text" maxlength="16" id="material_cve" name="data[Proveedor][material_cve]" class="span2"
			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
			data-autocomplete-url="/Articulos/autocomplete/tipo:3"
			/>
			<button id="btnServicioSubmit" class="btn" type="button"><i class="icon icon-plus-sign"></i> Agregar</button>
		</div>

		<div id="detailContentTelasTable">
		<table class="table table-condensed">
			<thead>
			<tr>
				<th class="cveart">Servicio</th>
				<th class="">Descripcion</th>
				<th class="span2">Cantidad</th>
				<th class="span3">Costo</th>
				<th class="span1">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($items['servicio'] as $item): ?>
			<tr id="<?php e($item['Explosion']['id']);?>" class="t-row">
				<td class="cveart" id="<?php e($item['Explosion']['material_id'])?>"><?php e($item['Articulo']['arcveart'])?></td>
				<td class=""><?php e($item['Articulo']['ardescrip'])?></td>
				<td class="span2"><?php e($item['Explosion']['cant'])?></td>
				<td class="span3">

				<div class="btn-group span3">
					<button class="btn btn-info" data-costo="">
					<?php if(isset($item['Costo'][0]) ):?>
					<?php e($item['Costo'][0]['ArticuloProveedor']['costo'])?> (<?php e($item['Costo'][0]['Proveedor']['prcvepro'])?>)
					<?php endif;?>
					</button>
					<button class="btn dropdown-toggle btn-info" data-toggle="dropdown">
					<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">					
					<?php foreach($item['Costo'] as $costo): ?>
					<li data-costo="" data-proveedorid=""><?php e($costo['ArticuloProveedor']['costo'])?> (<?php e($costo['Proveedor']['prcvepro'])?>)</li>
					<?php endforeach;?>
  					</ul>
				</div>

				</td>
				<td class="span1"><button type="button" class="btn btn-mini detailDelete" data-id="<?php e($item['Explosion']['id']) ?>"><i class="icon icon-trash"></i></button></td>
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
$this->Js->get('.detailDelete')->event(
'click', "
var theID=this.parentElement.parentElement.id;
bootbox.confirm('Seguro de ELIMINAR la partida ' + $('#'+theID).data('cve') + ' de la explosion ?', 
function(result) {
    if (result) {
		$.ajax({
			dataType: 'html', 
			type: 'post', 
			url: '/Explosiones/delete/'+theID,
			success: function (data, textStatus) {
			if(data=='OK') 
				$( '#'+theID ).remove();
			else 
				bootbox.alert( data + ' ('+textStatus+')' );
			},
		});

    }
}
);
"
, array('stop' => true));

?>