<?php 
$rows=0;
$totals=array();
$totals['oooccant']=0;
$totals['oococant']=0;
$totals['ooentcant']=0;

?>
<div class="report letter-portrait">
	
<div class="reportheader">
<h1>Informe General de Produccion</h1>
<h2>Resumen de Ordenes de Corte, Cortes, Entregas.</h2>
</div>

<div class="reportcontent">

<table class="report produccion general" cellspacing="0" cellpadding="0">
<theader>
<tr class="header ">
	<th>&nbsp;</th>
	<th>&nbsp;</th>
	<th>&nbsp;</th>
	<th>&nbsp;</th>
	<th>&nbsp;</th>
	<th colspan="3" class="colspan">Orden</th>
	<th colspan="3" class="colspan">Corte</th>
	<th colspan="2" class="colspan">Entrega</th>
</tr>
<tr>
	<th class="left span2">Folio</th>
	<th class="left">Producto</th>
	<th class="left span1">Linea</th>
	<th class="left span1">Maqui</th>
	<th class="center span0">ST</th>
	<th class="left span2">Fecha</th>
	<th class="right span1">Prom</th>
	<th class="right span2">Unidades</th>
	<th class="left span2">Fecha</th>
	<th class="right span1">Trazo</th>
	<th class="right span2">Unidades</th>
	<th class="left span2">Fecha</th>
	<th class="right span2">Unidades</th>
</tr>
</theader>

<tbody>
<?php foreach($rs as $item): ?>
<tr>
	<td class="left span2"><?php echo $item['Corte']['oorefer'];?></td>
	<td class="left"><?php echo $item['Corte']['articulo_cve'];?></td>
	<td class="left span1"><?php echo $item['Linea']['linea_cve'];?></td>
	<td class="left span1"><?php echo $item['Corte']['oocvepromaq'];?></td>
	<td class="center span0"><?php echo $item['Corte']['oost'];?></td>
	<td class="left span2"><?php echo substr($item['Corte']['ooocfecha'],2,8);?></td>
	<td class="right span1"><?php echo $item['Corte']['oooctrazo'];?></td>
	<td class="right span2"><?php echo (int)$item['Corte']['oooccant'];?></td>
	<td class="left span2"><?php echo substr($item['Corte']['oocofecha'],2,8);?></td>
	<td class="right span1"><?php echo (int)$item['Corte']['oocotrazo'];?></td>
	<td class="right span2"><?php echo (int)$item['Corte']['oococant'];?></td>
	<td class="left span2"><?php echo substr($item['Corte']['oofuentrada'],2,8);?></td>
	<td class="right span2"><?php echo (int)$item['Corte']['ooentcant'];?></td>
</tr>

<?php
$rows++;
$totals['oooccant']+=$item['Corte']['oooccant'];
$totals['oococant']+=$item['Corte']['oococant'];
$totals['ooentcant']+=$item['Corte']['ooentcant'];
?>
<?php endforeach; ?>
</tbody>

<tfooter>
<tr>
	<th class="left">TOTALES</td>
	<th class="left">(<?php echo $rows;?> registros)</td>
	<th class="left">&nbsp;</td>
	<th class="left">&nbsp;</td>
	<th class="left">&nbsp;</td>
	<th class="left">&nbsp;</td>
	<th class="left">&nbsp;</td>
	<th class="right"><?php echo $totals['oooccant'];?></td>
	<th class="left">&nbsp;</td>
	<th class="left">&nbsp;</td>
	<th class="right"><?php echo $totals['oococant'];?></td>
	<th class="left">&nbsp;</td>
	<th class="right"><?php echo $totals['ooentcant'];?></td>
</tr>
</tfooter>

</table>

</div>

<div class="reportfooter">
<table>
<tr class="footercompany">
<td></td>
<td>Junior de Mexico, S.A. de C.V.</td>
<td></td>
</tr>
<tr class="footerrequest">
<td>Generado: <?php echo date('Y-m-d H:i:s')?></td>
<td>Usuario: <?php echo $session->read('Auth.User.username');?> &nbsp;&nbsp;&nbsp;&nbsp;
	Grupo(<?php echo $session->read('Auth.User.group_id');?>)</td>
<td>Url: <?php echo $this->params['url'];?></td>
</tr>
<tr class="footeridd">
<td>Soporte Técnico: <a href="mailto:idd.mex@gmail.com">idd.mex@gmail.com</a></td>
<td>AX<strong>BOS</strong> :: <strong>B</strong>ussiness <strong>O</strong>perative <strong>S</strong>ystem</td>
<td>©2009-2012 Ingeniería de Datos (México)</td>
</tr>
</table>
</div>

<div class="code">
<?php echo $sql;?>
</div>

</div> <!-- div class report -->
