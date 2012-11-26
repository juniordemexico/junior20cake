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
