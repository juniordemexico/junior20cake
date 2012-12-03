<?php
/**
 * Sitemap Helper File
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
 * @subpackage webmaster_tools.views.helpers
 * @copyright  2010 David Persson <davidpersson@gmx.de>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link       http://sitemaps.org/protocol.php
 */
App::uses('AppHelper', 'View/Helper');
/**
 * Sitemap Helper Class
 *
 * @package    webmaster_tools
 * @subpackage webmaster_tools.views.helpers
 */
class SitemapHelper extends AppHelper {

	public $format = 'xml'; // xml, txt or html, indexXml

	public $helpers = array('Html');

	protected $_data = array();

	protected $_maxUrls = 50000;

	protected $_maxSize = 10485760;

	public function add($url, $options = array()) {
		$defaults = array(
			'modified' => null,
			'changes' => null, // always, hourly, daily, weekly, monthly, yearly, never.
			'priority' => null, // 0.0 - 1.0 (most important), 0.5 is considered the default.
			'title' => null, // For XML used as comment, otherwise for HTML.
			'section' => null, // Used for HTML only.
			'images' => array()
		);
		$this->_data[] = compact('url') + $options + $defaults;
	}

	public function generate($format = 'xml', array $options = array()) {
		$defaults = array('reset' => false);
		extract($options + $defaults);

		if (!method_exists($this, '_generate' . ucfirst($format))) {
			$message = 'SitemapHelper::generate - Invalid format given';
			trigger_error($message, E_USER_WARNING);
			return;
		}
		if (count($this->_data) > $this->_maxUrls) {
			$message  = "SitemapHelper::generate - More than {$this->_maxUrls} URLs";
			trigger_error($message, E_USER_WARNING);
		}

		$result = $this->{"_generate" . ucfirst($format)}();

		if ($reset) {
			$this->_data = array();
		}
		if (strlen($result) > $this->_maxSize) {
			$message  = "SitemapHelper::generate - Result document exceeds {$this->_maxSize} bytes";
			trigger_error($message, E_USER_WARNING);
		}
		return $result;
	}

	protected function _generateHtml() {
		$html = null;
		$sections = array();

		foreach ($this->_data as $item) {
			$sections[$item['section']][] = $item;
		}
		ksort($sections);

		foreach ($sections as $section => $items) {
			$html .= $this->Html->tag('h2', $section);
			$sectionHtml = '';

			foreach ($items as $item) {
				$sectionHtml .= $this->Html->tag(
					'li', $this->Html->link($item['title'], $item['url'])
				);
			}
			$class = 'sitemap';

			if ($section) {
				$class .= ' ' . strtolower(Inflector::slug($section, '-'));
			}
			$html .= $this->Html->tag('ul', $sectionHtml, compact('class'));
		}
		return $html;
	}

	protected function _generateXml() {
		$Document = new DomDocument('1.0', 'UTF-8');
		$Set = $Document->createElementNs(
			'http://www.sitemaps.org/schemas/sitemap/0.9', 'urlset'
		);
		$Set->setAttributeNs(
			'http://www.w3.org/2001/XMLSchema-instance',
			'xsi:schemaLocation',
			'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'
		);

		foreach ($this->_data as $item) {
			$Page = $Document->createElement('url');

			if ($item['title']) {
				$Page->appendChild($Document->createComment($item['title']));
			}
			$Page->appendChild($Document->createElement('loc', h($this->url($item['url'], true))));

			if ($item['modified']) {
				$Page->appendChild($Document->createElement('lastmod', date('c', strtotime($item['modified']))));
			}
			if ($item['changes']) {
				$Page->appendChild($Document->createElement('changefreq', $item['changes']));
			}
			if ($item['priority']) {
				$Page->appendChild($Document->createElement('priority', $item['priority']));
			}
			$Set->appendChild($Page);
		}
		$Document->appendChild($Set);

		return $Document->saveXml();
	}

	// @link http://www.sitemaps.org/protocol.php#otherformats
	protected function _generateTxt() {
		$result = null;

		foreach ($this->_data as $item) {
			$result .= $this->url($item['url'], true) . "\n";
		}
		return $result;
	}

	protected function _generateIndexXml() {
		$Document = new DomDocument('1.0', 'UTF-8');
		$Set = $Document->createElementNs(
			'http://www.sitemaps.org/schemas/sitemap/0.9', 'sitemapindex'
		);
		$Set->setAttributeNs(
			'http://www.w3.org/2001/XMLSchema-instance',
			'xsi:schemaLocation',
			'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd'
		);

		foreach ($this->_data as $item) {
			$Map = $Document->createElement('sitemap');

			if ($item['title']) {
				$Map->appendChild($Document->createComment($item['title']));
			}
			$Map->appendChild($Document->createElement('loc', h($this->url($item['url'], true))));

			if ($item['modified']) {
				$Map->appendChild($Document->createElement('lastmod', date('c', strtotime($item['modified']))));
			}
			$Set->appendChild($Map);
		}
		$Document->appendChild($Set);

		return $Document->saveXml();
	}

}