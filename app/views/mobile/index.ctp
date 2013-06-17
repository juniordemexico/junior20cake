	<div id="desktopHeader">
		<div id="desktopTitlebarWrapper">
			<div id="desktopTitlebar">
				<h1 class="applicationTitle">OGGI MOBILE</h1>
				<h2 class="tagline">OGGI <span class="taglineEm">MOBILE</span></h2>
				<div id="topNav">
					<ul class="menu-right">
						<li>Bienvenido <a href="#" onclick="MUI.notification('Do Something');return false;">Demo User</a>.</li>
						<li><a href="#" onclick="MUI.notification('Do Something');return false;">Sign Out</a></li>
					</ul>
				</div>
			</div>
		</div>
	
		<div id="desktopNavbar">

<?php 
echo $this->Element('menuoptions',array('UserID'=>'1','Privileges'=>'11111111111111111111'));
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

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
