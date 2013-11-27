
<div class="container">

<div class="header">
<h1>N/CREDITO <?php echo $data['Master']['ncrefer'];?>   </h1>
</div>

<div class="body">
<?php foreach($data['Details'] as $item):?>
<table>
	<thead>
	<tr>
		<th>CODIGO</th>
		<th>DESCRIPCION</th>
		<th>CANTIDAD</th>
	</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $item['Articulo']['arcveart']?></td>
			<td><?php echo $item['Articulo']['ardescrip']?></td>
			<td><?php echo $item['Detail']['ncdcant']?></td>
		</tr>
	</tbody>
	<tfoot>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th>tot pzas</th>
	</tfoot>
</table>
<?php endforeach;?>
</div>

<div class="footer">
<h1>TERMINA FACTURA</h1>
</div>

</div>

<?php
echo "ESTA ES LA VISTA PARA IMPRESION";

pr($data);
?>


