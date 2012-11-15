<div class="page-header">
<h1><?php e($this->data['Proveedor']['prcvepro']);?> 
	<small><?php e($this->data['Proveedor']['prnom']);?></small>
</h1>
<hr />
</div>

<div id="detailContent" class="row-fluid">

	<div id="detailContentMaterial" class="span6">
		<h4>Materiales relacionados:</h4><br />
		<?php echo $this->Form->create('Proveedor', array('action'=>'/costoarticulo', 'class'=>'form-search')); ?>
		<?php echo $this->Form->hidden('Proveedor.id'); ?>
		<?php echo $this->Form->hidden('Proveedor.prcvepro'); ?>
		<?php echo $this->Form->hidden('Proveedor.prnom'); ?>
		<?php echo $this->Form->hidden('Material.id'); ?>
		<!-- Typeahead init -->

		<div class="controls controls-row well well-small">
<?php
//		<input type="text" maxlength="16" id="material_cve" name="data[Proveedor][material_cve]" class="span2"
//		data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
//		data-autocomplete-url="/Articulos/autocomplete/tipo:1"
//		/>
?>
		<?php echo $this->TBS->input('Material.arcveart',
										array(
										'label'=>false,
										'postData'=>array('Proveedor.id'),
										'autocomplete'=>array(
											'url'=>'/Articulos/autocomplete/tipo:1',
											'min-length'=>2,
/*											'addHiddenField'=>array('Material.id'=>array('source'=>'id')) */
											),
										)
									);
		?>
<?php

/*
echo $this->Html->scriptBlock($this->Js->domReady("
var cveartmat_el = $('#MaterialArcveart');
    cveartmat_el.typeahead({
        source: function(typeahead, query) {
            if(this.ajax_call)
                this.ajax_call.abort();
            this.ajax_call = $.ajax({
                dataType: 'json',
				data: {
                    keyword: query,
                    proveedor_id: $('#Proveedor.id').val()
                },
                url: cveartmat_el.data('autocompleteUrl'),
                success: function(data) {
                    typeahead.process(data);
                }
            });
        },
        property: 'value',
        onselect: function (obj) {
			$('#MaterialId').val(obj.id);
			$('#MaterialPcosto').val(obj.pcosto);
			$('#MaterialArcveart').attr('title', obj.title);
        }
    });
"), 
array('inline'=>false)
);
*/
?>
		<!-- Typeahead term -->
		<input type="text" maxlength="8" id="material_costo" name="data[Proveedor][material_costo]" class="span1" />
		<button id="btnMaterialSubmit" class="btn" type="button"><i class="icon icon-plus-sign"></i> Agregar</button>
<?php echo 
$this->Js->get('#btnMaterialSubmit')->event(
'click',
"bootbox.alert( $('#MaterialId').val() );"
, array('stop' => true));
?>
		</div>
		<div id="detailContentMaterialTable">
		<table class="table table-condensed">
			<thead>
			<tr>
				<th class="">Material</th>
				<th class="precio">Costo</th>
				<th class="fecha">Autorizado</th>
				<th class="st">&nbsp</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($materiales as $item):?>
			<tr id="<?php e($item['ArticuloProveedor']['articulo_id']);?>" class="t-row">
				<td class="" title="<?php e($item['Articulo']['ardescrip'])?>"><?php e($item['Articulo']['arcveart'])?></td>
				<td class="precio"><?php e($item['ArticuloProveedor']['costo'])?></td>
				<td class="fecha">NO</td>
				<td class="st"><button class="btn btn-mini detailDelete"><i class="icon icon-trash"></i></button></td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>
		<?php echo $this->Form->End();?>
	</div>
	<div id="detailContentServicio" class="span6">
		<h4>Servicios y/o Procesos relacionados:</h4><br />
		<?php echo $this->Form->create('Proveedor', array('action'=>'/costoarticulo', 'class'=>'form-search')); ?>
		<?php echo $this->Form->hidden('Proveedor.id'); ?>
		<?php echo $this->Form->hidden('Proveedor.prcvepro'); ?>
		<?php echo $this->Form->hidden('Proveedor.prnom'); ?>
		<?php echo $this->Form->hidden('Material.id'); ?>
		<div class="controls controls-row well well-small">
		<?php //echo $this->TBS->autoComplete('Proveedor.cveart', '/Articulo/autocomplete', array('label'=>false) );?>
		<input type="text" maxlength="16" id="Proveedor.cveartserv" name="data[Proveedor][cveartserv]" class="span2" data-provide="typeahead" data-items="16" data-min-length="2" data-source='["uno","dos","tres","doscientos","cuadrados"]' />
		<input type="text" maxlength="6" id="Proveedor.costoserv" name="data[Proveedor][costoserv]" class="span1" />
		<button id="btnServicioSubmit" class="btn" type="button"><i class="icon icon-plus-sign"></i> Agregar</button>
		</div>
		<div id="detailContentServicioTable">
		<table class="table table-condensed">
			<thead>
			<tr>
				<th class="">Servicio</th>
				<th class="precio">Costo</th>
				<th class="fecha">Autorizado</th>
				<th class="st">&nbsp</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($servicios as $item):?>
			<tr id="<?php e($item['ArticuloProveedor']['articulo_id']);?>" class="t-row">
				<td class="" title="<?php e($item['Articulo']['ardescrip'])?>"><?php e($item['Articulo']['arcveart'])?></td>
				<td class="precio"><?php e($item['ArticuloProveedor']['costo'])?></td>
				<td class="fecha">NO</td>
				<td class="st"><button class="btn btn-mini detailDelete"><i class="icon icon-trash"></i></button></td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>
		<?php echo $this->Form->End();?>
	</div>
</div>

