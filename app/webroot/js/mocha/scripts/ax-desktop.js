/* 

	In this file we setup our Windows, Columns and Panels,
	and then inititialize MUI.
	
	At the bottom of Core.js you can setup lazy loading for your
	own plugins.

*/


/*
  
INITIALIZE WINDOWS

	1. Define windows
	
		var myWindow = function(){ 
			new MUI.Window({
				id: 'mywindow',
				title: 'My Window',
				contentURL: 'pages/lipsum.html',
				width: 340,
				height: 150
			});
		}

	2. Build windows on onDomReady
	
		myWindow();
	
	3. Add link events to build future windows
	
		if ($('myWindowLink')){
			$('myWindowLink').addEvent('click', function(e) {
				new Event(e).stop();
				jsonWindows();
			});
		}

		Note: If your link is in the top menu, it opens only a single window, and you would
		like a check mark next to it when it's window is open, format the link name as follows:

		window.id + LinkCheck, e.g., mywindowLinkCheck

		Otherwise it is suggested you just use mywindowLink

	Associated HTML for link event above:

		<a id="myWindowLink" href="pages/lipsum.html">My Window</a>	


	Notes:
		If you need to add link events to links within windows you are creating, do
		it in the onContentLoaded function of the new window. 
 
-------------------------------------------------------------------- */
/*
	var MasterDetailWindowSmallWidth= new array('width': '400px', 'max-width': '400px');

	var MasterDetailWidth={'width': '900px', 'max-width': '900px'};
	var MasterDetailBigWidth={width: '1200px',max-width: '1200px'};
*/


initializeWindows = function() {

	// Examples
	
	MUI.articulosWindow = function(){
		new MUI.Window({
			id: 'articulos',
			title: 'Articulos',
			loadMethod: 'iframe',
			contentURL: '/Articulos',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('articulosLinkCheck')) {
		$('articulosLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.articulosWindow();
		});
	}	

	
	MUI.articulosArchivosWindow = function(){
		new MUI.Window({
			id: 'articulosarchivos',
			title: 'Articulos Imagenes y Archivos',
			loadMethod: 'iframe',
			contentURL: '/Articulos/archivos',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('articulosArchivosLinkCheck')) {
		$('articulosArchivosLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.articulosArchivosWindow();
		});
	}	

	MUI.articulosTestTallaColorWindow = function(){
		new MUI.Window({
			id: 'articulostesttallacolor',
			title: 'Articulos Talla Color',
			loadMethod: 'iframe',
			contentURL: '/Articulos/testtallacolor',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('articulosTestTallaColorLinkCheck')) {
		$('articulosTestTallaColorLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.articulosTestTallaColorWindow();
		});
	}	

	MUI.articulospreciosWindow = function(){
		new MUI.Window({
			id: 'articulosprecios',
			title: 'Precios y Existencias',
			loadMethod: 'iframe',
			contentURL: '/Articulos/precios',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('articulospreciosLinkCheck')) {
		$('articulospreciosLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.articulospreciosWindow();
		});
	}	

	MUI.articulosexistenciasWindow = function(){
		new MUI.Window({
			id: 'articulosexistencias',
			title: 'Existencias',
			loadMethod: 'iframe',
			contentURL: '/Articulos/existencias',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('articulosexistenciasLinkCheck')) {
		$('articulosexistenciasLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.articulosexistenciasWindow();
		});
	}	

	MUI.articulosRptWindow = function(){
		new MUI.Window({
			id: 'articulosrpt',
			title: 'Inf Artículos',
			loadMethod: 'iframe',
			contentURL: '/ArticulosReports',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('articulosRptLinkCheck')) {
		$('articulosRptLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.articulosRptWindow();
		});
	}	

	MUI.contactosWindow = function(){
		new MUI.Window({
			id: 'contactos',
			title: 'Contactos',
			loadMethod: 'iframe',
			contentURL: '/Contactos',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}
	if ($('contactosLinkCheck')) {
		$('contactosLinkCheck').addEvent('click', function(e) {
		new Event(e).stop();
			MUI.contactosWindow();
		});
	}

	MUI.directoriosWindow = function(){
		new MUI.Window({
			id: 'directorios',
			title: 'Directorios',
			loadMethod: 'iframe',
			contentURL: '/Directorios',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}
	if ($('directoriosLinkCheck')) {
		$('directoriosLinkCheck').addEvent('click', function(e) {
		new Event(e).stop();
			MUI.directoriosWindow();
		});
	}

	MUI.clientesWindow = function(){
		new MUI.Window({
			id: 'clientes',
			title: 'Clientes',
			loadMethod: 'iframe',
			contentURL: '/Clientes',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}
	if ($('clientesLinkCheck')) {
		$('clientesLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.clientesWindow();
		});
	}	

	MUI.vendedoresWindow = function(){
		new MUI.Window({
			id: 'vendedores',
			title: 'Vendedores',
			loadMethod: 'iframe',
			contentURL: '/Vendedores',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('vendedoresLinkCheck')) {
		$('vendedoresLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.vendedoresWindow();
		});
	}	

	MUI.proveedoresWindow = function(){
		new MUI.Window({
			id: 'proveedores',
			title: 'Proveedores',
			loadMethod: 'iframe',
			contentURL: '/Proveedores',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	

	if ($('proveedoresLinkCheck')) {
		$('proveedoresLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.proveedoresWindow();
		});
	}	

	MUI.materialesWindow = function(){
		new MUI.Window({
			id: 'materiales',
			title: 'Materiales',
			loadMethod: 'iframe',
			contentURL: '/Materiales',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('materialesLinkCheck')) {
		$('materialesLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.materialesWindow();
		});
	}

	MUI.materialesArchivosWindow = function(){
		new MUI.Window({
			id: 'materialesarchivos',
			title: 'Materiales Imagenes y Documentos',
			loadMethod: 'iframe',
			contentURL: '/Materiales/archivos',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('materialesArchivosLinkCheck')) {
		$('materialesArchivosLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.materialesArchivosWindow();
		});
	}	

	MUI.materialproveedorCostosWindow = function(){
		new MUI.Window({
			id: 'materialproveedorcostos',
			title: 'Costos de Materiales por Proveedor',
			loadMethod: 'iframe',
			contentURL: '/Proveedores/costos',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('materialproveedorCostosLinkCheck')) {
		$('materialproveedorCostosLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.materialproveedorCostosWindow();
		});
	}	

	MUI.articuloExplosionWindow = function(){
		new MUI.Window({
			id: 'explosion',
			title: 'Explosion de Materiales',
			loadMethod: 'iframe',
			contentURL: '/Explosiones',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('articuloExplosionLinkCheck')) {
		$('articuloExplosionLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.articuloExplosionWindow();
		});
	}	

	MUI.articuloCosteosWindow = function(){
		new MUI.Window({
			id: 'costeoexplosion',
			title: 'Costeo de Productos',
			loadMethod: 'iframe',
			contentURL: '/Costeos',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('articuloCosteosLinkCheck')) {
		$('articuloCosteosLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.articuloCosteosWindow();
		});
	}	

	MUI.divisasWindow = function(){
		new MUI.Window({
			id: 'divisas',
			title: 'Divisas',
			loadMethod: 'iframe',
			contentURL: '/Divisas',
			y: 100,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('divisasLinkCheck')) {
		$('divisasLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.divisasWindow();
		});
	}	

	MUI.paisesWindow = function(){
		new MUI.Window({
			id: 'paises',
			title: 'Paises',
			loadMethod: 'iframe',
			contentURL: '/Paises',
			y: 100,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('paisesLinkCheck')) {
		$('paisesLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.paisesWindow();
		});
	}	

	MUI.estadosWindow = function(){
		new MUI.Window({
			id: 'estados',
			title: 'Estados',
			loadMethod: 'iframe',
			contentURL: '/Estados',
			y: 100,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('estadosLinkCheck')) {
		$('estadosLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.estadosWindow();
		});
	}	

	MUI.unidadesWindow = function(){
		new MUI.Window({
			id: 'unidades',
			title: 'Unidades',
			loadMethod: 'iframe',
			contentURL: '/Unidades',
			y: 100,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('unidadesLinkCheck')) {
		$('unidadesLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.unidadesWindow();
		});
	}	

	MUI.coloresWindow = function(){
		new MUI.Window({
			id: 'colores',
			title: 'Colores',
			loadMethod: 'iframe',
			contentURL: '/Colores',
			y: 100,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('coloresLinkCheck')) {
		$('coloresLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.coloresWindow();
		});
	}	

	MUI.lineasWindow = function(){
		new MUI.Window({
			id: 'lineas',
			title: 'Lineas',
			loadMethod: 'iframe',
			contentURL: '/Lineas',
			y: 100,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('lineasLinkCheck')) {
		$('lineasLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.lineasWindow();
		});
	}	
		
	MUI.marcasWindow = function(){
		new MUI.Window({
			id: 'marcas',
			title: 'Marcas',
			loadMethod: 'iframe',
			contentURL: '/Marcas',
			y: 100,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('marcasLinkCheck')) {
		$('marcasLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.marcasWindow();
		});
	}	

	MUI.temporadasWindow = function(){
		new MUI.Window({
			id: 'temporadas',
			title: 'Temporadas',
			loadMethod: 'iframe',
			contentURL: '/Temporadas',
			y: 100,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('temporadasLinkCheck')) {
		$('temporadasLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.temporadasWindow();
		});
	}	

	MUI.tallasWindow = function(){
		new MUI.Window({
			id: 'tallas',
			title: 'Tallas',
			loadMethod: 'iframe',
			contentURL: '/Tallas',
			y: 100,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('tallasLinkCheck')) {
		$('tallasLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.tallasWindow();
		});
	}	

	MUI.proporcionesWindow = function(){
		new MUI.Window({
			id: 'proporciones',
			title: 'Proporciones',
			loadMethod: 'iframe',
			contentURL: '/Proporciones',
			y: 100,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	if ($('proporcionesLinkCheck')) {
		$('proporcionesLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.proporcionesWindow();
		});
	}	


	MUI.facturasWindow = function(){
		new MUI.Window({
			id: 'facturas',
			title: 'Facturas',
			loadMethod: 'iframe',
			contentURL: '/Facturas',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	
	if ($('facturasLinkCheck')) {
		$('facturasLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.facturasWindow();
		});
	}	

	MUI.pedidosWindow = function(){
		new MUI.Window({
			id: 'pedidos',
			title: 'Pedidos',
			loadMethod: 'iframe',
			contentURL: '/Pedidos',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	
	if ($('pedidosLinkCheck')) {
		$('pedidosLinkCheck').addEvent('click', function(e) {
		new Event(e).stop();
			MUI.pedidosWindow();
		});
	}	

	MUI.pedidosautorizaWindow = function() {
		new MUI.Window({
			id: 'pedidosautoriza',
			title: 'Autorizacion de Pedidos',
			loadMethod: 'iframe',
			contentURL: '/Pedidos/autorizacion',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	
	if ($('pedidosautorizaLinkCheck')) {
		$('pedidosautorizaLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.pedidosautorizaWindow();
		});
	}	

	MUI.pedidosInformesWindow = function(){
		new MUI.Window({
			id: 'pedidosinformes',
			title: 'Pedidos::Informes',
			loadMethod: 'iframe',
			contentURL: '/Pedidos/reportsform',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	
	if ($('pedidosInformesLinkCheck')) {
		$('pedidosInformesLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.pedidosInformesWindow();
		});
	}	

	MUI.facturaselectronicasWindow = function(){
		new MUI.Window({
			id: 'facturaselectronicas',
			title: 'Facturas Electrónicas',
			loadMethod: 'iframe',
			contentURL: '/FacturaElectronica',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	
	if ($('facturaselectronicasLinkCheck')) {
		$('facturaselectronicasLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.facturaselectronicasWindow();
		});
	}	

	MUI.facturaembarqueWindow = function(){
		new MUI.Window({
			id: 'facturaembarque',
			title: 'Embarque de Facturas',
			loadMethod: 'iframe',
			contentURL: '/Facturas/embarque',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	
	if ($('facturaembarqueLinkCheck')) {
		$('facturaembarqueLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.facturaembarqueWindow();
		});
	}	

	MUI.facturaentregaWindow = function(){
		new MUI.Window({
			id: 'facturaentrega',
			title: 'Entrega Facturas',
			loadMethod: 'iframe',
			contentURL: '/Facturas/entrega',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	
	if ($('facturaentregaLinkCheck')) {
		$('facturaentregaLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.facturaentregaWindow();
		});
	}	

	MUI.monitorsWindow = function(){
		new MUI.Window({
			id: 'monitors',
			title: 'Monitores',
			loadMethod: 'iframe',
			contentURL: '/monitors',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	
	if ($('monitorLinkCheck')) {
		$('monitorLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.monitorsWindow();
		});
	}	

	MUI.historyWindow = function(){
		new MUI.Window({
			id: 'history',
			title: 'Historiales',
			loadMethod: 'iframe',
			contentURL: '/history',
			y: 80,
			width: 1000,
			height: 400,
			resizeLimit:  {'x': [1000, 1280], 'y': [200, 1024]},
			headerHeight: 26,
			footerHeight: 20,
			toolbar: false,
		});
	}	
	
	if ($('historyLinkCheck')) {
		$('historyLinkCheck').addEvent('click', function(e){
		new Event(e).stop();
			MUI.historyWindow();
		});
	}	

	MUI.clockWindow = function(){	
		new MUI.Window({
			id: 'clock',
			title: 'Canvas Clock',
			addClass: 'transparent',
			loadMethod: 'xhr',
			contentURL: '/js/mootools/plugins/coolclock/index.html',
			shape: 'gauge',
			headerHeight: 30,
			width: 160,
			height: 160,
			x: 600,
			y: 152,
			padding: { top: 0, right: 0, bottom: 0, left: 0 },
			require: {			
				js: [MUI.path.plugins + 'coolclock/scripts/coolclock.js'],
				onload: function(){
					if (CoolClock) new CoolClock();
				}	
			}			
		});	
	}
	if ($('clockLinkCheck')){
		$('clockLinkCheck').addEvent('click', function(e){
			new Event(e).stop();
			MUI.clockWindow();
		});
	}

	MUI.calculatorWindow = function(){	
		new MUI.Window({
			id: 'calculator',
			title: 'Calculadora',
			addClass: 'transparent',
			loadMethod: 'xhr',
			contentURL: 'plugins/calculator/index.html',
			shape: 'gauge',
			headerHeight: 30,
			width: 160,
			height: 160,
			x: 570,
			y: 152,
			padding: { top: 0, right: 0, bottom: 0, left: 0 },
			require: {			
				js: [MUI.path.plugins + 'calculator/scripts/calculator.js'],
				onload: function(){
					if (CoolClock) new CoolClock();
				}	
			}			
		});	
	}
	if ($('calculatorLinkCheck')){
		$('calculatorLinkCheck').addEvent('click', function(e){
			new Event(e).stop();
			MUI.clockWindow();
		});
	}
	

	// Examples > Tests
	MUI.eventsWindow = function(){	
		new MUI.Window({
			id: 'windowevents',
			title: 'Window Events',
			loadMethod: 'xhr',
			contentURL: 'pages/events.html',
			width: 340,
			height: 250,			
			onContentLoaded: function(windowEl){
				MUI.notification('Window content was loaded.');
			},
			onCloseComplete: function(){
				MUI.notification('The window is closed.');
			},
			onMinimize: function(windowEl){
				MUI.notification('Window was minimized.');
			},
			onMaximize: function(windowEl){
				MUI.notification('Window was maximized.');
			},
			onRestore: function(windowEl){
				MUI.notification('Window was restored.');
			},
			onResize: function(windowEl){
				MUI.notification('Window was resized.');
			},
			onFocus: function(windowEl){
				MUI.notification('Window was focused.');
			},
			onBlur: function(windowEl){
				MUI.notification('Window lost focus.');
			}
		});
	}	
	if ($('windoweventsLinkCheck')){
		$('windoweventsLinkCheck').addEvent('click', function(e){
			new Event(e).stop();
			MUI.eventsWindow();
		});
	}


	MUI.accordiantestWindow = function(){
		var id = 'accordiantest';
		new MUI.Window({
			id: id,
			title: 'Accordian',
			loadMethod: 'xhr',
			contentURL: 'pages/accordian-demo.html',
			width: 300,
			height: 200,
			scrollbars: false,
			resizable: false,
			maximizable: false,
			padding: { top: 0, right: 0, bottom: 0, left: 0 },
			require: {
				css: [MUI.path.plugins + 'accordian/css/style.css'],
				onload: function(){
					this.windowEl = $(id);				
					new Accordion('#' + id + ' h3.accordianToggler', "#" + id + ' div.accordianElement',{
						opacity: false,
						alwaysHide: true,
						onActive: function(toggler, element){
							toggler.addClass('open');
						},
						onBackground: function(toggler, element){
							toggler.removeClass('open');
						},							
						onStart: function(toggler, element){
							this.windowEl.accordianResize = function(){
								MUI.dynamicResize($(id));
							}
							this.windowEl.accordianTimer = this.windowEl.accordianResize.periodical(10);
						}.bind(this),
						onComplete: function(){
							this.windowEl.accordianTimer = $clear(this.windowEl.accordianTimer);
							MUI.dynamicResize($(id)) // once more for good measure
						}.bind(this)
					}, $(id));
				}	
			}
		});
	}	
	if ($('accordiantestLinkCheck')){ 
		$('accordiantestLinkCheck').addEvent('click', function(e){	
			new Event(e).stop();
			MUI.accordiantestWindow();
		});
	}
	

	// View
	if ($('sidebarLinkCheck')){
		$('sidebarLinkCheck').addEvent('click', function(e){
			new Event(e).stop();
			MUI.Desktop.sidebarToggle();
		});
	}

	if ($('cascadeLink')){
		$('cascadeLink').addEvent('click', function(e){
			new Event(e).stop();
			MUI.arrangeCascade();
		});
	}

	if ($('tileLink')){
		$('tileLink').addEvent('click', function(e){
			new Event(e).stop();
			MUI.arrangeTile();
		});
	}

	if ($('closeLink')){
		$('closeLink').addEvent('click', function(e){
			new Event(e).stop();
			MUI.closeAll();
		});
	}

	if ($('minimizeLink')){
		$('minimizeLink').addEvent('click', function(e){
			new Event(e).stop();
			MUI.minimizeAll();
		});
	}

	// Tools
	MUI.builderWindow = function(){	
		new MUI.Window({
			id: 'builder',
			title: 'Window Builder',
			icon: 'images/icons/page.gif',
			loadMethod: 'xhr',
			contentURL: 'plugins/windowform/',
			width: 370,
			height: 410,
			maximizable: false,
			resizable: false,
			scrollbars: false,
			onBeforeBuild: function(){
				if ($('builderStyle')) return;
				new Asset.css('plugins/windowform/css/style.css', {id: 'builderStyle'});
			},			
			onContentLoaded: function(){
				new Asset.javascript('plugins/windowform/scripts/Window-from-form.js', {
					id: 'builderScript',
					onload: function(){
						$('newWindowSubmit').addEvent('click', function(e){
							new Event(e).stop();
							new MUI.WindowForm();
						});
					}
				});
			}			
		});
	}
	if ($('builderLinkCheck')){
		$('builderLinkCheck').addEvent('click', function(e){	
			new Event(e).stop();
			MUI.builderWindow();
		});
	}	

	// Todo: Add menu check mark functionality for workspaces.

	// Workspaces

	if ($('saveWorkspaceLink')){
		$('saveWorkspaceLink').addEvent('click', function(e){
			new Event(e).stop();
			MUI.saveWorkspace();
		});
	}
	
	if ($('loadWorkspaceLink')){
		$('loadWorkspaceLink').addEvent('click', function(e){
			new Event(e).stop();
			MUI.loadWorkspace();
		});
	}
	
	if ($('toggleEffectsLinkCheck')){
		$('toggleEffectsLinkCheck').addEvent('click', function(e){
			new Event(e).stop();
			MUI.toggleEffects($('toggleEffectsLinkCheck'));			
		});
		if (MUI.options.useEffects == true) {
			MUI.toggleEffectsLink = new Element('div', {
				'class': 'check',
				'id': 'toggleEffects_check'
			}).inject($('toggleEffectsLinkCheck'));
		}
	}	

	// Help	
	MUI.featuresWindow = function(){
		new MUI.Window({
			id: 'features',
			title: 'Features',
			loadMethod: 'xhr',
			contentURL: 'pages/features-layout.html',
			width: 305,
			height: 175,
			resizeLimit: {'x': [275, 2500], 'y': [125, 2000]},
			toolbar: true,
			toolbarURL: 'pages/features-tabs.html',
			toolbarOnload: function(){
				MUI.initializeTabs('featuresTabs');

				$('featuresLayoutLink').addEvent('click', function(e){
					MUI.updateContent({
						'element':  $('features'),
						'url':       'pages/features-layout.html'
					});
				});

				$('featuresWindowsLink').addEvent('click', function(e){
					MUI.updateContent({
						'element':  $('features'),
						'url':       'pages/features-windows.html'
					});
				});

				$('featuresGeneralLink').addEvent('click', function(e){
					MUI.updateContent({
						'element':  $('features'),
						'url':       'pages/features-general.html'
					});
				});
			}			
		});
	}
	if ($('featuresLinkCheck')){
		$('featuresLinkCheck').addEvent('click', function(e){
			new Event(e).stop();
			MUI.featuresWindow();
		});
	}

	MUI.aboutWindow = function(){
		new MUI.Modal({
			id: 'about',
			addClass: 'about',
			title: 'MochaUI',
			loadMethod: 'xhr',
			contentURL: 'pages/about.html',
			type: 'modal2',
			width: 350,
			height: 195,
			padding: { top: 43, right: 12, bottom: 10, left: 12 },
			scrollbars:  false
		});
	}
	if ($('aboutLink')){
		$('aboutLink').addEvent('click', function(e){	
			new Event(e).stop();
			MUI.aboutWindow();
		});
	}

	MUI.flashWindow = function(){
		new MUI.Modal({
			id: 'flashwindow',
			addClass: 'flashwindow',
			title: 'Atención',
			loadMethod: 'xhr',
			content: 'asdasdasdasdpages/about.html',
			type: 'modal',
			width: 400,
			height: 240,
			padding: { top: 8, right: 16, bottom: 8, left: 16 },
			scrollbars:  false
		});
	}
	if ($('flashWindow')){
		$('flashWindow').addEvent('click', function(e){	
			new Event(e).stop();
			MUI.flashWindow();
		});
	}

	// Deactivate menu header links
	$$('a.returnFalse').each(function(el){
		el.addEvent('click', function(e){
			new Event(e).stop();
		});
	});

	// Build windows onLoad
//	MUI.parametricsWindow();
//	MUI.clockWindow();
	
	MUI.myChain.callChain();
	
}

initializeColumns = function() {

	new MUI.Column({
		id: 'sideColumn1',
		placement: 'left',
		width: 450,
		resizeLimit: [240, 450]
	});
	
	new MUI.Column({
		id: 'mainColumn',
		placement: 'main',
		resizeLimit: [100, 1024]
	});
	
	new MUI.Column({
		id: 'sideColumn2',
		placement: 'right',
		width: 400,
		resizeLimit: [240, 400]
	});
	
	// Add panels to first side column
	new MUI.Panel({
		id: 'pedidos-panel',
		title: 'Pedidos',	
		loadMethod: 'iframe',
		contentURL: document.getElementById('MonitorLeft').value,
		column: 'sideColumn1'
	});
	
	new MUI.Panel({
		id: 'panel2',
		title: 'Mensajería',
		contentURL: '', // '/chat',
		column: 'sideColumn1',
		onContentLoaded: function(){
/*
			$('myForm').addEvent('submit', function(e){
				e.stop();

				$('spinner').show();
				if ($('postContent') && MUI.options.standardEffects == true) {
					$('postContent').setStyle('opacity', 0);	
				}
				else {
					$('mainPanel_pad').empty();
				}
	
				this.set('send', {
					onComplete: function(response) { 
	 						MUI.updateContent({
							'element': $('mainPanel'),
							'content': response,
							'title': 'Ajax Response',
							'padding': { top: 8, right: 8, bottom: 8, left: 8 }
						});			
					},
					onSuccess: function(){
						if (MUI.options.standardEffects == true) {
							$('postContent').setStyle('opacity', 0).get('morph').start({'opacity': 1});
						}
					}
				});
				this.send();
			});	
			*/	
		}
	});
	
	// Add panels to main column	
	new MUI.Panel({
		id: 'mainPanel',
		title: 'BITACORA / AVISOS',
		contentURL: document.getElementById('MonitorCenter').value,
		column: 'mainColumn',
	});
	
	// Add panels to second side column
	
	new MUI.Panel({
		id: 'cxc-panel',
		title: 'Facturas',
		loadMethod: 'iframe',
		contentURL: document.getElementById('MonitorRight').value,
		column: 'sideColumn2',
/*		tabsURL: 'pages/panel-tabs.html',*/
/*		require: {
			css: [MUI.themePath() + 'css/Tabs.css']
		}*/		
	});

	new MUI.Panel({
		id: 'panel3',
		title: 'Twitter',
		contentURL: '', /* /tweeter */
		column: 'sideColumn2',
	});	
	
	MUI.splitPanelPanel = function() {
		if ($('mainPanel')) {			
			new MUI.Column({
				container: 'mainPanel',
				id: 'sideColumn3',
				placement: 'left',
				width: 400,
				resizeLimit: [400, 700]
			});
			
			new MUI.Column({
				container: 'mainPanel',
				id: 'mainColumn2',
				placement: 'main',
				width: 400,
				resizeLimit: [400, 700]
			});
			
			new MUI.Panel({
				header: false,
				id: 'splitPanel_sidePanel',
				addClass: 'panelAlt',
				contentURL: 'pages/lipsum.html',
				column: 'sideColumn3'
			});
		}
	};
	
	MUI.myChain.callChain();
};

// Initialize MochaUI when the DOM is ready
window.addEvent('load', function(){

	MUI.myChain = new Chain();
	MUI.myChain.chain(
		function(){MUI.Desktop.initialize();},
		function(){MUI.Dock.initialize();},
		function(){initializeWindows();},
		function(){initializeColumns();}		
	).callChain();
	
	// This is just for the demo. Running it onload gives pngFix time to replace the pngs in IE6.
	$$('.desktopIcon').addEvent('click', function(){
		MUI.notification('Do Something');
	});	

});

window.addEvent('unload', function(){
	// This runs when a user leaves your page.	
});