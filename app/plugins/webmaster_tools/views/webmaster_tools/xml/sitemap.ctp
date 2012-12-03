<?php
	$this->Sitemap->add('/bla', array(
		'changes' => 'always'
	));
	echo $this->Sitemap->generate();
?>