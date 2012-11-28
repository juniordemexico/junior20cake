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
				<td class="precio"><?php e($item['ArticuloProveedor']['costo'])?></td>
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
