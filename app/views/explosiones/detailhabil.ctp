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
