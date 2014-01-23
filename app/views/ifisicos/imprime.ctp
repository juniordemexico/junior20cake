<div id="divLayout" style="width: 10in; border:0px none; font-size: 12pt; margin: 0px; padding: 0px;">
	<h2>REPORTE DE INVENTARIO FISICO</h2>
	
	<table style="font-size: 8pt; width: 100%; margin: 0px; padding: 0px; border: 1px solid #000;" cellspacing="0" cellpadding="0">
		<thead>
			<tr style="text-align:left; background-color: #C0C0C0; font-weight: bold;"  rowspan="2">
				<th style="width: 12%;">Codigo</th>
				<th style="width: 12%;">Color</th>
				<th style="width: 6%;">ST</th>
				<th style="width: 46%; text-align: center;" colspan= "10">TALLAS</th>
				<th style="width: 12%;">Total</th>
				<th style="width: 12%;">Diferencia</th>
			</tr>
			<tr style="text-align:left; background-color: #C0C0C0; font-weight: bold;">
				<th></td>
				<th></td>
				<th></td>
				<th style="text-align:right;">T0</th>
				<th style="text-align:right;">T1</th>
				<th style="text-align:right;">T2</th>
				<th style="text-align:right;">T3</th>
				<th style="text-align:right;">T4</th>
				<th style="text-align:right;">T5</th>
				<th style="text-align:right;">T6</th>
				<th style="text-align:right;">T7</th>
				<th style="text-align:right;">T8</th>
				<th style="text-align:right;">T9</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $totales=array(
				't0_1'=>0, 't1_1'=>0, 't2_1'=>0, 't3_1'=>0, 't4_1'=>0,
				't5_1'=>0, 't6_1'=>0, 't7_1'=>0, 't8_1'=>0, 't9_1'=>0,
				't0_2'=>0, 't1_2'=>0, 't2_2'=>0, 't3_2'=>0, 't4_2'=>0,
				't5_2'=>0, 't6_2'=>0, 't7_2'=>0, 't8_2'=>0, 't9_2'=>0,
				'cant_1'=>0, 'cant_2'=>0, 'existencia'=>0
				);
			?>
			<?php foreach ($items as $item): ?>
			<tr style="text-align:left; background-color: #E0E0E0;" rowspan="3">
				<td><b><?php echo $item['Articulo']['arcveart']?></b></td>
				<td><b><?php echo $item['Color']['cve']?></b></td>
				<td><?php echo $item['Articulo']['arst']?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="text-align:right;"><b><?php echo $this->Number->format($item['Ifisico']['existencia']); ?></b></td>
				<td></td>
			</tr>
			<tr style="text-align:left;">
				<td></td>
				<td>Conteo 1</td>
				<td></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t0_1']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t1_1']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t2_1']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t3_1']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t4_1']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t5_1']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t6_1']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t7_1']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t8_1']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t9_1']?></td>
				<td style="text-align:right;"><b><?php echo $this->Number->format($item['Ifisico']['cant_1']); ?></b></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['existencia'] < 0 ? $this->Number->format(($item['Ifisico']['cant_1']) + ($item['Ifisico']['existencia'])) : $this->Number->format(($item['Ifisico']['cant_1']) - ($item['Ifisico']['existencia'])) ?></td>
			</tr>
			<tr style="text-align:left;">
				<td></td>
				<td>Conteo 2</td>
				<td></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t0_2']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t1_2']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t2_2']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t3_2']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t4_2']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t5_2']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t6_2']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t7_2']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t8_2']?></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['t9_2']?></td>
				<td style="text-align:right;"><b><?php echo $this->Number->format($item['Ifisico']['cant_2']); ?></b></td>
				<td style="text-align:right;"><?php echo $item['Ifisico']['existencia'] < 0 ? $this->Number->format(($item['Ifisico']['cant_2']) + ($item['Ifisico']['existencia'])) : $this->Number->format(($item['Ifisico']['cant_2']) - ($item['Ifisico']['existencia'])) ?></td>
			</tr>
			<?php
			$totales['t0_1']+=$item['Ifisico']['t0_1'];
			$totales['t1_1']+=$item['Ifisico']['t1_1'];
			$totales['t2_1']+=$item['Ifisico']['t2_1'];
			$totales['t3_1']+=$item['Ifisico']['t3_1'];
			$totales['t4_1']+=$item['Ifisico']['t4_1'];
			$totales['t5_1']+=$item['Ifisico']['t5_1'];
			$totales['t6_1']+=$item['Ifisico']['t6_1'];
			$totales['t7_1']+=$item['Ifisico']['t7_1'];
			$totales['t8_1']+=$item['Ifisico']['t8_1'];
			$totales['t9_1']+=$item['Ifisico']['t9_1'];
			$totales['cant_1']+=$item['Ifisico']['cant_1'];

			$totales['t0_2']+=$item['Ifisico']['t0_2'];
			$totales['t1_2']+=$item['Ifisico']['t1_2'];
			$totales['t2_2']+=$item['Ifisico']['t2_2'];
			$totales['t3_2']+=$item['Ifisico']['t3_2'];
			$totales['t4_2']+=$item['Ifisico']['t4_2'];
			$totales['t5_2']+=$item['Ifisico']['t5_2'];
			$totales['t6_2']+=$item['Ifisico']['t6_2'];
			$totales['t7_2']+=$item['Ifisico']['t7_2'];
			$totales['t8_2']+=$item['Ifisico']['t8_2'];
			$totales['t9_2']+=$item['Ifisico']['t9_2'];
			$totales['cant_2']+=$item['Ifisico']['cant_2'];

			$totales['existencia']+=$item['Ifisico']['existencia'];

			?>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr style="text-align:left; background-color: #C0C0C0; font-weight: bold;">
				<th></td>
				<th></td>
				<th></td>
				<th style="text-align:right;"><?php echo $totales['t0_1']?></th>
				<th style="text-align:right;"><?php echo $totales['t1_1']?></th>
				<th style="text-align:right;"><?php echo $totales['t2_1']?></th>
				<th style="text-align:right;"><?php echo $totales['t3_1']?></th>
				<th style="text-align:right;"><?php echo $totales['t4_1']?></th>
				<th style="text-align:right;"><?php echo $totales['t5_1']?></th>
				<th style="text-align:right;"><?php echo $totales['t6_1']?></th>
				<th style="text-align:right;"><?php echo $totales['t7_1']?></th>
				<th style="text-align:right;"><?php echo $totales['t8_1']?></th>
				<th style="text-align:right;"><?php echo $totales['t9_1']?></th>
				<th style="text-align:right;"><b><?php echo $this->Number->format($totales['cant_1'])?></b></th>
				<th></th>
			</tr>
			<tr style="text-align:left; background-color: #C0C0C0; font-weight: bold;">
				<th></td>
				<th></td>
				<th></td>
				<th style="text-align:right;"><?php echo $totales['t0_2']?></th>
				<th style="text-align:right;"><?php echo $totales['t1_2']?></th>
				<th style="text-align:right;"><?php echo $totales['t2_2']?></th>
				<th style="text-align:right;"><?php echo $totales['t3_2']?></th>
				<th style="text-align:right;"><?php echo $totales['t4_2']?></th>
				<th style="text-align:right;"><?php echo $totales['t5_2']?></th>
				<th style="text-align:right;"><?php echo $totales['t6_2']?></th>
				<th style="text-align:right;"><?php echo $totales['t7_2']?></th>
				<th style="text-align:right;"><?php echo $totales['t8_2']?></th>
				<th style="text-align:right;"><?php echo $totales['t9_2']?></th>
				<th style="text-align:right;"><b><?php echo $this->Number->format($totales['cant_2'])?></b></th>
				<th></th>
			</tr>
			<tr style="text-align:left; background-color: #C0C0C0; font-weight: bold;">
				<th></td>
				<th></td>
				<th></td>
				<th style="text-align:right;">&nbsp;</th>
				<th style="text-align:right;">&nbsp;</th>
				<th style="text-align:right;">&nbsp;</th>
				<th style="text-align:right;">&nbsp;</th>
				<th style="text-align:right;">&nbsp;</th>
				<th style="text-align:right;">&nbsp;</th>
				<th style="text-align:right;">&nbsp;</th>
				<th style="text-align:right;">&nbsp;</th>
				<th style="text-align:right;">&nbsp;</th>
				<th style="text-align:right;">&nbsp;</th>
				<th style="text-align:right;"><?php echo $this->Number->format($totales['existencia'])?></th>
				<th></th>
		</tfoot>
	</table>
</div>