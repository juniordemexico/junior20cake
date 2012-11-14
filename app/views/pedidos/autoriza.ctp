<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div id="gridWrapper">
<?php 
echo $form->create('Pedido',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed" cellspacing="0">
		<thead>
			<tr id="trFilter">
				<th class="refer"><?php echo $form->text('perefer', array('label' => '', 'type' => 'search', 'placeholder' => 'Folio', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('pefecha',array('label' => '', 'type' => 'search', 'placeholder' => 'Fecha', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('pefvence',array('label' => '', 'type' => 'search', 'placeholder' => 'Entrega', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('Cliente.clcvecli',array('label' => '', 'type' => 'search', 'placeholder' => 'Cliente', 'class' => 'search-query'));?></th>
				<th class="tda"><?php echo $form->text('Cliente.cltda',array('label' => '', 'type' => 'search', 'placeholder' => 'Tda', 'class' => 'search-query'));?></th>
				<th class="cveven"><?php echo $form->text('Vendedor.vecveven', array('label' => '', 'type' => 'search', 'placeholder' => 'Vend', 'class' => 'search-query'));?></th>
				<th class="total"><?php echo $form->text('petotal',array('label' => '', 'type' => 'search', 'placeholder' => 'Total', 'class' => 'search-query'));?></th>
				<th class="total">&nbsp;</th>
				<th class="date">&nbsp;</th>
				<th class="st"><?php echo $form->text('peauto',array('label' => '', 'type' => 'search', 'placeholder' => 'Aut', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr>
				<th class="refer"><?php echo $this->Paginator->sort('Folio','perefer'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Fecha','pefecha'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Vence','pefvence'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Cte','Cliente.clcvecli'); ?></th>
				<th class="tda"><?php echo $this->Paginator->sort('Tda','Cliente.cltda'); ?></th>
				<th class="cveven"><?php echo $this->Paginator->sort('Vend','Vendedor.vecveven'); ?></th>
				<th class="total"><?php echo $this->Paginator->sort('Total','petotal'); ?></th>
				<th class="total"><?php echo $this->Paginator->sort('Saldo','saldo'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('FUV','pefvence'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('Aut','peauto'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($pedidos as $pedido):
			$class = null;
			$thisID=trim($pedido['Pedido']['id']);
		?>
			<tr id="<?php echo $thisID?>" folio="<?php echo $pedido['Pedido']['perefer']; ?>" class="t-row">
				<td class="refer" rel="popover" data-trigger="hover" data-content="ASDASDASD asdASDAD ASD ASD ASDAS" data-original-title="<?php e("Pedido ".$pedido['Pedido']['perefer']);?>"><?php echo $pedido['Pedido']['perefer']; ?></td>
				<td class="date"><?php echo substr($pedido['Pedido']['pefecha'],0,10); ?></td>
				<td class="date"><?php echo substr($pedido['Pedido']['pefvence'],0,10); ?></td>
				<td class="" title="<?php echo $pedido['Cliente']['clnom']; ?>"><?php echo $pedido['Cliente']['clcvecli']; ?></td>
				<td class="tda" title="<?php echo trim($pedido['Cliente']['clsuc']); ?>"><?php echo $pedido['Cliente']['cltda']; ?></td>
				<td class="cveven" title="<?php echo $pedido['Vendedor']['venom']; ?>"><?php echo $pedido['Vendedor']['vecveven']; ?></td>
				<td class="total"><?php echo $this->Number->currency($pedido['Pedido']['pedido__petotal']); ?></td>
				<td class="total"><?php echo $this->Number->currency($pedido[0]['saldo']); ?></td>
				<td class="date"><?php echo substr($pedido['Pedido']['pefvence'],0,10); ?></td>
				<td class="date pefauto">
									<?php if (isset($pedido['Pedido']['pefauto']) &&
				 							!empty($pedido['Pedido']['pefauto'])) {
											echo substr($pedido['Pedido']['pefauto'],0,10);
										}
										elseif(empty($pedido['Pedido']['pefauto'])) {
											echo '<a class="pefauto btn btn-mini" data-toggle="modal" href="#dialogPedidoAutoriza" ><i class="icon-ok"></i></a>';
										}
									?>
				</td>
				<td class="id" title="<?php echo 'Creado: '.$pedido['Pedido']['crefec'].'.'; ?>"><?php echo $pedido['Pedido']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div>
</div>

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Cliente','MyRowClickAction' => 'edit')); ?>

<div id="dialogPedidoAutoriza">
	<form id="PedidoAutoriza" action="/Pedidos/autoriza" method="POST" onsubmit="return false;">
	<div id="dialogMessagesPedidoAutoriza"></div>
	<?php echo $this->Form->hidden('PedidoAutoriza.id'); ?>
	<?php echo $this->Form->hidden('PedidoAutoriza.perefer'); ?>
	<span><strong>Autorizar Pedido <span id="PedidoAutorizaFolio" style="font-weight: bold;"></span> ?</strong></span>
	</form>
</div>

</div> <!-- index-form -->

<?php

$this->Js->get('.pefauto')->event(
'click',
'
$( "#PedidoAutorizaId" ).val(this.parentElement.parentElement.id);
$( "#PedidoAutorizaFolio" ).html( $(this.parentElement.parentElement).attr("folio") );
$( "#dialogPedidoAutoriza" ).dialog( "open" );
'
, array('stop' => true));

?>

<script>

$( "#dialogPedidoAutoriza" ).dialog({
			autoOpen: false,
			width: 280,
			height: 180,
   			position: ["center","center"], 
			zIndex: 999999,
			modal: true,
			stack: true,
			resizable: false,
			hide: 'fade',
			show: 'fade',
			autoOpen: false,
			draggable: false,
			rezisable: false,
			title: '<i class="icon icon-question"></i> Autorizacion de Pedido',
			buttons: {
				"Autorizar": function() {
					$.ajax({
						dataType:"html", 
						type:"post", 
						data:$("#PedidoAutoriza").serialize(), 
						url:"\/Pedidos\/autoriza",
						success:function (data, textStatus) {
							$("#dialogMessagesPedidoAutoriza").html(data);
							if(data!="Error" && data!="") {
								$("#"+$( "#PedidoAutorizaId" ).val()+" TD.pefauto" ).html($( "#dialogMessagesPedidoAutoriza").html());			
								$( "#dialogPedidoAutoriza" ).dialog( "close" );
							}
						}, 
					});
				},
				Cerrar: function() {
					$( this ).dialog( "close" );
				}
			},
			open: function() {
			},
			close: function() {
				$( "#dialogMessagesPedidoAutoriza").html('');
				$( "#PedidoAutorizaId" ).val('');
				$( "#PedidoAutorizaPerefer" ).val('');
				$( "#PedidoAutorizaFolio" ).html('');
			}
		});
</script>
