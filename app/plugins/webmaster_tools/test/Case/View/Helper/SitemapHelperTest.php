<?php
/* Sitemap Test cases generated on: 2011-11-21 10:11:11 : 1321872851*/
App::uses('Controller', 'Controller');
App::uses('Helper', 'View');
App::uses('AppHelper', 'View/Helper');
App::uses('ClassRegistry', 'Utility'); 
App::uses('SitemapHelper', 'WebmasterTools.View/Helper');

/**
 * Sitemap Helper File Test
 *
 * Copyright (c) 2010 David Persson
 *
 * Distributed under the terms of the MIT License.
 * Redistributions of files must retain the above copyright notice.
 *
 * PHP version 5
 * CakePHP version 1.3
 *
 * @package    webmaster_tools
 * @subpackage webmaster_tools.tests.cases.views.helpers
 * @copyright  2010 David Persson <davidpersson@gmx.de>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link       http://sitemaps.org/protocol.php
 */
if(!class_exists('TestController')) {
class TestController extends Controller {
	public $name = 'TheTest';

/**
 * uses property
 *
 * @var mixed null
 */
	public $uses = null;
}
	
}

if(!class_exists('SitemapHelperTestCase')) {
class SitemapHelperTestCase extends CakeTestCase {

	protected $_online;
	
	public function startTest() {
		parent::setUp();
		$this->View = $this->getMock('View', null, array(new TestController()));
		$this->Sitemap = new SitemapHelper($this->View);
	}

	public function endTest() {
		unset($this->Sitemap);
		ClassRegistry::flush();
	}

	public function testAdd() {

	}

	public function testSiteindexXml() {
		$skipped  = $this->skipIf(!class_exists('DomDocument'), '%s DomDocument class not available.');
		$skipped |= $this->skipIf(!$this->_online, '%s Not connected to the internet.');

		if ($skipped) {
			return;
		}

		$this->Sitemap->add(array('controller' => 'site-a', 'action' => 'map', 'ext' => 'xml'), array(
			'title' => 'a map'
		));
		$this->Sitemap->add(array('controller' => 'site-b', 'action' => 'map', 'ext' => 'xml'), array(
			'title' => 'b map'
		));

		$Document = new DomDocument();
		$Document->loadXml($this->Sitemap->generate('indexXml'));
		$result = $Document->schemaValidate('http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd');

		$this->assertTrue($result);
	}

	public function testGenerateTxt() {
		$this->Sitemap->add(array('controller' => 'posts-abcdef', 'action' => 'index'), array(
			'title' => 'post index'
		));
		$this->Sitemap->add(array('controller' => 'posts-abcdef', 'action' => 'add'), array(
			'title' => 'post add',
			'modified' => 'monthly',
			'priority' => 0.4,
			'section' => 'the section'
		));

		$baseUrl = defined('FULL_BASE_URL') ? FULL_BASE_URL : 'http://localhost';

		$result = $this->Sitemap->generate('txt');
		$expected = <<<TXT
{$baseUrl}/posts-abcdef
{$baseUrl}/posts-abcdef/add

TXT;
		$this->assertEqual($expected, $result);
	}

	public function testGenerateXml() {
		$skipped  = $this->skipIf(!class_exists('DomDocument'), '%s DomDocument class not available.');
		$skipped |= $this->skipIf(!$this->_online, '%s Not connected to the internet.');

		if ($skipped) {
			return;
		}

		$this->Sitemap->add(array('controller' => 'posts-abcdef', 'action' => 'index'), array(
			'title' => 'post index'
		));
		$this->Sitemap->add(array('controller' => 'posts-abcdef', 'action' => 'add'), array(
			'title' => 'post add',
			'modified' => 'monthly',
			'priority' => 0.4,
			'section' => 'the section'
		));

		$Document = new DomDocument();
		$Document->loadXml($this->Sitemap->generate('xml'));
		$result = $Document->schemaValidate('http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

		$this->assertTrue($result);
	}

	public function testGenerateHtml() {

		$this->Sitemap->add(array('controller' => 'posts-abcdef', 'action' => 'index'), array(
			'title' => 'post index'
		));
		$this->Sitemap->add(array('controller' => 'posts-abcdef', 'action' => 'add'), array(
			'title' => 'post add',
			'modified' => 'monthly',
			'priority' => 0.4,
			'section' => 'the section'
		));

		$result = $this->Sitemap->generate('html');
		$expected = <<<HTML
<h2></h2><ul class="sitemap"><li><a href="/posts-abcdef">post index</a></li></ul><h2>the section</h2><ul class="sitemap the-section"><li><a href="/posts-abcdef/add">post add</a></li></ul>
HTML;
		$this->assertEqual($expected, $result);
	}

}
}
?>