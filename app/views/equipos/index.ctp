<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div id="gridWrapper">
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr>
				<th class="vendedor cve"><?php echo $this->Paginator->sort('Clave','vecveven'); ?></th>
				<th class="vendedor nom"><?php echo $this->Paginator->sort('Nombre','venom'); ?></th>
				<th class="vendedor st"><?php echo $this->Paginator->sort('ST','vest'); ?></th>
				<th class="vendedor id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($vendedores as $vendedor):
			$class = null;
			$thisID=trim($vendedor['Vendedor']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class="vendedor cve"><?php echo $vendedor['Vendedor']['vecveven']; ?></td>
				<td class="vendedor nom"><?php echo $vendedor['Vendedor']['venom']; ?></td>
				<td class="vendedor st"><?php echo $vendedor['Vendedor']['vest']; ?></td>
				<td class="vendedor id"><?php echo $vendedor['Vendedor']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Vendedor','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>


<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
