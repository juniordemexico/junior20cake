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
				<th class="span2">Cantidad</th>
				<th class="span1">Inventario Propio</th>
				<th class="span1">&nbsp</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($explosion['tela'] as $item): ?>
			<tr id="<?php e($item['Explosion']['id']);?>" class="t-row">
				<td class="" id="<?php e($item['Explosion']['material_id'])?>"><?php e($item['Articulo']['arcveart'])?></td>
				<td class=""><?php e($item['Articulo']['ardescrip'])?></td>
				<td class=""><?php e($item['Explosion']['cant'])?></td>
				<td class=""><input type="checkbox" id="propio[<?php e($item['Explosion']['id']) ?>]" title="Marcar en caso de ser un insumo propio" <?php e($item['Explosion']['insumopropio']==1?'checked="true"':'');?>" /></td>
				<td class=""><button class="btn btn-mini detailDelete"><i class="icon icon-trash"></i></button></td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>

</div> <!-- div tabs0 -->

<div id="tabs-1" class="tab-pane active">

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
				<th class="span2">Material</th>
				<th class="">Descripcion</th>
				<th class="span2">Cantidad</th>
				<th class="span1">Inventario Propio</th>
				<th class="span1">&nbsp</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($explosion['habilitacion'] as $item): ?>
			<tr id="<?php e($item['Explosion']['id']);?>" class="t-row">
				<td class="" id="<?php e($item['Explosion']['material_id'])?>"><?php e($item['Articulo']['arcveart'])?></td>
				<td class=""><?php e($item['Articulo']['ardescrip'])?></td>
				<td class=""><?php e($item['Explosion']['cant'])?></td>
				<td class=""><input type="checkbox detailPropio" data-id="<?php e($item['Explosion']['id']) ?>" id="propio[<?php e($item['Explosion']['id']) ?>]" title="Marcar en caso de ser un insumo propio" <?php e($item['Explosion']['insumopropio']==1?'checked="true"':'');?>" /></td>
				<td class=""><button class="btn btn-mini detailDelete" data-id="<?php e($item['Explosion']['id']) ?>"><i class="icon icon-trash"></i></button></td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>

</div> <!-- div tabs1 -->

<div id="tabs-2" class="tab-pane active">

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
				<th class="span2">Servicio</th>
				<th class="">Descripcion</th>
				<th class="span2">Cantidad</th>
				<th class="span1">Inventario Propio</th>
				<th class="span1">&nbsp</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($explosion['servicio'] as $item): ?>
			<tr id="<?php e($item['Explosion']['id']);?>" class="t-row">
				<td class="" id="<?php e($item['Explosion']['material_id'])?>"><?php e($item['Articulo']['arcveart'])?></td>
				<td class=""><?php e($item['Articulo']['ardescrip'])?></td>
				<td class="precio"><?php e($item['Explosion']['cant'])?></td>
				<td class="">&nbsp;</td>
				<td class=""><button class="btn btn-mini detailDelete" <?php e($item['Explosion']['id']) ?> ><i class="icon icon-trash"></i></button></td>
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
'click', '
var theID=$('#'+this.id).data('id');
$('#content').load('/Explosiones/delete/'+ theID);
'
, array('stop' => true));

?>