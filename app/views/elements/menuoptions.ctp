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
						<li><a id="serviciosLinkCheck" href="/Servicios">Servicios</a></li>
						<li><a id="serviciosArchivosLinkCheck" href="/Servicios/servicios">Imagenes/Documentos Servicios</a></li>
						<li><a id="materialproveedorCostosLinkCheck" href="/Proveedores/costos">Costos por Material/Proveedor</a></li>
						<li><a id="articuloExplosionLinkCheck" href="/Explosiones">Explosion</a></li>
						<li><a id="articuloCosteosLinkCheck" href="/Costeos">Costeos x Explosion</a></li>
						<li><a id="coloresLinkCheck" href="/Colores">Colores</a></li>
						<li><a id="lineasLinkCheck" href="/Lineas">Lineas</a></li>
						<li><a id="marcasLinkCheck" href="/Marcas">Marcas</a></li>
						<li><a id="temporadasLinkCheck" href="/Temporadas">Temporadas</a></li>
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
<li><a class="returnFalse" href="">Producción</a>	
	<ul>
		<li class="divider dividerhead"><a class="returnFalse" href="">Catálogos</a></li>
		<li><a id="coloresLinkCheck" href="/Colores" target="_new">Colores</a></li>
		<li><a id="marcasLinkCheck" href="/Tallas" target="_new">Tallas</a></li>
		<li><a id="temporadasLinkCheck" href="/Temporadas" target="_new">Temporadas</a></li>
		<li><a id="proporcionesLinkCheck" href="/Proporciones" target="_new">Proporciones</a></li>
		<li><a id="familiasLinkCheck" href="/Familias" target="_new">Familias</a></li>
		<li><a id="basesLinkCheck" href="/Bases" target="_new">Bases</a></li>
		<li><a id="estilosLinkCheck" href="/Estilos" target="_new">Estilos</a></li>
		<li class="divider dividerhead"><a class="returnFalse" href="">Productos</a></li>
		<li><a id="articulosLinkCheck" href="/Articulos" target="_new">Productos</a></li>
		<li><a id="articulosArchivosLinkCheck" href="/Articulos/archivos" target="_new">Imagenes/Archivos Productos</a></li>
		<li class="divider dividerhead"><a class="returnFalse" href="" target="_new">Materiales y Servicios</a></li>
		<li><a id="materialesLinkCheck" href="/Materiales">Materiales</a></li>
		<li><a id="materialesArchivosLinkCheck" href="/Materiales/archivos" target="_new">Imagenes/Documentos Materiales</a></li>
		<li><a id="serviciosLinkCheck" href="/Servicios">Servicios</a></li>
		<li><a id="serviciosArchivosLinkCheck" href="/Servicios/servicios" target="_new">Imagenes/Documentos Servicios</a></li>
		<li class="divider dividerhead"><a class="returnFalse" href="">Costeos</a></li>
		<li><a id="materialproveedorCostosLinkCheck" href="/Proveedores/costos" target="_new">Costos por Material/Proveedor</a></li>
		<li><a id="articuloCosteosLinkCheck" href="/Costeos" target="_new">Costeos x Explosion</a></li>
		<li class="divider dividerhead"><a class="returnFalse" href="" target="_new">Procesos de Manufactura</a></li>
		<li><a id="articuloExplosionLinkCheck" href="/Explosiones" target="_new">Explosion</a></li>
	</ul>
</li>
<li><a class="returnFalse" href="">Almacén Producción</a>	
	<ul>
		<li><a id="bodegamaterialesLinkCheck" href="/Bodegamateriales" target="_new">Bodega de Materiales</a></li>
		<li><a id="ProdEntsalLinkCheck" href="/Materialmovimientos" target="_new">Entradas / Salidas Habilitación</a></li>
		<li><a id="ProdExistenciasLinkCheck" href="/Materiales/existencias" target="_new">Existencias</a></li>
		<li><a id="ProdKardexLinkCheck" href="/Materiales/kardex" target="_new">Kardex</a></li>
	</ul>
</li>
				<li><a class="returnFalse" href="">Almacén</a>	
					<ul>
						<li class="divider dividerhead"><a class="returnFalse" href="">Movimientos</a>
						<li><a id="almacenLinkCheck" href="/Almacen" target="_new">Entradas/Salidas</a></li>
						<li><a id="articulosexistenciasLinkCheck" href="/Articulos/existencias" target="_new">Existencias</a></li>
					</ul>
				</li>
				<li><a class="returnFalse" href="">Ventas</a>	
					<ul>
						<li class="divider dividerhead"><a class="returnFalse" href="">Movimientos</a>
						<li><a id="articulospreciosLinkCheck" href="/Articulos/precios" target="_new">Lista de Precio y Exist</a></li>
						<li><a id="pedidosLinkCheck" href="/Pedidos" target="_new">Pedidos</a></li>
						<li><a id="ventaexposLinkCheck" href="/ventaexpos" target="_new">Pedidos Expos</a></li>
						<li><a id="facturasLinkCheck" href="/Facturas" target="_new">Facturas</a></li>
						<li><a id="ncreditoLinkCheck" href="/Ncredito" target="_new">Notas de Crédito</a></li>
						<li class="divider dividerhead"><a class="returnFalse href="">Logistica Ventas</a></li>
						<li><a id="facturaembarqueLinkCheck" href="/Facturas/embarque">Embarque de Facturas</a></li>
						<li><a id="facturaentregaLinkCheck" href="/Facturas/entrega">Entrega de Facturas</a></li>
						<li><a id="facturaselectronicasLinkCheck" href="/FacturaElectronica">Facturas Electrónicas</a></li>
						<li class="divider dividerhead"><a class="returnFalse href="">Informes</a></li>
						<li><a id="pedidosInformesLinkCheck" href="/Pedidos" target="_new">Pedidos</a></li>
						<li><a id="facturasLinkCheck" href="/Facturas" target="_new">Facturas</a></li>
					</ul>
				</li>
				<li><a class="returnFalse" href="">C x C</a>	
					<ul>
						<li class="divider dividerhead"><a class="returnFalse" href="">Movimientos</a>
						<li><a id="pedidosautorizaLinkCheck" href="/Pedidos/autorizacion" target="_new">Autorizacion de Pedidos</a></li>
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
