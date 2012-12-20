<h2>Etiquetas ubicaciones EPL2</h2>
<ul>
<?php foreach($items as $item): ?>
	<li data-item-id="<?php e($item['id'])?>">
		<strong><?php e($item['cve'])?></strong>
		<small><?php e($item['descrip'])?></small>
	</li>
<?php endforeach;?>
</ul>

<hr/>

<em>Respuesta del servidor de impresion:</em>
<code class="pre">
<?php echo $shellout; ?>
</code>

<hr/>

<code class="pre">
<?php echo $content; ?>
</code>
