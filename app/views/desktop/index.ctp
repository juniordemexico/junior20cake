	<div id="desktopHeader">
		<div id="desktopTitlebarWrapper">
			<div id="desktopTitlebar">
				<h1 class="applicationTitle">OGGI JEANS</h1>
				<h2 class="tagline">JUNIOR DE MEXICO, SA DE CV <span class="taglineEm">AxBOS</span></h2>
				<div id="topNav">
					<ul class="menu-right">
						<li>USUARIO: <?php echo $session->read('Auth.User.username');?>.</li>
						<li><a href="/users/logout" onclick="MUI.notification('Cerrando Sesión <strong><?php echo $session->read('Auth.User.username');?></strong>'); " title="Cerrar su Sesión de Forma Segura">SALIR</a></li>
					</ul>
				</div>
			</div>
		</div>
	
		<div id="desktopNavbar">

<?php 
echo $this->Element('menuoptions'.($session->read('Auth.User.group_id')>=10?'_'.$session->read('Auth.User.group_id'):''), array('UserID'=>1,'Privileges'=>'11111111111111111111'));
?>
		</div><!-- desktopNavbar end -->
	</div><!-- desktopHeader end -->

	<div id="dockWrapper">
		<div id="dock">
			<div id="dockPlacement"></div>
			<div id="dockAutoHide"></div>
			<div id="dockSort"><div id="dockClear" class="clear"></div></div>
		</div>
	</div>
