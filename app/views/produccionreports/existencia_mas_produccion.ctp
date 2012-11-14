<div class="code">
<?php echo $sql;?>
</div>

<?php 
$rows=0;
$totals=array();
for($i=0; $i<10; $i++) {
	$totals['t'.$i]=0;
}

?>
<div class="reportcontent">

<div class="reportheader">
<h1>Existencias Mas Produccion</h1>
<h2>Un reporte mas.</h2>
</div>

<table class="report produccion general" cellspacing="0" cellpadding="0">
<theader>
<tr>
	<th class="left">Producto</th>
	<?php for($i=0; $i<10; $i++): ?>
	<th class="right">T<?php echo ($i+1);?></th>
	<?php endfor; ?>
	<th class="right">Total</th>
</tr>
</theader>

<tbody>
<?php foreach($rs as $item): ?>
<?php $item=$item[0]; ?>
<tr>
	<td class="left span3"><?php echo $item['cveart'];?></td>
	<?php $itemTotals['total']=0; ?>	
	<?php for($i=0; $i<10; $i++): ?>
	<td class="right span1"><?php echo (int)$item['et'.$i];?></td>	
	<?php $itemTotals['total']+=$item['et'.$i]; ?>	
	<?php endfor;?>
	<td class="right span2"><?php echo $itemTotals['total'];?></td>		
</tr>

<?php
$rows++;
for($i=0; $i<10; $i++) {
	$totals['t'.$i]+=$item['et'.$i];
}
?>
<?php endforeach; ?>
</tbody>

<tfooter>
<tr>
	<th class="left"><?php echo "$rows registros."; ?></td>
	<?php for($i=0; $i<10; $i++): ?>
	<th class="right"><?php echo (int)$totals['t'.$i];?></th>
	<?php endfor; ?>
	<th class="right">&nbsp;</td>
</tr>
</tfooter>

</table>

<div class="reportfooter">

</div>

</div>