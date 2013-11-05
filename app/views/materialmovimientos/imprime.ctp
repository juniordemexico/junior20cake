<header>
<div class="page-header">
<h1><small>Movimiento de Almacén <strong class="text-info"><?php echo $data['Materialmovimientos']?></strong></small></h1>
</div>
</header>

<pre>
	<?php print_r($data['Master']);?>
</pre>

<pre>
	<?php print_r($data['Details']);?>
</pre>

<div class="row">
	<div class="span5">
	<div class="control-group">
		<label for="EntsalRefer" class="control-label">Folio:</label>
		<div class="controls input">
			<input type="text" id="EntsalRefer" name="data[Entsal][esrefer]" field="Entsal.esrefer"
				data-ng-readonly="true" readonly="true"
				data-ng-model="data.Master.esrefer"
				data-ng-minlength="1" data-ng-maxlength="8" data-ng-required="true"
				class="date readonly" placeholder="Folio..." title="Proporciona el Folio de la transacción" />
		</div>
	</div>
	<div class="control-group">
		<label for="EntsalEsfecha" class="control-label">Fecha:</label>
		<div class="controls input">
			<input type="text" id="EntsalEsfecha" name="data[Entsal][esfecha]" field="Entsal.esfecha"
				data-ui-date data-ui-date-format="yy-mm-dd"
				data-ng-model="data.Master.esfecha" data-ng-required="true"
				class="date" placeholder="Fecha..." title="Proporciona la Fecha de la transacción" />
		</div>
	</div>
	<div class="control-group">
		<label for="EntsalAlmacen_id" class="control-label">Almacén:</label>
		<div class="controls input">
			<select id="EntsalAlmacen_id" name="data[Entsal][almacen_id]"
				field="Entsal.almacen_id"
				class="span2"
				data-ng-model="data.Master.almacen_id"
				data-ng-options="i.id as i.cve for i in related.Almacen"
				data-ng-required="true">
			</select>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Estatus:</label>
		<div class="controls group">
		<div class="btn-group">
			<button type="button" id="EntsalStA" class="btn" data-ng-class="{'btn-success': data.Master.st==app.estatus.Activo}" name="data[Entsal][st]" data-ng-model="data.Master.st" data-btn-radio="'A'" data-ng-disabled="data.Master.st==estatus.Cancelado">Activo</button>
			<button type="button" id="EntsalStC" class="btn" data-ng-class="{'btn-danger': data.Master.st==app.estatus.Cancelado}" name="data[Entsal][st]" data-ng-model="data.Master.st" data-btn-radio="'C'" data-ng-disabled="data.Master.st==estatus.Activo">Cancelado</button>
		</div>
		</div>
	</div>

	<div class="control-group">
		<label for="EntsalOcompra_refer" class="control-label">Referencia Compra:</label>
		<div class="controls input">
			<input type="text" id="EntsalOcompra_refer" name="data[Entsal][ocompra_refer]" field="Entsal.ocompra_refer"
				class="span2"
				data-ng-model="data.Master.ocompra_refer"
				data-ng-minlength="0" data-ng-maxlength="8"
				class="date" placeholder="Folio..." title="Si este movimiento corresponde a una Orden de Compra, proporciona su Folio." />
		</div>
	</div>

	<div class="control-group">
		<label for="EntsalOproduce_refer" class="control-label">Referencia Órden de Prod:</label>
		<div class="controls input">
			<input type="text" id="EntsalOproduce_refer" name="data[Entsal][oproduce_refer]" field="Entsal.oproduce_refer"
				class="span2"
				data-ng-model="data.Master.oproduce_refer"
				data-ng-minlength="0" data-ng-maxlength="8"
				class="date" placeholder="Folio..." title="Si este movimiento corresponde a una Órden de Producción, proporciona su Folio." />
		</div>
	</div>

	</div> <!-- div.span -->
	<div class="span1">&nbsp;</div>

	<div class="span5">

	<div class="control-group">
		<label for="EntsalTipoartmovbodega_id" class="control-label">Tipo de Mov:</label>
		<div class="controls input">
			<select id="EntsalTipoartmovbodega_id" name="data[Entsal][tipoartmovbodega_id]"
				field="Entsal.tipoartmovbodega_id"
				class="span3"
				data-ng-model="data.Master.tipoartmovbodega_id"
				data-ng-options="i.id as i.cve for i in related.Tipoartmovbodega"
				data-ng-required="true">
			</select>
		</div>
	</div>
	<div class="control-group">
		<label for="EntsalEsconcep" class="control-label">Concepto:</label>
		<div class="controls input">
			<input type="text" id="EntsalEsconcep" name="data[Entsal][esconcep]" field="Entsal.esconcep"
				data-ng-model="data.Master.esconcep" ng-required="true"
				data-ng-minlength="1" data-ng-maxlength="32" data-ng-required="true"
				class="span3" placeholder="Concepto..." title="Concepto de la transacción" />
		</div>
	</div>
	<div class="control-group">
		<label for="CompraObser" class="control-label">Observaciones:</label>
		<div class="controls input">
			<textarea name="data[Entsal][obser]" field="Entsal.Obser" maxlength="255"
				class="span3" cols="20" rows="2" id="EntsalObser"
				data-ng-model="data.Master.esobser"
				data-ng-minlength="0" data-ng-maxlength="255"
				placeholder="Observaciones..."
			></textarea>
		</div>
	</div>

	</div> <!-- div.span5 -->

</div>


		<div class="toolbar well well-small" data-ng-hide="data.Master.id>0">
			<input class="span3" data-ng-model="currentItem.Articulo"
				data-ui-select2="fieldItem" data-ui-event="{ change : 'getItemByCve()' }" 
				data-item-placeholder="Código del Material..."
				title="Proporciona el Código del Material ({{currentItem.Articulo.ardescrip}})" />

			<select class="span3" data-ng-model="currentItem.Color" 
				data-ng-options="c.cve for c in currentItem.ArticuloColor" 
				title="Elige el Color del Material" />
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" maxlength="8" data-ng-model="currentItem.cant"
				data-ng-minlength="1" data-ng-maxlength="10"
				class="cant" placeholder="Cant..." title="Especifica la cantidad" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn" type="button" data-ng-click="addCurrentItem()" 
				data-ng-disabled="(!(currentItem.Articulo.id>0)||!(currentItem.cant>0))">
				<i class="icon icon-plus-sign"></i> Agregar
			</button>
		</div>

		<div id="detailContentTable">
		<table class="table table-condensed table-bordered table-hover ax-detail-table">
			<thead>
			<tr>
				<th class="span2">Material</th>
				<th class="span2">Color</th>
				<th class="">Descripción</th>
				<th class="cant">Cant</th>
				<th class="span1">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="i in data.Details" data-detail-id="{{i.Detail.id}}" class="item-row">
				<td class="span2">{{i.Articulo.arcveart}}</td>
				<td class="span2">{{i.Color.cve}}</td>
				<td class="">{{i.Articulo.ardescrip}}</td>
				<td class="cant">{{i.Detail.esdt0}}</td>
				<td class="span1">
					<button type="button" class="btn btn-mini ax-btn-detail-delete"
							data-ng-click="detailDelete($index, i, true)"
							data-ng-hide="data.Master.id>0">
							<i class="icon icon-trash"></i>
					</button>
				</td>
			</tr>
			</tbody>
		</table>
		</div>



<script language="javascript">

</script>
