<ul>
	<li><a class="returnFalse" href="">Catálogos</a>	
		<ul>
			<li class="divider dividerhead"><a class="returnFalse" href="">Maestros</a>
			<li><a id="directoriosLinkCheck" href="/Directorios">Directorio General</a></li>
			<li><a id="clientesLinkCheck" href="/Clientes">Clientes</a></li>
			<li><a id="proveedoresLinkCheck" href="/Proveedores">Proveedores</a></li>
			<li><a id="vendedoresLinkCheck" href="/Vendedores">Vendedores</a></li>
			<li><a id="contactosLinkCheck" href="/Contactos">Contactos</a></li>
			<li class="divider dividerhead"><a class="returnFalse" href="">Inventario</a>
			<li><a id="articulosLinkCheck" href="/Articulos">Articulos</a></li>
			<li><a id="articulosArchivosLinkCheck" href="/Articulos/archivos">Imagenes/Archivos Articulos</a></li>
			<li><a id="materialesLinkCheck" href="/Materiales">Materiales</a></li>
			<li><a id="materialesArchivosLinkCheck" href="/Materiales/archivos">Imagenes/Documentos Materiales</a></li>
			<li><a id="materialproveedorCostosLinkCheck" href="/Proveedor/costos">Costos por Material/Proveedor</a></li>
			<li><a id="coloresLinkCheck" href="/Colores">Colores</a></li>
			<li><a id="lineasLinkCheck" href="/Lineas">Lineas</a></li>
			<li><a id="marcasLinkCheck" href="/Marcas">Marcas</a></li>
			<li><a id="temporadasLinkCheck" href="/Temporadas">Temporadas</a></li>
			<li><a id="tallasLinkCheck" href="/Tallas">Tallas</a></li>
			<li><a id="proporcionesLinkCheck" href="/Proporciones">Proporciones Prod</a></li>
			<li class="divider dividerhead"><a class="returnFalse" href="">Auxiliares</a></li>
			<li><a id="paisesLinkCheck" href="/Paises">Paises</a></li>
			<li><a id="estadosLinkCheck" href="/Estados">Estados</a></li>
			<li><a id="unidadesLinkCheck" href="/Unidades">Unidades de Medida</a></li>
			<li class="divider dividerhead"><a class="returnFalse" href="">Financieros</a></li>
			<li><a id="divisasLinkCheck" href="/Divisas">Divisas</a></li>
			<li><a id="divisasLinkCheck" href="/TipoCambio">Tipos de Cambio</a></li>
			<li><a id="divisasLinkCheck" href="/TipoCambio">Usuario:<?php echo $session->read('Auth.User.username');?> Grupo:<?php echo $session->read('Auth.User.group_id');?></a></li>
		</ul>
	</li>
	<li><a class="returnFalse" href="">Almacén</a>	
		<ul>
			<li class="divider dividerhead"><a class="returnFalse" href="">Movimientos</a>
			<li><a id="almacenLinkCheck" href="/Almacen">Entradas/Salidas</a></li>
			<li><a id="articulosexistenciasLinkCheck" href="/Articulos/existencias">Existencias</a></li>
		</ul>
	</li>
	<li><a class="returnFalse" href="">Ventas</a>	
		<ul>
			<li class="divider dividerhead"><a class="returnFalse" href="">Movimientos</a>
			<li><a id="articulospreciosLinkCheck" href="/Articulos/precios">Lista de Precio y Exist</a></li>
			<li><a id="pedidosLinkCheck" href="/Pedidos">Pedidos</a></li>
			<li><a id="facturasLinkCheck" href="/Facturas">Facturas</a></li>
			<li><a id="ncreditoLinkCheck" href="/Ncredito">Notas de Crédito</a></li>
			<li><a id="ncargoLinkCheck" href="/Ncargo">Notas de Cargo</a></li>
			<li class="divider dividerhead"><a class="returnFalse href="">Logistica Ventas</a></li>
			<li><a id="facturaembarqueLinkCheck" href="/Facturas/embarque">Embarque de Facturas</a></li>
			<li><a id="facturaentregaLinkCheck" href="/Facturas/entrega">Entrega de Facturas</a></li>
			<li><a id="facturaselectronicasLinkCheck" href="/FacturaElectronica">Facturas Electrónicas</a></li>
			<li class="divider dividerhead"><a class="returnFalse href="">Informes</a></li>
			<li><a id="pedidosInformesLinkCheck" href="/Pedidos">Pedidos</a></li>
			<li><a id="facturasLinkCheck" href="/Facturas">Facturas</a></li>
		</ul>
	</li>
	<li><a class="returnFalse" href="">C x C</a>	
		<ul>
			<li class="divider dividerhead"><a class="returnFalse" href="">Movimientos</a>
			<li><a id="pedidosautorizaLinkCheck" href="/Pedidos/autorizacion">Autorizacion de Pedidos</a></li>
			<li class="divider dividerhead"><a class="returnFalse href="">Informes</a></li>
			<li><a id="cxcInformesLinkCheck" href="/cxc/">Estado de Cuenta</a></li>
		</ul>
	</li>
	<li><a class="returnFalse" href="">Compras</a>	
		<ul>
			<li class="divider dividerhead"><a class="returnFalse" href="">Movimientos</a>
			<li><a id="ocompraLinkCheck" href="/Pedidos">Ordenes de Compra</a></li>
			<li><a id="compraLinkCheck" href="/Pedidos">Recepción de Compra</a></li>
			<li><a id="ncreditopLinkCheck" href="/ncredito">Notas de Crédito</a></li>
			<li><a id="ncargopLinkCheck" href="/ncredito">Notas de Cargo</a></li>
			<li class="divider dividerhead"><a class="returnFalse href="">Informes</a></li>
			<li><a id="lineasLinkCheck" href="/Lineas">Pedidos</a></li>
			<li><a id="marcasLinkCheck" href="/Marcas">Facturas</a></li>
			<li><a id="temporadasLinkCheck" href="/Temporadas">Notas de Credito</a></li>
		</ul>
	</li>
	<li><a class="returnFalse" href="">C x P</a>	
		<ul>
			<li class="divider dividerhead"><a class="returnFalse" href="">Movimientos</a>
			<li><a id="cxpautorizaLinkCheck" href="/Pedidos/autorizacion">Autorizacion de Ordenes</a></li>
			<li class="divider dividerhead"><a class="returnFalse href="">Informes</a></li>
			<li><a id="cxpInformesLinkCheck" href="/cxp/">Estado de Cuenta</a></li>
		</ul>
	</li>
	<li><a class="returnFalse" href="">Ver</a>
		<ul>		
			<li><a id="cascadeLink" href="">Ordenar en Cascada</a></li>
			<li><a id="tileLink" href="">Ordenar en Cuadrícula</a></li>
			<li class="divider"><a id="minimizeLink" href="">Minimizar Todo</a></li>
			<li><a id="closeLink" href="">Cerrar Todo</a></li>
		</ul>
	</li>
	<li><a class="returnFalse" href="">Herramientas</a>
		<ul>
		<li class="divider dividerhead"><a class="returnFalse" href="">Administracion de Proyecto</a></li>						
		<li><a id="sistemasplaneacionLinkCheck" href="/sistemas/planeacion" target="_blank">Objectivos</a></li>
		<li><a id="sistemasinformesLinkCheck" href="/sistemas/informes" target="_blank">Informes</a></li>
		<li class="divider dividerhead"><a class="returnFalse" href="">Operación</a></li>						
		<li><a id="monitorLinkCheck" href="/monitors">Monitores</a></li>
		<li><a id="historyLinkCheck" href="/history">Historiales</a></li>
		<li class="divider dividerhead"><a class="returnFalse" href="">Widgets</a></li>						
			<li><a id="clockLinkCheck" href="plugins/coolclock/">Widget: Clock</a></li>
			<li><a id="calculatorLinkCheck" href="plugins/calculator/">Widget: Calculator</a></li>
			<li><a id="builderLinkCheck" href="plugins/windowform/">Contructor de Ventanas</a></li>
		</ul>
	</li>
	<li>
		<a class="returnFalse" href="">Escritorio</a>
		<ul>
			<li><a id="saveWorkspaceLink" href="">Guardar Escritorio</a></li>
			<li><a id="loadWorkspaceLink" href="">Cargar Escritorio</a></li>
			<li class="divider"><a id="toggleEffectsLinkCheck" href="#">Usar Efectos</a></li>				
		</ul>
	</li>
	<li><a class="returnFalse" href="">Ayuda</a>
		<ul>
			<li><a id="featuresLinkCheck" href="pages/features.html">Caracteristicas</a></li>
			<li class="divider"><a target="_blank" href="http://mochaui.com/docs/">Documentación</a></li>
			<li class="divider"><a id="aboutLink" href="pages/about.html">Acerca de...</a></li>
			<li><a id="featuresLinkCheck" href="pages/features.html">Extras</a></li>
			<li><a id="accordiantestLinkCheck" href="pages/accordian-demo.html">Acordeón</a></li>
			<li class="divider"><a class="returnFalse arrow-right" href="">Tests</a>
				<ul>								
					<li><a id="windoweventsLinkCheck" href="pages/events.html">Window Events</a></li>
					<li><a id="containertestLinkCheck" href="pages/lipsum.html">Container Test</a></li>
					<li><a id="iframetestLinkCheck" href="pages/iframetests.html">Iframe Tests</a></li>
					<li><a id="noCanvasLinkCheck" href="pages/lipsum.html">No Canvas Body</a></li>
				</ul>
			</li>
			<li class="divider"><a class="returnFalse arrow-right" href="">Starters</a>
				<ul>
					<li><a target="_blank" href="index.html">Web Application</a></li>
					<li><a target="_blank" href="demo-fixed-width.html">Fixed Width</a></li>
					<li><a target="_blank" href="demo-no-toolbars.html">No Toolbars</a></li>
					<li><a target="_blank" href="demo-no-desktop.html">No Desktop</a></li>
					<li><a target="_blank" href="demo-modal-only.html">Modal Only</a></li>
				</ul>
			</li>
		</ul>
	</li>
</ul>
