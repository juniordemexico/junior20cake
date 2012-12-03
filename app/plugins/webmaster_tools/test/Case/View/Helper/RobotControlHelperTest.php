<?php
/* RobotControl Test cases generated on: 2011-11-21 10:11:31 : 1321872871*/
App::uses('Controller', 'Controller');
App::uses('Helper', 'View');
App::uses('AppHelper', 'View/Helper');
App::uses('ClassRegistry', 'Utility'); 
App::uses('RobotControlHelper', 'WebmasterTools.View/Helper');

if (!defined('FULL_BASE_URL')) {
	define('FULL_BASE_URL', 'http://localhost');
}

/**
 * TestController class
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

/**
 * Robot Control Helper Class Test
 *
 * @package    webmaster_tools
 * @subpackage webmaster_tools.tests.cases.views.helpers
 */
if(!class_exists('RobotControlHelperTest')) {
class RobotControlHelperTest extends CakeTestCase {

	protected $_online;

	public function setUp() {
		parent::setUp();
		$this->View = $this->getMock('View', null, array(new TestController()));
		$this->_online = (boolean) @fsockopen('cakephp.org', 80);
		$this->RobotControl = new RobotControlHelper($this->View);
	}

	public function endTest() {
		unset($this->RobotControl);
		ClassRegistry::flush();
	}

	public function testAllow() {

		$this->RobotControl->allow('/css/');
		$this->RobotControl->allow('/img/');

		$result = $this->RobotControl->generate();
		$expected = <<<TXT
User-agent: *
Allow: /css/
Allow: /img/

TXT;
		$this->assertEqual($expected, $result);
	}

	public function testDeny() {
		$this->RobotControl->allow('/css/');
		$this->RobotControl->allow('/img/');
		$this->RobotControl->deny('/secret/');

		$result = $this->RobotControl->generate();
		$expected = <<<TXT
User-agent: *
Allow: /css/
Allow: /img/
Disallow: /secret/

TXT;
		$this->assertEqual($expected, $result);
	}

	public function testSitemap() {

		$this->RobotControl->sitemap('/sitemap.xml');

		$result = $this->RobotControl->generate();
		$expectedUrl = FULL_BASE_URL . '/sitemap.xml';
		$expected = <<<TXT
User-agent: *
Sitemap: {$expectedUrl}

TXT;
		$this->assertEqual($expected, $result);
	}

	public function testCrawlBlocks() {
		$this->RobotControl->allow('/test0/');
		$this->RobotControl->allow('/test1/', 'agent0');
		$this->RobotControl->allow('/test2/');

		$result = $this->RobotControl->generate(array('reset' => true));
		$expected = <<<TXT
User-agent: agent0
Allow: /test1/

User-agent: *
Allow: /test0/
Allow: /test2/

TXT;
		$this->assertEqual($expected, $result);

		$this->RobotControl->allow('/test0/', 'agent0');
		$this->RobotControl->allow('/test1/', 'agent1');
		$this->RobotControl->allow('/test2/', 'agent2');
		$this->RobotControl->allow('/test3/');
		$this->RobotControl->allow('/test4/', 'agent2');

		$result = $this->RobotControl->generate(array('reset' => true));
		$expected = <<<TXT
User-agent: agent2
Allow: /test2/
Allow: /test4/

User-agent: agent1
Allow: /test1/

User-agent: agent0
Allow: /test0/

User-agent: *
Allow: /test3/

TXT;
		$this->assertEqual($expected, $result);
	}

	public function testCrawlDelay() {
		$this->RobotControl->crawlDelay(30);

		$result = $this->RobotControl->generate();
		$expected = <<<TXT
User-agent: *
Crawl-delay: 30

TXT;
		$this->assertEqual($expected, $result);
	}

	public function testVisitTime() {
		$this->RobotControl->visitTime('13:00', '20:00');

		$result = $this->RobotControl->generate();
		$expected = <<<TXT
User-agent: *
Visit-time: 13:00 - 20:00

TXT;
		$this->assertEqual($expected, $result);
	}

	public function testRequestRate() {
		$this->RobotControl->requestRate(20, '13:00', '20:00', 'agent0');
		$this->RobotControl->requestRate(20, '13:00', null, 'agent1');
		$this->RobotControl->requestRate(20, null, null, 'agent2');

		$result = $this->RobotControl->generate();
		$expected = <<<TXT
User-agent: agent2
Request-rate: 20/60

User-agent: agent1
Request-rate: 20/60

User-agent: agent0
Request-rate: 20/60 13:00 - 20:00

TXT;
		$this->assertEqual($expected, $result);
	}

	public function testComment() {

	}

	public function testReset() {
		$this->RobotControl->allow('/css/');
		$resultA = $this->RobotControl->generate();
		$resultB = $this->RobotControl->generate();

		$this->assertEqual($resultA, $resultB);

		$resultA = $this->RobotControl->generate(array('reset' => true));
		$resultB = $this->RobotControl->generate();

		$this->assertNotEqual($resultA, $resultB);
	}

}
}
?>