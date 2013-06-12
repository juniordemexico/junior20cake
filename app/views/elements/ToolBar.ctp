<div id="toolBarContainer" class="container-fluid ax-page-container">
<div id="divNavbar" class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a href="/Desktop" class="brand right">OGGI JEANS, Co.</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<ul class="nav navvar">
				<li class="divider-vertical active">&nbsp;</li>
				<li>
					<?php echo $this->Html->link('<i class="icon icon-list icon-white"></i>  Lista', array('action' => (isset($listAction)?$listAction:'index')), array('escape'=>false)); ?>
				</li>
				<li class="divider-vertical">&nbsp;</li>
				<li>
					<?php echo $this->Html->link('<i class="icon icon-plus-sign icon-white"></i>  Agregar', array('action' => 'add'), array('escape'=>false)); ?>
				</li>
				<li class="divider-vertical">&nbsp;</li>
				<?php if( $this->action=='edit' ): ?>
				<?php if( isset($this->data) && isset($this->data[array_shift(array_keys($this->data))]['id']) ): ?>
				<li>
					<?php if(is_array($this->data)) {echo $this->Html->link('<i class="icon icon-trash"></i>  Eliminar', 
										array('action' => 'delete', $this->data[array_shift(array_keys($this->data))]['id']), 
										array('escape'=>false),
										sprintf(__('¿ Seguro de Eliminar # %s ?', true), $this->data[array_shift(array_keys($this->data))]['id'])); 


			//							array('action' => 'delete', $this->data[$MyModel]['id']),
			//							null, sprintf(__('¿ Seguro de Eliminar # %%s ?', true), $this->data[$MyModel]['id'])
										}
										?>


				</li>
				<?php endif;?>
				<?php endif;?>
			</ul>
			<ul class="nav navvar pull-right">
			<li class="divider-vertical">&nbsp;</li>
				<li>
<?php 
				echo $this->Html->link('<i class="icon icon-refresh icon-white"></i>', array(), array('update' => '#content', 'escape'=>false
				)); 
?>
				</li>
			<li class="divider-vertical">&nbsp;</li>
			<li class="dropdown navbar-icon-signal" id="btnNotifications"  style="background-color:transparent;" >
				<a class="dropdown-toggle " data-toggle="dropdown" href="#notifications">
<img src="/img/icons/devine/white/Mail.png" width="20px" height="20px" style="margin: 0px; padding: 0px; vertical-align:middle;" />
				<span class="badge badge-warning">10</span>
				<b class="caret"></b></a>
				<ul class="dropdown-menu notifications-list" style="opacity: 0.80;">
					<li class="notifications-list" style="border: 1px solid #000; background-color: white; padding: 4px;">
					<label class="label label-info">ATENCION!</label>
					<div>Mensaje de la persona esta que es bien buena</div>
					<a href="#">Ver</a>
					</li>
					<li class="notifications-list" style="border: 1px solid #000; background-color: white; padding: 4px;">
					<label class="label label-important">ERROR!</label>
					<div>Mensaje de la persona esta que es bien buena</div>
					<a href="#">Ver</a>
					</li>
					<li class="notifications-list" style="border: 1px solid #000; background-color: white; padding: 4px;">
					<label class="label label-success">OK!</label>
					<div>Mensaje de la persona esta que es bien buena</div>
					<a href="#">Ver</a>
					</li>
				</ul>
			</li>
			<li class="divider-vertical">&nbsp;</li>
			<li>
			<span id="busy-indicator-div" class="pull-right" style="float:right;">
			<?php echo $this->Html->image('/img/loading_circle.gif', array('id' => 'busy-indicator', 'alt' => 'Transmitiendo', 'style'=>'display: none; float: right;')); ?>
			</span>
			</li>
			</ul>
		</div> <!-- container -->
	</div>  <!-- navbar-inner -->

</div>  <!-- divNavbar -->
</div>


<?php
/*
			<li class="dropdown navbar-icon-signal" id="btnInstantMessanger" style="" >
				<a class="dropdown-toggle " data-toggle="dropdown" href="#msgnotifications" 
				onclick="javascript:$('#edtMsg').focus();">
<img src="/img/icons/devine/white/Massage.png" width="20px" height="20px" />
				<b class="caret"></b></a>
				<ul class="dropdown-menu notifications-list" style="opacity: 0.80; width: 200px; height:150px;">
					<li>
					<div>
					<form class="form-search form-well">
					<div class="control-group">
					<input id="edtMsg" type="text" placeholder="Escribe tu mensaje..." class="input-control span2">
					<button class="btn btn-small"><i class="icon icon-arrow-right"></i></btn>
					</div>
					</form>
					</div>
					</li>
				</ul>
			</li>
			<li class="divider-vertical">&nbsp;</li>

**/

?>


<div id="nav-container">
	<div class="container_16">
	<div id="nav">
	<ul class="sf-menu">
		<li>
			<a href="/croogo/admin/nodes">Content</a><ul>
				<li><a href="/croogo/admin/nodes">List</a></li>
				<li>
					<a href="/croogo/admin/nodes/create">Create</a>					<ul>
												<li><a href="/croogo/admin/nodes/add/blog">Blog</a></li>
												<li><a href="/croogo/admin/nodes/add/node">Node</a></li>
												<li><a href="/croogo/admin/nodes/add/page">Page</a></li>
											</ul>
				</li>
				<li><a href="/croogo/admin/types">Content types</a></li>
				<li>
					<a href="/croogo/admin/vocabularies">Taxonomy</a>					<ul>
						<li><a href="/croogo/admin/vocabularies">List</a></li>
						<li><a href="/croogo/admin/vocabularies/add" class="separator">Add new</a></li>
												<li><a href="/croogo/admin/terms/index/1">Categories</a></li>
												<li><a href="/croogo/admin/terms/index/2">Tags</a></li>
											</ul>
				</li>
				<li>
					<a href="/croogo/admin/comments">Comments</a>					<ul>
						<li><a href="/croogo/admin/comments/index/filter:status:1;">Published</a></li>
						<li><a href="/croogo/admin/comments/index/filter:status:0;">Approval</a></li>
					</ul>
				</li>
			</ul>
		</li>

		<li>
			<a href="/croogo/admin/menus">Menus</a>			<ul>
				<li><a href="/croogo/admin/menus">Menus</a></li>
				<li><a href="/croogo/admin/menus/add" class="separator">Add new</a></li>
								<li><a href="/croogo/admin/links/index/3">Main Menu</a></li>
								<li><a href="/croogo/admin/links/index/4">Footer</a></li>
								<li><a href="/croogo/admin/links/index/5">Meta</a></li>
								<li><a href="/croogo/admin/links/index/6">Blogroll</a></li>
							</ul>
		</li>

		<li>
			<a href="/croogo/admin/blocks">Blocks</a>			<ul>
				<li><a href="/croogo/admin/blocks">Blocks</a></li>
				<li><a href="/croogo/admin/regions">Regions</a></li>
			</ul>
		</li>

		<li>
			<a href="/croogo/admin/extensions/extensions_plugins">Extensions</a>			<ul>
				<li><a href="/croogo/admin/extensions/extensions_themes">Themes</a></li>
				<li><a href="/croogo/admin/extensions/extensions_locales">Locales</a></li>
				<li><a href="/croogo/admin/extensions/extensions_plugins" class="">Plugins</a></li>
							</ul>
		</li>

		<li>
			<a href="/croogo/admin/attachments">Media</a>			<ul>
				<li><a href="/croogo/admin/attachments">Attachments</a></li>
				<li><a href="/croogo/admin/filemanager">File Manager</a></li>
			</ul>
		</li>

		<li>
			<a href="/croogo/admin/contacts">Contacts</a>			<ul>
				<li><a href="/croogo/admin/contacts">Contacts</a></li>
				<li><a href="/croogo/admin/messages">Messages</a></li>
			</ul>
		</li>

		<li>
			<a href="/croogo/admin/users">Users</a>			<ul>
				<li><a href="/croogo/admin/users">Users</a></li>
				<li><a href="/croogo/admin/roles">Roles</a></li>
				<li><a href="/croogo/admin/acl/acl_permissions">Permissions</a></li>
			</ul>
		</li>

		<li>
			<a href="/croogo/admin/settings/prefix/Site">Settings</a>			<ul>
				<li><a href="/croogo/admin/settings/prefix/Site">Site</a></li>
				<li><a href="/croogo/admin/settings/prefix/Meta">Meta</a></li>
				<li><a href="/croogo/admin/settings/prefix/Reading">Reading</a></li>
				<li><a href="/croogo/admin/settings/prefix/Writing">Writing</a></li>
				<li><a href="/croogo/admin/settings/prefix/Comment">Comment</a></li>
				<li><a href="/croogo/admin/settings/prefix/Service">Service</a></li>
				<li><a href="/croogo/admin/languages">Languages</a></li>
			</ul>
		</li>
	</ul>
	</div>
	</div>
</div>


