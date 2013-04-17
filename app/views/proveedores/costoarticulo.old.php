<div ng-controller="AxAppController" class="ng-cloack">
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
		<?php echo $this->Form->hidden('Proveedor.id', array('value'=>$this->data['Proveedor']['id'])); ?>
		<?php echo $this->Form->hidden('Proveedor.prcvepro'); ?>
		<?php echo $this->Form->hidden('Proveedor.prnom'); ?>
		<?php echo $this->Form->hidden('Material.id', array('id'=>'MaterialId')); ?>
		<!-- Typeahead init -->

		<div class="controls controls-row well well-small">
			<div class="controls input">
			<input type="text" maxlength="16" id="edtMaterialCve"  name="data[ArticuloProveedor][MaterialCve]"
			class="span4"
			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
			data-auto complete-url="/Articulos/autocomplete/tipo:1"
			placeholder="Clave del Material..."
			/>

			<?php

			echo $this->Html->scriptBlock($this->Js->domReady("
			var cveartmat_el = $('#edtMaterialCve');
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
						$('#edtMaterialCve').attr('title', obj.title);
						axAlert('<strong>'+obj.value+'</strong>'+'<br/>'+obj.title, 'info', false, 'Material');
//						$('#edtMaterialPCosto').val(obj.pcosto);
			        }
			    });
			"), 
			array('inline'=>false)
			);
			?>


			</div>
			<div class="controls input">
			<input type="text" maxlength="8" id="edtMaterialPCosto" name="data[ArticuloProveedor][MaterialPCosto]" class="span2"
			placeholder="Costo..." title="Costo segun el proveedor especificado" />
			</div>
			<button id="submitMaterial" class="btn" type="button"
			data-url="/Proveedores/addCostoArticulo"
			><i class="icon icon-plus-sign"></i> Agregar</button>

		<?php
/*
		 echo $this->TBS->input('Material.arcveart',
										array(
										'id'=>'edtMaterialCve'
										'label'=>false,
										'postData'=>array('Proveedor.id'),
										'autocomplete'=>array(
											'url'=>'/Articulos/autocomplete/tipo:1',
											'min-length'=>2,
											'addHiddenField'=>array('Material.id'=>array('source'=>'id')) 
											),
										)
									);
*/
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
			<tr id="<?php e($item['ArticuloProveedor']['id']);?>" class="t-row">
				<td class="" title="<?php e($item['Articulo']['ardescrip'])?>"><?php e($item['Articulo']['arcveart'])?></td>
				<td class="precio">
					<input type="text" 
						class="cant bluraction detailCosto" 
						id="detailCantidad_<?php e($item['ArticuloProveedor']['id']) ?>"
						title="Especifica el Costo del Material" 
						placeholder="Costo..."
						data-type="changeaction"
						data-url="/Proveedores/changeCosto" 
						data-id="<?php e($item['ArticuloProveedor']['id']) ?>" 
						data-value="<?php e(trim($item['Articulo']['arcveart'])); ?>"
						data-confirm=false 
						value="<?php e($item['ArticuloProveedor']['costo'])?>" 
					/>
				</td>
				<td class="fecha">NO</td>
				<td class=""><button type="button" class="btn btn-mini clickaction detailDelete"
									id="btnDelete_<?php e($item['Articulo']['id']); ?>"
									data-type="clickaction"
									data-url="/Proveedores/deleteCostoArticulo" 
									data-id="<?php e($item['ArticuloProveedor']['id']); ?>" 
									data-value="<?php e(trim($item['Articulo']['arcveart'])); ?>"
									data-confirm="vale" 
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
		<?php echo $this->Form->End();?>
	</div>
	<div id="detailContentServicio" class="span6">
		<h4>Servicios y/o Procesos relacionados:</h4><br />
		<?php echo $this->Form->create('Proveedor', array('action'=>'/costoarticulo', 'class'=>'form-search')); ?>
		<?php echo $this->Form->hidden('Proveedor.id'); ?>
		<?php echo $this->Form->hidden('Proveedor.prcvepro'); ?>
		<?php echo $this->Form->hidden('Proveedor.prnom'); ?>
		<?php echo $this->Form->hidden('Servicio.id', array('id'=>'ServicioId')); ?>
		<div class="controls controls-row well well-small">
			<div class="controls input">
			<input type="text" maxlength="16" id="edtServicioCve" name="data[ArticuloProveedor][ServicioCve]"
			class="span4"
			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
			data-autocomplete-url="/Articulos/autocomplete/tipo:2"
			placeholder="Clave del Servicio..."
			/>

			<?php
				echo $this->Html->scriptBlock($this->Js->domReady("
				var cveartser_el = $('#edtServicioCve');
				    cveartser_el.typeahead({
			        	source: function(typeahead, query) {
		            	if(this.ajax_call)
			                this.ajax_call.abort();
			            this.ajax_call = $.ajax({
			                dataType: 'json',
							data: {
			                    keyword: query,
			                    proveedor_id: $('#Proveedor.id').val()
			                },
			                url: cveartser_el.data('autocompleteUrl'),
				                success: function(data) {
			                    typeahead.process(data);
				                }
				            });
				        },
				        property: 'value',
				        onselect: function (obj) {
							$('#ServicioId').val(obj.id);
							$('#edtServicioCve').attr('title', obj.title);
							axAlert('<strong>'+obj.value+'</strong>'+'<br/>'+obj.title, 'info', false, 'Servicio');
							
	//						$('#ServicioPcosto').val(obj.pcosto);
				        }
				    });
				"), 
				array('inline'=>false)
				);
			?>

			</div>
			<div class="controls input">
			<input type="text" maxlength="8" id="edtServicioPCosto" name="data[ArticuloProveedor][ServicioPcosto]" 
			class="span2" placeholder="Costo..." title="Costo segun el proveedor especificado" />
			</div>
			<button id="submitServicio" class="btn" type="button"
			data-url="/Proveedores/addCostoArticulo"
			><i class="icon icon-plus-sign"></i> Agregar</button>
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
			<tr id="<?php e($item['ArticuloProveedor']['id']);?>" class="t-row">
				<td class="" title="<?php e($item['Articulo']['ardescrip'])?>"><?php e($item['Articulo']['arcveart'])?></td>
				<td class="precio">
					<input type="text" 
						class="cant bluraction detailCosto" 
						id="detailCosto_<?php e($item['ArticuloProveedor']['id'])?>"
						title="Especifica el Costo del Sevicio"
						placeholder="Costo..." 
						data-type="changeaction"
						data-url="/Proveedores/changeCosto" 
						data-id="<?php e($item['ArticuloProveedor']['id']) ?>" 
						data-value="<?php e(trim($item['Articulo']['arcveart']));?>"
						data-confirm=false 
						value="<?php e($item['ArticuloProveedor']['costo'])?>" 
					/>
				</td>
				<td class="fecha">NO</td>
				<td class=""><button type="button" class="btn btn-mini clickaction detailDelete"
									id="btnDelete_<?php e($item['Articulo']['id']); ?>"
									data-type="clickaction"
									data-url="/Proveedores/deleteCostoArticulo" 
									data-id="<?php e($item['ArticuloProveedor']['id']); ?>" 
									data-value="<?php e(trim($item['Articulo']['arcveart'])); ?>"
									data-confirm="value" 
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
		<?php echo $this->Form->End();?>
	</div>
</div>

</div> <!-- AxAppController ends -->

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


// Add Detail Button Event

$this->Js->get('#submitMaterial')->event(
'click', "

var el=$('#'+this.id);
var theProveedorID=$('#ProveedorId').val();
var theCve=$('#edtMaterialCve').val();
var thePCosto=$('#edtMaterialPCosto').val();
var theUrl=el.data('url');

$.ajax({
	dataType: 'html', 
	type: 'post',
	url: theUrl+'/'+theProveedorID+'/cve:'+theCve+'/pcosto:'+thePCosto,
	success: function (data, textStatus) {
		if(data.substring(0,2)=='OK') {
			axAlert(data, 'success', false);
			$('#detailContentMaterialTable').load('/Proveedores/detailcostomaterial/'+theProveedorID);
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



// Add Detail Button Event::SERVICIOS

$this->Js->get('#submitServicio')->event(
'click', "

var el=$('#'+this.id);
var theProveedorID=$('#ProveedorId').val();
var theCve=$('#edtServicioCve').val();
var thePCosto = $('#edtServicioPCosto').val();
var theUrl =el.data('url');

$.ajax({
	dataType: 'html',
	type: 'post',
	url: theUrl+'/'+theProveedorID+'/cve:'+theCve+'/pcosto:'+thePCosto,
	success: function (data, textStatus) {
		if(data.substring(0,2)=='OK') {
			axAlert(data, 'success', false);
			$('#detailContentServicioTable').load('/Proveedores/detailcostoservicio/'+theProveedorID);
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

// Event for Changing an item's costo

$this->Js->get('.detailCosto')->event(
'blur', "
var el=$('#'+this.id);
var theID=el.data('id');
var theCve=el.data('value');
var theValue=el.val();
var theUrl=el.data('url');

if(!(theValue>0)) return;

$.ajax({
	dataType: 'html', 
	type: 'post',
	url: theUrl+'/'+theID+'?costo='+theValue,
	success: function (data, textStatus) {
		if(data=='OK') {
			axAlert('Insumo ' + theCve + ' Actualizado con Costo ' + theValue, 'success', false);
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