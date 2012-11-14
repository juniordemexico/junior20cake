<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->css('default');
		echo $html->meta('icon');
		echo $scripts_for_layout;
	?>
</head>
<body>
<div id="container">
	<div id="header">
		<h1><?php echo $html->link('OGGI JEANS','/'); ?></h1>
	</div>
	<div id="navbar" class="actions">
		<ul>
				<li><?php echo $html->link(__('divisas',true),''.'/'.'divisas'); ?></li>
				<li><?php echo $html->link(__('estados',true),''.'/'.'estados'); ?></li>
				<li><?php echo $html->link(__('paises',true),''.'/'.'paises'); ?></li>
		</ul>
	</div>
	<div id="wrapper">
		<div id="content">
		<?php
			if ($session->check('Message.flash')):
				echo $session->flash();
			endif;
		?>
			<?php echo $content_for_layout; ?>

		</div>
	</div>
	<div id="sidenav"></div>
	<div id="extra"></div>

	<div id="footer">
		<ul>
			<li>Ingenieria de Datos</li>
			<li>OGGI JEANS 2.0 alpha</li>
		</ul>
	</div>

</div>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
