<div class="span12 upload-form">

<?php echo $this->Form->create('Articulo', array('class'=>'form-horizontal')); ?>
<?php	echo $this->Form->hidden('Articulo.id'); ?>
<?php	echo $this->Form->hidden('Articulo.arcveart'); ?>
<?php	echo $this->Form->hidden('Articulo.ardescrip'); ?>
<?php 	echo $this->Form->hidden('Articulo.art', array( 'label' => null)); ?>

<div class="page-header">
	<h1>
	<?php e($this->data['Articulo']['arcveart']);?> 
	<small><?php e($this->data['Articulo']['ardescrip']);?></small>
	</h1>
</div>

<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab">Ver</a></li>
		<li><a href="#tabs-1" data-toggle="tab">Principal</a></li>
		<li><a href="#tabs-2" data-toggle="tab">Imagenes</a></li>
		<li><a href="#tabs-3" data-toggle="tab">Documentos</a></li>
		<li><a href="#tabs-4" data-toggle="tab">Varios</a></li>
	</ul>
<div class="tab-content">

<div id="tabs-0" class="tab-pane active">

<!--Carousel Begin -->
<?php
$imgResults = $this->Upload->listing ('img/Articulo', $this->data['Articulo']['id']);

$directory = $imgResults['directory'];
$baseUrl = $imgResults['baseUrl'];
$files = $imgResults['files'];
?>

<?php if(sizeof($files)>0): ?>

<div id="myCarousel" class="carousel slide">
  <!-- Carousel items -->
  <div class="carousel-inner">

<?php
	$i=-1;
	foreach ($files as $file):
		$i++;
		$f = basename($file);
		$url = $baseUrl . "/$f";
?>
	<div class="item <?php if($i==0) e('active')?>">
		<img src="<?php e($url);?>" alt=""/>
	    <div class="carousel-caption">
        	<h4><u><?php e($this->data['Articulo']['arcveart']);?></u></h4>
			<p>
			<strong><?php e($this->data['Articulo']['ardescrip']);?></strong>
			<?php e('<strong>Linea:</strong> '.$this->data['Linea']['licve']);?>
			<?php e('<strong>Marca:</strong> '.$this->data['Marca']['macve']);?>
			<?php e('<strong>Temporada:</strong> '.$this->data['Temporada']['tecve']);?>
			</p>
		</div>
	</div>
<?php endforeach; ?>       
  <!-- Carousel nav -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>
</div>
<!--Carousel End -->
<?php endif; ?> 

</div>

<div id="tabs-1" class="tab-pane">
	<label class="label">Imagen o Icono que representa este Articulo<i>( jpg, png )</i></label>
	<?php echo $this->Upload->edit('ico/Articulo', $this->data['Articulo']['id']); //$this->Form->fields['Articulo.id'] ?>
</div>

<div id="tabs-2" class="tab-pane">
	<label class="label">Imagenes y Fotografias <i>( jpg, png )</i></label>
	<?php echo $this->Upload->edit('img/Articulo', $this->data['Articulo']['id']); //$this->Form->fields['Articulo.id'] ?>
</div>

<div id="tabs-3" class="tab-pane">
	<label class="label">Documentos e Informacion referente al Articulo <i>( pdf, txt, xml, zip )</i></label>
	<?php echo $this->Upload->edit('doc/Articulo', $this->data['Articulo']['id']); //$this->Form->fields['Articulo.id'] ?>
</div> <!-- div tabs-2 -->
 
<div id="tabs-4" class="tab-pane">
	<label class="label">Cualquier otro tipo de Archivos o Documentos adicionales <i>( jpg, png, pdf, txt, xml, zip )</i></label>
	<?php echo $this->Upload->edit('etc/Articulo', $this->data['Articulo']['id']); //$this->Form->fields['Articulo.id'] ?>
</div>

</div> <!-- div tab-content-->
</div> <!-- div tabs tabbable-->

<?php
echo $this->Form->end(); 
?>

</div> <!-- span12 -->

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
