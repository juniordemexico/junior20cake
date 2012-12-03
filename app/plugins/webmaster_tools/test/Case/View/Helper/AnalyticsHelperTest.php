<?php
/* Analytics Test cases generated on: 2011-11-21 10:11:40 : 1321872880*/
App::uses('Controller', 'Controller');
App::uses('Helper', 'View');
App::uses('AppHelper', 'View/Helper');
App::uses('ClassRegistry', 'Utility'); 
App::uses('AnalyticsHelper', 'WebmasterTools.View/Helper');

if (!defined('FULL_BASE_URL')) {
	define('FULL_BASE_URL', 'http://localhost');
}

/**
 * TestController class
 *
 * @package       Cake.Test.Case.View.Helper
 */
if(!class_exists('TestController')) {
class TestController extends Controller {

/**
 * name property
 *
 * @var string 'TheTest'
 */
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
if(!class_exists('AnalyticsHelperTest')) {
class AnalyticsHelperTest extends CakeTestCase {

	public $Helper;

	protected $_online;
	protected $_backup;
	protected $_settings;
	protected $_debug;

	public function setUp() {
		parent::setUp();
		$this->View = $this->getMock('View', null, array(new TestController()));
		$this->_online = (boolean) @fsockopen('cakephp.org', 80);
		$this->Analytics = new AnalyticsHelper($this->View);
		$this->_debug = Configure::read('debug');
	}

	public function endTest() {
		Configure::write('debug', $this->_debug);
		unset($this->Analytics);
		ClassRegistry::flush();
	}

	public function testConfig() {

		Configure::write('WebmasterTools.googleAnalytics', array(
			'enable' => true,
			'account' => 'TW-834899-34',
			'domainName' => 'example.com',
			'allowLinker' => null,
			'allowHash' => null
		));
		Configure::write('debug', 0);
		$this->Analytics->config(array(
			'enable' => true,
			'account' => 'TW-834599-34',
			'domainName' => 'example2.com',
			'allowLinker' => true,
			'allowHash' => true
		));
		$result = $this->Analytics->generate();
		Configure::write('debug', 2);
		$expected = <<<HTML
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(["_setEnable",true]);
  _gaq.push(["_setAccount","TW-834599-34"]);
  _gaq.push(["_setDomainName","example2.com"]);
  _gaq.push(["_setAllowLinker",true]);
  _gaq.push(["_setAllowHash",true]);

  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = 'http://www.google-analytics.com/ga.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
HTML;
		$this->assertEqual($expected, $result);

	}

	public function testAnonymizeIp() {

		Configure::write('WebmasterTools.googleAnalytics', array(
			'enable' => true,
			'account' => 'TW-834899-34',
			'domainName' => 'example.com',
			'allowLinker' => null,
			'allowHash' => null
		));
		Configure::write('debug', 0);
		$this->Analytics->anonymizeIp();
		$result = $this->Analytics->generate();
		Configure::write('debug', 2);
		$expected = <<<HTML
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(["_gat._anonymizeIp"]);

  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = 'http://www.google-analytics.com/ga.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
HTML;
		$this->assertEqual($expected, $result, 'Test Anonymoze');

	}

	public function testVariable() {

		Configure::write('WebmasterTools.googleAnalytics', array(
			'enable' => true,
			'account' => 'TW-834899-34',
			'domainName' => 'example.com',
			'allowLinker' => null,
			'allowHash' => null
		));
		$this->Analytics->variable('index.php', 'varName2', 'MyThing');
		Configure::write('debug', 0);
		$result = $this->Analytics->generate();
		Configure::write('debug', 2);
		$expected = <<<HTML
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(["_setCustomVar","index.php","varName2","MyThing",3]);

  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = 'http://www.google-analytics.com/ga.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
HTML;
		$this->assertEqual($expected, $result, 'Test Variable');

	}

//	public function testVariableScope() {
//
//		Configure::write('WebmasterTools.googleAnalytics', array(
//			'enable' => true,
//			'account' => 'TW-834899-34',
//			'domainName' => 'example.com',
//			'allowLinker' => null,
//			'allowHash' => null
//		));
//		$this->Analytics->variable('index.php', 'varName', 'myvalue', 'page');
//		$result = $this->Analytics->generate();
//		$expected = <<<HTML
//<script type="text/javascript">
//
//  var _gaq = _gaq || '';
//
//  (function() {
//    var ga = document.createElement('script');
//    ga.type = 'text/javascript';
//    ga.async = true;
//    ga.src = 'http://www.google-analytics.com/ga.js';
//
//    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
//  })();
//
//</script>
//HTML;
//
//		
//		
//		print ('<code><pre>'.h($expected).'</pre></code>');
//		print ('<code><pre>'.h($result).'</pre></code>');
//		$this->assertEqual($expected, $result);
//
//	}

	public function testTrackPageview() {


		Configure::write('WebmasterTools.googleAnalytics', array(
			'enable' => true,
			'account' => 'TW-834899-34',
			'domainName' => 'example.com',
			'allowLinker' => null,
			'allowHash' => null
		));
		$this->Analytics->trackPageview('/pages/about/me');
		Configure::write('debug', 0);
		$result = $this->Analytics->generate();
		Configure::write('debug', 2);
		$expected = <<<HTML
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(["_trackPageview","\/pages\/about\/me"]);

  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = 'http://www.google-analytics.com/ga.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
HTML;
		$this->assertEqual($expected, $result, 'Test PageView');
	}

	public function testGenerate() {

		Configure::write('WebmasterTools.googleAnalytics', array(
			'enable' => true,
			'account' => 'TW-834899-34',
			'domainName' => 'example.com',
			'allowLinker' => null,
			'allowHash' => null
		));
		Configure::write('debug', 0);
		$result = $this->Analytics->generate();
		Configure::write('debug', 2);
		$expected = <<<HTML
<script type="text/javascript">

  var _gaq = _gaq || [];

  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = 'http://www.google-analytics.com/ga.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
HTML;
		$this->assertEqual($expected, $result, 'Test Generate');
		
		Configure::write('debug', 0);
		$result = $this->Analytics->generate(array(
			'reset' => false
		));
		Configure::write('debug', 2);
		$expected = <<<HTML
<script type="text/javascript">

  var _gaq = _gaq || [];

  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = 'http://www.google-analytics.com/ga.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
HTML;
		$this->assertEqual($expected, $result, 'Test Reset');
		
		Configure::write('debug', 2);
		$result = $this->Analytics->generate();
		
		$expected = <<<HTML
<script type="text/javascript">

  var _gaq = _gaq || [];

  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = 'http://www.google-analytics.com/u/ga_debug.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
HTML;
		$this->assertEqual($expected, $result, 'Test Debug');
		
		Configure::write('debug', 0);
		
		// having a specific switch that overides this value would be nicer - since
		// I may want to force it on / off - irrespective of the value that debug main is
		// or is that just me?
		$result = $this->Analytics->generate(array('debug' => true));
		
		$expected = <<<HTML
<script type="text/javascript">

  var _gaq = _gaq || [];

  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = 'http://www.google-analytics.com/u/ga_debug.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
HTML;

		
		
		print ('<code><pre>'.h($expected).'</pre></code>');
		print ('<code><pre>'.h($result).'</pre></code>');
		$this->assertEqual($expected, $result, 'Test Debug passed as arg');
		Configure::write('debug', 2);
	}

}
}
?>