<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<p>This is regular text</p>
<cake<cake:nocache>
	<p>A. Layout Before Content</p>
	<?php $this->log('1. layout before content') ?>
</cake<cake:nocache>
<cake<cake:nocache><?php echo $this->element('nocache/plain'); ?></cake<cake:nocache>
<cake<cake:nocache>
	<p>C. Layout After Test Element But Before Content</p>
	<?php $this->log('3. layout after test element but before content') ?>
</cake<cake:nocache>
<?php echo $content_for_layout; ?>
<cake<cake:nocache>
	<p>E. Layout After Content</p>
	<?php $this->log('5. layout after content') ?>
</cake<cake:nocache>
<p>Additional regular text.</p>
<?php //echo $this->element('nocache/contains_nocache'); stub?>
<cake<cake:nocache>
	<p>G. Layout After Content And After Element With No Cache Tags</p>
	<?php $this->log('7. layout after content and after element with no cache tags') ?>
</cake<cake:nocache>