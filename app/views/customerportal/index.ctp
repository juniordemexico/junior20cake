<h2>BIENVENIDO: <b><?php echo $session->read('Auth.User.username');?></b></h2>

<h3>Opciones</h3>
<ul style="font-size: 125%; color: blue;">
	<li><?php echo $this->Js->Link('Facturas','/customerportal/facturas',array('update'=>'#customercontent'));?></li>
	<li><?php echo $this->Js->Link('Pedidos','/customerportal/pedidos',array('update'=>'#customercontent'));?></li>
	<li><?php echo $this->Html->Link('SALIR','/users/logout');?></li>
</ul>
<br/>
<div id="customercontent" style="border: 1px solid black;width:90%;height:380px; margin: 4px; padding: 4px;overflow: hidden;">
</div>