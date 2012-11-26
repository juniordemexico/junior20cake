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
